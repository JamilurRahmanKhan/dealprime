@extends('admin.layouts.master')
@section('title')
    Terms Manage
@endsection
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Terms & condition Module</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Terms & condition Manage</li>
                        </ol>
                    </nav>
                </div>
                <h2 class="page-title">Terms & condition Module</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @can('terms.create') 
                <!--create-->
                <div class="my-1">
                    <a href="{{ route('terms.create') }}">
                        <button class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Color Create"><i
                                class="fa-solid fa-square-plus"></i> Add </button>
                    </a>
                </div>
            @endcan 
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All Terms & conditions Information</h4>
                    <p class="text-muted font-14">{{ Session::get('success') }}</p>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped dt-responsive  w-100">
                            <thead>
                                <tr>
                                    <th>SL NO</th>
                                    <th>Terms & condition details</th>
                                    <th>Terms Type</th>
                                    <th>User Type</th>
                                    @if(auth()->user()->can('terms.edit') || auth()->user()->can('terms.destroy') )
                                        <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                               @if ($terms->count()>0)
                                    @foreach($terms as $index=>$term)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                       <td>
                                            <div style="overflow-y: auto; max-height: 100px;">
                                                {!! $term->terms_and_condition !!}
                                            </div>
                                        </td>
                                        <td>
                                            @if($term->terms_type == 1)
                                                Terms and Conditions
                                            @elseif($term->terms_type == 2)
                                                Return & Refund Policy
                                            @elseif($term->terms_type == 3) 
                                                Privacy Policy
                                            @endif
                                        </td>
                                        <td>
                                            @if($term->user_type == 1)
                                                Partner
                                            @else
                                                Customer
                                            @endif
                                        </td>
                                        <td>
                                            <!--edit-->
                                             @can('terms.edit')  
                                            <a href="{{route('terms.edit',$term->id)}}"
                                                 class="btn btn-success btn-sm"
                                                 data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                <i class="ri-edit-box-fill"></i>
                                            </a>
                                            @endcan  

                                            <!--Destroy-->
                                            <!--{{-- @can('terms.destroy')-->
                                            <!--<form action="{{route('terms.destroy',$term->id)}}" method="POST" style="display: inline;">-->
                                            <!--    @csrf-->
                                            <!--    @method('DELETE')-->
                                            <!--    <button type="submit" class="btn btn-danger btn-sm"-->
                                            <!--    data-bs-toggle="tooltip" data-bs-placement="top" title="Banner Delete"-->
                                            <!--     onclick="return confirm('Are you sure you want to delete this teacher?');">-->
                                            <!--        <i class="ri-chat-delete-fill"></i>-->
                                            <!--    </button>-->
                                            <!--</form>-->
                                            <!--@endcan --}}-->
                                        </td>
                                    </tr>
                                      @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center">Terms & conditions not found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
@endsection
