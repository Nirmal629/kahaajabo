@extends('Admin.Layouts.App')

@section('main_content')
    <div class="page-content">

        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">
                {{ isset($banner_data) ? 'Edit Home Banner' : 'Add Home Banner' }}
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
                            {{ isset($banner_data) ? 'Update Banner Details' : 'Add Banner Details' }}
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
                            {{ isset($banner_data) ? 'Update Banner Details' : 'Add Banner Details' }}
                        </h5>

                        <form class="row g-3"
                            action="{{ isset($banner_data)
                                ? route('admin.home-banner.update', $banner_data->id)
                                : route('admin.home-banner.store') }}"
                            method="POST"
                            enctype="multipart/form-data">

                            @csrf

                            @if(isset($banner_data))
                                @method('PUT')
                            @endif

                            <!-- Banner Title -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    Banner Title
                                </label>

                                <input type="text"
                                    name="banner_title"
                                    class="form-control @error('banner_title') is-invalid @enderror"
                                    value="{{ old('banner_title', $banner_data->banner_title ?? '') }}"
                                    placeholder="Enter Banner Title">

                                @error('banner_title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Banner Sub-Title -->
                            <div class="col-md-6">
                                <label class="form-label">
                                    Banner Sub-Title
                                </label>

                                <input type="text"
                                    name="banner_sub_title"
                                    class="form-control @error('banner_sub_title') is-invalid @enderror"
                                    value="{{ old('banner_sub_title', $banner_data->banner_sub_title ?? '') }}"
                                    placeholder="Enter Banner Sub-Title">

                                @error('banner_sub_title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="col-md-12">
                                <label class="form-label">
                                    Description
                                </label>

                                <textarea
                                    name="banner_description"
                                    class="form-control @error('banner_description') is-invalid @enderror"
                                    rows="4"
                                    placeholder="Enter Banner Description">{{ old('banner_description', $banner_data->banner_description ?? '') }}</textarea>

                                @error('banner_description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Banner Image -->
                            <div class="col-md-8">
                                <label class="form-label">
                                    Banner Image
                                </label>

                                <input type="file"
                                        name="banner_image"
                                        id="banner_image"
                                        class="form-control @error('banner_image') is-invalid @enderror"
                                        accept=".jpg,.jpeg,.png"
                                        onchange="document.getElementById('banner_preview').src = window.URL.createObjectURL(this.files[0]); document.getElementById('banner_preview').style.display = 'block';">
                            
                                @error('banner_image')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                             </div>
                            <div class="col-md-4">

                                <img id="banner_preview"
                                    src="{{ isset($banner_data) && $banner_data->banner_image
                                        ? \App\Helpers\LocationHelper::imageUrl('uploads/home-dynamic/' . $banner_data->banner_image)
                                        : '' }}"
                                    width="150"
                                    height="100"
                                    style="
                                        object-fit: cover;
                                        border: 1px solid #ddd;
                                        border-radius: 5px;
                                        {{ !isset($banner_data) || !$banner_data->banner_image ? 'display:none;' : '' }}
                                    ">

                            </div>

                          
                            <!-- Buttons -->
                            <div class="col-md-12 mt-3">

                                <button type="submit" class="btn btn-primary">
                                    <i class="bx bx-save"></i>
                                    {{ isset($banner_data) ? 'Update' : 'Submit' }}
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