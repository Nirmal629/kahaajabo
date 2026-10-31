@extends('Admin.Layouts.App')
@section('main_content')
<div class="page-content">
	<!--breadcrumb-->
	<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
		<div class="breadcrumb-title pe-3">Home Dynamic</div>
		<div class="ps-3">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb mb-0 p-0">
					<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
					</li>
					<li class="breadcrumb-item active" aria-current="page">Home Dynamic Details</li>
				</ol>
			</nav>
		</div>
	</div>
	<!--end breadcrumb-->
	<div class="d-flex justify-content-between align-items-center mb-3">
		<h6 class="mb-0 text-uppercase">All Banner</h6>

		<div class="btn-group">
			<a href="{{ route('admin.home-banner.create') }}" class="btn btn-primary">
				Add Banner
			</a>
		</div>
	</div>
	<hr/>
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table id="example2" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Sl No.</th>
							<th>Banner Title</th>
							<th>Image</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($get_banner_details as $bannerDetails_val)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $bannerDetails_val->banner_title ?? '-' }}</td>
								<td>
									<img 
										src="{{ isset($bannerDetails_val) && $bannerDetails_val->banner_image
											? \App\Helpers\LocationHelper::imageUrl('uploads/home-dynamic/' . $bannerDetails_val->banner_image)
											: '' }}"
										width="120"
										height="80"
										style="
											object-fit: cover;
											border: 1px solid #ddd;
											border-radius: 5px;
										">
								</td>
								<td>
									<div class="d-flex align-items-center gap-2">
										<div class="form-check form-switch m-0">
											<input
												class="form-check-input"
												type="checkbox"
												role="switch"
												id="statusSwitch{{ $bannerDetails_val->id }}"
												data-id="{{ $bannerDetails_val->id }}"
												{{ $bannerDetails_val->status ? 'checked' : '' }}
												onchange="updateStatus(this)">
										</div>
										{{-- <span
											id="status-text-{{ $bannerDetails_val->id }}"
											class="form-check-label status-badge {{ $bannerDetails_val->status ? 'status-active' : 'status-inactive' }}">
											{{ $bannerDetails_val->status ? 'ACTIVE' : 'INACTIVE' }}
										</span> --}}
									</div>
								</td>

								<td>
									<div class="d-flex align-items-center gap-2">
										<!-- Edit -->
										<a href="{{ route('admin.home-banner.edit', $bannerDetails_val->id) }}"
										class="text-primary"
										title="Edit">
											<i class="bx bx-edit fs-5"></i>
										</a>

										<!-- Delete -->
										<form action="{{ route('admin.home-banner.delete', $bannerDetails_val->id) }}"
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

	<div class="d-flex justify-content-between align-items-center mb-3">
		<h6 class="mb-0 text-uppercase">Home Second & Third Section</h6>
	</div>
	<hr/>

	<div class="card">
		<div class="card-body">
			 <div class="card-body p-4">

				<h5 class="mb-4">
					Update Details
				</h5>

				<form class="row g-3"
					action="{{ route('admin.home-second-section.update') }}"
					method="POST"
					enctype="multipart/form-data">

					@csrf

					<!-- Title -->
					<div class="col-md-12">
						<label class="form-label">
						 Second Section Title
						</label>

						<input type="text"
							name="sectionSecond_title"
							class="form-control @error('sectionSecond_title') is-invalid @enderror"
							value="{{ old('sectionSecond_title', $home_dynmaic_data->sectionSecond_title ?? '') }}"
							placeholder="Enter Title">

						@error('sectionSecond_title')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>
					<!-- Description -->
					<div class="col-md-12">
						<label class="form-label">
							Description
						</label>

						<textarea
							name="sectionSection_description"
							class="form-control @error('sectionSection_description') is-invalid @enderror"
							rows="4"
							placeholder="Enter Description">{{ old('sectionSection_description', $home_dynmaic_data->sectionSection_description ?? '') }}</textarea>

						@error('sectionSection_description')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>

					<div class="col-md-12 mb-3">
						<label class="form-label">
						 Third Section Title
						</label>

						<input type="text"
							name="third_section_title"
							class="form-control @error('third_section_title') is-invalid @enderror"
							value="{{ old('third_section_title', $home_dynmaic_data->third_section_title ?? '') }}"
							placeholder="Enter Title">

						@error('third_section_title')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>

					
					<!-- Buttons -->
					<div class="col-md-12 mt-3">

						<button type="submit" class="btn btn-primary">
							<i class="bx bx-save"></i>
							Update
						</button>

						<button type="reset" class="btn btn-light px-4">
							Reset
						</button>

					</div>

				</form>

			</div>
		</div>
	</div>

	<div class="d-flex justify-content-between align-items-center mb-3">
		<h6 class="mb-0 text-uppercase">Popular Destination</h6>

		<div class="btn-group">
			<a href="{{ route('admin.home-destination.create') }}" class="btn btn-primary">
				Add Destination
			</a>
		</div>
	</div>
	<hr/>

	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table id="example3" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Sl No.</th>
							<th>Destination Name</th>
							<th>Image</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($destination_data as $destination_val)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $destination_val->destination_name ?? '-' }}</td>
								<td>
									<img 
										src="{{ isset($destination_val) && $destination_val->image
											? \App\Helpers\LocationHelper::imageUrl('uploads/home-dynamic/' . $destination_val->image)
											: '' }}"
										width="120"
										height="80"
										style="
											object-fit: cover;
											border: 1px solid #ddd;
											border-radius: 5px;
										">
								</td>
								<td>
									<div class="d-flex align-items-center gap-2">
										<div class="form-check form-switch m-0">
											<input
												class="form-check-input"
												type="checkbox"
												role="switch"
												id="statusSwitch{{ $destination_val->id }}"
												data-id="{{ $destination_val->id }}"
												{{ $destination_val->status ? 'checked' : '' }}
												onchange="updateDestinationStatus(this)">
										</div>
									</div>
								</td>

								<td>
									<div class="d-flex align-items-center gap-2">
										<!-- Edit -->
										<a href="{{ route('admin.home-destination.edit', $destination_val->id) }}"
										class="text-primary"
										title="Edit">
											<i class="bx bx-edit fs-5"></i>
										</a>

										<!-- Delete -->
										<form action="{{ route('admin.home-destination.delete', $destination_val->id) }}"
											method="POST"
											class="delete-form-destination m-0 p-0">
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

	<div class="d-flex justify-content-between align-items-center mb-3">
		<h6 class="mb-0 text-uppercase">Home Fourth Section</h6>
	</div>
	<hr/>

	<div class="card">
		<div class="card-body">
			 <div class="card-body p-4">

				<h5 class="mb-4">
					Update Details
				</h5>

				<form class="row g-3"
					action="{{ route('admin.home-fourth-section.update') }}"
					method="POST"
					enctype="multipart/form-data">

					@csrf

					<div class="col-md-12 mb-3">
						<label class="form-label">
						 Heading
						</label>

						<input type="text"
							name="fourth_section_heading"
							class="form-control @error('fourth_section_heading') is-invalid @enderror"
							value="{{ old('fourth_section_heading', $home_dynmaic_data->fourth_section_heading ?? '') }}"
							placeholder="Enter Heading">

						@error('fourth_section_heading')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>
					<div class="row">
						<div class="col-md-3">
							<label class="form-label">
							Title 1
							</label>

							<input type="text"
								name="fourth_section_title_1"
								class="form-control @error('fourth_section_title_1') is-invalid @enderror"
								value="{{ old('fourth_section_title_1', $home_dynmaic_data->fourth_section_title_1 ?? '') }}"
								placeholder="Enter Title">

							@error('fourth_section_title_1')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
			
						<div class="col-md-4">
							<label class="form-label">
								Description 1
							</label>

							<textarea
								name="fourth_section_description_1"
								class="form-control @error('fourth_section_description_1') is-invalid @enderror"
								rows="4"
								placeholder="Enter Description">{{ old('fourth_section_description_1', $home_dynmaic_data->fourth_section_description_1 ?? '') }}</textarea>

							@error('fourth_section_description_1')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>

						<div class="col-md-3">
							<label class="form-label">
								Image 1
							</label>
							<input type="file"
									name="fourth_section_image_1"
									id="fourth_section_image_1"
									class="form-control @error('fourth_section_image_1') is-invalid @enderror"
									accept=".jpg,.jpeg,.png"
									onchange="document.getElementById('banner_preview_1').src = window.URL.createObjectURL(this.files[0]); document.getElementById('banner_preview_1').style.display = 'block';">
						
							@error('fourth_section_image_1')
								<div class="text-danger mt-1">
									{{ $message }}
								</div>
							@enderror
							</div>
						<div class="col-md-2">
							<img id="banner_preview_1"
								src="{{ isset($home_dynmaic_data) && $home_dynmaic_data->fourth_section_image_1
									? \App\Helpers\LocationHelper::imageUrl('uploads/home-dynamic/' . $home_dynmaic_data->fourth_section_image_1)
									: '' }}"
								width="120"
								height="100"
								style="
									{{ !isset($home_dynmaic_data) || !$home_dynmaic_data->fourth_section_image_1 ? 'display:none;' : '' }}
								">

						</div>
					</div>

					<div class="row">
						<div class="col-md-3">
							<label class="form-label">
							Title 2
							</label>

							<input type="text"
								name="fourth_section_title_2"
								class="form-control @error('fourth_section_title_2') is-invalid @enderror"
								value="{{ old('fourth_section_title_2', $home_dynmaic_data->fourth_section_title_2 ?? '') }}"
								placeholder="Enter Title">

							@error('fourth_section_title_2')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
			
						<div class="col-md-4">
							<label class="form-label">
								Description 2
							</label>

							<textarea
								name="fourth_section_description_2"
								class="form-control @error('fourth_section_description_2') is-invalid @enderror"
								rows="4"
								placeholder="Enter Description">{{ old('fourth_section_description_2', $home_dynmaic_data->fourth_section_description_2 ?? '') }}</textarea>

							@error('fourth_section_description_2')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>

						<div class="col-md-3">
							<label class="form-label">
								Image 2
							</label>
							<input type="file"
									name="fourth_section_image_2"
									id="fourth_section_image_2"
									class="form-control @error('fourth_section_image_2') is-invalid @enderror"
									accept=".jpg,.jpeg,.png"
									onchange="document.getElementById('banner_preview_2').src = window.URL.createObjectURL(this.files[0]); document.getElementById('banner_preview_2').style.display = 'block';">
						
							@error('fourth_section_image_2')
								<div class="text-danger mt-1">
									{{ $message }}
								</div>
							@enderror
							</div>
						<div class="col-md-2">
							<img id="banner_preview_2"
								src="{{ isset($home_dynmaic_data) && $home_dynmaic_data->fourth_section_image_2
									? \App\Helpers\LocationHelper::imageUrl('uploads/home-dynamic/' . $home_dynmaic_data->fourth_section_image_2)
									: '' }}"
								width="120"
								height="100"
								style="
									{{ !isset($home_dynmaic_data) || !$home_dynmaic_data->fourth_section_image_2 ? 'display:none;' : '' }}
								">

						</div>
					</div>

					<div class="row">
						<div class="col-md-3">
							<label class="form-label">
							Title 3
							</label>

							<input type="text"
								name="fourth_section_title_3"
								class="form-control @error('fourth_section_title_3') is-invalid @enderror"
								value="{{ old('fourth_section_title_3', $home_dynmaic_data->fourth_section_title_3 ?? '') }}"
								placeholder="Enter Title">

							@error('fourth_section_title_3')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
			
						<div class="col-md-4">
							<label class="form-label">
								Description 3
							</label>

							<textarea
								name="fourth_section_description_3"
								class="form-control @error('fourth_section_description_3') is-invalid @enderror"
								rows="4"
								placeholder="Enter Description">{{ old('fourth_section_description_3', $home_dynmaic_data->fourth_section_description_3 ?? '') }}</textarea>

							@error('fourth_section_description_3')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>

						<div class="col-md-3">
							<label class="form-label">
								Image 3
							</label>
							<input type="file"
									name="fourth_section_image_3"
									id="fourth_section_image_3"
									class="form-control @error('fourth_section_image_3') is-invalid @enderror"
									accept=".jpg,.jpeg,.png"
									onchange="document.getElementById('banner_preview_3').src = window.URL.createObjectURL(this.files[0]); document.getElementById('banner_preview_3').style.display = 'block';">
						
							@error('fourth_section_image_3')
								<div class="text-danger mt-1">
									{{ $message }}
								</div>
							@enderror
							</div>
						<div class="col-md-2">
							<img id="banner_preview_3"
								src="{{ isset($home_dynmaic_data) && $home_dynmaic_data->fourth_section_image_3
									? \App\Helpers\LocationHelper::imageUrl('uploads/home-dynamic/' . $home_dynmaic_data->fourth_section_image_3)
									: '' }}"
								width="120"
								height="100"
								style="
									{{ !isset($home_dynmaic_data) || !$home_dynmaic_data->fourth_section_image_3 ? 'display:none;' : '' }}
								">

						</div>
					</div>

					<div class="row">
						<div class="col-md-3">
							<label class="form-label">
							Title 4
							</label>

							<input type="text"
								name="fourth_section_title_4"
								class="form-control @error('fourth_section_title_4') is-invalid @enderror"
								value="{{ old('fourth_section_title_4', $home_dynmaic_data->fourth_section_title_4 ?? '') }}"
								placeholder="Enter Title">

							@error('fourth_section_title_4')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
			
						<div class="col-md-4">
							<label class="form-label">
								Description 4
							</label>

							<textarea
								name="fourth_section_description_4"
								class="form-control @error('fourth_section_description_4') is-invalid @enderror"
								rows="4"
								placeholder="Enter Description">{{ old('fourth_section_description_4', $home_dynmaic_data->fourth_section_description_4 ?? '') }}</textarea>

							@error('fourth_section_description_4')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>

						<div class="col-md-3">
							<label class="form-label">
								Image 4
							</label>
							<input type="file"
									name="fourth_section_image_4"
									id="fourth_section_image_4"
									class="form-control @error('fourth_section_image_4') is-invalid @enderror"
									accept=".jpg,.jpeg,.png"
									onchange="document.getElementById('banner_preview_4').src = window.URL.createObjectURL(this.files[0]); document.getElementById('banner_preview_4').style.display = 'block';">
						
							@error('fourth_section_image_4')
								<div class="text-danger mt-1">
									{{ $message }}
								</div>
							@enderror
							</div>
						<div class="col-md-2">
							<img id="banner_preview_4"
								src="{{ isset($home_dynmaic_data) && $home_dynmaic_data->fourth_section_image_4
									? \App\Helpers\LocationHelper::imageUrl('uploads/home-dynamic/' . $home_dynmaic_data->fourth_section_image_4)
									: '' }}"
								width="120"
								height="100"
								style="
									{{ !isset($home_dynmaic_data) || !$home_dynmaic_data->fourth_section_image_4 ? 'display:none;' : '' }}
								">

						</div>
					</div>

					

					
					<!-- Buttons -->
					<div class="col-md-12 mt-3">

						<button type="submit" class="btn btn-primary">
							<i class="bx bx-save"></i>
							Update
						</button>

						<button type="reset" class="btn btn-light px-4">
							Reset
						</button>

					</div>

				</form>

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
			url: "{{ route('admin.home-banner.update_status') }}",
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

				// if(response.status == 1)
				// {
				// 	statusText.innerHTML = "ACTIVE";
				// 	statusText.classList.remove('status-inactive');
				// 	statusText.classList.add('status-active');
				// }
				// else
				// {
				// 	statusText.innerHTML = "INACTIVE";
				// 	statusText.classList.remove('status-active');
				// 	statusText.classList.add('status-inactive');
				// }

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

	function updateDestinationStatus(checkbox) {
		const id = checkbox.getAttribute('data-id');
		const status = checkbox.checked ? 1 : 0;

		$.ajax({
			url: "{{ route('admin.home-destination.update_status') }}",
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
				text: 'You want to delete this banner?',
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
		$(document).on('submit', '.delete-form-destination', function (e) {

			e.preventDefault();

			let form = this;

			Swal.fire({
				title: 'Are you sure?',
				text: 'You want to delete this destination?',
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
