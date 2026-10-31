@extends('Manager-Dashboard.Layouts.App')
@section('main-content')

<div class="container-fluid">
    <div class="page_Title">
        <h2 class="ProfilepageTitle mt-3">Direct Cost Estimate</h2>
    </div>
    <div class="employeeDetails">
        <div class="row">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
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
                    <form action="{{ route('manager.direct.cost.estimate.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <h4>
                                <i class="fa-solid fa-map-location-dot"></i>
                                Pickup Information
                            </h4>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>Pickup Location <span>*</span></label>
                                    <input type="text" name="pickup_location"
                                        class="form-control"
                                        placeholder="Enter pickup location"
                                        value="{{ old('pickup_location') }}" required>
                                    @error('pickup_location')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label>Pickup Latitude</label>
                                    <input type="number" step="any" name="pickup_latitude"
                                        class="form-control"
                                        placeholder="Enter latitude"
                                        value="{{ old('pickup_latitude') }}">
                                </div>
                                <div class="col-md-3">
                                    <label>Pickup Longitude</label>
                                    <input type="number" step="any" name="pickup_longitude"
                                        class="form-control"
                                        placeholder="Enter longitude"
                                        value="{{ old('pickup_longitude') }}">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <h4>
                                <i class="fa-solid fa-location-dot"></i>
                                Dropoff Information
                            </h4>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label>Dropoff Location <span>*</span></label>
                                    <input type="text" name="dropoff_location"
                                        class="form-control"
                                        placeholder="Enter dropoff location"
                                        value="{{ old('dropoff_location') }}" required>
                                    @error('dropoff_location')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label>Dropoff Latitude</label>
                                    <input type="number" step="any" name="dropoff_latitude"
                                        class="form-control"
                                        placeholder="Enter latitude"
                                        value="{{ old('dropoff_latitude') }}">
                                </div>
                                <div class="col-md-3">
                                    <label>Dropoff Longitude</label>
                                    <input type="number" step="any" name="dropoff_longitude"
                                        class="form-control"
                                        placeholder="Enter longitude"
                                        value="{{ old('dropoff_longitude') }}">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <h4>
                                <i class="fa-solid fa-car"></i>
                                Ride Cost Information
                            </h4>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label>Estimated Distance (KM)</label>
                                    <input type="number" step="0.01"
                                        name="estimated_distance"
                                        class="form-control"
                                        placeholder="Enter distance"
                                        value="{{ old('estimated_distance') }}">
                                </div>
                                <div class="col-md-4">
                                    <label>Vehicle Category</label>
                                    <select name="vehicle_category" class="form-control" required>
                                        <option value="">Select Vehicle Category</option>

                                        @foreach($vehicle_types as $vehicle)
                                            <option value="{{ $vehicle->id }}"
                                                {{ old('vehicle_category') == $vehicle->id ? 'selected' : '' }}>
                                                {{ $vehicle->vehicle_type }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Total Estimated Fare <span>*</span></label>
                                    <input type="number" step="0.01"
                                        name="total_estimated_fare"
                                        class="form-control"
                                        placeholder="Enter estimated fare"
                                        value="{{ old('total_estimated_fare', 0) }}" required>
                                    @error('total_estimated_fare')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="Primary-btn ml-auto d-table">
                            Save Cost Estimate
                        </button>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection
