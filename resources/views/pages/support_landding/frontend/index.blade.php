
@extends('layouts.landding')
@section('page_title', 'Events')
@section('content')
 
   <article>
      <section class="multi_step_form">
         <form id="msform" action="{{ route('landding.store') }}" method="post" data-member_id="0" data-url_savehd="{{ route('landding.storeHoadon') }}" data-_token="{{csrf_token()}}" >
            @csrf
            <!-- progressbar -->
            <ul id="progressbar">
               <li class="active">Wellcome</li>
               <li>Thông tin khách hàng </li>
               <li>Khảo sát </li>
               <li>Hóa đơn </li>
               <li>Kết thúc </li>
            </ul>
            <!-- fieldsets --> 
            
            <fieldset id="fieldset_0">
               <div class="aeon pb-4">
                  <img src="{{ asset('assets/images/landding/images-aeon.jpg') }}">
               </div>
               <button type="button" class="next action-button">Bắt đầu</button>  
            </fieldset>
            <fieldset id="fieldset_1">
               <h3 class="title-fieldset">Thông tin khách hàng</h3>
               <h6>Vui lòng điền chính xác thông tin để có thể nhận thưởng</h6>
               <div class="form-group"> 
                  <input name="name" id="name" required type="text" class="form-control" placeholder="Họ tên đầy đủ">
               </div>
               <div class="form-group"> 
                  <input name="dob" id="dob" required type="text" class="form-control" placeholder="Năm sinh">
               </div>
               <div class="form-group">
                  <select required name="gender" id="gender" class="select form-control" data-fouc>
                     <option value="">Chọn Gới tính</option>
                     <option value="Nam">Nam</option>
                     <option value="Nữ">Nữ</option>
                  </select>
               </div>
               
               <div class="form-group"> 
                  <input name="phone" required id="phone" type="text" class="form-control" placeholder="Số điện thoại">
               </div>
               <div class="form-group">
                  <select required name="thanhpho" id="thanhpho" class="form-control select-search" data-fouc>
                     <option value="">Chọn Thành Phố</option>
                     @foreach($thanhphos as $thanhpho)
                     <option value="{{$thanhpho}}">{{$thanhpho}}</option>
                     @endforeach
                  </select>
               </div> 
               <div class="form-group pb-4">
                  <input name="quan" required id="quan" type="text" class="form-control" placeholder="Địa chỉ chi tiết">
                  {{-- <select required name ="quan" id="quan">
                     <option value="">Chọn quận</option>
                     <option value="Quận 1">Quận 1</option>
                     <option value="Quận 2">Quận 2</option>
                  </select> --}}
               </div>
               
               <button type="button" class="action-button previous previous_button">Quay lại</button>
               <button type="button" class="next action-button">Tiếp theo</button>  
            </fieldset>
            <fieldset id="fieldset_2">
               <h3>Khảo sát</h3>
               <h6>Vui lòng cung cấp thông tin chính xác</h6>
               <div class="input-group-2">
                  <h6>Phương thức thanh toán của bạn là gì?</h6>
                  <div class="custom-radio">
                     <ul>
                        <li>
                        <input id="pttt1" type="radio" name="pttt" value="Tiền mặt" required="required">
                        <label for="pttt1">Tiền mặt</label>
                        </li> 
                     </ul>
                     <ul>
                        <li>
                        <input id="ptttd1d" type="radio" name="pttt" value="Không tiền mặt">
                        <label for="ptttd1d">Không tiền mặt</label>
                        </li> 
                     </ul>
                  </div>
               </div>
               <div class="input-group-2">
                  <h6>Bạn biết đến chương trình qua kênh nào?</h6>
                  <div class="custom-radio">
                  <ul>
                     <li>
                        <input id="bietct1" type="radio" name="bietct" value="Các nền tảng online" required="required">
                        <label for="bietct1">Các nền tảng online </label>
                     </li>
                     <li>
                        <input id="bietct2" type="radio" name="bietct" value="Nhân viên tư vấn">
                        <label for="bietct2">Nhân viên tư vấn </label>
                     </li>
                  </ul>
                  <ul>
                     <li>
                        <input id="bietct1d" type="radio" name="bietct" value="Hoạt Động tại sảnh">
                        <label for="bietct1d">Hoạt Động tại sảnh </label>
                     </li>
                     <li>
                        <input id="bietct2d" type="radio" name="bietct" value="Quảng cáo trong TTTM">
                        <label for="bietct2d">Quảng cáo trong TTTM</label>
                     </li>
                  </ul>
                  </div>
               </div>
               <div class="input-group-2">
                  <h6>Phương tiện bạn đến TTTM là gì?</h6>
                  <div class="custom-radio">
                  <ul>
                     <li>
                        <input id="pttttm1" type="radio" name="pttttm" value="Xe máy" required="required">
                        <label for="pttttm1">Xe máy</label>
                     </li>
                     <li>
                        <input id="pttttm2" type="radio" name="pttttm" value="Xe công nghệ">
                        <label for="pttttm2">Xe công nghệ</label>
                     </li>
                  </ul>
                  <ul>
                     <li>
                        <input id="pttttm1d" type="radio" name="pttttm" value="Xe hơi">
                        <label for="pttttm1d">Xe hơi</label>
                     </li>
                     <li>
                        <input id="pttttm2d" type="radio" name="pttttm" value="Khác">
                        <label for="pttttm2d">Khác</label>
                     </li>
                  </ul>
                  </div>
               </div>
               <button type="button" class="action-button previous previous_button">Quay lại</button>
               <button type="button" class="next action-button">Tiếp theo</button>  
            </fieldset>
            <fieldset id="fieldset_3">
               <h3>Hóa đơn</h3>
               <h6>Vui lòng cung cấp thông tin chính xác</h6>
               <div class="input-group-2 hoadon">
                  <div class="child-hoadon">
                     <h6>Hóa đơn</h6>
                     <div class="custom-hoadon">
                        <div class="form-group">
                           <select id="cuahang_0" class="hoadon form-control" data-fouc>
                              <option value="">Chọn cửa hàng</option>
                              @foreach($cuahangs as $cuahang)
                              <option value="{{$cuahang->id}}">{{$cuahang->name}} </option> 
                              @endforeach
                           </select>
                        </div>
                        
                        <div class="form-group"> 
                           <input type="text" class="gthd form-control" placeholder="Giá trị hóa đơn" id="gthd_0">
                        </div>
                     </div>
                  </div>
               </div> 
               <div class="btn-hoadon">
                  <button type="button" class="add-hoadon">Thêm hóa đơn</button>
                  <button type="button" class="remove-hoadon">Xóa hóa đơn</button>  
               </div>
               <div class="sum-hoadon">
                  <span>Tổng giá trị hóa đơn: </span>
                  <span class="number-hoadon">0</span>
                  </div>  
               <button type="button" class="action-button previous previous_button">Quay lại</button>
               <button type="button" class="next action-button">Tiếp theo</button>  
            </fieldset>
            <fieldset id="fieldset_4">
               <h4>Cảm ơn quý khách đã tham gia chương trình</h4>
               <h6>Mã số tham gia chương trình của quý khách là</h6>
                  <div class="sum-hoadon"> 
                  <span class="phone-hoadon">0</span>
                  </div>  
                  
               <a href="/" class="back-button">Trở về trang chủ</a> 
            </fieldset>
         </form>
      </section>
      <!-- END Multiform HTML -->
   </article>
   <script>
      $(document).ready(function(){ 
         var count_hoadon = 0; 
         $("#cuahang_0").select2();
         $('.add-hoadon').click(function(){ 
            // sum_gthd Thêm hóa đơn, nhiều hóa đơn -> tổng giá trị trên 2tr
            count_hoadon ++;
            var data_select = '<select id="cuahang_'+count_hoadon+'" class="hoadon form-control" ><option value="">Chọn cửa hàng</option>@foreach($cuahangs as $cuahang)<option value="{{$cuahang->id}}">{{$cuahang->name}} </option> @endforeach</select>';
             
            // $('.input-group-2.hoadon').html($('.input-group-2.hoadon').html()+'<div><h6>Hóa đơn '+count_hoadon+'</h6><div class="custom-hoadon"><div class="form-group">'+data_select+'</div><div class="form-group"> <input type="text" class="gthd form-control" placeholder="Giá trị hóa đơn" id="gthd_'+count_hoadon+'"></div></div></div>');
            var html = '<div class="child-hoadon"><h6>Hóa đơn '+count_hoadon+'</h6><div class="custom-hoadon"><div class="form-group">'+data_select+'</div><div class="form-group"> <input type="text" class="gthd form-control" placeholder="Giá trị hóa đơn" id="gthd_'+count_hoadon+'"></div></div></div>';
            $('.input-group-2.hoadon').append(html);
            
            $('#cuahang_'+count_hoadon).select2(); 
            
         });
         // $('input.gthd').on('change', function() {
         $(document).on("keyup", "input.gthd" , function() {
         // $('input.gthd').change(function(){
            var values = $(this).val().replaceAll('.', "");
            if(isNaN(values)){
                $(this).val(''); 
            } else {
               var gthds = 0;
               $('input.gthd').each(function(){
                  var gthd = $(this).val().replaceAll('.', "");
                  gthds += parseInt(gthd);
               });
               $('.number-hoadon').text(new Intl.NumberFormat('vi-VN').format(gthds));
               const formated = new Intl.NumberFormat('vi-VN').format(values); 
               $(this).val(formated);  
               
            } 
        })
      });
   </script>
@endsection
 