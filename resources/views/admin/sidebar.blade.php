<!-- Admin Sidebar -->
<nav class="col-md-2 d-none d-md-block sidebar p-3">
    <h4 class="mb-4 text-success"><i class="fa-solid fa-users"></i> HRM</h4>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">
                <i class="fa fa-home"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('attendance*') ? 'active' : '' }}" href="/attendance">
                <i class="fa fa-fingerprint"></i> Attendance
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('award*') ? 'active' : '' }}" href="/award">
                <i class="fa fa-trophy"></i> Award
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('department*') ? 'active' : '' }}" href="/department">
                <i class="fa fa-building"></i> Department
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('employees*') ? 'active' : '' }}" href="/employees">
                <i class="fa fa-users"></i> Employee
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('leave*') ? 'active' : '' }}" href="/leave">
                <i class="fa fa-plane"></i> Leave
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('loan*') ? 'active' : '' }}" href="/loan">
                <i class="fa fa-credit-card"></i> Loan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('notice-board*') ? 'active' : '' }}" href="/notice-board">
                <i class="fa fa-bullhorn"></i> Notice Board
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('payroll*') ? 'active' : '' }}" href="/payroll">
                <i class="fa fa-wallet"></i> Payroll
            </a>
        </li>
    </ul>
</nav>
