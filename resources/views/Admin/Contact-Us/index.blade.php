@extends('Admin.Layouts.App')

@section('main_content')

<div class="page-content">

    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Contact Us Details</div>

        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">
                        Update Contact Us Details
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
                        Update Contact Us Details
                    </h5>

                    <form class="row g-3" action="{{ route('admin.contact-details.update') }}"
                        method="POST">
                        @csrf
                        {{-- Vehicle Type --}}
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email Id</label>
                            <input type="email"
                                name="email_id"
                                class="form-control @error('email_id') is-invalid @enderror"
                                placeholder="Email" value="{{ old('email_id', $contact_data->email_id ?? '') }}">
                            @error('email_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Phone Number</label>
                            <input type="text"
                                name="phone_number"
                                class="form-control @error('phone_number') is-invalid @enderror"
                                maxlength="10"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                placeholder="Phone Number" value="{{ old('phone_number',$contact_data->phone_number ?? '') }}">

                            @error('phone_number')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Address</label>
                            <textarea name="address"
                                class="form-control @error('address') is-invalid @enderror">
                                {{ old('address',$contact_data->address ?? '') }}</textarea>

                            @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Timing</label>
                            <textarea type="text"
                                name="open_time"
                                class="form-control @error('open_time') is-invalid @enderror">
                                {{ old('open_time',$contact_data->open_time ?? '') }}</textarea>

                            @error('open_time')
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


