@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    @include('admin.sidebar') <!-- Sidebar -->

    <!-- Main Content -->
    <main class="col-md-10 ms-sm-auto px-4 py-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Edit Employee</h2>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back to Employees</a>
        </div>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Employee Edit Form -->
        <div class="card p-4">
            <form action="{{ route('employees.update', $employee) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">First Name *</label>
                    <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $employee->first_name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $employee->last_name) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email *</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $employee->email) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $employee->phone) }}">
                </div>

                <button type="submit" class="btn btn-success">Update Employee</button>
                <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </main>
  </div>
</div>

<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f8f9fa;
    }
    .card {
        border-radius: 12px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
     .sidebar {
      min-height: 100vh;
      background-color: #fff;
      border-right: 1px solid #ddd;
    }
    .sidebar .nav-link.active {
      background-color: #e9f8ef;
      color: #28a745;
      font-weight: bold;
    }   
</style>
@endsection
