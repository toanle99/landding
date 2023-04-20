@extends('layouts.master')
@section('page_title', 'Cài đặt hệ thống')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title font-weight-semibold">Cài đặt hệ thống</h6>
            {!! Qs::getPanelOptions() !!}
        </div>


        {{-- <form id="ajax-reg" method="post" enctype="multipart/form-data" class="wizard-form steps-validation pt-4" action="{{ route('students.store') }}" data-fouc>
            @csrf
            <h6>Personal data</h6>
            
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Họ & tên: <span class="text-danger">*</span></label>
                            <input value="{{ old('name') }}" required type="text" name="name" placeholder="Họ tên" class="form-control">
                        </div>
                    </div> --}}





        <div class="card-body pt-3">
            <form enctype="multipart/form-data"  method="post" class="wizard-form steps-validation pt-4"  action="{{ route('settings.update') }}" data-fouc>
                @csrf 
                <h6>Personal data</h6>
                <fieldset>
                    <div class="row">
                        <div class="col-md-8 border-right-2 border-right-blue-400">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Tên sự kiện <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input name="system_name" value="{{ $s['system_name'] }}" required type="text" class="form-control" placeholder="Tên trường">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="current_session" class="col-lg-3 col-form-label font-weight-semibold">Niên khóa hiện tại</label>
                                <div class="col-lg-9">
                                    <select data-placeholder="Choose..." name="current_session" id="current_session" class="select-search form-control">
                                        <option value=""></option>
                                        @for($y=date('Y', strtotime('- 3 years')); $y<=date('Y', strtotime('+ 1 years')); $y++)
                                            <option {{ ($s['current_session'] == (($y-=1).'-'.($y+=1))) ? 'selected' : '' }}>{{ ($y-=1).'-'.($y+=1) }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Viết tắt tên sự kiện</label>
                                <div class="col-lg-9">
                                    <input name="system_title" value="{{ $s['system_title'] }}" type="text" class="form-control" placeholder="Viết tắt tên trường">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Sđt</label>
                                <div class="col-lg-9">
                                    <input name="phone" value="{{ $s['phone'] }}" type="text" class="form-control" placeholder="Sđt">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Email</label>
                                <div class="col-lg-9">
                                    <input name="system_email" value="{{ $s['system_email'] }}" type="email" class="form-control" placeholder="Địa chỉ email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Địa chỉ <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input required name="address" value="{{ $s['address'] }}" type="text" class="form-control" placeholder="Địa chỉ">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Thông tin thêm <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input name="system_footer" value="{{ $s['system_footer'] }}" required type="text" class="form-control" placeholder="Thông tin thêm">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">  
                            {{--Logo--}}
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Thay đổi Logo:</label>
                                <div class="col-lg-9">
                                    <div class="mb-3">
                                        <img style="width: 100px" height="100px" src="{{ $s['logo'] }}" alt="">
                                    </div>
                                    <input name="logo" accept="image/*" type="file" class="file-input" data-show-caption="false" data-show-upload="false" data-fouc>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <hr class="divider"> --}}
                    {{-- <div class="text-right">
                        <button type="submit" class="btn btn-danger">Gửi đi <i class="icon-paperplane ml-2"></i></button>
                    </div>  --}}
                </fieldset>
            </form>
        </div>
    </div>

    {{--Settings Edit Ends--}}

@endsection
