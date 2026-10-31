@extends('Admin.Layouts.App')
@section('main_content')
<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">District</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">District List</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<a href="{{ route('admin.district.create') }}">
                                <button type="button" class="btn btn-primary">Add District</button>
                            </a>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase">All Districts</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Sl No.</th>
										<th>Country Name</th>
										<th>State Name</th>
										<th>District Name</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($all_district as $district_val)
										<tr>
											<td>{{ $loop->iteration }}</td>
											<td>{{ $district_val->country_name ?? '-' }}</td>
											<td>{{ $district_val->state_name }}</td>
											<td>{{ $district_val->district_name }}</td>
											<td>
												<div class="d-flex align-items-center gap-2">
													<div class="form-check form-switch m-0">
														<input
															class="form-check-input"
															type="checkbox"
															role="switch"
															id="statusSwitch{{ $district_val->id }}"
															data-id="{{ $district_val->id }}"
															{{ $district_val->status ? 'checked' : '' }}
															onchange="updateStatus(this)">
													</div>
													<span
														id="status-text-{{ $district_val->id }}"
														class="form-check-label status-badge {{ $district_val->status ? 'status-active' : 'status-inactive' }}">
														{{ $district_val->status ? 'ACTIVE' : 'INACTIVE' }}
													</span>
												</div>
											</td>

											<td>
												<div class="d-flex align-items-center gap-2">
													<!-- Edit -->
													<a href="{{ route('admin.district.edit', $district_val->id) }}"
													class="text-primary"
													title="Edit">
														<i class="bx bx-edit fs-5"></i>
													</a>

													<!-- Delete -->
													<form action="{{ route('admin.district.destroy', $district_val->id) }}"
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
			url: "{{ route('admin.district.update_status') }}",
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
				text: 'You want to delete this district?',
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
