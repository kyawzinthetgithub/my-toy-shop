@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class="d-md-flex justify-content-between align-items-center my-3">
            <div class="">
                <h3 class="text-muted">Category List</h3>
            </div>
            <div class="d-flex justify-content-end align-items-center">
                <form action="{{ route('admin#categoryList') }}" method="get">
                    @csrf
                    <div class="form-group">
                        <div class="input-group flex-nowrap">
                            <input type="text" name="key" class="form-control" placeholder="Search..."
                                aria-label="Username" aria-describedby="addon-wrapping" value="{{ request('key') }}">
                            <button type="submit" class="input-group-text" id="addon-wrapping"><i
                                    class="fa-solid fa-magnifying-glass"></i></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="d-flex align-items-center">
            <a href="{{ route('admin#categoryCreatePage') }}">
                <button class="btn btn-primary">New</button>
            </a>
            <p class="text-muted fw-bold ms-auto"> Total Category - {{count($datas)}}</p>
        </div>

        @if (session('updated'))
            <div class="col-md-3 offset-md-7">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <p>{{ session('updated') }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if (count($datas) != 0)
            <div class="table-responsive mt-3">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Category Name</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($datas as $data)
                            <tr>
                                <th class="align-middle">{{ $data->id }}</th>
                                <td>
                                    @if ($data->image)
                                        <img src="{{ asset('/storage/category/' . $data->image) }}" class="img-thumbnail"
                                            width="60px" style="height: 70px;">
                                    @else
                                        <img src="{{ asset('storage/defaultImg.jpg') }}" class="img-thumbnail"
                                            width="60px" style="height: 70px;">
                                    @endif
                                </td>
                                <td class="align-middle">{{ $data->category_name }}</td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('admin#categoryEdit', $data->id) }}">
                                            <button type="button" class="btn btn-dark me-3">Edit</button>
                                        </a>
                                        <button type="button" value="{{ $data->id }}"
                                            class="btn btn-danger conbtns">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="">{{ $datas->links() }}</div>
            </div>
        @else
            <div class="d-flex justify-content-center mt-5">
                <h5>There is no data !</h5>
            </div>
        @endif

        {{-- confirmation modal --}}

        <div class="confirmmodals">
            <div class="conmodals">
                <input type="hidden" id="deleteid">
                <h5>Are you sure want to delete !</h5>
                <div class="d-flex justify-content-end mt-2">
                    <button class="btn closes mx-3">Close</button>
                    <button id="deletecategory" class="btn btn-delete">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script_source')
    <script>
        $().ready(function() {
            // get category list
            $.ajax({
                url: "/admin/ajax/category/list",
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

            //delete category
            $("#deletecategory").on("click", function() {
                var DeleteId = $("#deleteid").val();

                $.ajax({
                    url: "/admin/ajax/category/delete/",
                    type: "get",
                    datatype: "json",
                    data: {
                        catId: DeleteId,
                    },
                    success: (response) => {
                        if (response.status == "success") {
                            location.href = "/admin/category/list";
                        }
                    },
                });
            });
        });
    </script>
@endsection
