@extends('layouts.app')

@section('content')

<section class="hero">
    <div class="container">
        <h1 class="display-4 fw-bold">Manage Your Employees Efficiently</h1>
        <p class="lead">A simple and intuitive Employee Management System for small and medium businesses.</p>
        <a href="#dashboard" class="btn btn-primary btn-lg mt-3">Go to Dashboard</a>
    </div>
</section>

<section class="py-5" id="features">
    <div class="container text-center">
        <h2 class="fw-bold mb-5">Features</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card p-4 feature-card shadow-sm">
                    <h5 class="fw-bold">Employee Management</h5>
                    <p>Track, add, and edit employee records easily.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 feature-card shadow-sm">
                    <h5 class="fw-bold">Order Tracking</h5>
                    <p>Manage orders, check statuses, and assign tasks efficiently.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 feature-card shadow-sm">
                    <h5 class="fw-bold">Analytics Dashboard</h5>
                    <p>View statistics, performance, and summary in one place.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light" id="dashboard">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">Dashboard Overview</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card p-4 shadow-sm">
                    <h5>Total Employees</h5>
                    <p class="display-6 fw-bold">25</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-4 shadow-sm">
                    <h5>Total Orders</h5>
                    <p class="display-6 fw-bold">120</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-4 shadow-sm">
                    <h5>Pending Tasks</h5>
                    <p class="display-6 fw-bold">5</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-4 shadow-sm">
                    <h5>Completed Tasks</h5>
                    <p class="display-6 fw-bold">115</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" id="contact">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">Contact Us</h2>
        <p>For support or inquiries, reach out to support@employeemanagement.com</p>
    </div>
</section>

@endsection
