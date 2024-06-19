<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class GoalController extends Controller
{
    public function progressAction(Request $request)
    {
        $errors = $this->validateRequest($request);
        if ($errors) {
            return $errors;
        }

        $employeeId = (int)$request->input('employee_id');
        $progress = (int)$request->input('progress');
        $goalId = (int)$request->input('goal_id');
        $goal = Goal::find($employeeId);

        if (!$this->isGoalBelongToEmployee($goal, $employeeId)) {
            return $this->errorResponse();
        }

        $this->updateGoalProgress($goal, $progress);

        return $this->successResponse();
    }

    private function validateRequest(Request $request)
    {
        try {
            $request->validate([
                'employee_id' => ['required', 'integer', 'exists:Employee,id'],
                'progress' => ['required', 'integer', 'min:0', 'max:100'],
                'goal_id' => ['required', 'integer', 'exists:Goal,id'],
            ]);
        } catch (ValidationException $th) {
            return $th->validator->errors();
        }

        return null;
    }

    private function isGoalBelongToEmployee($goal, $employeeId): bool
    {
        return $goal->employee_id === $employeeId;
    }

    private function updateGoalProgress($goal, $progress): void
    {
        $goal->progress = $progress;
        $goal->save();
    }

    private function successResponse(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Goal progress updated successfully',
        ], 200);
    }

    private function errorResponse(): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'message' => 'This goal does not belong to this employee',
        ], 404);
    }
}


