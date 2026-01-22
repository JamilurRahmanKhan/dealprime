<meta charset="utf-8" />
<title>Deal Prime | @yield('title')</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php header('Content-Type: text/xml'); ?>
<!-- App favicon -->
<link rel="shortcut icon" href="{{asset('/')}}admin/assets/images/gadget.jpg"/>

<!-- Daterangepicker css -->
<link rel="stylesheet" href="{{asset('/')}}admin/assets/vendor/daterangepicker/daterangepicker.css">

<!-- Vector Map css -->
<link rel="stylesheet" href="{{asset('/')}}admin/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css">

<!-- Theme Config Js -->
<script src="{{asset('/')}}admin/assets/js/hyper-config.js"></script>
<!-- Datatables css -->
<link href="{{asset('/')}}admin/assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('/')}}admin/assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('/')}}admin/assets/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('/')}}admin/assets/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('/')}}admin/assets/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('/')}}admin/assets/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css" rel="stylesheet" type="text/css" />

<!-- Theme Config Js -->
<script src="{{asset('/')}}admin/assets/js/hyper-config.js"></script>
<!-- App css -->
<link href="{{asset('/')}}admin/assets/css/app-saas.min.css" rel="stylesheet" type="text/css" id="app-style" />
<!-- Icons css -->
<link href="{{asset('/')}}admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!--jquery-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Custom css & js code  personal add -->
<link href="{{asset('/')}}admin/assets/custom-assets/custom.css" rel="stylesheet" type="text/css" />

<!--select2 css-->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- textarea text editor  -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<!-- DataTables CSS -->
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">



 <script>
    $(document).ready(function() {
      $('.my-select2').select2({
        placeholder: 'Select an option',
        // allowClear: true
      });
    });
  </script>

