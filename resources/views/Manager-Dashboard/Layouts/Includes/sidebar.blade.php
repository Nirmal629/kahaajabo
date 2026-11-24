<div id="sidebar" class="sidebar-section">

        <ul class="sidebar_nav">
                <li class="sidebar__nav-item"><a class="sidebar__nav-link" href="manager-dashboard.php">
                                <div class="d-flex align-items-center"><i
                                                class="fa-solid fa-bars-progress mr-2"></i>Rides</div>
                                <div><i class="fa-solid fa-arrow-right"></i></div>
                        </a></li>
                
                <li class="sidebar__nav-item">
                        <a class="sidebar__nav-link" href="javascript:void(0);"
                        data-toggle="collapse"
                        data-target="#rideCostDropdown"
                        aria-expanded="false">
                                <div class="d-flex align-items-center">
                                        <i class="fa-solid fa-bars-progress mr-2"></i>
                                        Ride Cost Estimate
                                </div>
                                <div>
                                        <i class="fa-solid fa-chevron-down"></i>
                                </div>
                        </a>

                        <ul class="collapse list-unstyled pl-4" id="rideCostDropdown">
                                <li class="sidebar__nav-item">
                                        <a href="{{ route('manager.directride.cost.estimate') }}">
                                                Direct Cost Estimate
                                        </a>
                                </li>

                                <li class="sidebar__nav-item">
                                        <a href="{{ route('manager.ride.cost.index') }}">
                                                Ride Cost Configuration
                                        </a>
                                </li>
                        </ul>
                </li>


                <li class="sidebar__nav-item"><a class="sidebar__nav-link" href="manager-dashboard-carlist.php">
                                <div class="d-flex align-items-center"><i class="fa-solid fa-car mr-2"></i>Car List
                                </div>
                                <div><i class="fa-solid fa-arrow-right"></i></div>
                        </a></li>
                <li class="sidebar__nav-item"><a class="sidebar__nav-link" href="">
                                <div class="d-flex align-items-center"><i class="fa-solid fa-user mr-2"></i>Owner List
                                </div>
                                <div><i class="fa-solid fa-arrow-right"></i></div>
                        </a></li>

                <li class="sidebar__nav-item"><a class="sidebar__nav-link" href="">
                                <div class="d-flex align-items-center"><i class="fa-regular fa-id-card mr-2"></i>Driver
                                        List</div>
                                <div><i class="fa-solid fa-arrow-right"></i></div>
                        </a></li>

        </ul>
</div>