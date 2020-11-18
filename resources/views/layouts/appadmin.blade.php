<!DOCTYPE html>
<html lang="en">

    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('backend/themify-icons/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/vendor.bundle.addons.css')}}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('backend/css/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{asset('backend/images/logo_2H_tech.png')}}" />
    </head>
    <body>

        <div class="container-scroller">
            <!-- partial:partials/_navbar.html -->
                @include('partials.nav1')
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
              <!-- partial:partials/_sidebar.html -->
                @include('partials.nav2')

                @yield('content')
            </div>
        </div>
        <!-- plugins:js -->
    <script src="{{asset('backend/js/vendor.bundle.base.js')}}"></script>
    <script src="{{asset('backend/js/vendor.bundle.addons.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{asset('backend/js/off-canvas.js')}}"></script>
    <script src="{{asset('backend/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('backend/js/template.js')}}"></script>
    <script src="{{asset('backend/js/settings.js')}}"></script>
    <script src="{{asset('backend/js/todolist.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{asset('backend/js/dashboard.js')}}"></script>
    <!-- Custom js for this page-->
    <script src="{{asset('backend/js/data-table.js')}}"></script>
    <script src="{{asset('backend/js/bootbox.min.js')}}"></script>

    <script>
		$(document).on("click", "#delete", function(e){
		e.preventDefault();
		var link = $(this).attr("href");
		bootbox.confirm("Do you really want to delete this ?", function(confirmed){
			if (confirmed){
				window.location.href = link;
			};
		});
	});
	</script>
    <!-- End custom js for this page-->
    </body>
</html>