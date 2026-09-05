@extends('Admin.Layouts.App')
@section('main_content')
<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Country</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Country List</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<a href="{{ route('admin.country.create') }}">
                                <button type="button" class="btn btn-primary">Add Country</button>
                            </a>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase">All Countries</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Sl No.</th>
										<th>Country Code</th>
										<th>Country</th>
										<th>Phone Code</th>
										<th>Currency</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($countries as $countries_val)
										<tr>
											<td>{{ $loop->iteration }}</td>
											<td>{{ $countries_val->country_code }}</td>
											<td>{{ $countries_val->country_name }}</td>
											<td>{{ $countries_val->phone_code }}</td>
											<td>{{ $countries_val->currency }}</td>
											<td>
												<div class="d-flex align-items-center gap-2">
													<div class="form-check form-switch m-0">
														<input
															class="form-check-input"
															type="checkbox"
															role="switch"
															id="statusSwitch{{ $countries_val->id }}"
															data-id="{{ $countries_val->id }}"
															{{ $countries_val->status ? 'checked' : '' }}
															onchange="updateStatus(this)">
													</div>
													<span
														id="status-text-{{ $countries_val->id }}"
														class="form-check-label status-badge {{ $countries_val->status ? 'status-active' : 'status-inactive' }}">
														{{ $countries_val->status ? 'ACTIVE' : 'INACTIVE' }}
													</span>
												</div>
											</td>

											<td>
												<div class="d-flex align-items-center gap-2">
													<!-- Edit -->
													<a href="{{ route('admin.country.edit', $countries_val->id) }}"
													class="text-primary"
													title="Edit">
														<i class="bx bx-edit fs-5"></i>
													</a>

													<!-- Delete -->
													<form action="{{ route('admin.country.destroy', $countries_val->id) }}"
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
			url: "{{ route('admin.country.update_status') }}",
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
				html: `
					<p>This action cannot be undone.</p>
					<p><strong>Deleting this country will also permanently delete all related states and cities.</strong></p>
				`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#dc3545',
				cancelButtonColor: '#6c757d',
				confirmButtonText: 'Yes, Delete Country',
				cancelButtonText: 'Cancel'
			}).then((result) => {
				if (result.isConfirmed) {
					form.submit();
				}
			});

		});

	});
</script>
