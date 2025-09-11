<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HRM Dashboard - Attendance</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}" type="text/css" />
</head>
<body>
<div class="container-fluid">
  <div class="row">
    @include('admin.sidebar')

    <main class="col-md-10 ms-sm-auto px-4 py-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">My Attendance</h2>
        <div class="dropdown">
          <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            @if(auth()->user()->profile_image)
              <img src="{{ asset('images/profiles/' . auth()->user()->profile_image) }}" class="rounded-circle me-2" width="40" height="40" alt="Profile">
            @else
              <img src="https://via.placeholder.com/60" class="rounded-circle me-2" width="40" height="40" alt="Profile">
            @endif
            <span>{{ auth()->user()->name }}</span>
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

      @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif

      <!-- Today's Attendance Card -->
      <div class="card shadow-sm border-0 rounded-3 mb-4">
        <div class="card-body p-4">
          <h5 class="card-title mb-3">Today's Attendance - {{ now()->format('F d, Y') }}</h5>
          
          <div class="row">
            <div class="col-md-6">
              <div class="d-flex align-items-center mb-3">
                <i class="fas fa-clock text-success me-2"></i>
                <span class="fw-bold">Current Time: </span>
                <span id="currentTime" class="ms-2"></span>
              </div>
              
              @if($todayAttendance)
                <div class="row">
                  <div class="col-6">
                    <div class="text-center p-3 bg-light rounded">
                      <i class="fas fa-sign-in-alt text-success mb-2"></i>
                      <p class="mb-1 fw-bold">Check In</p>
                      <p class="mb-0">{{ $todayAttendance->check_in }}</p>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="text-center p-3 bg-light rounded">
                      <i class="fas fa-sign-out-alt text-danger mb-2"></i>
                      <p class="mb-1 fw-bold">Check Out</p>
                      <p class="mb-0">{{ $todayAttendance->check_out ?? 'Not checked out' }}</p>
                    </div>
                  </div>
                </div>
                
                <div class="mt-3">
                  <span class="badge bg-{{ $todayAttendance->status === 'present' ? 'success' : ($todayAttendance->status === 'late' ? 'warning' : 'danger') }}">
                    {{ ucfirst($todayAttendance->status) }}
                  </span>
                </div>
              @else
                <div class="text-center p-4 bg-light rounded">
                  <i class="fas fa-calendar-times text-muted mb-2" style="font-size: 2rem;"></i>
                  <p class="text-muted">No attendance recorded for today</p>
                </div>
              @endif
            </div>
            
            <div class="col-md-6">
              <div class="d-flex flex-column gap-2">
                @if(!$todayAttendance)
                  <form action="{{ route('attendance.checkin') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success btn-lg w-100">
                      <i class="fas fa-sign-in-alt me-2"></i>Check In
                    </button>
                  </form>
                @elseif(!$todayAttendance->check_out)
                  <form action="{{ route('attendance.checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-lg w-100">
                      <i class="fas fa-sign-out-alt me-2"></i>Check Out
                    </button>
                  </form>
                @else
                  <div class="alert alert-info text-center">
                    <i class="fas fa-check-circle me-2"></i>
                    You have completed your attendance for today!
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Recent Attendance History -->
      <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-4">
          <h5 class="card-title mb-3">Recent Attendance History</h5>
          
          @if($recentAttendances->count() > 0)
            <div class="table-responsive">
              <table class="table table-hover">
                <thead class="table-light">
                  <tr>
                    <th>Date</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Status</th>
                    <th>Working Hours</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($recentAttendances as $attendance)
                    <tr>
                      <td>{{ $attendance->date->format('M d, Y') }}</td>
                      <td>{{ $attendance->check_in ?? '-' }}</td>
                      <td>{{ $attendance->check_out ?? '-' }}</td>
                      <td>
                        <span class="badge bg-{{ $attendance->status === 'present' ? 'success' : ($attendance->status === 'late' ? 'warning' : 'danger') }}">
                          {{ ucfirst($attendance->status) }}
                        </span>
                      </td>
                      <td>
                        @if($attendance->check_in && $attendance->check_out)
                          @php
                            $checkIn = \Carbon\Carbon::parse($attendance->check_in);
                            $checkOut = \Carbon\Carbon::parse($attendance->check_out);
                            $hours = $checkOut->diffInHours($checkIn);
                            $minutes = $checkOut->diffInMinutes($checkIn) % 60;
                          @endphp
                          {{ $hours }} hours {{ $minutes }} minutes
                        @else
                          -
                        @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <div class="text-center p-4">
              <i class="fas fa-calendar-alt text-muted mb-2" style="font-size: 3rem;"></i>
              <p class="text-muted">No attendance records found</p>
            </div>
          @endif
        </div>
      </div>

    </main>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function updateTime() {
    const now = new Date();
    const timeString = now.toLocaleTimeString();
    document.getElementById('currentTime').textContent = timeString;
  }
  
  updateTime();
  setInterval(updateTime, 1000);
</script>
</body>
</html>