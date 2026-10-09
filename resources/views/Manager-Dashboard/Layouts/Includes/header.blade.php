<nav class="navbar navbar-expand-sm customnavigation">
    <div class="sidebar-logo">
        <a href="/"> <img src="{{asset('public/Frontend/Assets/images/logo1.png')}}" class="img-fluid" alt="logo" /></a>
    </div>
    <ul class="navbar-nav">
        <li class="nav-item dropdown">
            <a class=" dropdown-toggle profile-dp" id="navbardrop" data-toggle="dropdown" href="/">
                <img src="{{asset('public/Frontend/Assets/images/image1.jpg')}}" alt="profile-pic" class="img-fluid mr-2">
                {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="/my-profile"><i
                        class="fa-regular fa-user mr-2"></i> My Profile</a>

                <a class="dropdown-item" href="{{ route('logout') }}">
                    <i class="fa fa-sign-out mr-2"></i>Logout</a>
            </div>
        </li>
    </ul>
</nav> 

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

@if(Auth::guard('web')->check() && !Auth::guard('web')->user()->profile_completed)

<div class="modal fade"
     id="mandatoryProfileModal"
     tabindex="-1"
     role="dialog"
     aria-hidden="true"
     data-backdrop="static"
     data-keyboard="false">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Complete Your Profile
                </h5>

            </div>


            <div class="modal-body">

                <p class="mb-4">
                    Please complete your location details
                    to continue.
                </p>


                <form id="mandatoryProfileForm">

                    @csrf


                    {{-- Country --}}

                    <div class="form-group mb-3">

                        <label>
                            Country
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            name="country_id"
                            class="form-control location-country"
                            required>

                            <option value="">
                                Choose Country
                            </option>

                            @foreach($countries as $country)

                                <option value="{{ $country->id }}">
                                    {{ $country->country_name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- State --}}

                    <div class="form-group mb-3">

                        <label>
                            State
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            name="state_id"
                            class="form-control location-state"
                            disabled
                            required>

                            <option value="">
                                Choose State
                            </option>

                        </select>

                    </div>


                    {{-- District --}}

                    <div class="form-group mb-3">

                        <label>
                            District
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            name="district_id"
                            class="form-control location-district"
                            disabled
                            required>

                            <option value="">
                                Choose District
                            </option>

                        </select>

                    </div>


                    {{-- City --}}

                    <div class="form-group mb-3">

                        <label>
                            City
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            name="city_id"
                            class="form-control location-city"
                            disabled
                            required>

                            <option value="">
                                Choose City
                            </option>

                        </select>

                    </div>


                    {{-- Area --}}

                    <div class="form-group mb-3">

                        <label>
                            Area
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            name="area_id"
                            class="form-control location-area"
                            disabled
                            required>

                            <option value="">
                                Choose Area
                            </option>

                        </select>

                    </div>


                    <div id="profileError"
                         class="alert alert-danger d-none">
                    </div>


                    <button
                        type="submit"
                        id="saveProfileBtn"
                        class="btn btn-primary w-100">

                        Save & Continue

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endif

@if(Auth::guard('web')->check() && !Auth::guard('web')->user()->profile_completed)

<script>

 $(document).ready(function() {

    $('#mandatoryProfileModal').modal({
        backdrop: 'static',
        keyboard: false,
        show: true
    });

    $('#mandatoryProfileModal').on(
        'hide.bs.modal',
        function(e) {

            e.preventDefault();

            return false;
        }
    );

    $('#mandatoryProfileForm .location-country').on(
        'change',
        function()
        {

            let form =
                $('#mandatoryProfileForm');

            let country_id =
                $(this).val();


            form.find('.location-state')
                .html(
                    '<option value="">Choose State</option>'
                )
                .prop('disabled', true);


            form.find('.location-district')
                .html(
                    '<option value="">Choose District</option>'
                )
                .prop('disabled', true);


            form.find('.location-city')
                .html(
                    '<option value="">Choose City</option>'
                )
                .prop('disabled', true);


            form.find('.location-area')
                .html(
                    '<option value="">Choose Area</option>'
                )
                .prop('disabled', true);


            if (!country_id) {
                return;
            }


            loadStates(
                form,
                country_id
            );

        }
    );

    $('#mandatoryProfileForm .location-state').on(
        'change',
        function()
        {

            let form =
                $('#mandatoryProfileForm');

            let country_id =
                form.find('.location-country').val();

            let state_id =
                $(this).val();


            form.find('.location-district')
                .html(
                    '<option value="">Choose District</option>'
                )
                .prop('disabled', true);


            form.find('.location-city')
                .html(
                    '<option value="">Choose City</option>'
                )
                .prop('disabled', true);


            form.find('.location-area')
                .html(
                    '<option value="">Choose Area</option>'
                )
                .prop('disabled', true);


            if (!state_id) {
                return;
            }


            loadDistricts(
                form,
                country_id,
                state_id
            );

        }
    );

    $('#mandatoryProfileForm .location-district').on(
        'change',
        function()
        {

            let form =
                $('#mandatoryProfileForm');

            let country_id =
                form.find('.location-country').val();

            let state_id =
                form.find('.location-state').val();

            let district_id =
                $(this).val();


            form.find('.location-city')
                .html(
                    '<option value="">Choose City</option>'
                )
                .prop('disabled', true);


            form.find('.location-area')
                .html(
                    '<option value="">Choose Area</option>'
                )
                .prop('disabled', true);


            if (!district_id) {
                return;
            }


            loadCities(
                form,
                country_id,
                state_id,
                district_id
            );

        }
    );

    $('#mandatoryProfileForm .location-city').on(
        'change',
        function()
        {

            let form =
                $('#mandatoryProfileForm');

            let country_id =
                form.find('.location-country').val();

            let state_id =
                form.find('.location-state').val();

            let district_id =
                form.find('.location-district').val();

            let city_id =
                $(this).val();


            form.find('.location-area')
                .html(
                    '<option value="">Choose Area</option>'
                )
                .prop('disabled', true);


            if (!city_id) {
                return;
            }


            loadAreas(
                form,
                country_id,
                state_id,
                district_id,
                city_id
            );

        }
    );

    $('#mandatoryProfileForm').on(
        'submit',
        function(e)
        {
            e.preventDefault();
            let form = $(this);
            let button = $('#saveProfileBtn');
            let errorBox = $('#profileError');
            errorBox.addClass('d-none').html('');
            button.prop('disabled', true).text('Saving...');
            $.ajax({
                url: "{{ route('profile.complete.update') }}",
                type:"POST",
                data:form.serialize(),
                success: function(response) {
                    if (response.status) {
                        window.location.href = response.redirect;
                    }
                },
                error: function(xhr) {
                    button.prop('disabled', false).text('Save & Continue');
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let html = '';
                        $.each(
                            errors,
                            function(key, messages)
                            {
                                $.each(
                                    messages,
                                    function(index, message)
                                    {
                                        html += '<div>' + message + '</div>';
                                    }
                                );
                            }
                        );
                        errorBox.removeClass('d-none').html(html);
                    } else {
                        errorBox.removeClass('d-none')
                            .html('Something went wrong. Please try again.');
                    }
                }
            });
        }
    );
});

</script>

@endif

<script>
    function loadStates(form, country_id, selectedState = null) {

        let state = form.find('.location-state');

        return $.ajax({

            url: "{{ route('location.fetch') }}",

            type: "POST",

            data: {
                _token: "{{ csrf_token() }}",
                type: "state",
                country_id: country_id
            }

        }).then(function(response) {

            state.html('<option value="">Choose State</option>');

            if (response.success) {

                $.each(response.status, function(key, value) {

                    state.append(
                        `<option value="${value.id}">
                        ${value.name}
                    </option>`
                    );

                });

                state.prop('disabled', false);

                if (selectedState) {
                    state.val(selectedState);
                }
            }

        });
    }

    function loadDistricts(form, country_id, state_id, selectedDistrict = null) {

        let district = form.find('.location-district');

        return jQuery.ajax({

            url: "{{ route('location.fetch') }}",

            type: "POST",

            data: {
                _token: "{{ csrf_token() }}",
                type: "district",
                country_id: country_id,
                state_id: state_id
            }

        }).then(function(response) {

            district.html('<option value="">Choose District</option>');

            if (response.success) {

                $.each(response.status, function(key, value) {

                    district.append(
                        `<option value="${value.id}">
                        ${value.district_name}
                    </option>`
                    );

                });

                district.prop('disabled', false);

                if (selectedDistrict) {
                    district.val(selectedDistrict);
                }
            }

        });
    }

    function loadCities(
        form,
        country_id,
        state_id,
        district_id,
        selectedCity = null
    ) {

        let city = form.find('.location-city');

        return $.ajax({

            url: "{{ route('location.fetch') }}",

            type: "POST",

            data: {
                _token: "{{ csrf_token() }}",
                type: "city",
                country_id: country_id,
                state_id: state_id,
                district_id: district_id
            }

        }).then(function(response) {

            city.html('<option value="">Choose City</option>');

            if (response.success) {

                $.each(response.status, function(key, value) {

                    city.append(
                        `<option value="${value.id}">
                        ${value.name}
                    </option>`
                    );

                });

                city.prop('disabled', false);

                if (selectedCity) {
                    city.val(selectedCity);
                }
            }

        });
    }

    function loadAreas(
        form,
        country_id,
        state_id,
        district_id,
        city_id,
        selectedArea = null
    ) {

        let area = form.find('.location-area');

        return $.ajax({

            url: "{{ route('location.fetch') }}",

            type: "POST",

            data: {
                _token: "{{ csrf_token() }}",
                type: "area",
                country_id: country_id,
                state_id: state_id,
                district_id: district_id,
                city_id: city_id
            }

        }).then(function(response) {

            area.html('<option value="">Choose Area</option>');

            if (response.success) {

                $.each(response.status, function(key, value) {

                    area.append(
                        `<option value="${value.id}">
                        ${value.area_name}
                    </option>`
                    );

                });

                area.prop('disabled', false);

                if (selectedArea) {
                    area.val(selectedArea);
                }
            }

        });
    }

    function restoreLocation(form, values) {

        let country_id = values.country;
        let state_id = values.state;
        let district_id = values.district;
        let city_id = values.city;
        let area_id = values.area;


        if (!country_id) {
            return;
        }


        loadStates(
                form,
                country_id,
                state_id
            )
            .then(function() {

                if (!state_id) {
                    return;
                }

                return loadDistricts(
                    form,
                    country_id,
                    state_id,
                    district_id
                );

            })
            .then(function() {

                if (!district_id) {
                    return;
                }

                return loadCities(
                    form,
                    country_id,
                    state_id,
                    district_id,
                    city_id
                );

            })
            .then(function() {

                if (!city_id) {
                    return;
                }

                return loadAreas(
                    form,
                    country_id,
                    state_id,
                    district_id,
                    city_id,
                    area_id
                );

            })
            .catch(function(error) {

                console.log(error);

            });
    }
</script>