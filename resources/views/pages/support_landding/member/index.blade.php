@extends('layouts.master')
@section('page_title', 'Quản lý khách hàng')
@section('content')
     
    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Quản lý khách hàng</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                 
                <li class="nav-item"><a href="#gifts" class="nav-link active show" data-toggle="tab">Quản lý khách hàng</a></li>
                {{-- <li class="nav-item"><a href="#new-gift" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i>Tạo khách hàng</a></li> --}}
            </ul> 
            <div class="tab-content">  
                <div class="tab-pane fade show active" id="gifts" >                         
                    <table class="table datatable-button-html5-columns show">
                        <thead>
                        <tr>
                            <th>Stt</th> 
                            <th>Chữ ký</th> 
                            <th>Họ tên</th>
                            <th>Năm sinh</th>
                            <th>Giới tính</th>
                            <th>Số điện thoại</th> 
                            <th>Thành phố</th>
                            <th>Địa chỉ chi tiết</th> 
                            <th>Tổng hóa đơn</th>
                            <th>Quà trúng thưởng</th>   
                            <th>Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($members as $u)
                            <tr>
                                {{-- // name, dob, gender, phone, thanhpho, quan, pttt, bietct, pttttm, cuahang, gthd,  --}}
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if(isset($u->signature))
                                    <img style="width: 100px;border: 1px solid;" src="{{$u->signature}}" alt=""> 
                                    @endif
                                </td>
                                <td>{{ $u->name }}</td>
                                <td>{{ $u->dob }}</td>
                                <td>{{ $u->gender }}</td>
                                <td>{{ $u->phone }}</td>
                                <td>{{ $u->thanhpho }}</td>
                                <td>{{ $u->quan }}</td> 
                                <td>{{ number_format($u->cost , 0, '', '.') }}đ</td>
                                <td>{{ isset($u->gift_id)?$gifts[$u->gift_id-1]->content:'' }}</td> 
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-left">
                                                Không có thao tác  
                                                {{-- <a href="{{ route('gift.edit', $u->id) }}" class="dropdown-item"><i class="icon-pencil"></i> Chỉnh sửa</a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div> 
            </div>
        </div>
    </div>  
@endsection
