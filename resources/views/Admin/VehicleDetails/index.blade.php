@extends('Admin.Layouts.App')
@section('main_content')

<?php
use App\Models\CarOwner;
?>

<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Vehicle</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Vehicle Details</li>
							</ol>
						</nav>
					</div>
					{{-- <div class="ms-auto">
						<div class="btn-group">
							<a href="{{ route('admin.vehicle-details.create') }}">
                                <button type="button" class="btn btn-primary">Add Vehicle Details</button>
                            </a>
						</div>
					</div> --}}
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase">Vehicle Details List</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>S/No.</th>
										<th>Car Owner Name</th>
										<th>Vehicle Brand</th>
										<th>Vehicle Model</th>
										<th>Vehicle Type</th>
										<th>Seat Capacity</th>
										<th>Year of Manufacture</th>
										<th>Fuel Type</th>
										<th>Registration Number</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($get_vehicleDetails as $get_vehicleDetails_Val)

										@php
											$car_ownerDetails = null;

											if ($get_vehicleDetails_Val->vehicle_owner_type == 'Car Owner') {
												$car_ownerDetails = App\Models\CarOwner::find($get_vehicleDetails_Val->vehicle_owner_id);
											}
										@endphp

										<tr>
											<td>{{ $loop->iteration }}</td>
											<td>{{ $car_ownerDetails ? $car_ownerDetails->first_name . ' ' . $car_ownerDetails->last_name : '-' }}</td>
											<td>{{ $get_vehicleDetails_Val->brand }}</td>
											<td>{{ $get_vehicleDetails_Val->model }}</td>
											<td>{{ $get_vehicleDetails_Val->type }}</td>
											<td>{{ $get_vehicleDetails_Val->seat_capacity }}</td>
											<td>{{ $get_vehicleDetails_Val->manufacture_year }}</td>
											<td>{{ $get_vehicleDetails_Val->fuel_type }}</td>
											<td>{{ $get_vehicleDetails_Val->registration_number }}</td>
											<td>
												<div class="d-flex align-items-center gap-2">
													<div class="form-check form-switch m-0">
														<input
															class="form-check-input"
															type="checkbox"
															role="switch"
															id="statusSwitch{{ $get_vehicleDetails_Val->id }}"
															data-id="{{ $get_vehicleDetails_Val->id }}"
															{{ $get_vehicleDetails_Val->status ? 'checked' : '' }}
															onchange="updateStatus(this)">
													</div>
													<span
														id="status-text-{{ $get_vehicleDetails_Val->id }}"
														class="form-check-label status-badge {{ $get_vehicleDetails_Val->status ? 'status-active' : 'status-inactive' }}">
														{{ $get_vehicleDetails_Val->status ? 'ACTIVE' : 'INACTIVE' }}
													</span>
												</div>
											</td>

											<td>
												<div class="d-flex align-items-center gap-2">

													<!-- View -->
													<a href="javascript:void(0)"
														class="text-primary me-2 viewVehicle"
														data-id="{{ $get_vehicleDetails_Val->id }}"
														title="View">
														<i class="bx bx-show fs-5"></i>
													</a>

													<!-- Edit -->
													<a href="{{ route('admin.vehicle-details.edit', $get_vehicleDetails_Val->id) }}"
													class="text-primary"
													title="Edit">
														<i class="bx bx-edit fs-5"></i>
													</a>

													<!-- Delete -->
													<form action="{{ route('admin.vehicle-details.destroy', $get_vehicleDetails_Val->id) }}"
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

					<div class="modal fade" id="vehicleViewModal" tabindex="-1">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">

								<div class="modal-header">
									<h5 class="modal-title">Vehicle Details</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>

								<div class="modal-body" id="vehicleDetailsBody">

									<div class="text-center">
										Loading...
									</div>

								</div>

							</div>
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
			url: "{{ route('admin.vehicleDetails.update_status') }}",
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

				if(response.status == 1)
				{
					statusText.innerHTML = "ACTIVE";
					statusText.classList.remove('status-inactive');
					statusText.classList.add('status-active');
				}
				else
				{
					statusText.innerHTML = "INACTIVE";
					statusText.classList.remove('status-active');
					statusText.classList.add('status-inactive');
				}

				// if (statusText) {
				//     statusText.textContent = (response.status == 1) ? 'Active' : 'Inactive';
				// }

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
				text: 'You want to delete this vehicle?',
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

<script>
	$(document).on('click','.viewVehicle',function(){

		let id=$(this).data('id');

		$.ajax({

			url:"{{ url('admin/vehicle-details') }}/"+id+"/view",

			type:"GET",

			success:function(res){
                    
				let html = `

				<div class="container-fluid">

					<!-- Vehicle Information -->
					<div class="card shadow-sm border-0 mb-4">

						<div class="card-header bg-light">
							<h5 class="mb-0 text-primary">
								<i class="bx bx-car"></i> Vehicle Information
							</h5>
						</div>

						<div class="card-body">

							<div class="row">

								<div class="col-md-3 mb-3">
									<label class="fw-bold text-secondary">Brand</label>
									<div>${res.brand ?? '-'}</div>
								</div>

								<div class="col-md-3 mb-3">
									<label class="fw-bold text-secondary">Model</label>
									<div>${res.model ?? '-'}</div>
								</div>

								<div class="col-md-3 mb-3">
									<label class="fw-bold text-secondary">Vehicle Type</label>
									<div>${res.type ?? '-'}</div>
								</div>

								<div class="col-md-3 mb-3">
									<label class="fw-bold text-secondary">Capacity</label>
									<div>${res.seat_capacity} Persons</div>
								</div>

								<div class="col-md-3 mb-3">
									<label class="fw-bold text-secondary">Manufacture Year</label>
									<div>${res.manufacture_year}</div>
								</div>

								<div class="col-md-3 mb-3">
									<label class="fw-bold text-secondary">Fuel Type</label>
									<div>
										<span class="badge bg-success">
											${res.fuel_type}
										</span>
									</div>
								</div>
							</div>

						</div>

					</div>


					<!-- Documents -->

					<div class="card shadow-sm border-0">

						<div class="card-header bg-light">
							<h5 class="mb-0 text-primary">
								<i class="bx bx-file"></i> Vehicle Documents
							</h5>
						</div>

						<div class="card-body">

							<div class="row">

								<!-- RC -->

								<div class="col-md-6 mb-4">

									<div class="card h-100 border">

										<div class="card-body">

											<h6 class="text-primary mb-3">
												<i class="bx bx-id-card"></i>
												Registration Certificate
											</h6>

											<p class="mb-2">
												<strong>Registration Number :</strong><br>
												${res.registration_number}
											</p>

											<a href="/storage/${res.document.registration_certificate}"
												target="_blank"
												class="btn btn-primary btn-sm">

												<i class="bx bx-show"></i>
												View Document

											</a>

										</div>

									</div>

								</div>


								<!-- Insurance -->

								<div class="col-md-6 mb-4">

									<div class="card h-100 border">

										<div class="card-body">

											<h6 class="text-success mb-3">
												<i class="bx bx-shield"></i>
												Insurance Policy
											</h6>

											<p class="mb-2">
												<strong>Policy No :</strong><br>
												${res.document.insurance_policy_number ?? '-'}
											</p>

											<p class="mb-2">
												<strong>Validity :</strong><br>
												${formatDate(res.document.insurance_policy_startDate ?? '-')}
												&nbsp;to&nbsp;
												${formatDate(res.document.insurance_policy_endDate ?? '-')}
											</p>

											<a href="/storage/${res.document.insurance_policy_file}"
												target="_blank"
												class="btn btn-success btn-sm">

												<i class="bx bx-show"></i>
												View Document

											</a>

										</div>

									</div>

								</div>


								<!-- Fitness -->

								<div class="col-md-6 mb-4">

									<div class="card h-100 border">

										<div class="card-body">

											<h6 class="text-warning">
												<i class="bx bx-certification"></i>
												Fitness Certificate
											</h6>

											<p class="mb-2">
												<strong>Certificate No :</strong><br>
												${res.document.fitness_certificate_number ?? '-'}
											</p>

											<p class="mb-2">
												<strong>Validity :</strong><br>
												${formatDate(res.document.fitness_certificate_startDate ?? '-')}
												&nbsp;to&nbsp;
												${formatDate(res.document.fitness_certificate_endDate ?? '-')}
											</p>

											<a href="/storage/${res.document.fitness_certificate_file}"
												target="_blank"
												class="btn btn-warning btn-sm text-dark">

												<i class="bx bx-show"></i>
												View Document

											</a>

										</div>

									</div>

								</div>


								<!-- AITP -->

								<div class="col-md-6 mb-4">

									<div class="card h-100 border">

										<div class="card-body">

											<h6 class="text-info">
												<i class="bx bx-world"></i>
												All India Tourist Permit
											</h6>

											<p class="mb-2">
												<strong>Permit No :</strong><br>
												${res.document.allIndia_tourist_permit_number ?? '-'}
											</p>

											<p class="mb-2">
												<strong>Validity :</strong><br>
												${formatDate(res.document.allIndia_tourist_permit_startDate ?? '-')}
												&nbsp;to&nbsp;
												${formatDate(res.document.allIndia_tourist_permit_endDate ?? '-')}
											</p>

											<a href="/storage/${res.document.allIndia_tourist_permit_file}"
												target="_blank"
												class="btn btn-info btn-sm text-white">

												<i class="bx bx-show"></i>
												View Document

											</a>

										</div>

									</div>

								</div>

							</div>

						</div>

					</div>

				</div>`;


				$("#vehicleDetailsBody").html(html);

				$("#vehicleViewModal").modal('show');

			}

		});

	});
</script>