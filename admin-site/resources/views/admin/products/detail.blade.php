@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class="row mt-5">

            <div class="col-md-8 offset-md-2 p-5 rounded"
                style="box-shadow: 0px 0px 5px 1px rgba(87, 87, 87, 0.5);background:#e6e6e6;">
                <a href="{{ route('admin#productList') }}" class="text-black"><i
                        class="fa-solid fa-circle-arrow-left fa-2x"></i></a>

                <div class="d-flex justify-content-center align-items-center">
                    <div class="row">
                        <div class="col-md-4 d-flex align-items-center">
                            @if ($product->image)
                                <img src="{{ asset('storage/products/' . $product->image) }}" width="100%"
                                    class="img-thumbnail" alt="">
                            @else
                                <img src="{{ asset('storage/defaultImg.jpg') }}" width="100%" class="img-thumbnail"
                                    alt="">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h5 class="text-muted my-3">Product Details</h5>
                            <table class="table table-sm">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $product->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <td class="text-capitalize">
                                            {{ $product->product_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Category</th>
                                        <td class="text-capitalize">
                                            {{ $product->category_name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Size</th>
                                        <td>
                                            {{ $product->size }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Details</th>
                                        <td class="text-capitalize">
                                            {{ $product->product_detail }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Made by</th>
                                        <td class="text-capitalize">
                                            {{ $product->made_by }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Made In</th>
                                        <td class="text-capitalize">
                                            {{ $product->made_country }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Price</th>
                                        <td>
                                            {{ $product->product_price }} <span>MMK</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end mt-3">
                                <a href="{{ route('admin#productUpdate', $product->id) }}">
                                    <button type="button" class="btn btn-primary">Edit</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
