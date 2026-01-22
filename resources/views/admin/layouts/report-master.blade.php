<!DOCTYPE html>
<html lang="en">
<!--head section  -->
<head>
    @include('admin.layouts.head')
</head>

<body>
<!-- Begin page -->
    <div class="wrapper">
        <div class="container-fluid">
            @yield('body')
        </div>
    </div>
<!-- END wrapper -->
<!--------script start------------>
@include('admin.layouts.script')
<!--------script end------------>
</body>

</html>
