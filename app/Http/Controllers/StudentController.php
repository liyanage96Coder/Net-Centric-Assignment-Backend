<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;


class StudentController extends Controller
{

    public function index() : JsonResponse
    {
        try {
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved students',
                'students' => Student::where('active', 1)->get()
            ],200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while getting students!',
        ],500);
    }

     function get($id): JsonResponse
    {
        try {
            return response()->json([
                'error' => false,
                'message' => 'Successfully retrieved student',
                'student' => Student::findOrFail($id)
            ],200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while getting student!',
        ],500);
    }

    function create(Request $request): JsonResponse
    {
        try {
            $student = new Student;
            $this->getData($request, $student);

            return response()->json([
                'error' => false,
                'message' => 'Successfully created student',
                'student' => $student
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while creating student!',
        ]);
    }

    public function delete($id): JsonResponse
    {
        try {
            $student = Student::findOrFail($id);
            $student->update(['active' => false]);

            return response()->json([
                'error' => false,
                'message' => 'Successfully deleted student',
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while deleting student!',
        ]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $student = Student::findOrFail($id);
            $this->getData($request, $student);

            return response()->json([
                'error' => false,
                'message' => 'Successfully updated student',
                'student' => $student
            ],200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        return response()->json([
            'error' => true,
            'message' => 'An error occurred while updating student!',
        ],500);
    }

    private function getData($request, $student)
    {
        $student->name = $request->name;
        $student->dob = $request->dob;
        $student->gpa = $request->gpa;
        $student->gender = $request->gender;
        $student->email = $request->email;
        $student->save();
    }
}

