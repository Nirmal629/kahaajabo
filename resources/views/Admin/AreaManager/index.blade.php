@extends('Admin.Layouts.App')
@section('main_content')
    <style>
        /* Modal Width */
        #areaManagerViewModal .modal-dialog {
            max-width: 730px;
        }

        /* Modal */
        #areaManagerViewModal .modal-content {
            border-radius: 12px;
        }

        #areaManagerViewModal .modal-header {
            padding: 12px 20px;
        }

        #areaManagerViewModal .modal-body {
            padding: 15px;
            max-height: 75vh;
            overflow-y: auto;
        }

        /* Grid */
        #areaManagerViewModal .row {
            --bs-gutter-x: 12px;
            --bs-gutter-y: 12px;
        }

        /* Card */
        #areaManagerViewModal .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 .125rem .35rem rgba(0, 0, 0, .08) !important;
        }

        #areaManagerViewModal .card-body {
            padding: 15px;
        }

        /* Heading */
        #areaManagerViewModal h4 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 12px !important;
        }

        #areaManagerViewModal h4 i {
            font-size: 24px;
            margin-right: 2px;
        }

        /* Paragraph */
        #areaManagerViewModal p {
            margin-bottom: 12px;
            font-size: 15px;
            line-height: 1.45;
        }

        #areaManagerViewModal strong {
            font-size: 15px;
            font-weight: 600;
        }

        /* Button */
        #areaManagerViewModal .btn {
            font-size: 14px;
            padding: 6px 14px;
        }

        /* Badge */
        #areaManagerViewModal .badge {
            font-size: 13px;
        }

        /* Last paragraph */
        #areaManagerViewModal p:last-child {
            margin-bottom: 0;
        }

        .modal-xl {
            max-width: 1200px;
        }

        .modal-content {
            border-radius: 18px;
            overflow: hidden;
            border: none;
        }

        .modal-body {
            padding: 0;
        }

        /* Tabs */

        .custom-tabs {
            border-bottom: 1px solid #dee2e6;
        }

        /* .custom-tabs .nav-item {
            margin-right: 12px;
        } */

        .custom-tabs .nav-link {
            border: none;
            border-radius: 15px 15px 0 0;
            /* padding: 14px 28px; */
            padding: 7px 17px;
            font-size: 18px;
            font-weight: 400;
            color: #4608ba;
            transition: .3s;

        }

        .custom-tabs .nav-link i {
            font-size: 22px;
            vertical-align: middle;
        }

        .custom-tabs .nav-link:hover {
            color: #b70c06;
        }

        .custom-tabs .nav-link.active {
            background: #fff;
            color: #b70c06;
            border: 2px solid #b70c06;
            border-bottom: 2px solid #fff;
        }

        .tab-content {
            min-height: 650px;
            background: #fff;
        }
    </style>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Area Manager</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Area Manager Details</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">Area Manager Details List</h6>
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
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($managerData as $managerData_Val)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $managerData_Val->first_name }}
                                        {{ strtoupper(substr(trim($managerData_Val->last_name), 0, 1)) }}</td>
                                    <td>{{ $managerData_Val->email ?? '-' }}</td>
                                    <td>{{ $managerData_Val->country_name ?? '-' }}</td>
                                    <td>{{ $managerData_Val->state_name ?? '-' }}</td>
                                    <td>{{ $managerData_Val->district_name ?? '-' }}</td>
                                    <td>{{ $managerData_Val->city_name ?? '-' }}</td>
                                    <td>
                                        {{ $managerData_Val->area_name ?? '-' }}
                                        @if ($managerData_Val->pincode)
                                            - {{ $managerData_Val->pincode }}
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="statusSwitch{{ $managerData_Val->id }}"
                                                    data-id="{{ $managerData_Val->id }}"
                                                    {{ $managerData_Val->status ? 'checked' : '' }}
                                                    onchange="updateStatus(this)">
                                            </div>
                                            {{-- <span id="status-text-{{ $managerData_Val->id }}"
                                                class="form-check-label status-badge {{ $managerData_Val->status ? 'status-active' : 'status-inactive' }}">
                                                {{ $managerData_Val->status ? 'ACTIVE' : 'INACTIVE' }}
                                            </span> --}}
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center gap-2">

                                            <!-- View -->
                                            <a href="javascript:void(0)" class="text-primary me-2 viewAreaManager"
                                                data-id="{{ $managerData_Val->id }}" title="View">
                                                <i class="bx bx-show fs-5"></i>
                                            </a>

                                            <!-- Edit -->
                                            <a href="{{ route('admin.area-manager.edit', $managerData_Val->id) }}"
                                                class="text-primary" title="Edit">
                                                <i class="bx bx-edit fs-5"></i>
                                            </a>

                                            <!-- Delete -->
                                            <form action="{{ route('admin.area-manager.destroy', $managerData_Val->id) }}"
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
            <!-- View Modal -->
            <div class="modal fade" id="areaManagerViewModal" tabindex="-1" aria-hidden="true">

                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

                    <div class="modal-content">

                        <div class="modal-body p-0">

                            <!-- Close Button -->
                            <div class="text-end p-3 pb-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Tabs -->
                            <ul class="nav nav-tabs custom-tabs px-2" id="bookingTabs" role="tablist">

                                <li class="nav-item" role="presentation">

                                    <button class="nav-link active" id="manager-tab" data-bs-toggle="tab"
                                        data-bs-target="#manager" type="button">

                                        <i class="bx bx-user me-2"></i>
                                        Area Manager Details

                                    </button>

                                </li>

                                <li class="nav-item" role="presentation">

                                    <button class="nav-link" id="owner-tab" data-bs-toggle="tab" data-bs-target="#owner"
                                        type="button">

                                        <i class="bx bx-group me-2"></i>
                                        Car Owner

                                    </button>

                                </li>

                                <li class="nav-item" role="presentation">

                                    <button class="nav-link" id="vehicle-tab" data-bs-toggle="tab"
                                        data-bs-target="#vehicle" type="button">

                                        <i class="bx bx-car me-2"></i>
                                        Vehicle Details

                                    </button>

                                </li>

                                <li class="nav-item" role="presentation">

                                    <button class="nav-link" id="driver-tab" data-bs-toggle="tab"
                                        data-bs-target="#driver" type="button">

                                        <i class="bx bx-id-card me-2"></i>
                                        Driver

                                    </button>

                                </li>

                            </ul>

                            <!-- Tab Content -->
                            <div class="tab-content p-4">

                                <!-- Manager -->
                                <div class="tab-pane fade show active" id="manager" role="tabpanel">

                                    <div id="areaManagerBody">

                                        <div class="text-center py-5">

                                            <div class="spinner-border text-primary"></div>

                                            <p class="mt-3">
                                                Loading Manager Details...
                                            </p>

                                        </div>

                                    </div>

                                </div>

                                <!-- Car Owner -->
                                <div class="tab-pane fade" id="owner" role="tabpanel">

                                    <div id="ownerBody">

                                        <div class="text-center py-5">

                                            <div class="spinner-border text-success"></div>

                                            <p class="mt-3">
                                                Loading Car Owner Details...
                                            </p>

                                        </div>

                                    </div>

                                </div>

                                <!-- Vehicle -->
                                <div class="tab-pane fade" id="vehicle" role="tabpanel">

                                    <div id="vehicleBody">

                                        <div class="text-center py-5">

                                            <div class="spinner-border text-warning"></div>

                                            <p class="mt-3">
                                                Loading Vehicle Details...
                                            </p>

                                        </div>

                                    </div>

                                </div>

                                <!-- Driver -->
                                <div class="tab-pane fade" id="driver" role="tabpanel">

                                    <div id="driverBody">

                                        <div class="text-center py-5">

                                            <div class="spinner-border text-danger"></div>

                                            <p class="mt-3">
                                                Loading Driver Details...
                                            </p>

                                        </div>

                                    </div>

                                </div>

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
            url: "{{ route('admin.areaManager.update_status') }}",
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
                text: 'You want to delete this area manager?',
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

            url: "{{ url('admin/area-manager-details') }}/" + id + "/view",

            type: "GET",

            success: function(res) {

                let d = res.data;
                let owners = res.car_owner ?? [];
                let vehicles = res.vehicle_details ?? [];
                let drivers = res.drivers ?? [];

                let status = d.status == 1 ?
                    '<span class="badge bg-success px-3 py-2">Active</span>' :
                    '<span class="badge bg-danger px-3 py-2">Inactive</span>';

                function documentCard(title, icon, color, numberLabel, number, file, buttonText =
                    'View Document') {

                    let btn = file ?
                        `<a href="/uploads/area-manager/${file}"
                    target="_blank"
                    class="btn btn-${color}">
                    <i class="bx bx-show me-1"></i>${buttonText}
               </a>` :
                        `<button class="btn btn-outline-secondary" disabled>
                    <i class="bx bx-file"></i> No File
               </button>`;

                    return `
                        <div class="col-md-6">
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

<div class="row g-2">

<div class="col-md-6">
<div class="card shadow-sm border-0 h-100">

<div class="card-body p-3">

<h4 class="text-primary mb-4">
<i class="bx bx-user me-2"></i>
Personal Information
</h4>

<p><strong>Full Name</strong><br>${d.first_name} ${d.last_name ?? ''}</p>

<p><strong>Email</strong><br>${d.email}</p>

<p><strong>Phone</strong><br>${d.phone_number}</p>

<p class="mb-0">
<strong>Address</strong><br>
${d.complete_address ?? '-'}
</p>

</div>
</div>
</div>


<div class="col-md-6">

<div class="card shadow-sm border-0 h-100">

<div class="card-body p-3">

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

<div class="col-md-6">

<div class="card shadow-sm border-0 h-100">

<div class="card-body p-3">

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
`<a href="/uploads/area-manager/${d.bank_passBook_file}"
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

<div class="col-12">

<div class="card shadow-sm border-0">

<div class="card-body p-3">

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

  let ownerHtml = `
<div class="card shadow-sm border-0 mb-3">
    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">
                Car Owner Details
            </h4>

            <span class="badge bg-primary fs-6">
                Total Car Owners : ${owners.length}
            </span>
        </div>

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-light">

                    <tr>
                        <th width="80">#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                    </tr>

                </thead>

                <tbody>
`;

if (owners.length > 0) {

    owners.forEach(function(owner, index){

        ownerHtml += `
            <tr>
                <td>${index + 1}</td>
                <td>${owner.first_name} ${owner.last_name ?? ''}</td>
                <td>${owner.email ?? '-'}</td>
                <td>${owner.phone_number ?? '-'}</td>
            </tr>
        `;

    });

} else {

    ownerHtml += `
        <tr>
            <td colspan="4" class="text-center text-muted">
                No Car Owner Found
            </td>
        </tr>
    `;

}

ownerHtml += `
                </tbody>

            </table>

        </div>

    </div>

</div>
`;

$("#ownerBody").html(ownerHtml);

let vehicleHtml = `
<div class="card shadow-sm border-0">

    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h4 class="mb-0">
                Vehicle Details
            </h4>

            <span class="badge bg-primary fs-6">
                Total Vehicles : ${vehicles.length}
            </span>

        </div>

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th width="60">#</th>

                        <th>Vehicle Number</th>

                        <th>Vehicle Type</th>

                        <th>Brand</th>

                        <th>Model</th>

                    </tr>

                </thead>

                <tbody>
`;

if (vehicles.length > 0) {

    vehicles.forEach(function(vehicle,index){

        vehicleHtml += `

        <tr>

            <td>${index+1}</td>

            <td>${vehicle.registration_number ?? '-'}</td>

            <td>${vehicle.type ?? '-'}</td>

            <td>${vehicle.brand ?? '-'}</td>

            <td>${vehicle.model ?? '-'}</td>

        </tr>

        `;

    });

}else{

    vehicleHtml += `

    <tr>

        <td colspan="6" class="text-center">

            No Vehicle Found

        </td>

    </tr>

    `;

}

vehicleHtml += `

                </tbody>

            </table>

        </div>

    </div>

</div>
`;

$("#vehicleBody").html(vehicleHtml);

let driverHtml = `
<div class="card border-0 shadow-sm">

    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h4 class="mb-0 text-primary">
                <i class="bx bx-id-card me-2"></i>
                Driver Details
            </h4>

            <span class="badge bg-primary fs-6">
                Total Drivers : ${drivers.length}
            </span>

        </div>

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th width="60">#</th>

                        <th>Driver Name</th>

                        <th>Email</th>

                        <th>Phone Number</th>

                    </tr>

                </thead>

                <tbody>
`;

if (drivers.length > 0) {

    $.each(drivers, function(index, driver){

        driverHtml += `

            <tr>

                <td>${index + 1}</td>

                <td>${driver.first_name} ${driver.last_name ?? ''}</td>

                <td>${driver.email ?? '-'}</td>

                <td>${driver.phone_number ?? '-'}</td>

            </tr>

        `;

    });

} else {

    driverHtml += `

        <tr>

            <td colspan="4" class="text-center text-muted">

                No Driver Found

            </td>

        </tr>

    `;

}

driverHtml += `

                </tbody>

            </table>

        </div>

    </div>

</div>
`;

$("#driverBody").html(driverHtml);

                $("#areaManagerViewModal").modal('show');
            }
        });

    });
</script>
