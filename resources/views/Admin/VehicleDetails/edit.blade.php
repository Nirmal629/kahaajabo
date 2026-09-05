@extends('Admin.Layouts.App')

@section('main_content')
    <div class="page-content">

        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Vehicle Details</div>

            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active">
                            Edit Vehicle Details
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
                            Update Vehicle Details
                        </h5>

                        <form class="row g-3" action="{{ route('admin.vehicle-details.update', $data->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!-- Vehicle Details -->
                            <div class="card shadow-sm mb-4">
                                <div class="card-header text-white">
                                    <h5 class="mb-0">
                                        <i class="bx bx-car"></i> Vehicle Details
                                    </h5>
                                </div>

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Brand</label>
                                            <input type="text" class="form-control" placeholder="Brand" name="brand"
                                                value="{{ old('brand', $data->brand ?? '') }}">

                                            @error('brand')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Model</label>
                                            <input type="text" class="form-control" placeholder="Model" name="model"
                                                value="{{ old('model', $data->model ?? '') }}">

                                            @error('model')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Vehicle Type</label>
                                            <input type="text" class="form-control" placeholder="Vehicle Type"
                                                name="type" value="{{ old('type', $data->type ?? '') }}">

                                            @error('type')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Seat Capacity</label>
                                            <input type="number" class="form-control" placeholder="" name="seat_capacity"
                                                value="{{ old('seat_capacity', $data->seat_capacity ?? '') }}">

                                            @error('seat_capacity')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Manufacture Year</label>
                                            <input type="number" class="form-control" placeholder=""
                                                name="manufacture_year"
                                                value="{{ old('manufacture_year', $data->manufacture_year ?? '') }}">

                                            @error('manufacture_year')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Fuel Type</label>

                                            <select class="form-select" name="fuel_type">
                                                <option value="">Choose Option..</option>
                                                <option value="Petrol"
                                                    {{ old('fuel_type', $data->fuel_type ?? '') == 'Petrol' ? 'selected' : '' }}>
                                                    Petrol
                                                </option>
                                                <option value="Diesel"
                                                    {{ old('fuel_type', $data->fuel_type ?? '') == 'Diesel' ? 'selected' : '' }}>
                                                    Diesel
                                                </option>
                                                <option value="CNG"
                                                    {{ old('fuel_type', $data->fuel_type ?? '') == 'CNG' ? 'selected' : '' }}>
                                                    CNG
                                                </option>
                                                <option value="Electric"
                                                    {{ old('fuel_type', $data->fuel_type ?? '') == 'Electric' ? 'selected' : '' }}>
                                                    Electric
                                                </option>
                                            </select>

                                            @error('fuel_type')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>
                                    </div>

                                </div>
                            </div>


                            <!-- Registration Certificate -->
                            <div class="card shadow-sm mb-4">

                                <div class="card-header text-white">
                                    <h5 class="mb-0">
                                        Registration Certificate
                                    </h5>
                                </div>

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Registration Number</label>
                                            <input type="text" class="form-control" placeholder="Registration Number"
                                                name="registration_number"
                                                value="{{ old('registration_number', $data->registration_number ?? '') }}">

                                            @error('registration_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-8 mb-3">
                                            <label class="form-label">RC File</label>
                                            <input type="file" class="form-control" name="registration_certificate"
                                                accept=".pdf,.jpg,.jpeg,.png,.webp">

                                            @error('registration_certificate')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3 d-flex align-items-end">
                                            @if (!empty($data->document?->registration_certificate))
                                                <a href="{{ asset('uploads/vehicle-documents/' . $data->document->registration_certificate) }}"
                                                    target="_blank" class="btn btn-outline-primary">
                                                    <i class="bx bx-show"></i> View Current File
                                                </a>
                                            @else
                                                <span class="text-danger">No file uploaded</span>
                                            @endif

                                        </div>

                                    </div>

                                </div>

                            </div>


                            <!-- Insurance -->
                            <div class="card shadow-sm mb-4">

                                <div class="card-header text-white">
                                    <h5 class="mb-0">
                                        Insurance Policy
                                    </h5>
                                </div>

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Policy Number</label>
                                            <input type="text" class="form-control" name="policy_number"
                                                value="{{ old('policy_number', $data->document->insurance_policy_number ?? '') }}">

                                            @error('policy_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Start Date</label>
                                            <input type="date" class="form-control" name="insurance_policy_startDate"
                                                value="{{ old('insurance_policy_startDate', $data->document->insurance_policy_startDate ?? '') }}">

                                            @error('insurance_policy_startDate')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">End Date</label>
                                            <input type="date" class="form-control" name="insurance_policy_endDate"
                                                value="{{ old('insurance_policy_endDate', $data->document->insurance_policy_endDate ?? '') }}">

                                            @error('insurance_policy_endDate')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-8 mb-3">
                                            <label class="form-label">Insurance File</label>
                                            <input type="file" class="form-control" name="insurance_policy_file"
                                                accept=".pdf,.jpg,.jpeg,.png,.webp">

                                            @error('insurance_policy_file')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3 d-flex align-items-end">
                                            @if (!empty($data->document?->insurance_policy_file))
                                                <a href="{{ asset('uploads/vehicle-documents/' . $data->document->insurance_policy_file) }}"
                                                    target="_blank" class="btn btn-outline-success">
                                                    <i class="bx bx-show"></i> View Current File
                                                </a>
                                            @else
                                                <span class="text-danger">No file uploaded</span>
                                            @endif
                                        </div>

                                    </div>

                                </div>

                            </div>


                            <!-- Fitness Certificate -->
                            <div class="card shadow-sm mb-4">

                                <div class="card-header">
                                    <h5 class="mb-0">
                                        Fitness Certificate
                                    </h5>
                                </div>

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Certificate Number</label>
                                            <input type="text" class="form-control" name="fitness_certificate_number"
                                                value="{{ old('fitness_certificate_number', $data->document->fitness_certificate_number ?? '') }}">

                                            @error('fitness_certificate_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Start Date</label>
                                            <input type="date" class="form-control"
                                                name="fitness_certificate_startDate"
                                                value="{{ old('fitness_certificate_startDate', $data->document->fitness_certificate_startDate ?? '') }}">

                                            @error('fitness_certificate_startDate')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">End Date</label>
                                            <input type="date" class="form-control" name="fitness_certificate_endDate"
                                                value="{{ old('fitness_certificate_endDate', $data->document->fitness_certificate_endDate ?? '') }}">

                                            @error('fitness_certificate_endDate')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-8 mb-3">
                                            <label class="form-label">Fitness Certificate File</label>
                                            <input type="file" class="form-control" name="fitness_certificate_file"
                                                accept=".pdf,.jpg,.jpeg,.png,.webp">

                                            @error('fitness_certificate_file')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3 d-flex align-items-end">
                                            @if (!empty($data->document?->fitness_certificate_file))
                                                <a href="{{ asset('uploads/vehicle-documents/' . $data->document->fitness_certificate_file) }}"
                                                    target="_blank" class="btn btn-outline-warning">
                                                    <i class="bx bx-show"></i> View Current File
                                                </a>
                                            @else
                                                <span class="text-danger">No file uploaded</span>
                                            @endif
                                        </div>

                                    </div>

                                </div>

                            </div>


                            <!-- Tourist Permit -->
                            <div class="card shadow-sm mb-4">

                                <div class="card-header text-white">
                                    <h5 class="mb-0">
                                        All India Tourist Permit
                                    </h5>
                                </div>

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Permit Number</label>
                                            <input type="text" class="form-control"
                                                name="allIndia_tourist_permit_number"
                                                value="{{ old('allIndia_tourist_permit_number', $data->document->allIndia_tourist_permit_number ?? '') }}">

                                            @error('allIndia_tourist_permit_number')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Start Date</label>
                                            <input type="date" class="form-control"
                                                name="allIndia_tourist_permit_startDate"
                                                value="{{ old('allIndia_tourist_permit_startDate', $data->document->allIndia_tourist_permit_startDate ?? '') }}">

                                            @error('allIndia_tourist_permit_startDate')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">End Date</label>
                                            <input type="date" class="form-control"
                                                name="allIndia_tourist_permit_endDate"
                                                value="{{ old('allIndia_tourist_permit_endDate', $data->document->allIndia_tourist_permit_endDate ?? '') }}">

                                            @error('allIndia_tourist_permit_endDate')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-8 mb-3">
                                            <label class="form-label">Permit File</label>
                                            <input type="file" class="form-control"
                                                name="allIndia_tourist_permit_file" accept=".pdf,.jpg,.jpeg,.png,.webp">

                                            @error('allIndia_tourist_permit_file')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4 mb-3 d-flex align-items-end">
                                            @if (!empty($data->document?->allIndia_tourist_permit_file))
                                                <a href="{{ asset('uploads/vehicle-documents/' . $data->document->allIndia_tourist_permit_file) }}"
                                                    target="_blank" class="btn btn-outline-info">
                                                    <i class="bx bx-show"></i> View Current File
                                                </a>
                                            @else
                                                <span class="text-danger">No file uploaded</span>
                                            @endif
                                        </div>

                                    </div>

                                </div>

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
