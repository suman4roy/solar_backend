<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
        public function addUpdateEmployee(Request $request, $id = null)
        {
            $validation = Validator::make($request->all(),[ 
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'phone' => 'required|string|max:255',
                'address' => 'required|string|max:255',
            ]);

            if($validation->fails()){
                return response()->json([
                    'status' => 500,
                    'message' => 'Validation failed',
                    'err' => $validation->errors()
                ], 500);
            }

            try {
                $data = Employee::updateOrCreate(
                    ['id' => $id],
                    [
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    ]
                );
                return response()->json([
                    'status' => 200,
                    'message' => 'Employee added or updated successfully',
                    'data' => $data
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong in server',
                    'err' => $e->getMessage()
                ], 500);
            }
        }

        public function deleteEmployee($id)
        {
            try {
                $employee = Employee::find($id);
                
                if (!$employee) {
                    return response()->json([
                        'status' => 404,
                        'message' => 'Employee not found'
                    ], 404);
                }

                $employee->delete();

                return response()->json([
                    'status' => 200,
                    'message' => 'Employee deleted successfully'
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong in server',
                    'err' => $e->getMessage()
                ], 500);
            }
        }
}
