@extends('Admin.Layouts.App')

@section('main_content')
    <div class="page-content">

        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">
                {{ isset($destination_data) ? 'Edit Home popular Destination' : 'Add Home popular Destination' }}
            </div>

            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">
                                <i class="bx bx-home-alt"></i>
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            {{ isset($destination_data) ? 'Update popular Destination Details' : 'Add popular Destination Details' }}
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
                            {{ isset($destination_data) ? 'Update popular Destination Details' : 'Add popular Destination Details' }}
                        </h5>

                        <form class="row g-3"
                            action="{{ isset($destination_data)
                                ? route('admin.home-destination.update', $destination_data->id)
                                : route('admin.home-destination.store') }}"
                            method="POST"
                            enctype="multipart/form-data">

                            @csrf

                            @if(isset($destination_data))
                                @method('PUT')
                            @endif

                            <!-- Banner Title -->
                            <div class="col-md-12">
                                <label class="form-label">
                                    Destination Name
                                </label>

                                <input type="text"
                                    name="destination_name"
                                    class="form-control @error('destination_name') is-invalid @enderror"
                                    value="{{ old('destination_name', $destination_data->destination_name ?? '') }}"
                                    placeholder="Enter Destination Name">

                                @error('destination_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Banner Image -->
                            <div class="col-md-8">
                                <label class="form-label">
                                    Image
                                </label>

                                <input type="file"
                                        name="image"
                                        id="banner_image"
                                        class="form-control @error('image') is-invalid @enderror"
                                        accept=".jpg,.jpeg,.png"
                                        onchange="document.getElementById('banner_preview').src = window.URL.createObjectURL(this.files[0]); document.getElementById('banner_preview').style.display = 'block';">
                            
                                @error('image')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                             </div>
                            <div class="col-md-4">

                                <img id="banner_preview"
                                    src="{{ isset($destination_data) && $destination_data->image
                                        ? asset('uploads/home-dynamic/' . $destination_data->image)
                                        : '' }}"
                                    width="150"
                                    height="100"
                                    style="
                                        object-fit: cover;
                                        border: 1px solid #ddd;
                                        border-radius: 5px;
                                        {{ !isset($destination_data) || !$destination_data->image ? 'display:none;' : '' }}
                                    ">

                            </div>

                          
                            <!-- Buttons -->
                            <div class="col-md-12 mt-3">

                                <button type="submit" class="btn btn-primary">
                                    <i class="bx bx-save"></i>
                                    {{ isset($destination_data) ? 'Update' : 'Submit' }}
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