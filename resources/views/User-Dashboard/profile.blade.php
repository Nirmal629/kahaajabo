@extends('User-Dashboard.Layouts.App')

@section('main-content')

<div class="container-fluid">
    <div class="page_Title">
        <h2 class="ProfilepageTitle mt-3">Profile Settings</h2>
    </div>
    <div class="employeeDetails">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-12">
                <div class="user-details">
                    <div class="profile_img">
                        <img src="{{ Auth::user()->profile_image
                            ? asset('storage/' . Auth::user()->profile_image)
                            : asset('Assets/images/image1.jpg') }}"
                            class="img-fluid"
                            id="profilePreview"
                            alt="Profile Image">
                    </div>

                    <div class="DetailsData">
                        <h4>{{ Auth::user()->name }}</h4>
                        <h6>{{ Auth::user()->user_type ?? 'User' }}</h6>
                        <div class="d-flex justify-content-center align-items-center">

                            <input type="file" id="profileImageInput" accept="image/*" hidden>

                            <a href="javascript:void(0)" class="choose_image"
                            onclick="document.getElementById('profileImageInput').click()">
                                <i class="fa-regular fa-images"></i> Choose
                            </a>

                            <button type="button" class="action_btn upload">
                                <i class="fa-solid fa-upload"></i> Upload
                            </button>

                            <button type="button" class="action_btn delete">
                                <i class="fa-solid fa-trash"></i> Delete
                            </button>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-12">
                <div class="user_form">

                    <form>
                        <div class="mb-3">
                            <h4><i class="fa-solid fa-circle-user"></i> Account Details</h4>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="userForminput1">Name <span>*</span></label>
                                    <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" placeholder="Name">
                                </div>
                                <div class="col">
                                    <label for="userForminput2">Email <span>*</span></label>
                                    <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" placeholder="Email">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="userForminput3">WhatsApp Number<span>*</span></label>
                                    <input type="text" class="form-control" placeholder="Number">
                                </div>
                                <div class="col">
                                    <label for="userForminput4">Password<span>*</span></label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="userForminput5">Gender<span>*</span></label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                                <div class="col">
                                    <label for="userForminput6">Date Of Birth<span>*</span></label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h4><i class="fa-solid fa-sliders"></i> Preferences & Settings</h4>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="userForminput7">Skill Level<span>*</span></label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                                <div class="col">
                                    <label for="userForminput8">Currency<span>*</span></label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="userForminput9">Time Zone<span>*</span></label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                                <div class="col">
                                    <label for="userForminput10">User type<span>*</span></label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div>

                        </div>
                        <div class="mb-3">
                            <h4><i class="fa-solid fa-map-location-dot"></i> Location Information</h4>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="userForminput7">City<span>*</span></label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                                <div class="col">
                                    <label for="userForminput8">Province<span>*</span></label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="userForminput9">Country<span>*</span></label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div>

                        </div>
                        <div>
                            <h4> <i class="fa-solid fa-shield-halved"></i> permissions & Privacy</h4>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Email Notification Permission <span>*</span></label>

                                        <div class="toggle-group">
                                            <button class="toggle-btn active">Yes</button>
                                            <button class="toggle-btn">No</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label> Call, Text & Chat Consent <span>*</span></label>

                                        <div class="toggle-group">
                                            <button class="toggle-btn active">Yes</button>
                                            <button class="toggle-btn">No</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <button class="Primary-btn ml-auto d-table">Save Profile Changes</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // Yes / No notification toggles
    document.querySelectorAll('.toggle-btn').forEach(function (button) {

        button.addEventListener('click', function () {

            const group = this.dataset.group;
            const value = this.dataset.value;

            document.querySelectorAll(
                '.toggle-btn[data-group="' + group + '"]'
            ).forEach(function (item) {
                item.classList.remove('active');
            });

            this.classList.add('active');

            document.getElementById(group).value = value;
        });

    });

    // Show / hide password
    document.querySelectorAll('.password-eye').forEach(function (icon) {

        icon.addEventListener('click', function () {

            const input = document.getElementById(this.dataset.target);

            if (input.type === 'password') {
                input.type = 'text';
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }

        });

    });

    // Profile image preview
    const imageInput = document.getElementById('profileImage');
    const imagePreview = document.getElementById('profilePreview');

    if (imageInput && imagePreview) {

        imageInput.addEventListener('change', function () {

            const file = this.files[0];

            if (!file) return;

            if (!['image/jpeg', 'image/png', 'image/webp'].includes(file.type)) {
                alert('Please select a JPG, PNG or WEBP image.');
                this.value = '';
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                alert('Profile image must be 2 MB or smaller.');
                this.value = '';
                return;
            }

            imagePreview.src = URL.createObjectURL(file);
        });

    }

});
</script>

@endsection
