@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <h3>Admin Lists</h3>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <p>Total - {{count($users)}}</p>
            <div>
                <form action="" method="get">
                    <div class="input-group">
                        <input type="text" name="searchKey" class="form-control rounded-0" placeholder="Search..." value="{{request('searchKey')}}">
                        <button type="submit" class="btn btn-muted rounded-0 input-group-text"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
        </div>

        @if (count($users))
        <div class="table-responsive mt-3">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th>Role</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <input type="hidden" name="userId" class="UserId" value="{{$user->id}}">
                        <td class="align-middle">{{$user->id}}</td>
                        <td class="align-middle">
                            @if ($user->image != null)
                                <img src="{{ asset('storage/account/' . $user->image) }}" width="50" class="img-thumbnail">
                            @else
                                @if ($user->gender == 'male')
                                    <img src="{{ asset('assets/images/profile/user-1.jpg') }}" width="50" class="img-thumbnail">
                                @else
                                    <img src="{{ asset('assets/images/profile/default-female.jpg') }}"
                                        width="50" class="img-thumbnail">
                                @endif
                            @endif
                        </td>
                        <td class="align-middle">{{$user->name}}</td>
                        <td class="align-middle">{{$user->email}}</td>
                        <td class="align-middle">{{$user->phone}}</td>
                        <td class="align-middle">{{$user->address}}</td>
                        <td class="align-middle">{{$user->gender}}</td>
                        <td class="align-middle">
                            <div class="form-group">
                                <select name="role" class="form-select changeroles">
                                    <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
                                    <option value="user" @if($user->role == 'user') selected @endif @if($user->id == Auth::user()->id) disabled @endif>User</option>
                                </select>
                            </div>
                        </td>
                        <td class="align-middle">
                            @if ($user->id != Auth::user()->id)
                                <button type="button" class="btn btn-sm btn-warning rounded conbtns" value="{{$user->id}}">
                                    <img src="{{asset('assets/images/PersonRemove.svg')}}" width="25" class=" align-middle">
                                </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">{{$users->links()}}</div>
        </div>
        @else
        <div class="d-flex justify-content-center align-items-center">
            <h3 class="text-danger mt-5">There is no user !</h3>
        </div>
        @endif


        {{-- confimation modal --}}
        <div class="confirmmodals">
            <div class="conmodals">
                <input type="hidden" id="deleteid">
                <h5>Are you sure want to delete !</h5>
                <div class="d-flex justify-content-end mt-2">
                    <button class="btn closes mx-3">Close</button>
                    <button id="deleteadmin" class="btn btn-delete">Delete</button>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script_source')
    <script>
        $(document).ready(function(){

            // get modal box
            $(".conbtns").on("click", function() {
                var delUser = $(this).val();
                $("#deleteid").val(delUser);
                $(".confirmmodals").slideDown("200ms");
            });

            $(".closes").on("click", function() {
                $(".confirmmodals").slideUp("200ms");
            });

            //delete admin
            $("#deleteadmin").on("click", function() {
                var DeleteId = $("#deleteid").val();
                $.ajax({
                    url: "/admin/delete",
                    type: "get",
                    datatype: "json",
                    data: {
                        DelId: DeleteId,
                    },
                    success: (response) => {
                        if (response.status == 'success') {
                            $(".confirmmodals").slideUp("200ms");
                            location.reload();
                        }
                    },
                });
            });

            //change role
            $('.changeroles').change(function(){
                let getParent = $(this).parents('tr');
                let curVal = $(this).val();
                let curId = getParent.find('.UserId').val();
                $.ajax({
                    url : '/admin/change/role',
                    type : 'get',
                    data : {
                        usrId : curId,
                        Role : curVal
                    },
                    datatype : 'json',
                    success : function(response){
                        if (response.status == 'success') {
                            location.reload();
                        }
                    }
                });

            });

        });
    </script>
@endsection
