<!doctype html>
<html lang="en">


@include('dashboard.partials.head', ['title' => 'Dashboard Main'])


<body>

    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        @include('dashboard.partials.asidebar')


        <!--  Main wrapper -->
        <div class="body-wrapper">

            @include('dashboard.partials.header')

            <div class="container-fluid">

                <div class="container">
                    @yield('content')
                </div>

            </div>
        </div>
    </div>

    @include('dashboard.partials.scripts')

</body>

</html>
