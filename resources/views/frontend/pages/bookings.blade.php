@extends('frontend.master')

@section('content')
<div class="container">
    <h1>Available Schedules</h1>
    <div class="row">
        @forelse($schedules as $schedule)
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Bus: {{ $schedule->bus->name }}</h5>
                    <p>Route: {{ $schedule->route->starting_point }} to {{ $schedule->route->destination }}</p>
                    <p>Departure: {{ $schedule->departure_time }}</p>
                    <p>Arrival: {{ $schedule->arrival_time }}</p>
                    <button
                        class="btn btn-primary btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#bookingModal-{{ $schedule->id }}">
                        Book Now (Arrives at: {{ $schedule->arrival_time }})
                    </button>
                </div>
            </div>
        </div>

        <!-- Booking Modal -->
        <div class="modal fade" id="bookingModal-{{ $schedule->id }}" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('bookings.store', $schedule->id) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="bookingModalLabel">Book a Seat</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            {{ $schedule->bus->name }}_
                            {{ $schedule->route->starting_point }} to {{ $schedule->route->destination }}_
                            {{ $schedule->departure_time }}-{{ $schedule->arrival_time }}
                            <br>
                            <div class="form-group mb-3">
                                <label for="customer_name">Name</label>
                                <input type="text" name="customer_name" id="customer_name" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="customer_phone">Phone</label>
                                <input type="text" name="customer_phone" id="customer_phone" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="row">Select Row</label>
                                <select name="row" id="row" class="form-control" required>
                                    @for ($i = 1; $i <= $schedule->rows; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="column">Select Column</label>
                                <select name="column" id="column" class="form-control" required>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="payment_status">Payment Status</label>
                                <select name="status" id="payment_status" class="form-control" required>
                                    <option value="paid">Paid</option>
                                    <option value="unpaid">Unpaid</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Confirm Booking</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <p>No schedules available at the moment.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
