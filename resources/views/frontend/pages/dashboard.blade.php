@extends('frontend.master')

@section('title', 'Dashboard')
@section('content')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <!-- Widgets -->
                    <div class="col-md-3 grid-margin">
                        <div class="card bg-primary text-white text-center">
                            <div class="card-body">
                                <h4>Total Buses</h4>
                                <h2>{{ $busesCount }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 grid-margin">
                        <div class="card bg-success text-white text-center">
                            <div class="card-body">
                                <h4>Total Employees</h4>
                                <h2>{{ $employeesCount }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 grid-margin">
                        <div class="card bg-warning text-white text-center">
                            <div class="card-body">
                                <h4>Total Routes</h4>
                                <h2>{{ $routesCount }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 grid-margin">
                        <div class="card bg-danger text-white text-center">
                            <div class="card-body">
                                <h4>Total Bookings</h4>
                                <h2>{{ $bookingsCount }}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Bookings -->
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="card">
                            <div class="card-header bg-dark text-white">
                                Recent Bookings
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Phone</th>
                                            <th>Seat</th>
                                            <th>Status</th>
                                            <th>Schedule</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentBookings as $booking)
                                            <tr>
                                                <td>{{ $booking->customer_name }}</td>
                                                <td>{{ $booking->customer_phone }}</td>
                                                <td>{{ $booking->seat_number }}</td>
                                                <td>{{ $booking->status }}</td>
                                                <td>{{ $booking->schedule->route->starting_point }} - {{ $booking->schedule->route->destination }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Schedules -->
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                Upcoming Schedules
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Route</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($schedules as $schedule)
                                            <tr>
                                                <td>{{ $schedule->route->starting_point }} - {{ $schedule->route->destination }}</td>
                                                <td>{{ $schedule->departure_time }}</td>
                                                <td>{{ $schedule->arrival_time }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="card">
                            <div class="card-body text-center">
                                <a href="{{ route('buses.index') }}" class="btn btn-primary">Manage Buses</a>
                                <a href="{{ route('employees.index') }}" class="btn btn-success">Manage Employees</a>
                                <a href="{{ route('routes.index') }}" class="btn btn-warning">Manage Routes</a>
                                <a href="{{ route('schedules.index') }}" class="btn btn-danger">Manage Schedules</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

