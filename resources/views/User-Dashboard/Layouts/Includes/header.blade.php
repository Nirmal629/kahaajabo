<nav class="navbar navbar-expand-sm customnavigation"><a class="Mobtoggole"><i class="fa fa-bars"
            aria-hidden="true"></i></a>
    <h4 class="entryTitle">User Dashboard</h4>
    @auth
    <ul class="navbar-nav">
        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle profile" id="navbardrop" data-toggle="dropdown"
                href="/"><img
                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAANDSURBVHgBrVfNUhNBEO6eXQE1lWywrEJJcCB6JkdvxicAb97AGzfCzRvJEwBPkPgExpPlKeENwllSrJCUnGAJWkVpdsfuZaEgfzOLfFVTmcz09Dc9P9/0IhjAcaQzlYC8hWIJFBQQUSpq5j4E8KjeBFDNAILdn0duzcQn6ggfJcW6UFi8IjKAq1BVgz/Bp+Nj14W4xJm5hXVQWIpBODABKuXOUas6rNMa1jg7t7DFpFSdgruDJ7ycTKWd8+7pNy3x82yugoBrcG/A18nUtCTyLyOJOVJTUj5UVC7AbFXy/ZGLa9JsbpWWt6jzgArLDyx/vn3USnPxqc5toAUWn80tFG9MHGBmRkrrgVWnqhw5jK+NJd523O/NYf2z8lUe/aCuOYze73N/3vNcL4xY2GJlHClDBVgeRcrgPoXayPl6FqNAwmU+0BB7dC3SoIGU0un51oFJ1CKbzS1rSBl7YADXdT36aWjMnETCzotAqQLocQD3CAXBsgDERa0lqjyYQimptRHwRtAm650qzD+dlVo7vh10wEz8SWGqxRPC2tLZ0JWsgBkcAeYokJx+5qgGvNArlqE+tgFDIA04jfMCRe9vjfb98qQreEEyuxrzFfNsOgwumOxLhIiA5fVmW1zs2TRoF0wOWMgQRtkg0iZlIS43ISonvJICOTuRhn6amMm8LFDGUB9riGQYiI12e78xziz0JVRFN4EA/HeolTkFO512S/tq9U2gRMFsDu1EcDuHrXnL87yLRDL9kJauMGBDok8a/RFiots9aaSST+jMwTCfO92zk0Z4nSbsYJtP6+2JQa19uF+CO4K2pQT9uk3R9kSvytWQmMW9/0nrWf4G/CcoSfhwKyAFZUo83QHDTCa3TU+kolKHewILS+iTfI81JKNqRF5hRYI7gsdy4hj5qvb3D2SZlJDVUsnpNO3H2sSkeE8Z4hm1NSEGZjKyMDlpfUWW0MtbMZBAjkzow+QPYTO6ky6Vsv/Xb4z6OuAIHycFK9oS/S2E0srpUmd/6BKP/YSh90DaPXuVRGHlWhRIdehOeNFkriQ0j1EWEx4mhTu/7N62d5mRQGzim+AUKZRG0nUatHj7o039oBk0EESNCJvjCK/wD0qeVd285630AAAAAElFTkSuQmCC"
                    alt="" class="img-fluid mr-2">
                        <span>{{ Auth::user()->name }}</span>
                    </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="/my-profile">
                    <i class="fa-regular fa-user mr-2"></i> My Profile</a>

                <a class="dropdown-item" href="{{ route('user.logout') }}">
                    <i class="fa fa-sign-out mr-2"></i>Logout</a>
            </div>
        </li>
    </ul>
    @endauth
</nav>