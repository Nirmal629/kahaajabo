@extends('CarOwner-Dashboard.Layouts.App')
@section('main-content')
<div class="container-fluid">
    <div class="page_Title">
        <h2 class="ProfilepageTitle">Profile Settings</h2>
    </div>
    <div class="employeeDetails">

        <div class="row">
            <div class="col-lg-4 col-md-4 col-12">
                <div class="user-details">
                    <div class="profile_img">
                        <img src="./Assets/images/image1.jpg" class="img-fluid">
                    </div>
                    <div class="DetailsData">
                        <h4>John Doe</h4>
                        <h6>User</h6>
                        <div class="d-flex justify-content-center align-items-center">
                            <a href="#" class="choose_image"><i class="fa-regular fa-images"></i> Choose</a>
                            <button class="action_btn upload"><i class="fa-solid fa-upload"></i>
                                Upload</button>
                            <button class="action_btn delete"><i class="fa-solid fa-trash"></i>
                                Delete</button>
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
                                    <input type="text" class="form-control" placeholder="Name">
                                </div>
                                <div class="col">
                                    <label for="userForminput2">Email <span>*</span></label>
                                    <input type="email" class="form-control" placeholder="Email">
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
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection