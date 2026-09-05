@extends('Admin.Layouts.App')

@section('main_content')

<div class="page-content">

    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">
            {{ isset($vehicle_data) ? 'Update Vehicle Type' : 'Add Vehicle Type' }}
        </div>

        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">
                        {{ isset($vehicle_data) ? 'Update Vehicle Type' : 'Add Vehicle Type' }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mx-auto">

            <div class="card">

                <div class="card-body p-4">

                    <h5 class="mb-4">
                        {{ isset($vehicle_data) ? 'Update Vehicle Type' : 'Add Vehicle Type' }}
                    </h5>

                    <form class="row g-3"
                        action="{{ isset($vehicle_data)
                                ? route('admin.vehicle-types.update', $vehicle_data->id)
                                : route('admin.vehicle-types.store') }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        @if(isset($vehicle_data))
                            @method('PUT')
                        @endif
            
                        <div class="col-md-12">
                            <label class="form-label">Vehicle Type</label>
                            <input type="text"
                                name="vehicle_type"
                                class="form-control @error('vehicle_type') is-invalid @enderror"
                                value="{{ old('vehicle_type', $vehicle_data->vehicle_type ?? '') }}"
                                placeholder="Vehicle Type">

                            @error('vehicle_type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                       
                        <div class="col-md-12 mt-3">

                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                            <button type="reset" class="btn btn-light px-4">Reset</button>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection

