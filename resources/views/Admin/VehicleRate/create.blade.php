@extends('Admin.Layouts.App')

@section('main_content')
    <div class="page-content">

        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">
                {{ isset($vehicle_rate) ? 'Update Vehicle Rate' : 'Add Vehicle Rate' }}
            </div>

            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active">
                            {{ isset($vehicle_rate) ? 'Update Vehicle Rate' : 'Add Vehicle Rate' }}
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
                            {{ isset($vehicle_rate) ? 'Update Vehicle Rate' : 'Add Vehicle Rate' }}
                        </h5>

                        <form class="row g-3"
                            action="{{ isset($vehicle_rate)
                                ? route('admin.vehicle-rates.update', $vehicle_rate->id)
                                : route('admin.vehicle-rates.store') }}"
                            method="POST" enctype="multipart/form-data">

                            @csrf
                            @if (isset($vehicle_rate))
                                @method('PUT')
                            @endif

                            <div class="row">
                                <div class="col-md-6 mb-3">

                                    <label class="form-label">
                                        Vehicle Type
                                        <span class="text-danger">*</span>
                                    </label>

                                    <select name="vehicle_type_id"
                                        class="form-select @error('vehicle_type_id') is-invalid @enderror">

                                        <option value="">
                                            Select Vehicle Type
                                        </option>

                                        @foreach ($vehicle_types as $vehicle_type)
                                            <option value="{{ $vehicle_type->id }}"
                                                {{ old('vehicle_type_id', $vehicle_rate->vehicle_type_id ?? '') == $vehicle_type->id ? 'selected' : '' }}>
                                                {{ $vehicle_type->vehicle_type }}
                                            </option>
                                        @endforeach

                                    </select>

                                    @error('vehicle_type_id')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                                <div class="col-md-6 mb-3">

                                    <label class="form-label">
                                        Vehicle Name
                                        <span class="text-danger">*</span>
                                    </label>

                                    <input type="text" name="vehicle_name"
                                        value="{{ old('vehicle_name', $vehicle_rate->vehicle_name ?? '') }}"
                                        class="form-control @error('vehicle_name') is-invalid @enderror">

                                    @error('vehicle_name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                                <div class="col-md-4 mb-3">

                                    <label class="form-label">
                                        Price Per KM
                                        <span class="text-danger">*</span>
                                    </label>

                                    <input type="number" name="price_per_km"
                                        value="{{ old('price_per_km', $vehicle_rate->price_per_km ?? '') }}" step="1"
                                        min="0" class="form-control @error('price_per_km') is-invalid @enderror">

                                    @error('price_per_km')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                                <div class="col-md-6 mb-3">

                                    <label class="form-label">
                                        Vehicle Image
                                    </label>

                                    <input type="file" name="vehicle_image" accept="image/*"
                                        class="form-control @error('vehicle_image') is-invalid @enderror"
                                        onchange="document.getElementById('vehicle_preview').src = window.URL.createObjectURL(this.files[0]); document.getElementById('vehicle_preview').style.display = 'block';">
                            

                                    @error('vehicle_image')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                                <div class="col-md-2 mb-3">
                                    <img id="vehicle_preview"
                                        src="{{ isset($vehicle_rate) && $vehicle_rate->vehicle_image
                                            ? \App\Helpers\LocationHelper::imageUrl('uploads/vehicle-rate/' . $vehicle_rate->vehicle_image)
                                            : '' }}"
                                        width="150"
                                        height="100"
                                        style="
                                            object-fit: cover;
                                            border: 1px solid #ddd;
                                            border-radius: 5px;
                                            {{ !isset($vehicle_rate) || !$vehicle_rate->vehicle_image ? 'display:none;' : '' }}
                                        ">
                                </div>
                            </div>

                                <div class="col-md-12 mt-3">

                                    <button type="submit" class="btn btn-primary">
                                        <i class="bx bx-save"></i>
                                        {{ isset($vehicle_rate) ? 'Update' : 'Submit' }}
                                    </button>

                                    <button type="reset" class="btn btn-light px-4">
                                        Reset
                                    </button>
                                </div>

                        </form>

                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
