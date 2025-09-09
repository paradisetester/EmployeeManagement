<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
     public function index()
    {
        $employees = User::where('role', 'employee')->paginate(10);
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
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|max:255',
            'phone'      => 'nullable|string|max:20',
        ]);

        $data['role'] = 'employee';
        $data['name'] = $data['first_name'] . ' ' . $data['last_name'];
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
    }  

// Show edit form
public function edit(User $employee)
{
    return view('admin.employee.edit', compact('employee'));
}

// Update employee
public function update(Request $request, User $employee)
{
    $data = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name'  => 'nullable|string|max:255',
        'email'      => 'required|email|unique:users,email,' . $employee->id,
        'reset_password' => 'nullable|string|max:255',
        'phone'      => 'nullable|string|max:20',
    ]);

    $data['name'] = $data['first_name'] . ' ' . $data['last_name'];

    if (!empty($data['reset_password'])) {
        $data['password'] = Hash::make($data['reset_password']);
    }
    unset($data['reset_password']);

    $employee->update($data);

    return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
}


    public function destroy(User $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
