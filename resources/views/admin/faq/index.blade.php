@extends('admin.layouts.master')
@section('title')Faqs Manage  @endsection
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Faqs Module</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Faqs Manage</li>
                    </ol>
                  </nav>
                 </div>
            <h2 class="page-title">Faqs Module</h2>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <!--create-->
            {{-- @can('faq.create') --}}
            <div class="my-1">
                <a  href="{{route('faq.create')}}">
                    <button class="btn btn-info"   data-bs-toggle="tooltip" data-bs-placement="top" title="Faqs Create"><i class="fa-solid fa-square-plus"></i> Add </button>
                </a>
            </div>
            {{-- @endcan --}}
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All Faqs Information</h4>
                    <p class="text-muted font-14">{{Session::get('success')}}</p>
                    <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped dt-responsive  w-100">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Question </th>
                            <th>Answer </th>
                            <th>Status </th>
                            {{-- @if(auth()->user()->can('faq.edit') || auth()->user()->can('faq.destroy') ) --}}
                            <th>Action</th>
                            {{-- @endif --}}
                        </tr>
                        </thead>
                        <tbody>
                            @if ($faqs->count()>0)
                            @foreach($faqs as $index=>$faq)
                                <tr>
                                    <td>{{$index +1}}</td>
                                    <td>{{$faq->question}}</td>
                                    <td>{!!$faq->answer!!}</td>
                                    <td>
                                        @if ($faq->status==1)
                                        <span class="badge p-1 bg-success">Published</span>
                                        @else
                                        <span class="badge p-1 bg-danger">Unpublished</span>
                                        @endif
                                    </td>

                                    {{-- @if(auth()->user()->can('faq.edit') || auth()->user()->can('faq.destroy') ) --}}
                                    <td>
                                        <!--edit-->
                                        {{-- @can('faq.edit') --}}
                                        <a href="{{route('faq.edit',$faq->id)}}"
                                             class="btn btn-success btn-sm"
                                             data-bs-toggle="tooltip" data-bs-placement="top" title="Faqs Edit">
                                            <i class="ri-edit-box-fill"></i>
                                        </a>

                                        @if ($faq->status==1)
                                        <a href="{{route('faq.show',$faq->id)}}"
                                             class="btn btn-warning btn-sm"
                                             data-bs-toggle="tooltip" data-bs-placement="top" title="Published">
                                            <i class="fa-solid fa-lock-open py-"></i>
                                        </a>
                                        @endif
                                        @if ($faq->status==0)
                                        <a href="{{route('faq.show',$faq->id)}}"
                                            class="btn btn-info btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Unpublished">
                                            <i class="fa-solid fa-lock"></i>
                                        </a>
                                        @endif
                                        {{-- @endcan --}}
                                        <!--Destroy-->
                                        {{-- @can('faq.destroy')
                                        <form action="{{route('faq.destroy',$faq->id)}}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Faqs Delete"
                                             onclick="return confirm('Are you sure you want to delete this teacher?');">
                                                <i class="ri-chat-delete-fill"></i>
                                            </button>
                                        </form>
                                        @endcan --}}
                                    </td>
                                    {{-- @endif --}}
                                </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="6" class="text-center">Faqs not found </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>
@endsection
