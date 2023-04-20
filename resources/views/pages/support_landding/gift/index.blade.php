@extends('layouts.master')
@section('page_title', 'Quản lý quà')
@section('content')
     
    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Quản lý quàp</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                 
                <li class="nav-item"><a href="#gifts" class="nav-link active show" data-toggle="tab">Quản lý quà</a></li>
                <li class="nav-item"><a href="#new-gift" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i>Tạo quà</a></li>
            </ul> 
            <div class="tab-content">  
                <div class="tab-pane fade show active" id="gifts" >                         
                    <table class="table datatable-button-html5-columns show">
                        <thead>
                        <tr>
                            <th>Stt</th> 
                            <th>Brand</th>
                            <th>Số lượng</th>
                            <th>Type</th>
                            <th>Nội dung</th> 
                            <th>Thời gian xuất hiện</th>
                            <th>Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($gifts as $u)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $u->brand }}</td>
                                <td>{{ $u->count }}</td>
                                <td>{{ $u->type }}</td>
                                <td>{{ $u->content }}</td>
                                <td>{{ date('d/m/Y', strtotime($u->date_start))." - ".date('d/m/Y', strtotime($u->date_end)) }}</td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-left">  
                                                <a href="{{ route('gift.edit', $u->id) }}" class="dropdown-item"><i class="icon-pencil"></i> Chỉnh sửa</a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div> 
                <div class="tab-pane fade" id="new-gift">
                    <form id="ajax-reg" method="post" enctype="multipart/form-data" class="wizard-form steps-validation pt-4" action="{{ route('gift.store') }}" data-fouc>
                        @csrf
                        <h6>Personal Data</h6>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="brand">Brand: </label>  
                                        <input name="brand" id="brand" value="{{ old('brand') }}" type="text" class="form-control" placeholder="brand..." >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="count">Số lượng: <span class="text-danger">*</span></label> 
                                        <input name="count" id="count" value="{{ old('count') }}" type="number" class="form-control" placeholder="số lượng..." >
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="type">Loại:</label>
                                        <input name="type" id="type" value="{{ old('type') }}" type="text" class="form-control" placeholder="type..." >
                                    </div>
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="content">Nội dung: <span class="text-danger">*</span></label>
                                        <input name="content" id="content" value="{{ old('content') }}" type="text" class="form-control" placeholder="nội dung ..." >
                                    </div>
                                </div>
                            </div> 
                            <div class="row"> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="d-block">Hình ảnh quà:</label>
                                        <input value="{{ old('image') }}" accept="image/*" type="file" name="image" class="form-input-styled" data-fouc>
                                        <span class="form-text text-muted">Loại hình ảnh: jpeg, png. Tối đa 2Mb</span>
                                    </div>
                                </div>
                            </div> 
                        </fieldset>
                    </form>
                </div> 
            </div>
        </div>
    </div>  
@endsection
