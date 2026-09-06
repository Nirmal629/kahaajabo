@extends('Admin.Layouts.App')

@section('main_content')

<div class="page-content">

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

        <div class="breadcrumb-title pe-3">
            Vehicle Rates
        </div>

        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">

                    <li class="breadcrumb-item">
                        <i class="bx bx-home-alt"></i>
                    </li>

                    <li class="breadcrumb-item active">
                        Vehicle Rates
                    </li>

                </ol>
            </nav>
        </div>

        <div class="ms-auto">
            <a href="{{ route('admin.vehicle-rates.create') }}"
               class="btn btn-primary">

                <i class="bx bx-plus"></i>
                Add Vehicle Rate

            </a>
        </div>

    </div>


    <div class="card">

        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Vehicle Type</th>
                            <th>Vehicle Name</th>
                            <th>Price / KM</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($vehicle_rates as $vehicle_rate)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                           
                            <td>{{ $vehicle_rate->vehicleType->vehicle_type ?? '-' }}
                            </td>
                            <td>{{ $vehicle_rate->vehicle_name }}</td>
                            <td>₹{{ number_format($vehicle_rate->price_per_km, 2) }} / KM
                            </td>
                            <td>
                                @if($vehicle_rate->vehicle_image)
                                    <img
                                        src="{{ asset('uploads/vehicle-rate/' . $vehicle_rate->vehicle_image) }}"
                                        width="100"
                                        height="60"
                                        style="object-fit: cover; border-radius: 5px;"
                                    >
                                @else
                                    <span class="text-muted">
                                        No Image
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="form-check form-switch m-0">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            role="switch"
                                            id="statusSwitch{{ $vehicle_rate->id }}"
                                            data-id="{{ $vehicle_rate->id }}"
                                            {{ $vehicle_rate->status ? 'checked' : '' }}
                                            onchange="updateStatus(this)">
                                    </div>
                                </div>
                            </td>

                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <!-- Edit -->
                                    <a href="{{ route('admin.vehicle-rates.edit', $vehicle_rate->id) }}"
                                    class="text-primary"
                                    title="Edit">
                                        <i class="bx bx-edit fs-5"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('admin.vehicle-rates.destroy', $vehicle_rate->id) }}"
                                        method="POST"
                                        class="delete-form m-0 p-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn p-0 mt-2 border-0 bg-transparent text-danger"
                                                title="Delete">
                                            <i class="bx bx-trash fs-5"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection

<script>
	function updateStatus(checkbox) {
        
		const id = checkbox.getAttribute('data-id');
		const status = checkbox.checked ? 1 : 0;

		$.ajax({
			url: "{{ route('admin.vehicle-rates.update_status') }}",
			type: 'POST',
			data: {
				id: id,
				status: status
			},
			headers: {
				'X-CSRF-TOKEN': '{{ csrf_token() }}'
			},
			success: function(response) {
				const statusText = document.getElementById(`status-text-${id}`);

				toastr.options = {
					"closeButton": true,
					"progressBar": true,
					"maxOpened": 1,
					"limit": 1
				};

				if (response.success) {
					toastr.success(response.message);
				} else {
					toastr.error(response.message);
				}
			},
			error: function(xhr) {
				console.error("Error updating status:", xhr.responseText);
			}
		});
	}
</script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	$(document).ready(function () {

		$(document).on('submit', '.delete-form', function (e) {

			e.preventDefault();

			let form = this;

			Swal.fire({
				title: 'Are you sure?',
				text: 'You want to delete this vehicle rate details?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#dc3545',
				cancelButtonColor: '#6c757d',
				confirmButtonText: 'Yes, Delete it!'
			}).then((result) => {
				if (result.isConfirmed) {
					form.submit();
				}
			});

		});

	});
</script>