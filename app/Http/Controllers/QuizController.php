<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\Question;
use App\QuizQuestion;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    /**
     * Display a listing of all the categoriess.
     */
    public function index()
    {
        // Fetch all quizzes with their associated questions and categories using eager loading
        $quizzes = Quiz::with('questions.question')->get();

        // Return a JSON response containing the quizzes and their questions along with categories
        return response()->json([
            'quizzes' => $quizzes,
        ], 200);
    }

    /**
     * Store a newly created quiz in library.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:25',
            'content' => 'required|string|max:255',
            'total_questions' => 'required|numeric|min:1',
            'is_random_category' => 'required|numeric|min:0|max:1',
            'categories' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $validatedData = $validator->validated();
        
        // If categories are provided, convert the comma-separated string of categories into an array
        if (isset($validatedData['is_random_category'])) {
            // Fetch all categories from the database
            $categories = Category::pluck('id')->toArray();
        } else {
            $categories = explode(',', $validatedData['categories']);
        }

        // Calculate the number of questions per category
        $numCategories = count($categories);
        $questionsPerCategory = intval($validatedData['total_questions'] / $numCategories);

        // Check if the total questions are evenly divisible among categories
        $remainingQuestions = $validatedData['total_questions'] % $numCategories;

        // Create a new quiz instance
        $quiz = new Quiz();
        $quiz->title = $validatedData['title'];
        $quiz->content = $validatedData['content'];
        $quiz->total_questions = $validatedData['total_questions'];
        $quiz->is_random_category = $validatedData['is_random_category'];
        $quiz->categories = empty($validatedData['categories']) ? 'random' : $validatedData['categories'];

        // Save the quiz to the database
        $quiz->save();

        $quizQuestionData = [];

        // Fetch questions for each category from the database
        foreach ($categories as $category) {
            $categoryQuestions = min($questionsPerCategory + ($remainingQuestions-- > 0 ? 1 : 0), $numCategories);
        
            // Fetch questions from the database based on the category
            $questions = Question::where('category_id', $category)->inRandomOrder()->limit($categoryQuestions)->get();
        
            // Create an array of quiz_question data
            foreach ($questions as $question) {
                $quizQuestionData[] = [
                    'quiz_id' => $quiz->id,
                    'question_id' => $question->id,
                    'category_id' => $category,
                ];
            }
        }

        // Bulk insert the quiz_question data
        QuizQuestion::insert($quizQuestionData);

        // Return a JSON response indicating success
        return response()->json([
            'message' => 'Quiz created successfully',
            'quiz' => $quiz,
        ], 201);
    }

    /**
     * Display the specified quiz.
     */
    public function show(Quiz $quiz)
    {
        return $quiz;
    }

    /**
     * Update the specified quiz in library.
     */
    public function update($id, Request $request)
    {
        $quiz = Quiz::find($id);
        if ($quiz == null) {
            return response()->json(['errors' => 'Quiz Not Found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:25'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        $quiz->update($validator->validated());
        return $quiz;
    }

    /**
     * Remove the specified quiz from library.
     */
    public function destroy($id)
    {
        $quiz = Quiz::find($id);
        if ($quiz == null) {
            return response()->json(['errors' => 'Quiz Not Found'], 404);
        }

        $quiz->delete();
        return response()->json(['message' => 'Quiz deleted successfully']);
    }
}
