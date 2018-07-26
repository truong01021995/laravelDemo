@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>{{$user->name}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->

                    @if(count($errors)>0)
                        <div class="alert alert-ranger">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                    @endif

                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif

                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="admin/user/sua/{{$user->id}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" placeholder="nhap ten nguoi dung" value="{{$user->name}}" />
                            </div>
                            <div class="form-group">
                                <label>email</label>
                                <input class="form-control" name="email" placeholder="nhap email" value="{{$user->email}}" readonly="" />
                            </div>
                            <div class="form-group">
                                <input name="changePass" id="changepassword" type="checkbox" >
                                <label>doi password</label>
                                <input class="form-control password" type="password" name="pass" placeholder="mat khau moi" />
                            </div>
                            <div class="form-group">
                                <label>Nhap lai password</label>
                                <input class="form-control password" type="password" name="passagain" placeholder="nhap lai mat khau" />
                            </div>
                            
                            <div class="form-group">
                                <label>Quyen truy cap
                                <label class="radio-inline">
                                    <input name="quyen" value="1"
                                    @if($user->quyen == 1)
                                    {{"checked"}}
                                    @endif
                                    type="radio">Admin
                                </label>
                                <label class="radio-inline">
                                    <input name="quyen" value="" 
                                    @if($user->quyen == 0)
                                    {{"checked"}}
                                    @endif
                                     type="radio">Nguoi dung
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Sua</button>
                            <button type="reset" class="btn btn-default">lam moi</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("#changepassword").change(function(){
                if($(this).is(":checked")){
                    $(".password").removeAttr('disabled');
                }else{
                    $(".password").attr('disabled','');
                }
            });
        });
    </script>
@endsection