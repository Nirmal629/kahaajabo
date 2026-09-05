<!DOCTYPE html>
<html lang="en">

@include('Frontend.Includes.head')

<body>
    @include('Frontend.Includes.header')


        <div class="main">
            @yield('main_content')
        </div>

    @include('Frontend.Includes.footer')

    @include('Frontend.Includes.foot')
    </body>
</html>