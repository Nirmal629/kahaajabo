@extends('Admin.Layouts.App')

@section('main_content')

<div class="page-content">

    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Update Country</div>

        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">
                        Update Country
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
                        Update Country Details
                    </h5>

                    <form class="row g-3"
                        action="{{ route('admin.country.update',$data->id) }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        @if(isset($data))
                            @method('PUT')
                        @endif

                        {{-- Vehicle Type --}}
                        <div class="col-md-6">
                            <label class="form-label">Country Name</label>

                            <input type="text"
                                name="country_name"
                                class="form-control @error('country_name') is-invalid @enderror"
                                value="{{ old('country_name',$data->country_name ?? '') }}"
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
                                value="{{ old('country_code',$data->country_code ?? '') }}"
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
                                value="{{ old('phone_code',$data->phone_code ?? '') }}"
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
                                value="{{ old('currency',$data->currency ?? '') }}"
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
                                value="{{ old('currency_name',$data->currency_name ?? '') }}"
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
                                value="{{ old('currency_symbol',$data->currency_symbol ?? '') }}"
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
                                name="flag"
                                accept="image/*"
                                class="form-control @error('flag') is-invalid @enderror"
                                oninput="document.getElementById('flag').src = window.URL.createObjectURL(this.files[0]);document.getElementById('preview_imge').style.display='block';">

                            @error('flag')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- Preview --}}
                        <div class="col-md-4">
                            <img id="preview_imge"
                                class="img-thumbnail"
                                src="{{ isset($data) && $data->flag ? asset('uploads/Country-flag/'.$data->flag) : '' }}"
                                style="width:200px;height:150px;object-fit:cover;{{ isset($data) && $data->flag ? '' : 'display:none;' }}">

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