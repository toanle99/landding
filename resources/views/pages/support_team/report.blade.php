@extends('layouts.master')
@section('page_title', 'Báo cáo thống kê')
@section('content')
    <div class="card">
        <div class="card-body">  
            <div class="tab-content">  
                <table id="example" class="example key table datatable-button-html5-columns show">
                    <thead>
                    <tr>
                        <th>Stt</th> 
                        <th>Họ tên</th>
                        <th>Lớp</th>
                        <th>Ngày sinh</th>
                        <th>Ngày xin nghỉ</th>
                        <th>Thời gian</th>
                        <th>Lý do</th> 
                        <td>Thao tác</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($gxps->whereIn('status', [1, 2, 4]) as $u)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $u->student_record->user->name }}</td>
                            <td>{{ $u->student_record->my_class->name }}</td>
                            <td>{{ $u->student_record->user->dob }}</td>
                            <td>{{ date('d/m/Y', strtotime($u->date_at)) }}</td>
                            <td>{{ $u->session_time }}</td>
                            <td>{{ $u->reason }}</td> 
                            <td class="text-center">
                                <div class="list-icons">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-left"> 
                                            Không có thao tác 
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
    <script>
        $(document).ready(function () {  
             
        }); 
    </script>

    @endsection
