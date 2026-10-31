@extends('Admin.Layouts.App')

@section('main_content')

<div class="page-content">

    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Update Area </div>

        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">
                        Update Area Details
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
                        Update Area Details
                    </h5>

                    <form class="row g-3"
                        action="{{ route('admin.area.update',$area->id) }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        @if(isset($area))
                            @method('PUT')
                        @endif

                        {{-- Vehicle Type --}}
                        <div class="col-md-3">
                            <label for="country" class="form-label">Country</label>
                            <select id="country" class="form-select @error('country_id') is-invalid @enderror" name="country_id" onchange="select_state()">
                                <option value="">Choose...</option>
                                @foreach ($countries as $countriesVal)
                                    <option value="{{ $countriesVal->id }}" {{ old('country_id', $area->country_id ?? '') == $countriesVal->id ? 'selected' : '' }}>{{ $countriesVal->country_name }}</option>
                                @endforeach
                            </select>
                            @error('country_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Charges Type --}}
                        <div class="col-md-3">

                            <label class="form-label">State</label>

                            <select id="state_id" class="form-select @error('state_id') is-invalid @enderror" name="state_id" onchange="fetch_district()">
                                <option value="">Choose...</option>
                                @foreach ($states as $statesVal)
                                    <option value="{{ $statesVal->id }}" {{ old('state_id', $area->state_id ?? '') == $statesVal->id ? 'selected' : '' }}>{{ $statesVal->name }}</option>
                                @endforeach
                            </select>

                            @error('state_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="col-md-3">

                            <label class="form-label">District</label>

                            <select id="district_id" class="form-select @error('district_id') is-invalid @enderror" name="district_id" onchange="fetch_city()">
                                <option value="">Choose...</option>
                                @foreach ($district as $districtVal)
                                    <option value="{{ $districtVal->id }}" {{ old('district_id', $area->district_id ?? '') == $districtVal->id ? 'selected' : '' }}>{{ $districtVal->district_name }}</option>
                                @endforeach
                            </select>

                            @error('district_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-md-3">
                            <label class="form-label">City </label>

                             <select id="city_id" class="form-select @error('city_id') is-invalid @enderror" name="city_id">
                                <option value="">Choose...</option>
                                 @foreach ($cities as $citiesVal)
                                    <option value="{{ $citiesVal->id }}" {{ old('city_id', $area->city_id ?? '') == $citiesVal->id ? 'selected' : '' }}>{{ $citiesVal->name }}</option>
                                @endforeach
                            </select>

                            @error('city_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Area Name</label>
                            <input type="text"
                                name="area_name"
                                class="form-control @error('area_name') is-invalid @enderror"
                                placeholder="Area Name" value="{{ old('area_name',$area->area_name ?? '') }}">

                            @error('area_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Pincode</label>
                            <input type="text"
                                name="pincode"
                                class="form-control @error('pincode') is-invalid @enderror" value="{{ old('pincode',$area->pincode ?? '') }}"
                                placeholder="Pincode" maxlength="6" oninput="this.value = this.value.replace(/[^0-9]/g, '')">

                            @error('pincode')
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

<script>
    function select_state(){

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
    function fetch_district(){

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
                            '<option value="' + district.id + '">' + district.district_name + '</option>'
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
    function fetch_city(){
        var country_id = $('#country').val();
        var state_id = $('#state_id').val();
        var district_id = $('#district_id').val();

		$.ajax({
			url: "{{ route('admin.fetch_city') }}",
			type: 'POST',
			data: {
				country_id: country_id,
				state_id: state_id,
                district_id:district_id
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
</script>


