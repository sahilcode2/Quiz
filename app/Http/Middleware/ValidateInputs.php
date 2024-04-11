<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Validator;

class ValidateInputs
{
    public function handle($request, Closure $next, $switchValue)
    {
        $rules = $this->getValidationRules($switchValue);

        // Perform validation
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->first()], 422);
        }

        // Merge validated values into the request
        $request->merge(['validated_data' => $validator->validated()]);
        return $next($request);
    }

    protected function getValidationRules($switchValue)
    {
        switch ($switchValue) {
            case 'case1':
                return [
                    'title' => 'required|string|max:255',
                    'description' => 'required|string',
                ];
            default:
                return [
                    'title' => 'required',
                    'description' => 'required',
                ];
        }
    }
}
