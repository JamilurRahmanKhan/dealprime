@extends('website.layouts.master')
@section('title','Compare Products')
@section('body')
<main class="main">
    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Compare products
                        </li>
                    </ol>
                </div>
            </nav>
            <h1>Compare </h1>
        </div>
    </div>
    <div class="container mt-5">
        <!-- Responsive table wrapper -->
        <div class="table-responsive">
            <table>
                <tr>
                    <td>
                        <table class="table table-striped  ">
                            <tbody >
                                <!-- Product Images Row -->
                                <tr >
                                    @foreach ($compares as $comp => $compare)
                                        <td class="compare-column-productinfo">
                                            <div class="compare-product-image">
                                                @if($compare)
                                                    <a href="{{ route('product_item.details', $compare->product_id) }}">
                                                        <img src="{{ asset($compare->p_image) }}" alt="{{ $compare->product_name }}" style="height: 180px; width:180px">
                                                    </a><br>
                                                    <form action="{{ route('compare.delete', $compare->compare_id) }}" method="post" class="p-0 d-inline">
                                                        @csrf
                                                        <button class="btn btn-sm btn-danger my-1 px-2">Delete Item</button>
                                                    </form>
                                                @else
                                                    <p>Product not found.</p>
                                                @endif
                                            </div>
                                            <table style="border: none">
                                                <tr>
                                                    <td colspan="2">
                                                        <h5 class="compare-product-name">
                                                            <a href="{{ route('product_item.details', $compare->product_id) }}">
                                                                {{ $compare->product_name }}
                                                            </a>
                                                        </h5>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table >
                                                            @foreach ($compare->p_key_names as $comp )
                                                                <tr>
                                                                    <td>
                                                                        {{$comp}}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                     </td>
                                                    <td>
                                                        <table>
                                                            @foreach ($compare->p_key_values as $compv )
                                                                <tr>
                                                                    <td>
                                                                        {{$compv}}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                     </td>
                                                </tr>
                                            </table>
                                        </td>

                                    @endforeach
                                </tr>


                                <!-- Product Names Row -->




                            </tbody>
                        </table>
                    </td>

                </tr>
            </table>
        </div>
    </div>
</main>

{{--@foreach($compareChunk as $comProduct)--}}
{{--    @foreach($comProduct->productComaperison as $comPro )--}}
{{--        <tr>--}}
{{--            <th>{{$comPro->key_name}}</th>--}}
{{--            <th>{{$comPro->key_value}}</th>--}}

{{--        </tr>--}}
{{--    @endforeach--}}
{{--@endforeach--}}
@endsection
