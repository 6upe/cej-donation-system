<!doctype html>
<html lang="en">


@include('dashboard.partials.head', ['title' => 'Dashboard Main'])


<body>

    <!--  Body Wrapper -->
    <div class="page-wrapper bg-black" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">


        @yield('content')

    </div>

    @include('dashboard.partials.scripts')
<x-loader />

<script>
function showLoader(message = "Processing...") {
    const loader = document.getElementById('globalLoader');
    loader.classList.remove('d-none');
    loader.querySelector('p').innerText = message;
}

function hideLoader() {
    document.getElementById('globalLoader').classList.add('d-none');
}
</script>
</body>

</html>
