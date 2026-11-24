
@extends('Manager-Dashboard.Layouts.App')
@section('main-content')

<div class="container-fluid">
    <div class="page_Title">
        <h2 class="ProfilepageTitle mt-3">Ride Cost Configuration</h2>
    </div>

    <div class="employeeDetails">
        <div class="row">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="col-lg-12 col-md-12 col-12">
                <div class="user_form">

                    <form
                        action="{{ isset($ride_cost)
                            ? route('manager.ride.cost.update', $ride_cost->id)
                            : route('manager.ride.cost.store') }}"
                        method="POST">

                        @csrf

                        @if(isset($ride_cost))
                            @method('PUT')
                        @endif

                        {{-- VEHICLE INFORMATION --}}
                        <div class="mb-3">
                            <h4>
                                <i class="fa-solid fa-car"></i>
                                Vehicle Information
                            </h4>

                            <div class="row mb-3">

                                <div class="col-md-6">
                                    <label>Vehicle Type <span>*</span></label>

                                    <select name="vehicle_type_id" class="form-control" required>
                                        <option value="">Select Vehicle Type</option>

                                        @foreach($vehicle_types as $vehicle)
                                            <option value="{{ $vehicle->id }}"
                                                {{ old('vehicle_type_id', $ride_cost->vehicle_type_id ?? '') == $vehicle->id ? 'selected' : '' }}>
                                                {{ $vehicle->vehicle_type }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('vehicle_type_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label>Fuel Type  <span>*</span></label>

                                    <select name="vehicle_input" class="form-control" required>
                                        <option value="">Select Fuel Type </option>

                                        @foreach(['Petrol', 'Diesel', 'CNG', 'EV'] as $input)
                                            <option value="{{ $input }}"
                                                {{ old('vehicle_input', $ride_cost->vehicle_input ?? '') == $input ? 'selected' : '' }}>
                                                {{ $input }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('vehicle_input')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>
                        </div>


                        {{-- COST INFORMATION --}}
                        <div class="mb-3">
                            <h4>
                                <i class="fa-solid fa-money-bill-wave"></i>
                                Ride Cost Information
                            </h4>

                            <div class="row mb-3">

                                <div class="col-md-4">
                                    <label>Gas Cost / KM<span>*</span></label>

                                    <input type="number" step="0.01" min="0"
                                        name="gas_cost"
                                        class="form-control"
                                        placeholder="Enter gas cost"
                                        value="{{ old('gas_cost', $ride_cost->gas_cost ?? '') }}"
                                        required>

                                    @error('gas_cost')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                <div class="col-md-4">
                                    <label>Car Maintenance / KM<span>*</span></label>

                                    <input type="number" step="0.01" min="0"
                                        name="car_maintenance"
                                        class="form-control"
                                        placeholder="Enter car maintenance cost"
                                        value="{{ old('car_maintenance', $ride_cost->car_maintenance ?? '') }}"
                                        required>

                                    @error('car_maintenance')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label>Driver Cost (Night) / KM <span>*</span></label>

                                    <input type="number" step="0.01" min="0"
                                        name="driver_cost"
                                        class="form-control"
                                        placeholder="Enter driver cost"
                                        value="{{ old('driver_cost', $ride_cost->driver_cost ?? '') }}"
                                        required>

                                    @error('driver_cost')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>Vehicle Cost / KM<span>*</span></label>

                                    <input type="number" step="0.01" min="0"
                                        name="per_km_cost"
                                        class="form-control"
                                        placeholder="Enter Vehicle Cost"
                                        value="{{ old('per_km_cost', $ride_cost->per_km_cost ?? '') }}"
                                        required>

                                    @error('per_km_cost')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Total Cost / KM<span>*</span></label>

                                    <input type="number" step="0.01" min="0"
                                        name="total_cost"
                                        id="total_cost"
                                        class="form-control"
                                        placeholder="Enter total cost"
                                        value="{{ old('total_cost', $ride_cost->total_cost ?? '') }}"
                                        required readonly>

                                    @error('total_cost')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="Primary-btn ml-auto d-table">
                            {{ isset($ride_cost) ? 'Update Ride Cost' : 'Save Ride Cost' }}
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>




<script>
    document.addEventListener('DOMContentLoaded', function () {

        const gasCost = document.querySelector('[name="gas_cost"]');
        const maintenanceCost = document.querySelector('[name="car_maintenance"]');
        const driverCost = document.querySelector('[name="driver_cost"]');
        const vehicleCost = document.querySelector('[name="per_km_cost"]');
        const totalCost = document.querySelector('#total_cost');

        function calculateTotal() {

            let gas = parseFloat(gasCost.value) || 0;
            let maintenance = parseFloat(maintenanceCost.value) || 0;
            let driver = parseFloat(driverCost.value) || 0;
            let vehicle = parseFloat(vehicleCost.value) || 0;

            let total = gas + maintenance + driver + vehicle;

            totalCost.value = total.toFixed(2);
        }

        gasCost.addEventListener('input', calculateTotal);
        maintenanceCost.addEventListener('input', calculateTotal);
        driverCost.addEventListener('input', calculateTotal);
        vehicleCost.addEventListener('input', calculateTotal);

        // Calculate on page load
        calculateTotal();

    });
</script>
@endsection
