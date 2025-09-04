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
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f8f9fa;
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
    .stat-card {
      border-radius: 12px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .leave-card {
      border-bottom: 1px solid #eee;
      padding: 10px 0;
    }
    .leave-card img {
      border-radius: 50%;
      width: 40px;
      height: 40px;
      margin-right: 10px;
    }
  </style>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    
    <!-- Sidebar -->
    <nav class="col-md-2 d-none d-md-block sidebar p-3">
      <h4 class="mb-4 text-success"><i class="fa-solid fa-users"></i> HRM</h4>
      <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link active" href="#"><i class="fa fa-home"></i> Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-fingerprint"></i> Attendance</a></li>
        <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-trophy"></i> Award</a></li>
        <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-building"></i> Department</a></li>
        <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-users"></i> Employee</a></li>
        <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-plane"></i> Leave</a></li>
        <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-credit-card"></i> Loan</a></li>
        <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-bullhorn"></i> Notice Board</a></li>
        <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-wallet"></i> Payroll</a></li>
      </ul>
    </nav>

    <!-- Main Content -->
    <main class="col-md-10 ms-sm-auto px-4 py-4">
      
      <!-- Header -->
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Dashboard</h2>
        <div class="d-flex align-items-center gap-3">
          <button class="btn btn-outline-success">Cache Clear</button>
          <div class="dropdown">
            <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="https://via.placeholder.com/40" alt="profile" class="rounded-circle me-2">
              <span>Admin</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="#">Profile</a></li>
              <li><a class="dropdown-item" href="#">Logout</a></li>
            </ul>
          </div>
        </div>
      </div>
      
      <!-- Stats Cards -->
      <div class="row g-3 mb-4">
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
      </div>
      
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
      
    </main>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
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
</script>
</body>
</html>