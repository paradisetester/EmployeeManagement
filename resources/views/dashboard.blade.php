<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HRM Dashboard</title>
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- FontAwesome Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{asset ('css/admin/style.css') }}" type="text/css" />
</head>
<body>
<div class="container-fluid">
  <div class="row">
    @include('admin.sidebar')
    <!-- Sidebar -->
    <!-- Main Content -->
    <main class="col-md-10 ms-sm-auto px-4 py-4">
      
      <!-- Header -->
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Dashboard</h2>
        <div class="d-flex align-items-center gap-3">
          <div class="dropdown">
            <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="https://via.placeholder.com/40" alt="profile" class="rounded-circle me-2">
              <span>Admin</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="/profile">Profile</a></li>
              <li><a class="dropdown-item" href="/logout">Logout</a></li>
            </ul>
          </div>
        </div>
      </div>
      
      <!-- Stats Cards -->
      <div class="row g-3 mb-4">
        @if(auth()->user()->role === 'employee')
          <div class="col-md-3">
            <div class="card stat-card p-3">
              <h6>This Month Holidays</h6>
              <h3>5</h3>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card stat-card p-3">
              <h6>Leave Pending</h6>
              <h3>2</h3>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card stat-card p-3">
              <h6>Today Date & Time</h6>
              <h3 id="currentDateTime"></h3>
            </div>
          </div>
        @else
          <div class="col-md-3">
            <div class="card stat-card p-3">
              <h6>Total Employees</h6>
              <h3>31</h3>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card stat-card p-3">
              <h6>Today Presents</h6>
              <h3>4</h3>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card stat-card p-3">
              <h6>Today Absents</h6>
              <h3>21</h3>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card stat-card p-3">
              <h6>Today Leave</h6>
              <h3>6</h3>
            </div>
          </div>
        @endif
      </div>
      
      @if(auth()->user()->role !== 'employee')
      <div class="row">
        <!-- Chart Section -->
        <div class="col-md-8">
          <div class="card p-3">
            <h6 class="fw-bold">Daily Attendance Statistic (Department wise)</h6>
            <canvas id="attendanceChart" height="150"></canvas>
          </div>
        </div>
        
        <!-- Leave Applications -->
        <div class="col-md-4">
          <div class="card p-3">
            <h6 class="fw-bold">Leave Application</h6>
            
            <div class="leave-card d-flex align-items-center">
              <img src="https://via.placeholder.com/40" alt="">
              <div>
                <p class="mb-0 fw-bold">Maisha Lucy Zamora Gonzales</p>
                <small class="text-success">Approved</small>
              </div>
            </div>
            <div class="leave-card d-flex align-items-center">
              <img src="https://via.placeholder.com/40" alt="">
              <div>
                <p class="mb-0 fw-bold">Amy Aphrodite Zamora Peck</p>
                <small class="text-success">Approved</small>
              </div>
            </div>
            
            <a href="#" class="text-success fw-bold mt-2 d-block">See All Requests →</a>
          </div>
        </div>
      </div>
      @endif
      
    </main>
  </div>
</div>
  <style>

  </style>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  @if(auth()->user()->role !== 'employee')
  const ctx = document.getElementById('attendanceChart');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Sales', 'Accounts & Finance', 'IT', 'Production'],
      datasets: [
        {
          label: 'Leave %',
          data: [0, 0, 0, 4],
          backgroundColor: '#dc3545'
        },
        {
          label: 'Present %',
          data: [0, 0, 0, 10],
          backgroundColor: '#28a745'
        },
        {
          label: 'Absent %',
          data: [0, 0, 0, 86],
          backgroundColor: '#ffc107'
        }
      ]
    },
    options: {
      responsive: true,
      plugins: { legend: { position: 'bottom' } },
      scales: { y: { beginAtZero: true, max: 120 } }
    }
  });
  @endif
  
  @if(auth()->user()->role === 'employee')
  function updateDateTime() {
    const now = new Date();
    const options = { 
      year: 'numeric', 
      month: 'short', 
      day: 'numeric', 
      hour: '2-digit', 
      minute: '2-digit'
    };
    document.getElementById('currentDateTime').textContent = now.toLocaleDateString('en-US', options);
  }
  updateDateTime();
  setInterval(updateDateTime, 60000);
  @endif
</script>
</body>
</html>