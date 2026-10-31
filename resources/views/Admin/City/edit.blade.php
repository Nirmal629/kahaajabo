@extends('Admin.Layouts.App')

@section('main_content')

<div class="page-content">

    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Update City </div>

        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">
                        Update City Details
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
                        Update City Details
                    </h5>

                    <form class="row g-3"
                        action="{{ route('admin.city.update',$data->id) }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        @if(isset($data))
                            @method('PUT')
                        @endif
                        {{-- Vehicle Type --}}
                        <div class="col-md-4">
                            <label for="country" class="form-label">Country</label>
                            <select id="country" class="form-select @error('country_id') is-invalid @enderror" name="country_id" onchange="select_state()">
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
                        <div class="col-md-4">

                            <label class="form-label">State</label>

                            <select id="state_id" class="form-select @error('state_id') is-invalid @enderror" name="state_id" onchange="fetch_district()">
                                <option value="">Choose...</option>
                                @foreach ($states as $statesVal)
                                    <option value="{{ $statesVal->id }}" {{ old('state_id', $data->state_id ?? '') == $statesVal->id ? 'selected' : '' }}>{{ $statesVal->name }}</option>
                                @endforeach
                            </select>

                            @error('state_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-md-4">

                            <label class="form-label">District</label>

                            <select id="district_id" class="form-select @error('district_id') is-invalid @enderror" name="district_id">
                                <option value="">Choose...</option>
                                @foreach ($district as $districtVal)
                                    <option value="{{ $districtVal->id }}" {{ old('district_id', $data->district_id ?? '') == $districtVal->id ? 'selected' : '' }}>{{ $districtVal->district_name }}</option>
                                @endforeach
                            </select>

                            @error('district_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="col-md-12">
                            <label class="form-label">City Name</label>
                            <input type="text"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="City Name" value="{{ old('name',$data->name ?? '') }}">

                            @error('name')
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



