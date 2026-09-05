@extends('Admin.Layouts.App')
@section('main_content')
    <style>
        #requestCallModal th {
            font-weight: 600;
            color: #6c757d;
            white-space: nowrap;
        }

        #requestCallModal td {
            color: #212529;
        }

        #requestCallModal .table tr:last-child {
            border-bottom: none !important;
        }
    </style>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Request Call</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Request Call List</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">All Request Call</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>First Name</th>
                                <th>Primary Mobile Number</th>
                                <th>Email Id</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_enquiry as $all_enquiryVal)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $all_enquiryVal->first_name ?? '-' }}</td>
                                    <td>{{ $all_enquiryVal->mobile_number ?? '-' }}</td>
                                    <td>{{ $all_enquiryVal->email ?? '-' }}</td>
                                    <td>{{ $all_enquiryVal->message ?? '-' }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="statusSwitch{{ $all_enquiryVal->id }}"
                                                    data-id="{{ $all_enquiryVal->id }}"
                                                    {{ $all_enquiryVal->status ? 'checked' : '' }}
                                                    onchange="updateStatus(this)">
                                            </div>
                                            <span id="status-text-{{ $all_enquiryVal->id }}"
                                                class="form-check-label status-badge {{ $all_enquiryVal->status ? 'status-active' : 'status-inactive' }}">
                                                {{ $all_enquiryVal->status ? 'ACTIVE' : 'INACTIVE' }}
                                            </span>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center gap-2">

                                            <a href="javascript:void(0)" class="text-primary me-2 viewCallDetails"
                                                data-id="{{ $all_enquiryVal->id }}" title="View">
                                                <i class="bx bx-show fs-5"></i>
                                            </a>

                                            <!-- Edit -->
                                            <a href="{{ route('admin.requestCall.edit', $all_enquiryVal->id) }}"
                                                class="text-primary" title="Edit">
                                                <i class="bx bx-edit fs-5"></i>
                                            </a>

                                            <!-- Delete -->
                                            <form action="{{ route('admin.requestCall.delete', $all_enquiryVal->id) }}"
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

                <div class="modal fade" id="requestCallModal" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Request Call Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body" id="requestCallBody">

                                <div class="text-center">
                                    Loading...
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
            url: "{{ route('admin.requestCall.update_status') }}",
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

                if (response.status == 1) {
                    statusText.innerHTML = "ACTIVE";
                    statusText.classList.remove('status-inactive');
                    statusText.classList.add('status-active');
                } else {
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
    $(document).ready(function() {

        $(document).on('submit', '.delete-form', function(e) {

            e.preventDefault();

            let form = this;

            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to delete this request call enquiry?',
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
    $(document).on('click', '.viewCallDetails', function() {

        let id = $(this).data('id');

        $.ajax({

            url: "{{ url('admin/request-call-details') }}/" + id + "/view",

            type: "GET",

            success: function(res) {

                if (res.status) {

                    let d = res.data;
                    let createdAt = '-';

                    if (d.created_at) {
                        createdAt = new Date(d.created_at).toLocaleString('en-IN', {
                            day: '2-digit',
                            month: 'short',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit',
                            hour12: true
                        });
                    }
                    
                    let status = d.status == 1 ?
                        `<span class="badge rounded-pill bg-success px-3 py-2">
                    <i class="bx bx-check-circle me-1"></i> Active
               </span>` :
                        `<span class="badge rounded-pill bg-danger px-3 py-2">
                    <i class="bx bx-x-circle me-1"></i> Inactive
               </span>`;

                    let html = `
            <div class="border rounded shadow-sm">

                <div class="d-flex justify-content-between align-items-center bg-light border-bottom px-3 py-3">
                    <h5 class="mb-0 fw-semibold">
                        ${d.first_name} ${d.middle_name ?? ''} ${d.last_name ?? ''}
                    </h5>

                    ${status}
                </div>

                <table class="table table-borderless align-middle mb-0">

                    <tbody>

                        <tr class="border-bottom">
                            <th width="30%" class="text-muted">Email</th>
                            <td>${d.email ?? '-'}</td>
                        </tr>

                        <tr class="border-bottom">
                            <th class="text-muted">Mobile Number</th>
                            <td>${d.mobile_number ?? '-'}</td>
                        </tr>

                        <tr class="border-bottom">
                            <th class="text-muted">Secondary Mobile</th>
                            <td>${d.secondaryMobile_number ?? '-'}</td>
                        </tr>

                        <tr class="border-bottom">
                            <th class="text-muted">Home Address</th>
                            <td>${d.home_address ?? '-'}</td>
                        </tr>

                        <tr class="border-bottom">
                            <th class="text-muted">Office Address</th>
                            <td>${d.office_address ?? '-'}</td>
                        </tr>

                        <tr class="border-bottom">
                            <th class="text-muted">Message</th>
                            <td>
                                <div class="bg-light rounded border p-3">
                                    ${d.message ?? '-'}
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th class="text-muted">Date</th>
                            <td>${createdAt}</td>
                        </tr>

                    </tbody>

                </table>

            </div>
        `;

                    $("#requestCallBody").html(html);
                    $("#requestCallModal").modal("show");
                } else {
                    alert(res.message);
                }

            }

        });

    });
</script>
