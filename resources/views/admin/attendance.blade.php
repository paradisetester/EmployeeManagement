<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HRM Dashboard - Employee Attendance</title>
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
        <h2 class="fw-bold">Employee Attendance</h2>
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

      <!-- View Toggle and Filters -->
      <div class="card shadow-sm border-0 rounded-3 mb-4">
        <div class="card-body p-3">
          <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-3">
              <label class="form-label">View Type</label>
              <select name="view" class="form-select" onchange="this.form.submit()">
                <option value="daily" {{ $view === 'daily' ? 'selected' : '' }}>Daily View</option>
                <option value="monthly" {{ $view === 'monthly' ? 'selected' : '' }}>Monthly View</option>
              </select>
            </div>
            
            @if($view === 'daily')
              <div class="col-md-3">
                <label class="form-label">Date</label>
                <input type="date" name="date" class="form-control" value="{{ $date }}" onchange="this.form.submit()">
              </div>
            @else
              <div class="col-md-3">
                <label class="form-label">Month</label>
                <input type="month" name="month" class="form-control" value="{{ $month }}" onchange="this.form.submit()">
              </div>
            @endif
          </form>
        </div>
      </div>

      @if($view === 'daily')
        <!-- Daily Attendance View -->
        <div class="card shadow-sm border-0 rounded-3">
          <div class="card-body p-4">
            <h5 class="card-title mb-3">Daily Attendance - {{ \Carbon\Carbon::parse($date)->format('F d, Y') }}</h5>
            
            <div class="table-responsive">
              <table class="table table-hover">
                <thead class="table-light">
                  <tr>
                    <th>Employee</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Status</th>
                    <th>Working Hours</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($employees as $employee)
                    @php $attendance = $employee->attendances->first(); @endphp
                    <tr>
                      <td>
                        <div class="d-flex align-items-center">
                          <img src="{{ $employee->profile_image ? asset('images/profiles/' . $employee->profile_image) : 'https://via.placeholder.com/40' }}" 
                               class="rounded-circle me-2" width="40" height="40" alt="Profile">
                          <div>
                            <div class="fw-bold">{{ $employee->name }}</div>
                            <small class="text-muted">{{ $employee->email }}</small>
                          </div>
                        </div>
                      </td>
                      <td>{{ $attendance->check_in ?? '-' }}</td>
                      <td>{{ $attendance->check_out ?? '-' }}</td>
                      <td>
                        @if($attendance)
                          <span class="badge bg-{{ $attendance->status === 'present' ? 'success' : ($attendance->status === 'late' ? 'warning' : 'danger') }}">
                            {{ ucfirst($attendance->status) }}
                          </span>
                        @else
                          <span class="badge bg-secondary">Absent</span>
                        @endif
                      </td>
                      <td>
                        @if($attendance && $attendance->check_in && $attendance->check_out)
                          @php
                            $checkIn = \Carbon\Carbon::parse($attendance->check_in);
                            $checkOut = \Carbon\Carbon::parse($attendance->check_out);
                            $hours = $checkOut->diffInHours($checkIn);
                            $minutes = $checkOut->diffInMinutes($checkIn) % 60;
                          @endphp
                          {{ $hours }}h {{ $minutes }}m
                        @else
                          -
                        @endif
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="5" class="text-center text-muted">No employees found</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      @else
        <!-- Monthly Attendance View -->
        <div class="card shadow-sm border-0 rounded-3">
          <div class="card-body p-4">
            <h5 class="card-title mb-3">Monthly Attendance - {{ $monthStart->format('F Y') }}</h5>
            
            <div class="table-responsive">
              <table class="table table-sm table-bordered">
                <thead class="table-light">
                  <tr>
                    <th>Employee</th>
                    @for($day = 1; $day <= $monthEnd->day; $day++)
                      <th class="text-center" style="min-width: 35px;">{{ $day }}</th>
                    @endfor
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($employees as $employee)
                    <tr>
                      <td>
                        <div class="d-flex align-items-center">
                          <img src="{{ $employee->profile_image ? asset('images/profiles/' . $employee->profile_image) : 'https://via.placeholder.com/30' }}" 
                               class="rounded-circle me-2" width="30" height="30" alt="Profile">
                          <div>
                            <div class="fw-bold small">{{ $employee->name }}</div>
                          </div>
                        </div>
                      </td>
                      @php 
                        $employeeAttendances = $attendances->get($employee->id, collect());
                        $presentDays = 0;
                      @endphp
                      @for($day = 1; $day <= $monthEnd->day; $day++)
                        @php
                          $currentDate = $monthStart->copy()->day($day);
                          $dayAttendance = $employeeAttendances->where('date', $currentDate->format('Y-m-d'))->first();
                        @endphp
                        <td class="text-center p-1">
                          @if($dayAttendance)
                            @if($dayAttendance->status === 'present')
                              <span class="badge bg-success" style="font-size: 10px;">P</span>
                              @php $presentDays++; @endphp
                            @elseif($dayAttendance->status === 'late')
                              <span class="badge bg-warning" style="font-size: 10px;">L</span>
                              @php $presentDays++; @endphp
                            @else
                              <span class="badge bg-danger" style="font-size: 10px;">A</span>
                            @endif
                          @else
                            @if($currentDate->isPast())
                              <span class="badge bg-secondary" style="font-size: 10px;">A</span>
                            @else
                              <span class="text-muted" style="font-size: 10px;">-</span>
                            @endif
                          @endif
                        </td>
                      @endfor
                      <td class="text-center fw-bold">{{ $presentDays }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            
            <div class="mt-3">
              <small class="text-muted">
                <span class="badge bg-success me-2">P</span> Present
                <span class="badge bg-warning me-2">L</span> Late
                <span class="badge bg-danger me-2">A</span> Absent
                <span class="badge bg-secondary">-</span> Future/Weekend
              </small>
            </div>
          </div>
        </div>
      @endif

    </main>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>