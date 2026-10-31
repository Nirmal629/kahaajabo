@extends('Admin.Layouts.App')

@section('main_content')

<div class="page-content">

    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Vehicle Type</div>

        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">
                        {{ isset($data) ? 'Edit Vehicle Type' : 'Add Vehicle Type' }}
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
                        {{ isset($data) ? 'Edit Vehicle Type' : 'Add Vehicle Type' }}
                    </h5>

                    <form class="row g-3"
                        action="{{ isset($data) ? route('admin.vehicle-type.update',$data->id) : route('admin.vehicle-type.store') }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        @if(isset($data))
                            @method('PUT')
                        @endif

                        {{-- Vehicle Type --}}
                        <div class="col-md-12">
                            <label class="form-label">Vehicle Type</label>

                            <input type="text"
                                name="vehicle_type"
                                class="form-control @error('vehicle_type') is-invalid @enderror"
                                value="{{ old('vehicle_type',$data->vehicle_type ?? '') }}"
                                placeholder="Vehicle Type">

                            @error('vehicle_type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Charges Type --}}
                        <div class="col-md-4">

                            <label class="form-label">Charges Type</label>

                            <select name="charges_type"
                                class="form-select @error('charges_type') is-invalid @enderror">

                                <option value="">Choose...</option>

                                <option value="kilometer"
                                    {{ old('charges_type',$data->charges_type ?? '') == 'kilometer' ? 'selected' : '' }}>
                                    Per Kilometer
                                </option>

                                <option value="hourly"
                                    {{ old('charges_type',$data->charges_type ?? '') == 'hourly' ? 'selected' : '' }}>
                                    Per Hours
                                </option>

                            </select>

                            @error('charges_type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- Charges --}}
                        <div class="col-md-4">

                            <label class="form-label">Charges</label>

                            <input type="text"
                                name="rates"
                                class="form-control @error('rates') is-invalid @enderror"
                                value="{{ old('rates',$data->charges ?? '') }}"
                                placeholder="Charges">

                            @error('rates')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- Seat --}}
                        <div class="col-md-4">

                            <label class="form-label">Total Seat Number</label>

                            <input type="number"
                                name="total_seat"
                                class="form-control @error('total_seat') is-invalid @enderror"
                                value="{{ old('total_seat',$data->totalSeatNumbar ?? '') }}"
                                placeholder="Seat">

                            @error('total_seat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- Image --}}
                        <div class="col-md-8">

                            <label class="form-label">Vehicle Image</label>

                            <input type="file"
                                name="vehicle_image"
                                accept="image/*"
                                class="form-control @error('vehicle_image') is-invalid @enderror"
                                oninput="document.getElementById('preview_imge').src = window.URL.createObjectURL(this.files[0]);document.getElementById('preview_imge').style.display='block';">

                            @error('vehicle_image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- Preview --}}
                        <div class="col-md-4">

                            <img id="preview_imge"
                                class="img-thumbnail"
                                src="{{ isset($data) && $data->vehicleImage ? asset('uploads/vehicles-type/'.$data->vehicleImage) : '' }}"
                                style="width:200px;height:150px;object-fit:cover;{{ isset($data) && $data->vehicleImage ? '' : 'display:none;' }}">

                        </div>

                        <div class="col-md-12">

                            <button type="submit" class="btn btn-primary">
                                {{ isset($data) ? 'Update' : 'Submit' }}
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