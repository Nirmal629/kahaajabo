@extends('Admin.Layouts.App')
@section('main_content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Car Owner</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Car Owner Details</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">Car Owner Details List</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>S/No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Country</th>
                                <th>Province</th>
                                <th>District</th>
                                <th>City</th>
                                <th>Area</th>
                                <th>A Manager</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carOwnerData as $carOwnerData_Val)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $carOwnerData_Val->first_name }} {{ strtoupper(substr(trim($carOwnerData_Val->last_name), 0, 1)) }}</td>
                                    <td>{{ $carOwnerData_Val->email ?? '-' }}</td>
                                    <td>{{ $carOwnerData_Val->country_name ?? '-' }}</td>
                                    <td>{{ $carOwnerData_Val->state_name ?? '-' }}</td>
                                    <td>{{ $carOwnerData_Val->district_name ?? '-' }}</td>
                                    <td>{{ $carOwnerData_Val->city_name ?? '-' }}</td>
                                    <td>
                                        {{ $carOwnerData_Val->area_name ?? '-' }}
                                        @if ($carOwnerData_Val->pincode)
                                            - {{ $carOwnerData_Val->pincode }}
                                        @endif
                                    </td>
                                    <td>{{ $carOwnerData_Val->area_manager_name }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="statusSwitch{{ $carOwnerData_Val->id }}"
                                                    data-id="{{ $carOwnerData_Val->id }}"
                                                    {{ $carOwnerData_Val->status ? 'checked' : '' }}
                                                    onchange="updateStatus(this)">
                                            </div>
                                            {{-- <span id="status-text-{{ $carOwnerData_Val->id }}"
                                                class="form-check-label status-badge {{ $carOwnerData_Val->status ? 'status-active' : 'status-inactive' }}">
                                                {{ $carOwnerData_Val->status ? 'ACTIVE' : 'INACTIVE' }}
                                            </span> --}}
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center gap-2">

                                            <!-- View -->
                                            <a href="javascript:void(0)" class="text-primary me-2 viewAreaManager"
                                                data-id="{{ $carOwnerData_Val->id }}" title="View">
                                                <i class="bx bx-show fs-5"></i>
                                            </a>

                                            <!-- Edit -->
                                            <a href="{{ route('admin.car-owner.edit', $carOwnerData_Val->id) }}"
                                                class="text-primary" title="Edit">
                                                <i class="bx bx-edit fs-5"></i>
                                            </a>

                                            <!-- Delete -->
                                            <form action="{{ route('admin.car-owner.destroy', $carOwnerData_Val->id) }}"
                                                method="POST" class="delete-form m-0 p-0">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="btn p-0 mt-2 border-0 bg-transparent text-danger" title="Delete">
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

            <div class="modal fade" id="areaManagerViewModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">Car Owner Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body" id="areaManagerBody">

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
            url: "{{ route('admin.carOwner.update_status') }}",
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

                // if (response.status == 1) {
                //     statusText.innerHTML = "ACTIVE";
                //     statusText.classList.remove('status-inactive');
                //     statusText.classList.add('status-active');
                // } else {
                //     statusText.innerHTML = "INACTIVE";
                //     statusText.classList.remove('status-active');
                //     statusText.classList.add('status-inactive');
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
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        $(document).on('submit', '.delete-form', function(e) {

            e.preventDefault();

            let form = this;

            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to delete this car owner details?',
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
    $(document).on('click', '.viewAreaManager', function() {

        let id = $(this).data('id');

        $.ajax({

            url: "{{ url('admin/car-owner-details') }}/" + id + "/view",

            type: "GET",

 success: function (res) {

    let d = res.data;

    let status = d.status == 1
        ? '<span class="badge bg-success px-3 py-2">Active</span>'
        : '<span class="badge bg-danger px-3 py-2">Inactive</span>';

    function documentCard(title, icon, color, numberLabel, number, file, buttonText = 'View Document') {

        let btn = file
            ? `<a href="/uploads/car-owner/${file}"
                    target="_blank"
                    class="btn btn-${color}">
                    <i class="bx bx-show me-1"></i>${buttonText}
               </a>`
            : `<button class="btn btn-outline-secondary" disabled>
                    <i class="bx bx-file"></i> No File
               </button>`;

        return `
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <h4 class="text-${color} mb-4">
                        <i class="${icon} me-2"></i>${title}
                    </h4>

                    <p class="mb-4">
                        <strong>${numberLabel}</strong><br>
                        ${number ?? '-'}
                    </p>

                    ${btn}

                </div>

            </div>
        </div>`;
    }

    let html = `

<div class="row">

<div class="col-md-6 mb-4">
<div class="card shadow-sm border-0 h-100">

<div class="card-body">

<h4 class="text-primary mb-4">
<i class="bx bx-user me-2"></i>
Personal Information
</h4>

<p><strong>Full Name</strong><br>${d.first_name} ${d.last_name ?? ''}</p>

<p><strong>Email</strong><br>${d.email}</p>

<p><strong>Phone</strong><br>${d.phone_number}</p>

<p class="">
<strong>Address</strong><br>
${d.complete_address ?? '-'}
</p>

<p><strong>Area Manager</strong><br>${d.area_manager_name ?? '-'}</p>


</div>
</div>
</div>


<div class="col-md-6 mb-4">

<div class="card shadow-sm border-0 h-100">

<div class="card-body">

<h4 class="text-success mb-4">
<i class="bx bx-map me-2"></i>
Location Details
</h4>

<p><strong>Country</strong><br>${d.country_name}</p>

<p><strong>State</strong><br>${d.state_name}</p>

<p><strong>District</strong><br>${d.district_name}</p>

<p><strong>City</strong><br>${d.city_name}</p>

<p class="mb-0">
<strong>Area</strong><br>
${d.area_name} - ${d.pincode}
</p>

</div>
</div>
</div>

${documentCard(
    'Aadhaar Card',
    'bx bx-id-card',
    'primary',
    'Aadhaar Number',
    d.aadhar_card_number,
    d.aadhar_card_file
)}

${documentCard(
    'PAN Card',
    'bx bx-credit-card',
    'danger',
    'PAN Number',
    d.pan_card_number,
    d.pan_card_file
)}

<div class="col-md-6 mb-4">

<div class="card shadow-sm border-0 h-100">

<div class="card-body">

<h4 class="text-warning mb-4">
<i class="bx bx-buildings me-2"></i>
Bank Details
</h4>

<p><strong>Bank</strong><br>${d.bank_name}</p>

<p><strong>Account Holder</strong><br>${d.account_holder_name}</p>

<p><strong>Account Number</strong><br>${d.account_number}</p>

<p><strong>IFSC</strong><br>${d.ifsc_code}</p>

${
d.bank_passBook_file
?
`<a href="/uploads/car-owner/${d.bank_passBook_file}"
class="btn btn-warning"
target="_blank">
<i class="bx bx-show"></i>
View Passbook
</a>`
:
`<button class="btn btn-outline-secondary" disabled>No File</button>`
}

</div>
</div>

</div>

${documentCard(
    'Driving License',
    'bx bx-car',
    'info',
    'License Number',
    d.driving_license,
    d.driving_license_file
)}

<div class="col-md-12">

<div class="card shadow-sm border-0">

<div class="card-body">

<h4 class="text-dark mb-4">
<i class="bx bx-briefcase me-2"></i>
Employment Details
</h4>

<div class="row">

<div class="col-md-3">
<strong>Register Date</strong><br>
${d.register_date ?? '-'}
</div>

<div class="col-md-3">
<strong>Start Date</strong><br>
${d.start_date ?? '-'}
</div>

<div class="col-md-3">
<strong>End Date</strong><br>
${d.end_date ?? '-'}
</div>

<div class="col-md-3">
<strong>Status</strong><br>
${status}
</div>

</div>

</div>
</div>

</div>

</div>
`;

    $("#areaManagerBody").html(html);

    $("#areaManagerViewModal").modal('show');
}
        });

    });
</script>
