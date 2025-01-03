    @extends('frontend.master')

    @section('content')
    <div class="container">
        <h2 class="mb-4">Routes Management</h2>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Add Route Button -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addRouteModal">Add Route</button>

        <!-- Routes Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Starting Point</th>
                    <th>Destination</th>
                    <th>Distance (km)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($routes as $route)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $route->starting_point }}</td>
                        <td>{{ $route->destination }}</td>
                        <td>{{ $route->distance }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editRouteModal{{ $route->id }}">Edit</button>
                            <form action="{{ route('routes.destroy', $route->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Route Modal -->
                    <div class="modal fade" id="editRouteModal{{ $route->id }}" tabindex="-1" aria-labelledby="editRouteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('routes.update', $route->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Route</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="starting_point">Starting Point</label>
                                            <input type="text" name="starting_point" class="form-control" value="{{ $route->starting_point }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="destination">Destination</label>
                                            <input type="text" name="destination" class="form-control" value="{{ $route->destination }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="distance">Distance (km)</label>
                                            <input type="number" name="distance" class="form-control" value="{{ $route->distance }}" required>
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

        <!-- Add Route Modal -->
        <div class="modal fade" id="addRouteModal" tabindex="-1" aria-labelledby="addRouteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('routes.store') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Route</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="starting_point">Starting Point</label>
                                <input type="text" name="starting_point" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="destination">Destination</label>
                                <input type="text" name="destination" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="distance">Distance (km)</label>
                                <input type="number" name="distance" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Route</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
