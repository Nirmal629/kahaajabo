@extends('Admin.Layouts.App')

@section('main_content')
    <div class="page-content">

        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Update Request Call </div>

            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active">
                            Update Request Call Details
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
                            Update Request Call Details
                        </h5>

                        <form class="row g-3" action="{{ route('admin.requestCall.update', $data->id) }}" method="POST">

                            @csrf
                            @method('PUT')

                            <!-- First Name -->
                            <div class="col-md-4">
                                <label class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" name="first_name"
                                    class="form-control @error('first_name') is-invalid @enderror"
                                    value="{{ old('first_name', $data->first_name) }}" placeholder="Enter First Name">

                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Middle Name -->
                            <div class="col-md-4">
                                <label class="form-label">Middle Name</label>
                                <input type="text" name="middle_name"
                                    class="form-control @error('middle_name') is-invalid @enderror"
                                    value="{{ old('middle_name', $data->middle_name) }}" placeholder="Enter Middle Name">

                                @error('middle_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Last Name -->
                            <div class="col-md-4">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name"
                                    class="form-control @error('last_name') is-invalid @enderror"
                                    value="{{ old('last_name', $data->last_name) }}" placeholder="Enter Last Name">

                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label class="form-label">Email<span class="text-danger">*</span></label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $data->email) }}" placeholder="Enter Email">

                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Mobile -->
                            <div class="col-md-3">
                                <label class="form-label">Primary Mobile Number<span class="text-danger">*</span></label>
                                <input type="text" name="mobile_number" maxlength="10"
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                    class="form-control @error('mobile_number') is-invalid @enderror"
                                    value="{{ old('mobile_number', $data->mobile_number) }}" placeholder="Mobile Number">

                                @error('mobile_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Secondary Mobile -->
                            <div class="col-md-3">
                                <label class="form-label">Secondary Mobile</label>
                                <input type="text" name="secondaryMobile_number" maxlength="10"
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                    class="form-control @error('secondaryMobile_number') is-invalid @enderror"
                                    value="{{ old('secondaryMobile_number', $data->secondaryMobile_number) }}"
                                    placeholder="Secondary Mobile">

                                @error('secondaryMobile_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Home Address -->
                            <div class="col-md-6">
                                <label class="form-label">Home Address</label>
                                <textarea name="home_address" rows="3" class="form-control @error('home_address') is-invalid @enderror"
                                    placeholder="Home Address">{{ old('home_address', $data->home_address) }}</textarea>

                                @error('home_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Office Address -->
                            <div class="col-md-6">
                                <label class="form-label">Office Address</label>
                                <textarea name="office_address" rows="3" class="form-control @error('office_address') is-invalid @enderror"
                                    placeholder="Office Address">{{ old('office_address', $data->office_address) }}</textarea>

                                @error('office_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Message -->
                            <div class="col-md-12">
                                <label class="form-label">Message<span class="text-danger">*</span></label>
                                <textarea name="message" rows="4" class="form-control @error('message') is-invalid @enderror"
                                    placeholder="Enter Message">{{ old('message', $data->message) }}</textarea>

                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Buttons -->
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary px-4">
                                    Update
                                </button>

                                <button type="reset" class="btn btn-light px-4">
                                    Cancel
                                </button>
                            </div>

                        </form>

                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection
