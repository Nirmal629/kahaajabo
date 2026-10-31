@extends('Admin.Layouts.App')

@section('main_content')

<div class="page-content">

    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Update State </div>

        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">
                        Update State Details
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
                        Update State Details
                    </h5>

                    <form class="row g-3"
                        action="{{ route('admin.state.update',$data->id) }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        @if(isset($data))
                            @method('PUT')
                        @endif
                        {{-- Vehicle Type --}}
                        <div class="col-md-6">
                            <label for="country" class="form-label">Country</label>
                            <select id="country" class="form-select @error('country_id') is-invalid @enderror" name="country_id">
                                <option value="">Choose...</option>
                                @foreach ($countries as $countriesVal)
                                    <option value="{{ $countriesVal->id }}" {{ old('country_id', $data->country_id ?? '') == $countriesVal->id ? 'selected' : '' }}>{{ $countriesVal->country_name }}</option>
                                @endforeach
                            </select>

                            @error('country_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Charges Type --}}
                        <div class="col-md-6">

                            <label class="form-label">State Name</label>

                            <input type="text"
                                name="state_name"
                                class="form-control @error('state_name') is-invalid @enderror"
                                value="{{ old('state_name',$data->name ?? '') }}"
                                placeholder="State Name">

                            @error('state_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                       
                        <div class="col-md-12 mt-3">

                            <button type="submit" class="btn btn-primary">
                                Update
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
