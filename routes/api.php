<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix'=>'v1'], function(){
    Route::apiResource('questions', 'QuestionsController');//CRUD for questions
    Route::apiResource('categories', 'CategoriesController');//CRUD for categoris
    Route::apiResource('quiz', 'QuizController');//CRUD for Quiz
});



