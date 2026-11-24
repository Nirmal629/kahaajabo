@extends('Manager-Dashboard.Layouts.App')
@section('main-content')

<style>
.add-btn {
    background-color: #007bff;
    color: #fff !important;
    padding: 8px 12px;
    border-radius: 5px;
    display: inline-block;
    text-decoration: none;
}

.add-btn:hover {
    background-color: #0056b3;
    color: #fff !important;
}

</style>
    <div class="">
        <div class="container-fluid">
            <div class="col-12">
                <div class="topHead_title">
                    <h3 class="pageTitle">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAACbSURBVHgB7ZS9DcIwEIWff9J7hIwADRIjIUag8RKInWhgAzKCe3wXnDR0jk9JE+leZUuf9L3mnUFJvD8PYBNQi89DvJwHKW/i49Vb8AcNYaYjbJckvAdyD9gWHq60JpuDhG8jV0QFKthA0LkxtcJU1inlzfSY1uzmwVWa8Jhu19Nbyvv5x99AbFBvQ//mAl5v0WJUoIINBLu/RT+cpnQk4e3X2wAAAABJRU5ErkJggg=="
                            class="img-fluid mr-2">Ride Cost Configuration
                    </h3>

                    <div style="width: 6%;">
                        <div style="border-right:none;">
                            <a href="{{route('manager.ride.cost.create')}}" class="add-btn">
                                <i class="fa-solid fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="table-responsive my-5 col-12">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>SL No.</th>
                        <th>Vehicle Type</th>
                        <th>Gas Cost / KM</th>
                        <th>Fuel Type</th>
                        <th>Car Maintenance / KM</th>
                        <th>Driver Cost (Night) / KM</th>
                        <th>Vehicle Cost / KM</th>
                        <th>Total Cost / KM</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                    
                <tbody>
                    @forelse($ride_costs as $key => $estimate)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                {{ $estimate->vehicleType->vehicle_type ?? 'N/A' }}
                            </td>
                            <td>{{ $estimate->gas_cost }}</td>
                            <td>{{ $estimate->vehicle_input }}</td>
                            <td>{{ $estimate->per_km_cost }}</td>
                            <td>{{ $estimate->car_maintenance }}</td>
                            <td>{{ $estimate->total_cost }}</td>
                            <td>{{ $estimate->driver_cost }}</td>


                            <td class="text-center">
                                <label class="status-toggle">
                                    <input type="checkbox"
                                        class="status-checkbox"
                                        data-id="{{ $estimate->id }}"
                                        data-url="{{ route('manager.ride.cost.status', $estimate->id) }}"
                                        {{ strtolower($estimate->status) == 'approved' ? 'checked' : '' }}>


                                    <span class="toggle-slider"></span>
                                </label>
                            </td>

                            <td class="text-center">

                                {{-- <button class="action_btn view_btn" type="button"
                                    onclick="window.location.href='{{ route('manager.directride.cost.view', $estimate->id) }}'">
                                    <i class="fa-solid fa-eye"></i>
                                </button> --}}

                                <button class="action_btn edit_btn" type="button"
                                    onclick="window.location.href='{{ route('manager.ride.cost.edit', $estimate->id) }}'">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>

                                <form action="{{ route('manager.ride.cost.delete', $estimate->id) }}"
                                    method="POST"
                                    class="delete-form"
                                    style="display:inline;">

                                    @csrf
                                    @method('DELETE')

                                    <button type="button" class="action_btn delete_btn delete-confirm">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>

                                </form>

                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="13" class="text-center">
                                No direct cost estimates found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
document.querySelectorAll('.status-checkbox').forEach(function(toggle) {
    toggle.addEventListener('change', function() {
        let checkbox = this;
        let previousStatus = !checkbox.checked;
        let status = checkbox.checked ? 'approved' : 'pending';
        let parentTd = checkbox.closest('td');
        let statusText = parentTd.querySelector('.status-text');
        checkbox.disabled = true;

        fetch(checkbox.dataset.url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                throw new Error(data.message);
            }
            if (statusText) {
                statusText.textContent = data.status;
            }
            toastr.success(data.message, 'Success');
        })
        .catch(error => {
            checkbox.checked = previousStatus;
            toastr.error(
                error.message || 'Something went wrong!',
                'Error'
            );
            console.error(error);
        })
        .finally(() => {
            checkbox.disabled = false;
        });
    });
});
</script>

<script>
document.querySelectorAll('.delete-confirm').forEach(function(button) {

    button.addEventListener('click', function(e) {

        e.preventDefault();

        let form = this.closest('.delete-form');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to recover this cost configuration!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {

            if (result.isConfirmed) {
                form.submit();
            }

        });

    });

});
</script>


@endsection


