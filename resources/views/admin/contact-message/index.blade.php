@extends('admin.layouts.master')
@section('title')
    Contact message Manage
@endsection
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Contact message Module</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contact message Manage</li>
                        </ol>
                    </nav>
                </div>
                <h2 class="page-title">Contact message Module</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All Message Information</h4>
                    <p class="text-muted font-14">{{ Session::get('success') }}</p>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped dt-responsive  w-100">
                            <thead>
                                <tr>
                                    <th>SL NO</th>
                                    <th> Name </th>
                                    <th>Email </th>
                                    <th>Phone </th>
                                    <th>Message </th>
                                    <th>sending time </th>

                                </tr>
                            </thead>
                            <tbody>
                                @if ($messages->count() > 0)
                                    @foreach ($messages as $index => $message)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $message->name }}</td>
                                            <td>{{ $message->email }}</td>
                                            <td>{{ $message->phone }}</td>
                                            <td>{!! $message->message !!}</td>
                                            <td>
                                                {{ $message->created_at->format('d M Y') }}<br>
                                                ({{ $message->created_at->diffForHumans() }})
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center">Contact message not found</td>
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
