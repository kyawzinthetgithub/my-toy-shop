@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class="d-md-flex justify-content-between align-items-center my-3">
            <div class="">
                <h3 class="text-muted">Product List</h3>
            </div>
            <div class="d-flex justify-content-end align-items-center">
                <form action="{{ route('admin#productList') }}" method="get">
                    @csrf
                    <div class="form-group">
                        <div class="input-group flex-nowrap">
                            <input type="text" name="key" class="form-control" placeholder="Search..."
                                value="{{ request('key') }}">
                            <button type="submit" class="input-group-text" id="addon-wrapping"><i
                                    class="fa-solid fa-magnifying-glass"></i></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="d-flex align-items-center">
            <a href="{{ route('admin#productCreate') }}">
                <button class="btn btn-primary">New</button>
            </a>

            <p class="text-muted fw-bold ms-auto"> Total Products - {{count($products)}}</p>

        </div>

        @if (session('update'))
            <div class="col-md-3 offset-md-7">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <p>{{ session('update') }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if (count($products) != 0)
            <div class="table-responsive mt-3">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Category Name</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($products as $product)
                            <tr>
                                <th class="align-middle">{{ $product->id }}</th>
                                <td class="align-middle">
                                    @if ($product->image)
                                        <img src="{{ asset('/storage/products/' . $product->image) }}" class="img-thumbnail"
                                            width="70px" style="height:75px;">
                                    @else
                                        <img src="{{ asset('storage/defaultImg.jpg') }}" class="img-thumbnail"
                                            width="70px" style="height:75px;">
                                    @endif
                                </td>
                                <td class="align-middle text-capitalize">{{ $product->product_name }}</td>
                                <td class="align-middle text-capitalize">{{ $product->category_name }}</td>
                                <td class="align-middle">{{ $product->size }}</td>

                                <td class="align-middle">{{ $product->product_price }}</td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('admin#productDetail', $product->id) }}">
                                            <button type="button" class="btn btn-dark me-2">Details</button>
                                        </a>
                                        <button type="button" value="{{ $product->id }}"
                                            class="btn btn-danger conbtns">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">{{ $products->links() }}</div>
            </div>
        @else
            <div class="d-flex justify-content-center mt-5">
                <h5 class="text-danger">There is no product !</h5>
            </div>
        @endif

        {{-- confirmation modal --}}

        <div class="confirmmodals">
            <div class="conmodals">
                <input type="hidden" id="deleteid">
                <h5>Are you sure want to delete !</h5>
                <div class="d-flex justify-content-end mt-2">
                    <button class="btn closes mx-3">Close</button>
                    <button id="deletecproduct" class="btn btn-delete">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script_source')
    <script>
        $().ready(function() {
            //get product
            $.ajax({
                url: "/admin/ajax/product/list",
                type: "get",
                datatype: "json",
            });

            //get confirm modal

            $(".conbtns").on("click", function() {
                var catId = $(this).val();
                $("#deleteid").val(catId);
                $(".confirmmodals").slideDown("200ms");
            });

            //hide modal
            $(".closes").on("click", function() {
                $(".confirmmodals").slideUp("200ms");
            });

            //delete product
            $("#deletecproduct").on("click", function() {
                var DeleteId = $("#deleteid").val();
                $.ajax({
                    url: "/admin/ajax/product/delete",
                    type: "get",
                    datatype: "json",
                    data: {
                        catId: DeleteId,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            location.href = '/admin/product/list';
                        }
                    },
                });
            });
        });
    </script>
@endsection
