@extends('admin.layouts.master')
@section('title')Terms & condition Create @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Terms & condition Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Terms & condition Add</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Terms & condition Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Add Terms & condition form</h4>
                    <p class="text-muted font-14">{{ Session::get('failed') }}</p>
                    <form class="form-horizontal" action="{{route('terms.store')}}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="terms_and_condition" class="col-md-3 col-form-label">Terms & condition  details</label>
                            <div class="col-md-9">
                                <textarea class="form-control" id="summernote" name="terms_and_condition" cols="3" rows="3" placeholder="Enter Terms & condition"  ></textarea>
                                <div class="text-danger">@error('terms_and_condition'){{$message}} @enderror</div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="BannerSubTitle" class="col-md-3 col-form-label">Terms</label>
                            <div class="col-md-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"  name="terms_type" type="radio" id="1" value="1">
                                    <label class="form-check-label" for="1">Terms and Conditions</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="terms_type" type="radio" id="2" value="2">
                                    <label class="form-check-label" for="2">Return & Refund Policy</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="terms_type" type="radio" id="3" value="3" >
                                    <label class="form-check-label" for="3">Privacy Policy </label>
                                </div> 
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="user_type" class="col-md-3 pt-0 col-form-label">User Type</label>
                            <div class="col-md-9">
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="1" name="user_type" checked id="status1">
                                    <label class="form-check-label" for="status1">
                                        Partner
                                    </label>
                                </div> &nbsp;
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" value="0"  name="user_type" id="status2">
                                    <label class="form-check-label" for="status2">
                                        Customer
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-info">Add terms & condition</button>
                            </div>
                        </div>
                    </form>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>

    
    // <script>
    //     $(document).ready(function () {
    //         function fetchTerms(userType) {
    //             $.ajax({
    //                 url: "{{ route('term.positions') }}",
    //                 method: "GET",
    //                 data: { user_type: userType },
    //                 success: function (positions) {
    //                     // Reset checkboxes
    //                     $('input[name="terms_type"]').prop('checked', false).prop('disabled', false);

    //                     // Iterate over the positions and set them to disabled and checked
    //                     positions.forEach(function (position) {
    //                         $(`input[name="terms_type"][value="${position}"]`)
    //                             .prop('disabled', true)
    //                             .prop('checked', true);
    //                     });
    //                 },
    //                 error: function (xhr) {
    //                     console.error("Error fetching terms positions:", xhr.responseText);
    //                 }
    //             });
    //         }

    //         // Initial fetch on page load
    //         fetchTerms($('input[name="user_type"]:checked').val());

    //         // Fetch terms when user_type changes
    //         $('input[name="user_type"]').on('change', function () {
    //             fetchTerms($(this).val());
    //         });

    //         // Handle change event for terms_type checkboxes
    //         $('input[name="terms_type"]').on('change', function () {
    //             if (!$(this).is(':checked')) {
    //                 $(this).prop('disabled', false);
    //             }
    //         });
    //     });
    // </script>
     <script>
        $(document).ready(function () {
            function fetchTerms(userType) {
                $.ajax({
                    url: "{{ route('term.positions') }}",
                    method: "GET",
                    data: { user_type: userType },
                    success: function (positions) {
                        // Reset checkboxes
                        $('input[name="terms_type"]').prop('checked', false).prop('disabled', false);

                        // Check and disable multiple terms
                        positions.forEach(function (position) {
                            $(`input[name="terms_type"][value="${position}"]`)
                                .prop('checked', true)
                                .prop('disabled', true);
                        });
                    },
                    error: function (xhr) {
                        console.error("Error fetching terms positions:", xhr.responseText);
                    }
                });
            }

            function fetchUserType() {
                $.ajax({
                    url: "{{ route('term.positions') }}",
                    method: "GET",
                    success: function (userType) {
                        // Reset all radio buttons
                        $('input[name="user_type"]').prop('checked', false).prop('disabled', false);
                        // Check the fetched user type radio button
                        $(`input[name="user_type"][value="${userType}"]`).prop('checked', true);

                        // Fetch terms based on user type
                        fetchTerms(userType);
                    },
                    error: function (xhr) {
                        console.error("Error fetching user type:", xhr.responseText);
                    }
                });
            }

            // Initial fetch on page load
            fetchUserType();

            // Update checkboxes when user type changes
            $('input[name="user_type"]').on('change', function () {
                fetchTerms($(this).val());
            });

            // Allow unchecking manually if needed
            $('input[name="terms_type"]').on('change', function () {
                if (!$(this).is(':checked')) {
                    $(this).prop('disabled', false);
                }
            });
        });
    </script>

    @include('admin.layouts.text-editor')
@endsection
