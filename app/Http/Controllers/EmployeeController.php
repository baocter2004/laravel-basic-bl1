<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    const PATH_VIEW = 'employees.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Employee::latest('id')
            ->join('departments as d', 'employees.department_id', '=', 'd.id')
            ->join('managers as e', 'employees.manager_id', '=', 'e.id')
            ->select([
                'employees.id',
                'employees.first_name',
                'employees.last_name',
                'employees.email',
                'employees.phone',
                'employees.profile_picture',
                'employees.date_of_birth',
                'employees.hire_date',
                'employees.salary',
                'employees.is_active',
                'employees.address',
                'employees.created_at',
                'employees.updated_at',
                'd.id as department_id',
                'd.name as department_name',
                'e.id as manager_id',
                'e.name as manager_name'
            ])
            ->paginate(10);
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dataM = Manager::get(['id', 'name']);
        $dataD = Department::get(['id', 'name']);
        return view(self::PATH_VIEW . __FUNCTION__, ['dataM' => $dataM, 'dataD' => $dataD]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());

        $data = $request->validate(
            [
                'first_name' => 'required|max:100',
                'last_name' => 'required|max:100',
                'email' => [
                    'required',
                    'max:150',
                    Rule::unique('employees')
                ],
                'phone' => 'required|string|max:30',
                'date_of_birth' => 'required|date',
                'hire_date' => 'required|date',
                'salary' => 'required|numeric',
                'is_active' => [
                    'nullable',
                    Rule::in([0, 1])
                ],
                'department_id' => 'nullable',
                'manager_id' => 'nullable',
                'address' => 'required'
            ]
        );

        try {

            if ($request->hasFile('profile_picture')) {
                $data['profile_picture'] = Storage::put('employees', $request->file('profile_picture'));
            };

            Employee::query()->create($data);

            return redirect()
                ->route('employees.index')
                ->with('success', true);
        } catch (\Throwable $th) {
            if (!empty($data['profile_picture']) && Storage::exists($data['profile_picture'])) {
                Storage::delete($data['profile_picture']);
            }

            return back()
                ->with('success', false);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate(
            [
                'first_name' => 'required|max:100',
                'last_name' => 'required|max:100',
                'email' => [
                    'required',
                    'max:150',
                    Rule::unique('employees')->ignore($employee->id)
                ],
                'phone' => 'required|string|max:30',
                'date_of_birth' => 'required|date',
                'hire_date' => 'required|date',
                'salary' => 'required|numeric',
                'is_active' => [
                    'nullable',
                    Rule::in([0, 1])
                ],
                'department_id' => 'nullable',
                'manager_id' => 'nullable',
                'address' => 'required'
            ]
        );

        try {

            $data['is_active'] = isset($data['is_active']) ? $data['is_active'] : 0;

            if ($request->hasFile('profile_picture')) {
                $data['profile_picture'] = Storage::put('employees', $request->file('profile_picture'));
            };

            $currentImg = $employee->profile_picture;

            $employee->update($data);

            if (
                !empty($currentImg)
                && Storage::exists($data['profile_picture'])
                && $request->hasFile('profile_picture')
            ) {
                Storage::delete($currentImg);
            }

            return redirect()
                ->route('employees.index')
                ->with('success', true);
        } catch (\Throwable $th) {

            if (!empty($data['profile_picture']) && Storage::exists($data['profile_picture'])) {
                Storage::delete($data['profile_picture']);
            }

            return back()
                ->with('success', false)
                ->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {
            $employee->forceDelete();

            if (!empty($employee->profile_picture) && Storage::exists($employee->profile_picture)) {
                Storage::delete($employee->profile_picture);
            }

            return redirect()
                ->route('employees.index')
                ->with('success', true);
        } catch (\Throwable $th) {
            return back()
                ->with('success', false);
        }
    }
}
