@extends('layout.index')

@section('content')


<!-- Page Content -->
    <div class="container">

    	<!-- slider -->
    	@include('layout.slide')
        <!-- end slide -->

        <div class="space20"></div>


        <div class="row main-left">
            @include('layout.menu')

            <div class="col-md-9">
	            <div class="panel panel-default">            
	            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
	            		<h2 style="margin-top:0px; margin-bottom:0px;">Giới thiệu</h2>
	            	</div>

	            	<div class="panel-body">
	            		<!-- item -->
					   <p>
					   	Anh Nguyễn Tiến Cường

Năm 2013, anh Tiến đã mạnh dạn đầu tư cải tạo 3 sào ruộng cấy lúa kém hiệu quả sang nuôi ba ba trơn. Không có tiền, nên anh chỉ thuê mỗi máy múc, còn lại vợ chồng con cái anh bảo nhau tự làm lấy. Sau hơn 1 tháng hì hụi, 3 ao nuôi ba ba của anh đã hoàn thiện. Ngày thả 1.000 con ba ba trơn xuống ao, anh Tiến nuôi bao hy vọng.

“Nhờ được các hộ đi trước hướng dẫn cặn kẽ kỹ thuật nuôi ba ba từ cách thiết kế ao nuôi đến kỹ thuật chăm sóc, phòng trừ bệnh, nên tôi đã thắng lớn ngay từ vụ đầu tiên. Sau 2 năm nuôi, tôi xuất bán lứa ba ba đầu tiên, thu về gần 300 triệu đồng, trừ chi phí đầu tư con giống, thức ăn..., còn thu lãi 220 triệu đồng. Tính ra, mỗi năm lãi ròng hơn trăm triệu đồng, gấp 30 lần so với trồng lúa trên cùng 1 đơn vị diện tích” - anh Tiến khoe.

					   	
					   </p>

					</div>
	            </div>
        	</div>
        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
@endsection