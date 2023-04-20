@extends('layouts.master')
@section('page_title', 'chỉnh sửa quà ')
@section('content')

        <div class="card">
            <div class="card-header bg-white header-elements-inline">
                <h6 id="ajax-title" class="card-title"> chỉnh sửa thông tin quà  </h6>

                {!! Qs::getPanelOptions() !!}
            </div>

            <form method="post" enctype="multipart/form-data" class="wizard-form steps-validation ajax-update pt-4" data-reload="#ajax-title" action="{{ route('gift.update', Qs::hash($gift->id)) }}" data-fouc>
                @csrf @method('PUT')
                <h6>Personal data</h6> 
                <fieldset>
                    <div class="row">
                        <div class="row col-md-6 border-right-2 border-right-blue-400">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="brand">Brand: </label>  
                                    <input name="brand" id="brand" value="{{ $gift->brand }}" type="text" class="form-control" placeholder="brand..." >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="count">Số lượng: <span class="text-danger">*</span></label> 
                                    <input name="count" id="count" value="{{ $gift->count }}" type="number" class="form-control" placeholder="số lượng..." >
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="type">Loại:</label>
                                    <input name="type" id="type" value="{{ $gift->type }}" type="text" class="form-control" placeholder="type..." >
                                </div>
                            </div> 
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="content">Nội dung: <span class="text-danger">*</span></label>
                                    <input name="content" id="content" value="{{ $gift->content }}" type="text" class="form-control" placeholder="nội dung ..." >
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Ngày bắt đầu:</label>
                                    <input name="date_start" value="{{ date('m/d/Y',strtotime($gift->date_start))  }}" type="text" class="form-control date-pick" placeholder="Ngày bắt đầu ">
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Ngày kết thúc:</label>
                                    <input name="date_end" value="{{ date('m/d/Y',strtotime($gift->date_end)) }}" type="text" class="form-control date-pick" placeholder="Ngày kết thúc ">
                                </div>
                            </div> 
                        </div>
                        <div class="col-md-6">   
                            <div class="form-group row">
                                <div class="col-lg-6 from-group">
                                    <label class="ml-4">Hình ảnh:</label>
                                    <div class="mb-3 ml-4">
                                        <img style="width: 400px" height="400px" src="{{ $gift->image }}" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <input name="image" accept="image/*" type="file" class="file-input" data-show-caption="false" data-show-upload="false" data-fouc>
                                </div>
                            </div>
                        </div>
                        
                    </div> 
                </fieldset>

            </form>
        </div>
@endsection
