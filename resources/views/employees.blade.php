<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HRM Dashboard - Employees</title>
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- FontAwesome Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{asset ('css/admin/style.css') }}" type="text/css" />
</head>
<body>
<div class="container-fluid">
  <div class="row">
    @include('admin.sidebar') <!-- Sidebar -->

    <!-- Main Content -->
    <main class="col-md-10 ms-sm-auto px-4 py-4">
      
      <!-- Header -->
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Employees</h2>
        <a href="{{ route('employees.create') }}" class="btn btn-success">Add New Employee</a>
      </div>

      <!-- Success message -->
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <!-- Employees Table -->
      <div class="card p-3 mb-4">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($employees as $employee)
              <tr>
                <td>{{ $employee->id }}</td>
                <td>{{ $employee->first_name }}</td>
                <td>{{ $employee->last_name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->phone ?? '-' }}</td>
                <td>
                  <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-primary">
                    <i class="fa fa-edit"></i> Edit
                  </a>

                  <form action="{{ route('employees.destroy', $employee) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this employee?')">
                      <i class="fa fa-trash"></i> Delete
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center">No employees found.</td>
              </tr>
            @endforelse
          </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
          {{ $employees->links() }}
        </div>
      </div>
      
      <!-- Stats Cards (optional, from your original dashboard) -->
      <div class="row g-3 mb-4">
        <div class="col-md-3">
          <div class="card stat-card p-3">
            <h6>Total Employees</h6>
            <h3>{{ $employees->count() }}</h3>
          </div>
        </div>
        <!-- Add other stats cards if needed -->
      </div>

    </main>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
