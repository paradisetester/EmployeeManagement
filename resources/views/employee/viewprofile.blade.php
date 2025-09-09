<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HRM Dashboard - Profile</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- FontAwesome Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}" type="text/css" />
</head>
<body>
<div class="container-fluid">
  <div class="row">
    @include('admin.sidebar')

    <main class="col-md-10 ms-sm-auto px-4 py-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">My Profile</h2>
        <div class="dropdown">
          <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            @if($user->profile_image)
              <img src="{{ asset('images/profiles/' . $user->profile_image) }}" class="rounded-circle me-2" width="40" height="40" alt="Profile">
            @else
              <img src="https://via.placeholder.com/60" class="rounded-circle me-2" width="40" height="40" alt="Profile">
            @endif
            <span>{{ $user->name }}</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="/profile">Profile</a></li>
            <li><a class="dropdown-item" href="/logout">Logout</a></li>
          </ul>
        </div>
      </div>

      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-4">
          <div class="row">
            <!-- Profile Image Section -->
            <div class="col-md-3 text-center border-end">
              <img src="{{ $user->profile_image ? asset('images/profiles/' . $user->profile_image) : 'https://via.placeholder.com/150' }}" 
                   class="rounded-circle img-fluid mb-3 shadow-sm" 
                   style="width: 150px; height: 150px; object-fit: cover;" 
                   alt="Profile">
              <form action="{{ route('employee.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="file" name="profile_image" class="form-control mb-2" accept="image/*">
                <button type="submit" class="btn btn-sm btn-primary w-100">Update Photo</button>
              </form>
            </div>

            <!-- Profile Info Section -->
            <div class="col-md-9">
              <form action="{{ route('employee.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">First Name</label>
                    <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}" disabled>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Last Name</label>
                    <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}" disabled>
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label fw-bold">Full Name</label>
                  <input type="text" class="form-control" name="name" value="{{ $user->name }}" disabled>
                </div>

                <div class="mb-3">
                  <label class="form-label fw-bold">Email</label>
                  <input type="email" class="form-control" name="email" value="{{ $user->email }}" disabled>
                </div>

                <div class="mb-3">
                  <label class="form-label fw-bold">Phone</label>
                  <input type="text" class="form-control" name="phone" value="{{ $user->phone }}">
                </div>

                <div class="mb-3">
                  <label class="form-label fw-bold">Role</label>
                  <input type="text" class="form-control" value="{{ ucfirst($user->role) }}" disabled>
                </div>

                <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-success px-4">Save Changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </main>
  </div>
</div>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
