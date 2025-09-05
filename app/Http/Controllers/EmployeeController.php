<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
     public function index()
    {
        $employees = Employee::paginate(10); // fetch all with pagination
        return view('employees', compact('employees'));
    }

  
    // Show form to create new employee
    public function create()
    {
        return view('admin.employee.create');

    }

    // Store new employee
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'nullable|string|max:255',
            'email'      => 'required|email|unique:employees,email',
            'phone'      => 'nullable|string|max:20',
        ]);

        Employee::create($data);

        return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
    }  

// Show edit form
public function edit(Employee $employee)
{
    return view('admin.employee.edit', compact('employee'));
}

// Update employee
public function update(Request $request, Employee $employee)
{
    $data = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name'  => 'nullable|string|max:255',
        'email'      => 'required|email|unique:employees,email,' . $employee->id,
        'phone'      => 'nullable|string|max:20',
    ]);

    $employee->update($data);

    return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
}


    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
