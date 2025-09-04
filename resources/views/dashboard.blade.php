  @extends('layouts.app')
  <div class="d-flex">
    <!-- Sidebar -->
    <div class="bg-dark text-white p-3" style="width:250px; height:100vh;">
      <h4 class="text-center">Admin</h4>
      <ul class="nav flex-column">
        <li class="nav-item"><a href="#" class="nav-link text-white">Dashboard</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-white">All Employees</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-white">Add New</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-white">Notifications</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-white">Sent Mail</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-white">Leaves</a></li>
      </ul>
    </div>

    <!-- Content -->
    <div class="flex-grow-1 p-4">
      @yield('content')
    </div>
  </div>