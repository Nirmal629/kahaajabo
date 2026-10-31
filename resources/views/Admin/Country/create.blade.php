@extends('Admin.Layouts.App')

@section('main_content')

<div class="page-content">

    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Add Country </div>

        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">
                        Add Country Details
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
                        Add Country Details
                    </h5>

                    <form class="row g-3"
                        action="{{ route('admin.country.store') }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        {{-- Vehicle Type --}}
                        <div class="col-md-6">
                            <label class="form-label">Country Name</label>

                            <input type="text"
                                name="country_name"
                                class="form-control @error('country_name') is-invalid @enderror"
                                
                                placeholder="Country Name">

                            @error('country_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Charges Type --}}
                        <div class="col-md-6">

                            <label class="form-label">Country Code</label>

                            <input type="text"
                                name="country_code"
                                class="form-control @error('country_code') is-invalid @enderror"
                                
                                placeholder="Country Code">

                            @error('country_code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- Charges --}}
                        <div class="col-md-3">

                            <label class="form-label">Phone Code</label>

                            <input type="text"
                                name="phone_code"
                                class="form-control @error('phone_code') is-invalid @enderror"
                                
                                placeholder="Phone Code" oninput="this.value = this.value.replace(/[^0-9+]/g, '')">

                            @error('phone_code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- Seat --}}
                        <div class="col-md-3">

                            <label class="form-label">Currency</label>

                            <input type="text"
                                name="currency"
                                class="form-control @error('currency') is-invalid @enderror"
                                
                                placeholder="Currency">

                            @error('currency')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Currency Name</label>
                            <input type="text"
                                name="currency_name"
                                class="form-control @error('currency_name') is-invalid @enderror"
                                
                                placeholder="Currency Name">

                            @error('currency_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Currency Symbol</label>
                            <input type="text"
                                name="currency_symbol"
                                class="form-control @error('currency_symbol') is-invalid @enderror"
                                
                                placeholder="Currency Symbol">

                            @error('currency_symbol')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Image --}}
                        <div class="col-md-8">
                            <label class="form-label">Flag</label>

                            <input type="file"
                                id="flag"
                                name="flag"
                                accept="image/*"
                                class="form-control @error('flag') is-invalid @enderror">

                            @error('flag')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <img id="preview_image"
                                src=""
                                class="img-thumbnail"
                                style="width:200px;height:150px;display:none;object-fit:cover;">
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

<script>

document.addEventListener('DOMContentLoaded', function () {

    const input = document.getElementById('flag');
    const preview = document.getElementById('preview_image');

    input.addEventListener('change', function (e) {

        if (e.target.files.length > 0) {

            const file = e.target.files[0];

            const reader = new FileReader();

            reader.onload = function(event){

                preview.src = event.target.result;
                preview.style.display = "block";

            };

            reader.readAsDataURL(file);

        }

    });

});

</script>