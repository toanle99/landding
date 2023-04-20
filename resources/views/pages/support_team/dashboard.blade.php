@extends('layouts.master')
@section('page_title', 'Trang chủ')
@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Thống kê</h5>
            {!! Qs::getPanelOptions() !!}
        </div>
        <div class="card-body">  
            <div class="tab-content"> 
                <div class="row">
                    <div class="col-sm-6 col-xl-6">
                        <div class="card card-body bg-success-400 has-bg-image">
                            <div class="media">
                                <div class="media-body text-center">
                                    <h2 class="mb-0">{{count($members)}} </h2>
                                    <span class="text-uppercase font-size-xs font-weight-bold">Tổng số khách hàng</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-6">
                        <div class="card card-body bg-blue-400 has-bg-image">
                            <div class="media">
                                <div class="media-body text-center">
                                    <h2 class="mb-0">{{count($gifts)}} </h2>
                                    <span class="text-uppercase font-size-xs font-weight-bold">Tổng số quà</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>  
            </div>
        </div>
    </div>

    @endsection
