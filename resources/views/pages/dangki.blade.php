@extends('layout.index')

@section('content')

 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>Dang Ki</small>
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
                        <form action="admin/user/them" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" placeholder="nhap ten nguoi dung" />
                            </div>
                            <div class="form-group">
                                <label>email</label>
                                <input class="form-control" name="email" placeholder="nhap email" />
                            </div>
                            <div class="form-group">
                                <label>password</label>
                                <input class="form-control" type="password" name="pass" placeholder="nhap mat khau" />
                            </div>
                            <div class="form-group">
                                <label>Nhap lai password</label>
                                <input class="form-control" type="password" name="passagain" placeholder="nhap lai mat khau" />
                            </div>
                            
                            
                            <button type="submit" class="btn btn-default">Đăng kí</button>
                            
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

@endsection