@extends('admin.layouts.master')
@section('title')Settings Manage  @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Settings Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Settings Manage</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Settings Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All Settings Information</h4>
                    <p class="text-muted font-14">{{Session::get('success')}}</p>
                    <div class="table-responsive">
                    <table  class="table  table-bordered table-striped dt-responsive nowrap w-100">
                        <tr>
                            <td colspan="3" class="text-center">
                                <a href="">
                                    <button class="btn btn-outline-primary"
                                     data-bs-toggle="tooltip" data-bs-placement="top" title="App Refresh">App Refresh
                                    </button></a>
                                <!--EDit-->
                                @if ($setting)
                                @can('settings.edit')
                                <a href="{{route('settings.edit',$setting->id)}}">
                                    <button class="btn  btn-info "
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Setting Edit">
                                         <i class="fa-solid fa-pen-to-square"></i> Edit Setting
                                    </button>
                                </a>
                                @endcan
                                @else
                                <!--create-->
                                @can('settings.create')
                                <a href="{{route('settings.create')}}">
                                    <button class="btn  btn-primary "
                                     data-bs-toggle="tooltip" data-bs-placement="top" title="Setting Create">
                                         <i class="fa-regular fa-square-plus"></i> Add Setting
                                    </button>
                                </a>
                                @endcan
                                @endif
                                <a href="{{route('cache.clear')}}">
                                    <button class="btn btn-outline-primary"
                                     data-bs-toggle="tooltip" data-bs-placement="top" title="Cache Clear"> All Cache Clear</button>
                                </a>
                            </td>
                        </tr>
                        @if ($setting)
                        <tr>
                            <td>Logo Png</td>
                            <td>Logo Favicon</td>
                            <td>Payment Method Image</td>
                        </tr>
                        <tr>

                            <td>
                                <img src="{{asset($setting->logo_png)}}" style="width: 100px ;height:100px;">
                            </td>
                            <td>
                                <img src="{{asset($setting->favicon)}}" style="width: 100px ;height:100px;">
                            </td>
                            <td>
                                <img src="{{asset($setting->payment_method_image)}}" style="width: 300px ;height:80px;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="1">Company Name</td>
                            <td colspan="2">{{$setting->company_name}}</td>
                        </tr>


                        <tr>
                            <td colspan="1">Contact Phone</td>
                            <td colspan="2">{{$setting->contact_phone}}</td>
                        </tr>
                        <tr>
                            <td colspan="1">Support Phone</td>
                            <td colspan="2">{{$setting->support_phone}}</td>
                        </tr>
                        <tr>
                            <td colspan="1">Contact Email</td>
                            <td colspan="2">{{$setting->contact_email}}</td>
                        </tr>
                        <tr>
                            <td colspan="1">Support Email</td>
                            <td colspan="2">{{$setting->support_email}}</td>
                        </tr>
                        <tr>
                            <td colspan="1">Support Hour</td>
                            <td colspan="2">{{$setting->support_hours}}</td>
                        </tr>
                        <tr>
                            <td colspan="1">Facebook</td>
                            <td colspan="2">{{$setting->facebook}}</td>
                        </tr>
                        <tr>
                            <td colspan="1">Twitter</td>
                            <td colspan="2">{{$setting->twitter}}</td>
                        </tr>

                        <tr>
                            <td colspan="1">Instagram</td>
                            <td colspan="2">{{$setting->instagram}}</td>
                        </tr>

                        <tr>
                            <td colspan="1">Company Address</td>
                            <td colspan="2"> 
                                {!!$setting->company_address!!}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="1">Trade No</td>
                            <td colspan="2">
                                {!!$setting->trade_no!!}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="1">Tin No</td>
                            <td colspan="2">
                                {!!$setting->tin_no!!}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="1">Google Map </td>
                            <td colspan="2">{!!$setting->google_map!!}</td>
                        </tr>
                        @else
                        <tr>
                            <td class="text-center">Setting Data Not found</td>
                        </tr>
                        @endif
                    </table>
                </div>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>
@endsection
