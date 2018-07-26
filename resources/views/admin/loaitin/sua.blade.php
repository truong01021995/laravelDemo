@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Loại Tin
                            <small>{{$loaitin->Ten}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->

                    @if(count($errors) > 0)
                        <div class="alert alert-ranger">
                            @foreach($errors as $err)
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
                        <form action="admin/loaitin/sua/{{$loaitin->id}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Thể Loại</label>
                                <select class="form-control" name="theloai">
                                    @foreach($theloai as $tl)
                                        <option
                                            @if($loaitin->idTheLoai == $tl->id)
                                                {{"selected"}}
                                            @endif
                                         value="{{$tl->id}}">{{$tl->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tên Loại Tin</label>
                                <input class="form-control" name="ten" placeholder="thay đổi tên loại tin" value="{{$loaitin->Ten}}" />
                            </div>
                            
                            <button type="submit" class="btn btn-default">Cap nhat</button>
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