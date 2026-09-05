@extends('Admin.Layouts.App')

@section('main_content')
    <div class="page-content">

        <!-- Breadcrumb -->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Update Car Owner Details</div>

            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active">
                            Update Car Owner Details
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
                            Update Car Owner Details
                        </h5>

                        <form class="row g-3" action="{{ route('admin.car-owner.update', $car_owner->id) }}"
                            method="POST" enctype="multipart/form-data">

                            @csrf

                            @if (isset($car_owner))
                                @method('PUT')
                            @endif

                            <!-- Personal Information -->
                            <div class="col-12">
                                <h5 class="mb-3">Personal Information</h5>
                                <hr>
                            </div>

                            <!-- First Name -->
                            <div class="col-md-3">
                                <label class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" name="first_name"
                                    class="form-control @error('first_name') is-invalid @enderror"
                                    value="{{ old('first_name', $car_owner->first_name ?? '') }}"
                                    placeholder="Enter First Name">

                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Last Name -->
                            <div class="col-md-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" name="last_name"
                                    class="form-control @error('last_name') is-invalid @enderror"
                                    value="{{ old('last_name', $car_owner->last_name ?? '') }}"
                                    placeholder="Enter Last Name">

                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-3">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $car_owner->email ?? '') }}"
                                    placeholder="Enter Email Address">

                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Phone Number -->
                            <div class="col-md-3">
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="phone_number" maxlength="10"
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                    class="form-control @error('phone_number') is-invalid @enderror"
                                    value="{{ old('phone_number', $car_owner->phone_number ?? '') }}"
                                    placeholder="Enter Phone Number">

                                @error('phone_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Vehicle Type --}}
                            <div class="col-md-4">
                                <label for="country" class="form-label">Country<span class="text-danger">*</span></label>
                                <select id="country" class="form-select @error('country_id') is-invalid @enderror"
                                    name="country_id" onchange="select_state()">
                                    <option value="">Choose...</option>
                                    @foreach ($countries as $countriesVal)
                                        <option value="{{ $countriesVal->id }}"
                                            {{ old('country_id', $car_owner->country_id ?? '') == $countriesVal->id ? 'selected' : '' }}>
                                            {{ $countriesVal->country_name }}</option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Charges Type --}}
                            <div class="col-md-4">

                                <label class="form-label">State<span class="text-danger">*</span></label>

                                <select id="state_id" class="form-select @error('state_id') is-invalid @enderror"
                                    name="state_id" onchange="fetch_district()">
                                    <option value="">Choose...</option>
                                    @foreach ($states as $statesVal)
                                        <option value="{{ $statesVal->id }}"
                                            {{ old('state_id', $car_owner->state_id ?? '') == $statesVal->id ? 'selected' : '' }}>
                                            {{ $statesVal->name }}</option>
                                    @endforeach
                                </select>

                                @error('state_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="col-md-4">

                                <label class="form-label">District<span class="text-danger">*</span></label>

                                <select id="district_id" class="form-select @error('district_id') is-invalid @enderror"
                                    name="district_id" onchange="fetch_city()">
                                    <option value="">Choose...</option>
                                    @foreach ($district as $districtVal)
                                        <option value="{{ $districtVal->id }}"
                                            {{ old('district_id', $car_owner->district_id ?? '') == $districtVal->id ? 'selected' : '' }}>
                                            {{ $districtVal->district_name }}</option>
                                    @endforeach
                                </select>

                                @error('district_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="col-md-4">
                                <label class="form-label">City<span class="text-danger">*</span> </label>

                                <select id="city_id" class="form-select @error('city_id') is-invalid @enderror"
                                    name="city_id" onchange="fetch_area()">
                                    <option value="">Choose...</option>
                                    @foreach ($cities as $citiesVal)
                                        <option value="{{ $citiesVal->id }}"
                                            {{ old('city_id', $car_owner->city_id ?? '') == $citiesVal->id ? 'selected' : '' }}>
                                            {{ $citiesVal->name }}</option>
                                    @endforeach
                                </select>

                                @error('city_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Area<span class="text-danger">*</span></label>
                                <select id="area_id" class="form-select @error('area_id') is-invalid @enderror"
                                    name="area_id" onchange="fetch_area_manager()">
                                    <option value="">Choose...</option>
                                    @foreach ($area as $areaVal)
                                        <option value="{{ $areaVal->id }}"
                                            {{ old('area_id', $car_owner->area_id ?? '') == $areaVal->id ? 'selected' : '' }}>
                                            {{ $areaVal->area_name }} - {{ $areaVal->pincode }}</option>
                                    @endforeach
                                </select>

                                @error('area_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Area Manager<span class="text-danger">*</span></label>
                                <select id="area_manager_id" class="form-select @error('area_manager_id') is-invalid @enderror"
                                    name="area_manager_id">
                                    <option value="">Choose...</option>
                                    @foreach ($area_manager as $area_managerVal)
                                        <option value="{{ $area_managerVal->id }}"
                                            {{ old('area_manager_id', $car_owner->area_manager_id ?? '') == $area_managerVal->id ? 'selected' : '' }}>
                                            {{ $area_managerVal->first_name }} {{ $area_managerVal->last_name }}</option>
                                    @endforeach
                                </select>

                                @error('area_manager_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <!-- Complete Address -->
                            <div class="col-md-12">
                                <label class="form-label">Complete Address</label>
                                <textarea name="complete_address" rows="3" class="form-control">{{ old('complete_address', $car_owner->complete_address) }}</textarea>
                            </div>

                            <!-- Aadhaar Number -->
                            <div class="col-md-4">
                                <label class="form-label">Aadhaar Number</label>
                                <input type="text" name="aadhar_card_number" maxlength="12" class="form-control"
                                    value="{{ old('aadhar_card_number', $car_owner->aadhar_card_number) }}">
                            </div>

                            <!-- Aadhaar File -->
                            <div class="col-md-8">
                                <label class="form-label">Aadhaar Card</label>

                                <div class="d-flex align-items-center gap-2">
                                    <input type="file" name="aadhar_card_file" class="form-control"
                                        accept=".pdf,.jpg,.jpeg,.png">

                                    @if ($car_owner->aadhar_card_file)
                                        <a href="{{ asset('uploads/car-owner/' . $car_owner->aadhar_card_file) }}"
                                            target="_blank" class="btn btn-outline-primary text-nowrap">
                                            <i class="bx bx-show"></i> View
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <!-- PAN -->
                            <div class="col-md-4">
                                <label class="form-label">PAN Number</label>
                                <input type="text" name="pan_card_number" class="form-control"
                                    value="{{ old('pan_card_number', $car_owner->pan_card_number) }}">
                            </div>

                            <!-- PAN File -->
                            <div class="col-md-8">
                                <label class="form-label">PAN Card</label>

                                <div class="d-flex align-items-center gap-2">
                                    <input type="file" name="pan_card_file" class="form-control"
                                        accept=".pdf,.jpg,.jpeg,.png">

                                    @if ($car_owner->pan_card_file)
                                        <a href="{{ asset('uploads/car-owner/' . $car_owner->pan_card_file) }}"
                                            target="_blank" class="btn btn-outline-primary text-nowrap">
                                            <i class="bx bx-show me-1"></i> View
                                        </a>
                                    @else
                                        <button type="button" class="btn btn-outline-secondary text-nowrap" disabled>
                                            <i class="bx bx-file me-1"></i> No File
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <hr>

                            <h5 class="mt-3">Bank Details</h5>

                            <div class="col-md-6">
                                <label class="form-label">Bank Name</label>
                                <input type="text" name="bank_name" class="form-control"
                                    value="{{ old('bank_name', $car_owner->bank_name) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Account Holder Name</label>
                                <input type="text" name="account_holder_name" class="form-control"
                                    value="{{ old('account_holder_name', $car_owner->account_holder_name) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Account Number</label>
                                <input type="text" name="account_number" class="form-control"
                                    value="{{ old('account_number', $car_owner->account_number) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">IFSC Code</label>
                                <input type="text" name="ifsc_code" class="form-control"
                                    value="{{ old('ifsc_code', $car_owner->ifsc_code) }}">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Passbook</label>

                                <div class="d-flex align-items-center gap-2">
                                    <input type="file" name="bank_passBook_file" class="form-control"
                                        accept=".pdf,.jpg,.jpeg,.png">

                                    @if ($car_owner->bank_passBook_file)
                                        <a href="{{ asset('uploads/car-owner/' . $car_owner->bank_passBook_file) }}"
                                            target="_blank" class="btn btn-outline-primary text-nowrap">
                                            <i class="bx bx-show me-1"></i> View Current File
                                        </a>
                                    @else
                                        <button type="button" class="btn btn-outline-secondary text-nowrap" disabled>
                                            <i class="bx bx-file me-1"></i> No File
                                        </button>
                                    @endif
                                </div>
                            </div>

                            <hr>

                            <h5 class="mt-3">Driving License</h5>

                            <div class="col-md-4">
                                <label class="form-label">Driving License Number</label>
                                <input type="text" name="driving_license" class="form-control"
                                    value="{{ old('driving_license', $car_owner->driving_license) }}">
                            </div>

                            <div class="col-md-8">
                                <label class="form-label">Driving License</label>

                                <div class="row g-2">
                                    <div class="col-md-8">
                                        <input type="file" name="driving_license_file" class="form-control"
                                            accept=".pdf,.jpg,.jpeg,.png">
                                    </div>

                                    <div class="col-md-4">
                                        @if ($car_owner->driving_license_file)
                                            <a href="{{ asset('uploads/car-owner/' . $car_owner->driving_license_file) }}"
                                                target="_blank" class="btn btn-outline-primary w-100">
                                                <i class="bx bx-show me-1"></i> View Current File
                                            </a>
                                        @else
                                            <button type="button" class="btn btn-outline-secondary w-100" disabled>
                                                <i class="bx bx-file me-1"></i> No File
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">License Start Date</label>
                                <input type="date" name="license_start_date" class="form-control"
                                    value="{{ old('license_start_date', $car_owner->license_start_date) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">License End Date</label>
                                <input type="date" name="license_end_date" class="form-control"
                                    value="{{ old('license_end_date', $car_owner->license_end_date) }}">
                            </div>

                            <hr>

                            <h5 class="mt-3">Employment</h5>

                            <div class="col-md-4">
                                <label class="form-label">Register Date</label>
                                <input type="date" name="register_date" class="form-control"
                                    value="{{ old('register_date', $car_owner->register_date) }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Start Date</label>
                                <input type="date" name="start_date" class="form-control"
                                    value="{{ old('start_date', $car_owner->start_date) }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">End Date</label>
                                <input type="date" name="end_date" class="form-control"
                                    value="{{ old('end_date', $car_owner->end_date) }}">
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
    function select_state() {

        var country_id = $('#country').val();

        $.ajax({
            url: "{{ route('admin.fetch_state') }}",
            type: 'POST',
            data: {
                country_id: country_id
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#state_id').empty();

                $('#state_id').append('<option value="">Choose...</option>');

                if (response.success) {
                    $.each(response.status, function(index, state) {
                        $('#state_id').append(
                            '<option value="' + state.id + '">' + state.name + '</option>'
                        );
                    });
                }
            },
            error: function(xhr) {
                console.error("Error updating status:", xhr.responseText);
            }
        });
    }
</script>

<script>
    function fetch_district() {

        var country_id = $('#country').val();
        var state_id = $('#state_id').val();

        $.ajax({
            url: "{{ route('admin.fetch_district') }}",
            type: 'POST',
            data: {
                country_id: country_id,
                state_id: state_id
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#district_id').empty();

                $('#district_id').append('<option value="">Choose...</option>');

                if (response.success) {
                    $.each(response.status, function(index, district) {
                        $('#district_id').append(
                            '<option value="' + district.id + '">' + district.district_name +
                            '</option>'
                        );
                    });
                }
            },
            error: function(xhr) {
                console.error("Error updating status:", xhr.responseText);
            }
        });
    }
</script>

<script>
    function fetch_city() {
        var country_id = $('#country').val();
        var state_id = $('#state_id').val();
        var district_id = $('#district_id').val();

        $.ajax({
            url: "{{ route('admin.fetch_city') }}",
            type: 'POST',
            data: {
                country_id: country_id,
                state_id: state_id,
                district_id: district_id
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#city_id').empty();

                $('#city_id').append('<option value="">Choose...</option>');

                if (response.success) {
                    $.each(response.status, function(index, state) {
                        $('#city_id').append(
                            '<option value="' + state.id + '">' + state.name + '</option>'
                        );
                    });
                }
            },
            error: function(xhr) {
                console.error("Error updating status:", xhr.responseText);
            }
        });
    }

    function fetch_area() {
        var country_id = $('#country').val();
        var state_id = $('#state_id').val();
        var district_id = $('#district_id').val();
        var city_id = $('#city_id').val();

        $.ajax({
            url: "{{ route('admin.fetch_area') }}",
            type: 'POST',
            data: {
                country_id: country_id,
                state_id: state_id,
                district_id: district_id,
                city_id: city_id
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#area_id').empty();

                $('#area_id').append('<option value="">Choose...</option>');

                if (response.success) {
                    $.each(response.status, function(index, area) {
                        $('#area_id').append(
                            '<option value="' + area.id + '">' + area.area_name +'-'+ area.pincode +
                            '</option>'
                        );
                    });
                }
            },
            error: function(xhr) {
                console.error("Error updating status:", xhr.responseText);
            }
        });
    }

    function fetch_area_manager(){
        var country_id = $('#country').val();
        var state_id = $('#state_id').val();
        var district_id = $('#district_id').val();
        var city_id = $('#city_id').val();
        var area_id = $('#area_id').val();

        $.ajax({
            url: "{{ route('admin.fetch_area_manager') }}",
            type: 'POST',
            data: {
                country_id: country_id,
                state_id: state_id,
                district_id: district_id,
                city_id: city_id,
                area_id: area_id
                
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#area_manager_id').empty();

                $('#area_manager_id').append('<option value="">Choose...</option>');

                if (response.success) {
                    $.each(response.status, function(index, areaManager) {
                        $('#area_manager_id').append(
                            '<option value="' + areaManager.id + '">' + areaManager.first_name +''+ areaManager.last_name +
                            '</option>'
                        );
                    });
                }
            },
            error: function(xhr) {
                console.error("Error updating status:", xhr.responseText);
            }
        });
    }
</script>
