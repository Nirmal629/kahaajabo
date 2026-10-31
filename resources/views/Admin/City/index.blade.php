@extends('Admin.Layouts.App')
@section('main_content')
<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">City</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">City List</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<a href="{{ route('admin.city.create') }}">
                                <button type="button" class="btn btn-primary">Add City</button>
                            </a>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase">All Cities</h6>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="exampleCity" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Sl No.</th>
										<th>Country Name</th>
										<th>State Name</th>
										<th>District Name</th>
										<th>City</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
							
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
			url: "{{ route('admin.city.update_status') }}",
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

		$('#exampleCity').DataTable({
			processing: true,
			serverSide: true,

			ajax: "{{ route('admin.city.index') }}",

			pageLength: 25,

			lengthMenu: [
				[10, 25, 50, 100],
				[10, 25, 50, 100]
			],

			dom: 'Bfrtip',

			buttons: [
				'copy',
				'excel',
				'pdf',
				'print'
			],

			columns: [
				{
					data: 'DT_RowIndex',
					name: 'DT_RowIndex',
					orderable: false,
					searchable: false
				},
				{
					data: 'country_name',
					name: 'country_name'
				},
				{
					data: 'state_name',
					name: 'state_name'
				},
				{
					data: 'district_name',
					name: 'district_name'
				},
				{
					data: 'name',
					name: 'name'
				},
				{
					data: 'status',
					name: 'status',
					orderable: false,
					searchable: false
				},
				{
					data: 'action',
					name: 'action',
					orderable: false,
					searchable: false
				}
			],

			order: [
				[4, 'asc']
			]
		});

	});
</script>
<script>
	$(document).ready(function () {

		$(document).on('submit', '.delete-form', function (e) {

			e.preventDefault();

			let form = this;

			Swal.fire({
				title: 'Are you sure?',
				text: 'You want to delete this city?',
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
