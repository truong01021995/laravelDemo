@extends('admin.layout.index')

@section('content')

 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin Tức
                            <small>{{$tintuc -> TieuDe}}</small>
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
                        <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Thể Loại</label>
                                <select class="form-control" name="theloai" id="theloai">
                                    @foreach($theloai as $tl)
                                        <option 
                                            @if($tintuc->loaitin->theloai->id == $tl->id)
                                            {{"selected"}}
                                            @endif
                                        value="{{$tl->id}}">{{$tl->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại Tin</label>
                                <select class="form-control" name="loaitin" id="loaitin">
                                    @foreach($loaitin as $lt)
                                        <option 
                                            @if($tintuc->loaitin->id == $lt->id)
                                            {{"selected"}}
                                            @endif
                                        value="{{$lt->id}}">{{$lt->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tiêu Đề</label>
                                <input class="form-control" name="tieude" placeholder="nhập tiêu đề" value="{{$tintuc->TieuDe}}" />
                            </div>
                            
                            <div class="form-group">
                                <label>Tóm Tắt</label>
                                <textarea name="tomtat" id="demo" class="form-control ckeditor" rows="3">{{$tintuc->TomTat}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Nội Dung</label>
                                <textarea name="noidung" id="demo" class="form-control ckeditor" rows="5">{{$tintuc->NoiDung}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <p>
                                    <img src="upload/tintuc/{{$tintuc->Hinh}}" alt="" width="400px">
                                </p>
                                <input type="file" name="hinhanh" value="" placeholder="hình minh họa" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nổi bật</label>
                                <label class="radio-inline">
                                    <input name="noibat" value="0" 
                                    @if($tintuc->NoiBat == 0)
                                        {{"checked"}}
                                    @endif
                                     type="radio">không
                                </label>
                                <label class="radio-inline">
                                    <input name="noibat" value="1"
                                    @if($tintuc->NoiBat == 1)
                                        {{"checked"}}
                                    @endif

                                     type="radio">có
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Sua</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Comment
                            <small>Danh Sach</small>
                        </h1>
                    </div>

                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Nguoi Dung</th>
                                <th>Noi dung</th>
                                <th>Ngay Dang</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tintuc->comment as $cm)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$cm -> id}}</td> 
                                    <td>{{$cm -> user-> name}}</td>
                                    <td>{{$cm->NoiDung}}</td>
                                    <td>{{$cm->created_at}}</td>
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{$cm->id}}/{{$tintuc->id}}"> Delete</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- end row --}}
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("#theloai").change(function(){
                var idtheloai = $(this).val();
                $.get("admin/ajax/loaitin/"+idtheloai, function(data){
                    $("#loaitin").html(data);
                });
            });
        });
    </script>
@endsection