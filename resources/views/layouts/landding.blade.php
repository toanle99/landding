<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta id="csrf-token" name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="LARAVEL Event">

    <title> @yield('page_title') </title>

    @include('partials.inc_top_landding')
</head>

<body>

    {{-- @include('partials.top_menu') --}}
    <div class="page-content">
        {{-- @include('partials.menu') --}}
        <div class="content-wrapper">
            {{-- @include('partials.header') --}}

            <div class="content">
                {{--Error Alert Area--}}
                @if($errors->any())
                    <div class="alert alert-danger border-0 alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>

                            @foreach($errors->all() as $er)
                                <span><i class="icon-arrow-right5"></i> {{ $er }}</span> <br>
                            @endforeach

                    </div>
                @endif
                <div id="ajax-alert" style="display: none"></div>

                @yield('content')
            </div>

            
        </div>
    </div>
    {{-- @include('partials.footer') --}}
    @include('partials.inc_bottom_landding')
    @yield('scripts')
</body>
</html>
