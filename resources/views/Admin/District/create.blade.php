@extends('Admin.Layouts.App')

@section('main_content')

<div class="page-content">

    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Add District </div>

        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">
                        Add District Details
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
                        Add District Details
                    </h5>

                    <form class="row g-3"
                        action="{{ route('admin.district.store') }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        {{-- Vehicle Type --}}
                        <div class="col-md-6">
                            <label for="country" class="form-label">Country</label>
                            <select id="country" class="form-select @error('country_id') is-invalid @enderror" name="country_id" onchange="select_state()">
                                <option value="">Choose...</option>
                                @foreach ($countries as $countriesVal)
                                    <option value="{{ $countriesVal->id }}">{{ $countriesVal->country_name }}</option>
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

                            <label class="form-label">State</label>

                            <select id="state_id" class="form-select @error('state_id') is-invalid @enderror" name="state_id">
                                <option value="">Choose...</option>
                        
                            </select>

                            @error('state_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="col-md-12">
                            <label class="form-label">District Name</label>
                            <input type="text"
                                name="district_name"
                                class="form-control @error('district_name') is-invalid @enderror"
                                placeholder="District Name">

                            @error('district_name')
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



