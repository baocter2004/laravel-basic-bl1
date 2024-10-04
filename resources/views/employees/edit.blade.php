@extends('master')

@section('title')
    Sửa Nhân Viên
@endsection

@section('content')
    @if (session()->has('success') && !session()->get('success'))
        <div class="alert alert-danger">
            {{ session()->get('error', 'Có lỗi xảy ra!') }} <!-- Cung cấp một thông báo mặc định -->
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('employees.update', $employee) }}" method="POST" enctype="multipart/form-data" class="mt-5">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" value="{{ $employee->first_name }}" name="first_name"
                    id="first_name" placeholder="John">
            </div>
            <div class="col-md-6">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" value="{{ $employee->last_name }}" name="last_name"
                    id="last_name" placeholder="Doe">
            </div>
        </div>

        <div class="row g-3 mt-3">
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" value="{{ $employee->email }}" name="email" id="email"
                    placeholder="example@email.com">
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" value="{{ $employee->phone }}" name="phone" id="phone"
                    placeholder="0123456789">
            </div>
        </div>

        <div class="mt-3 mb-4">
            <label for="">salary</label>
            <input type="text" name="salary" class="form-control" value="{{ $employee->salary }}">
        </div>

        <div class="row g-3 mt-3">
            <div class="col-md-6">
                <label for="date_of_birth" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" value="{{ $employee->date_of_birth }}" name="date_of_birth"
                    id="date_of_birth">
            </div>
            <div class="col-md-6">
                <label for="hire_date" class="form-label">Hire Date</label>
                <input type="datetime-local" class="form-control" value="{{ $employee->hire_date }}" name="hire_date"
                    id="hire_date">
            </div>
        </div>

        <div class="row g-3 mt-3">
            <div class="col-md-6">
                <label for="department_id" class="form-label">Department ID</label>
                <input type="number" class="form-control" value="{{ $employee->department_id }}" name="department_id"
                    id="department_id" placeholder="1">
            </div>
            <div class="col-md-6">
                <label for="manager_id" class="form-label">Manager ID</label>
                <input type="number" class="form-control" value="{{ $employee->manager_id }}" name="manager_id"
                    id="manager_id" placeholder="2">
            </div>
        </div>

        <div class="row g-3 mt-3">
            <div class="col-md-6">
                <label for="profile_picture" class="form-label">Profile Picture</label>
                <input type="file" class="form-control" value="" name="profile_picture" id="profile_picture">
                <img src="{{ Storage::url($employee->profile_picture) }}" alt="" width="100px">
            </div>
            <div class="col-md-6">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" name="address" id="address" rows="3" placeholder="Enter address...">{{ $employee->address }}</textarea>
            </div>
        </div>

        <div class="mt-3 mb-3">
            <label for="">is_active</label>
            <input type="checkbox" @checked($employee->is_active) name="is_active" class="form-checkbox" value="1">
        </div>

        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary ms-2">Back to List</a>
        </div>
    </form>
@endsection
