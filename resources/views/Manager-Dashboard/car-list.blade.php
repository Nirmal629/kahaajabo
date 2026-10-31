@extends('Manager-Dashboard.Layouts.App')
@section('main-content')
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
                        <h2>Total Cars</h2>
                        <h4 class="countnumber">300</h4>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-lg-4 col-12">
                    <div class="itemstcok">
                        <h2>Total Assigned Cars</h2>
                        <h4 class="countnumber">100</h4>
                    </div>

                </div>
                <div class="col-xl-4 col-md-6 col-lg-4 col-12">
                    <div class="itemstcok">
                        <h2>Available Cars</h2>
                        <h4 class="countnumber">200</h4>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
