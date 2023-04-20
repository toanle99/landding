
@extends('layouts.landding')
@section('page_title', 'Vòng quay')
@section('content')
 
   <article>
      <section class="multi_step_form">
         <form id="msform" action="{{ route('landding.eventStep2') }}" method="get">
            <fieldset id="fieldset_1" style="margin-top: 25%">
               <h3 class="title-fieldset">Xin Chào</h3>
               <h6>Nhập số điện thoại để bắt đầu</h6>
                
               <div class="form-group"> 
                  <input name="phone" required id="phone" type="text" class="form-control phone-rote" placeholder="Số điện thoại">
               </div> 
               <button type="submit" class="btn-start-rote btn-start-event action-button">Bắt đầu</button>  
            </fieldset> 
         </form>
      </section>
   </article>
       
@endsection



