<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //show all listings
    public function index()
    {
        return view('admin.employees.index', [
            'employees' => Employee::all()
        ]);
    }

    //create form
    public function create()
    {
        return view('admin.employees.create');
    }

    //store employee
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|numeric|digits:10',
            'email' => 'required|email|max:255',
            'hire_date' => 'required',
            'type' => 'required',
        ]);

        Employee::create($formFields);

        return redirect('/admin/employees')->with('message', 'Employee created successfully!');
    }

    //edit form
    public function edit(Employee $employee)
    {
        return view('admin.employees.edit', ['employee' => $employee]);
    }

    //update employee
    public function update(Request $request, Employee $employee)
    {
        $formFields = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|numeric|digits:10',
            'email' => 'required|email|max:255',
            'hire_date' => 'required',
            'type' => 'required',
        ]);

        $employee->update($formFields);

        return redirect('/admin/employees')->with('message', 'Employee updated successfully!');
    }

    //delete employee
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect('/admin/employees')->with('message', 'Employee deleted successfully');
    }
}
