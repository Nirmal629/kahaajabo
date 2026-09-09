@extends('Manager-Dashboard.Layouts.App')
@section('main-content')
    <div class="">
        <div class="container-fluid">
            <div class="col-12">
                <div class="topHead_title">
                    <h3 class="pageTitle">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAACbSURBVHgB7ZS9DcIwEIWff9J7hIwADRIjIUag8RKInWhgAzKCe3wXnDR0jk9JE+leZUuf9L3mnUFJvD8PYBNQi89DvJwHKW/i49Vb8AcNYaYjbJckvAdyD9gWHq60JpuDhG8jV0QFKthA0LkxtcJU1inlzfSY1uzmwVWa8Jhu19Nbyvv5x99AbFBvQ//mAl5v0WJUoIINBLu/RT+cpnQk4e3X2wAAAABJRU5ErkJggg=="
                            class="img-fluid mr-2">Manager Dasboard
                    </h3>
                </div>
            </div>
            <div class="dashboard-box">
                <div class="add_btn"><a href="#"><i class="fa-solid fa-plus"></i></a></div>

                <div class="flex-box">
                    <div class="col-xl-4 col-md-6 col-lg-4 col-12">
                        <div class="itemstcok">
                            <h2>Total rides</h2>
                            <h4 class="countnumber">27</h4>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 col-lg-4 col-12">
                        <div class="itemstcok">
                            <h2>Total complaints</h2>
                            <h4 class="countnumber">300</h4>
                        </div>

                    </div>
                    <div class="col-xl-4 col-md-6 col-lg-4 col-12">
                        <div class="itemstcok">
                            <h2>Total observation</h2>
                            <h4 class="countnumber">300</h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- <div class="col-12 my-5 table-top-btn-wrap ">
                        <button class="cost_share_btn ml-auto Primary-btn d-table">Ride Cost Share</button>
                        <button class="Primary-btn add_btn">Add</button>
                    </div> -->
        <div class="table-responsive my-5 col-12">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Area ID</th>
                        <th>Customer Info</th>
                        <th>Pickup Zip</th>
                        <th>Drop Zip</th>
                        <th>Assigned Driver</th>
                        <th>Assigned Car</th>
                        <th>Ride Cost Share</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>BK_9901</td>
                        <td>AM_NORTH</td>
                        <td>Jane D. (+15550112)</td>
                        <td>10001</td>
                        <td>10001</td>
                        <td>-</td>
                        <td>DRV_702 (Alex)</td>
                        <td class="text-center"><i class="fa-solid fa-dollar-sign"></i></td>
                        <td class="text-center">
                            <buuton class="status_btn completed_btn"><i class="fa-solid fa-check"></i></buuton>
                        </td>
                        <td class="text-center"><button class="action_btn view_btn"><i class="fa-solid fa-eye"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>BK_9901</td>
                        <td>AM_NORTH</td>
                        <td>Jane D. (+15550112)</td>
                        <td>10001</td>
                        <td>10001</td>
                        <td>-</td>
                        <td>DRV_702 (Alex)</td>
                        <td class="text-center"><i class="fa-solid fa-dollar-sign"></i></td>
                        <td class="text-center">
                            <buuton class="status_btn progress_btn"><i class="fa-solid fa-ellipsis"></i>
                            </buuton>
                        </td>
                        <td class="text-center"><button class="action_btn edit_btn"><i
                                    class="fa-regular fa-pen-to-square"></i></button></td>
                    </tr>
                    <tr>
                        <td>BK_9901</td>
                        <td>AM_NORTH</td>
                        <td>Jane D. (+15550112)</td>
                        <td>10001</td>
                        <td>10001</td>
                        <td>-</td>
                        <td>DRV_702 (Alex)</td>
                        <td class="text-center"><i class="fa-solid fa-dollar-sign"></i></td>
                        <td class="text-center">
                            <buuton class="status_btn pending_btn"><i class="fa-solid fa-spinner"></i></buuton>
                        </td>
                        <td class="text-center"><button class="action_btn delete_btn"><i
                                    class="fa-solid fa-trash"></i></button></td>
                    </tr>
                    <tr>
                        <td>BK_9901</td>
                        <td>AM_NORTH</td>
                        <td>Jane D. (+15550112)</td>
                        <td>10001</td>
                        <td>10001</td>
                        <td>-</td>
                        <td>DRV_702 (Alex)</td>
                        <td class="text-center"><i class="fa-solid fa-dollar-sign"></i></td>
                        <td class="text-center">
                            <buuton class="status_btn progress_btn"><i class="fa-solid fa-ellipsis"></i>
                            </buuton>
                        </td>
                        <td class="text-center"><button class="action_btn edit_btn"><i
                                    class="fa-regular fa-pen-to-square"></i></button></td>
                    </tr>
                    <tr>
                        <td>BK_9901</td>
                        <td>AM_NORTH</td>
                        <td>Jane D. (+15550112)</td>
                        <td>10001</td>
                        <td>10001</td>
                        <td>-</td>
                        <td>DRV_702 (Alex)</td>
                        <td class="text-center"><i class="fa-solid fa-dollar-sign"></i></td>
                        <td class="text-center">
                            <buuton class="status_btn pending_btn"><i class="fa-solid fa-spinner"></i></buuton>
                        </td>
                        <td class="text-center"><button class="action_btn delete_btn"><i
                                    class="fa-solid fa-trash"></i></button></td>
                    </tr>
                    <tr>
                        <td>BK_9901</td>
                        <td>AM_NORTH</td>
                        <td>Jane D. (+15550112)</td>
                        <td>10001</td>
                        <td>10001</td>
                        <td>-</td>
                        <td>DRV_702 (Alex)</td>
                        <td class="text-center"><i class="fa-solid fa-dollar-sign"></i></td>
                        <td class="text-center">
                            <buuton class="status_btn pending_btn"><i class="fa-solid fa-spinner"></i></buuton>
                        </td>
                        <td class="text-center"><button class="action_btn delete_btn"><i
                                    class="fa-solid fa-trash"></i></button></td>
                    </tr>
                    <tr>
                        <td>BK_9901</td>
                        <td>AM_NORTH</td>
                        <td>Jane D. (+15550112)</td>
                        <td>10001</td>
                        <td>10001</td>
                        <td>-</td>
                        <td>DRV_702 (Alex)</td>
                        <td class="text-center"><i class="fa-solid fa-dollar-sign"></i></td>
                        <td class="text-center">
                            <buuton class="status_btn progress_btn"><i class="fa-solid fa-ellipsis"></i>
                            </buuton>
                        </td>
                        <td class="text-center"><button class="action_btn edit_btn"><i
                                    class="fa-regular fa-pen-to-square"></i></button></td>
                    </tr>
                    </tfoot>
            </table>
        </div>
    </div>
@endsection
