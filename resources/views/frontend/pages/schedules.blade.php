@extends('frontend.master')

@section('content')
<div class="container">
    <h2 class="mb-4">Schedules Management</h2>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Add Schedule Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addScheduleModal">Add Schedule</button>

    <!-- Schedules Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Bus</th>
                <th>Route</th>
                <th>Departure Time</th>
                <th>Arrival Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schedules as $schedule)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $schedule->bus->name }}</td>
                    <td>{{ $schedule->route->starting_point }} - {{ $schedule->route->destination }}</td>
                    <td>{{ $schedule->departure_time }}</td>
                    <td>{{ $schedule->arrival_time }}</td>
                    <td>{{ ucfirst($schedule->status) }}</td>
                    <td>
                        <!-- Edit Button -->
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editScheduleModal{{ $schedule->id }}">Edit</button>
                        <!-- Delete Form -->
                        <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>

                <!-- Edit Schedule Modal -->
                <div class="modal fade" id="editScheduleModal{{ $schedule->id }}" tabindex="-1" aria-labelledby="editScheduleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('schedules.update', $schedule->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Schedule</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="bus_id">Bus</label>
                                        <select name="bus_id" class="form-select" required>
                                            @foreach($buses as $bus)
                                                <option value="{{ $bus->id }}" {{ $schedule->bus_id == $bus->id ? 'selected' : '' }}>
                                                    {{ $bus->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="route_id">Route</label>
                                        <select name="route_id" class="form-select" required>
                                            @foreach($routes as $route)
                                                <option value="{{ $route->id }}" {{ $schedule->route_id == $route->id ? 'selected' : '' }}>
                                                    {{ $route->starting_point }} - {{ $route->destination }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="departure_time">Departure Time</label>
                                        <input type="time" name="departure_time" class="form-control" value="{{ $schedule->departure_time }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="arrival_time">Arrival Time</label>
                                        <input type="time" name="arrival_time" class="form-control" value="{{ $schedule->arrival_time }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-select" required>
                                            <option value="active" {{ $schedule->status == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="canceled" {{ $schedule->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    <!-- Add Schedule Modal -->
    <div class="modal fade" id="addScheduleModal" tabindex="-1" aria-labelledby="addScheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('schedules.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Schedule</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="bus_id">Bus</label>
                            <select name="bus_id" class="form-select" required>
                                @foreach($buses as $bus)
                                    <option value="{{ $bus->id }}">{{ $bus->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="route_id">Route</label>
                            <select name="route_id" class="form-select" required>
                                @foreach($routes as $route)
                                    <option value="{{ $route->id }}">{{ $route->starting_point }} - {{ $route->destination }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="departure_time">Departure Time</label>
                            <input type="time" name="departure_time" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="arrival_time">Arrival Time</label>
                            <input type="time" name="arrival_time" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="active">Active</option>
                                <option value="canceled">Canceled</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Schedule</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
