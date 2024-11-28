<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function store(Request $request){
        try {
            $validated = Validator::make($request->all(), [
                'firstLastName' => 'required|string|max:20|regex:/^[A-Z]+$/',
                'secondLastName' => 'required|string|max:20|regex:/^[A-Z]+$/',
                'firstName' => 'required|string|max:20|regex:/^[A-Z]+$/', 
                'middleName' => 'nullable|string|max:50|regex:/^[A-Z\s]+$/', 
                'typeId' => 'required|string',
                'doc' => 'required|string|regex:/^[a-zA-Z0-9-]+$/|max:20|unique:employees,doc', 
                'area' => 'required|string',
                'startDate' => 'required|date|after_or_equal:' . Carbon::now()->subMonth()->toDateString() . '|before_or_equal:' . Carbon::now()->toDateString(),
            ]);
    
            if($validated->fails()){
                return response()->json([
                    'success' => false,
                    'message' => 'Error en la validación de datos',
                    'errors' => $validated->errors(),
                ], 400);
            }

            $emailBase = strtolower($request->firstName . '.' . $request->firstLastName . '@cidenet.com.co');
            
            $email = $emailBase;
            $counter = 1;

            while (Employee::where('email', $email)->exists()) {
                $email = strtolower($request->firstName . '.' . $request->firstLastName . '.' . $counter . '@cidenet.com.co');
                $counter++; 
            }

            $employee = Employee::create([
                'firstLastName' => $request->firstLastName,
                'secondLastName' => $request->secondLastName,
                'firstName' => $request->firstName,
                'middleName' => $request->middleName ?? '', 
                'country' => $request->country,
                'typeId' => $request->typeId,
                'email' => $email,
                'area' => $request->area,
                'doc' => $request->doc,
                'startDate' => $request->startDate,
            ]);
    
            return response()->json([
                'success' => true,
                'message' => 'Employee successfully registered',
            ]);
    
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unspected Error',
                'errors' => ['general' => $e->getMessage()],
            ], 422);
        }
    }

    public function deleteEmployee(Request $request, $id)
{
    $employee = Employee::find($id);

    if ($employee) {
        $employee->delete();
        return response()->json([
            'success' => true,
            'message' => 'Employee successfully deleted'
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Employee not found'
    ], 404);
}

public function editEmployee(Request $request, $id)
{
    try {
        $validated = Validator::make($request->all(), [
            'firstLastName' => 'required|string|max:20|regex:/^[A-Z]+$/',
            'secondLastName' => 'required|string|max:20|regex:/^[A-Z]+$/',
            'firstName' => 'required|string|max:20|regex:/^[A-Z]+$/', 
            'middleName' => 'nullable|string|max:50|regex:/^[A-Z\s]+$/', 
            'doc' => 'required|string|regex:/^[a-zA-Z0-9-]+$/|max:20|unique:employees,doc,'.$id, 
            'area' => 'required|string',
        ]);

        if($validated->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Error en la validación de datos',
                'errors' => $validated->errors(),
            ], 400);
        }

        $employee = Employee::findOrFail($id);

        $emailBase = strtolower($request->firstName . '.' . $request->firstLastName . '@cidenet.com.co');
        
        $email = $emailBase;
        $counter = 1;

        while (Employee::where('email', $email)->where('id', '!=', $id)->exists()) {
            $email = strtolower($request->firstName . '.' . $request->firstLastName . '.' . $counter . '@cidenet.com.co');
            $counter++; 
        }

        $employee->firstLastName = $request->firstLastName;
        $employee->secondLastName = $request->secondLastName;
        $employee->firstName = $request->firstName;
        $employee->middleName = $request->middleName;
        $employee->doc = $request->doc;
        $employee->area = $request->area;
        $employee->email = $email;
        
        $employee->save();

        return response()->json([
            'success' => true,
            'message' => 'Employee updated successfully',
        ]);

    } catch (Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Unexpected Error',
            'errors' => ['general' => $e->getMessage()],
        ], 422);
    }
}

}
    

