@extends('frontend.master')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Bus Management</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBusModal">Add Bus</button>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Bus Name</th>
                        <th>Bus Number</th>
                        <th>Type</th>
                        <th>Capacity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($buses as $bus)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $bus->name }}</td>
                            <td>{{ $bus->bus_number }}</td>
                            <td>{{ $bus->type }}</td>
                            <td>{{ $bus->capacity }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editBusModal{{ $bus->id }}">Edit</button>
                                <form action="{{ route('buses.destroy', $bus->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Bus Modal -->
                        <div class="modal fade" id="editBusModal{{ $bus->id }}" tabindex="-1" aria-labelledby="editBusModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('buses.update', $bus->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editBusModalLabel">Edit Bus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" class="form-control" value="{{ $bus->name }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="type">Type</label>
                                                <input type="text" name="type" class="form-control" value="{{ $bus->type }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="capacity">Capacity</label>
                                                <input type="number" name="capacity" class="form-control" value="{{ $bus->capacity }}" required>
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

        </div>
    </div>
</div>

<!-- Add Bus Modal -->
<div class="modal fade" id="addBusModal" tabindex="-1" aria-labelledby="addBusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('buses.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBusModalLabel">Add Bus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <input type="text" name="type" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="capacity">Capacity</label>
                        <input type="number" name="capacity" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
