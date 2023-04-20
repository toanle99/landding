
@extends('layouts.landding')
@section('page_title', 'Vòng quay')
@section('content')
<style type="text/css">
    
    #spin_button {
        position: relative;
        top: -256px;
        background: radial-gradient(#fff, #b6a404);
        width: 66px;
        height: 66px;
        text-align: center;
        text-align-last: center;    
        border: 5px solid #b6aa3ac7;
        border-radius: 50%;
        color: #620606;
        font-size: 23px;
        font-weight: bold;
        line-height: 55px;
        /* left: 7px; */
    }
    .triangle_down {
        width: 0;
        height: 0;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-top: 20px solid #2f2f2f;
        font-size: 0;
        line-height: 0;   
    }
    #canvasContainer {
        position: relative;
        width: 434px;
    }
         
    #canvas {
       
    }
         
    #prizePointer {
        position: absolute;
        left: 205px;
        top: -20px;
        z-index: 999;
        width: 26px;
        height: auto;
    }
    
    body {
        /* background-image: url('images-background.jpg'); */
    }
    div#canvasContainer {
    z-index: 2;
    }
    .all {
    /* position: relative; */
    padding-top: 10%;
    }
    .header-logo img {
    position: relative;
    top: -48px;
    /* width: 40%; */
    }
</style>
{{-- <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css"> --}}
<style> 
canvas#sketchpad {box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px; margin: 1rem auto; width: 100%;}
.pad #sketchpad{}
</style>




{{-- <link href="css/jquery.signature.css" rel="stylesheet"> --}}
<style>
.kbw-signature { width: 100%; height: 250px; }
#sig canvas {width: 99%;}
#sig {border: 2px solid;border-radius: 5px;}

.modal-body h2 {color: red;font-weight: bold;}
</style> 

{{-- <script>
    $(function() {
        var sig = $('#sig').signature();
        $('#disable').click(function() {
            var disable = $(this).text() === 'Disable';
            $(this).text(disable ? 'Enable' : 'Disable');
            sig.signature(disable ? 'disable' : 'enable');
        });
        $('#clear').click(function() {
            sig.signature('clear');
        });
        $('#json').click(function() {
            alert(sig.signature('toJSON'));
        });
        $('#svg').click(function() {
            alert(sig.signature('toDataURL'));
        });
    });
</script> --}}


<body>
    <div class="all" align="center">
        <div class="header-logo">
            <img src="{{ asset('assets/images/landding/header.png') }}" alt="">
        </div>
         
        <div id="canvasContainer" width="438" height="582" class="the_wheel" align="center" valign="center"> 
            <canvas id="canvas" width="434" height="434">
                
            </canvas>
            <div style="" id="spin_button" alt="Spin" onClick="startSpin();" >Quay</div>
            <img id="prizePointer" src="{{ asset('assets/images/landding/Capture.png') }}" alt="V" />
        </div> 
        <div style="width: 276px;height: auto;margin-top: -102px;margin-left: 25px;">
            <img style="
           
                width: 168%;
                position: relative;
                top: -422px;left: -107px;
                z-index: 1;
            " src="{{ asset('assets/images/landding/bg.png') }}"/>
           
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body text-center">
              ...
            </div>
            <div class="modal-footer">
                {{-- data-dismiss="modal" --}}
              <button type="button" class="btn btn-xacnhan btn-danger w-100">Xác nhận</button>
            </div>
          </div>
        </div>
    </div>
    {{-- <img id="signature" class="hidden signature" src="signature.png" alt="signature" /> --}}
    {{-- <h1>jQuery UI Signature</h1> 
    <div id="sig"></div>
    <p style="clear: both;">
        <button id="disable">Disable</button> 
        <button id="clear">Clear</button> 
        <button id="json">To JSON</button>
        <button id="svg">To SVG</button>
    </p> 
     --}}


    <script>
        // Create new wheel object specifying the parameters at creation time.
        var sig;
        var gift_id;
        

        let theWheel = new Winwheel({
            'outerRadius'     : 212, 
            'innerRadius'     : 0, 
            'textFontSize'    : 22,   
            // 'textOrientation' : 'vertical', 
            'textAlignment'   : 'outer', 
            'numSegments'     : {{count($gifts)}},  
            'strokeStyle'      : '#EDEED0',
            'segments'        :    
            [     
                @foreach($gifts as $key=>$gift)
                
                {textFillStyle:'{{$key%2==0?"#A21E20":"#EDEED0"}}', 'textStrokeStyle' : '{{$key%2==0?"#A21E20":"#EDEED0"}}', 'fillStyle' : '{{$key%2==0?"#EDEED0":"#A21E20"}}', 'data_image':'{{$gift["image"]}}', 'data_shows': '{{$gift["show"]}}', 'data_id': '{{$gift["id"]}}', 'textLineHeight':'10px','textFontWeight' : 400, 'textFontSize' : 14, 'text' : '{{$gift["content"]}}'},
                
                @endforeach
            ],
            'animation' :           
            {
                'type'     : 'spinToStop',
                // 'duration' : 6,    
                // 'spins'    : 3,     
                'callbackFinished' : alertPrize,
                'callbackSound'    : playSound,   
                'soundTrigger'     : 'pin'        
            },
            'pins' :                // Turn pins on.
            {
                'number'     : {{count($gifts)}},
                // 'fillStyle'  : 'silver',
                'outerRadius': 4,
            }
        }); 
        let audio = new Audio('{{ asset('assets/sound/tick.mp3') }}');
        function playSound()
        {
            audio.pause();
            audio.currentTime = 0;
            audio.play();
        }

        let wheelPower    = 0;
        let wheelSpinning = false;  
 
        function startSpin()
        { 
            if (wheelSpinning == false) { 
                
                theWheel.animation.spins = Math.floor(Math.random() * (9 - 3 + 1)) + 3; 
                document.getElementById('spin_button').src       = "spin_off.png";
                document.getElementById('spin_button').className = "";
 
                theWheel.startAnimation(); 
                wheelSpinning = true;
            }
        } 
        function alertPrize(indicatedSegment)
        {   
            // id quà 
            gift_id = indicatedSegment.data_id; 
            
            gift_shows = indicatedSegment.data_shows; 
            console.log(gift_id);
            console.log(gift_shows);
            if(gift_id == 5) { // xét quà 5
                // 'gift_shows'
                console.log('quà só 5');
                if(gift_shows == 'oke'){
                    $('#exampleModalCenter .modal-body').html('<img style="width: 100%;" src="'+indicatedSegment.data_image+'" alt=""> <h2>Chúc mừng</h2><h5>Chúc mừng bạn đã trúng thưởng</h5>');
                    $("#exampleModalCenter").modal('show');
                }else {
                    $('#exampleModalCenter .modal-body').html('<h2>Rất xin lỗi</h2><h5>'+gift_shows+'</h5>');
                    $('#exampleModalCenter .modal-footer').html('<button type="button" class="btn btn-exit btn-danger w-100" data-dismiss="modal">Xác nhận</button>');
                    $("#exampleModalCenter").modal('show');
                }
            }else {
                $('#exampleModalCenter .modal-body').html('<img style="width: 100%;" src="'+indicatedSegment.data_image+'" alt=""> <h2>Chúc mừng</h2><h5>Chúc mừng bạn đã trúng thưởng</h5>');
                $("#exampleModalCenter").modal('show'); 
            }
            
        }
        $('.btn.btn-xacnhan').click(function(){ 
            $(function() {
                // sig = $('#sig').signature();
                // $('#clear').click(function() {
                //     sig.signature('clear');
                // }); 
                


// data: {'phone':'{{$member->phone}}', 'gift_id': gift_id ,'signature': sig.signature('toDataURL'), "_token": "{{ csrf_token() }}"},
                $('.btn.btn-guichuki').click(function(){
                    var canvas = document.getElementById('sketchpad');
                    dataUrl = canvas.toDataURL();
                    // console.log(dataUrl);
                    $.ajax({
                        type: 'post',   
                        url: "{{route('signature.save')}}", 
                        data: {'phone':'{{$member->phone}}', 'gift_id': gift_id ,'signature': dataUrl, "_token": "{{ csrf_token() }}"},
                        success: function (data) {  
                            $('#exampleModalCenter .modal-body').html('<h2>Chúc mừng bạn đã trúng thưởng</h2><h5>Liên hệ nhân viên để nhận quà nhé</h5>'); 
                            $('#exampleModalCenter .modal-footer').html('<button type="button" class="btn btn-exit btn-danger w-100" data-dismiss="modal">Tiếp tục</button>');                      
                        },
                        error: function (data) {
                            next_ok = false;
                            swal({
                                title: "Lỗi !",
                                text: "Không thể !",
                                icon: "error",
                                buttons: false,
                                dangerMode: false
                            }); 
                        }, 
                    });

                    console.log('oke ');
                    // alert(sig.signature('toDataURL'));
                    // sig.signature('toJSON');
                    
                });
            });

            
            
            // add gift->id, signature  
            $('#exampleModalCenter .modal-body').html('<div id="pad"><canvas id="sketchpad"></canvas></div>'); 
            $('#exampleModalCenter .modal-footer').html('<button type="button" class="btn btn-guichuki btn-danger w-100">Gửi chữ ký</button>');
            // js tooth pad
            var sketchpad = new Sketchpad({
                element: '#sketchpad',
                width: $('#pad').width() ,
                // width: $('#pad').width() ,
                height: $('#pad').width()/2,
            });
            
        });
        
    </script>
    {{-- <h1>Mobile-friendly Sketch Pad Exmaples</h1> --}}
   
    {{-- <canvas id="sketchpad"></canvas>
    <p><button onclick="sketchpad.undo();" class="btn">Undo</button>
    <button onclick="sketchpad.redo();" class="btn">Redo</button>
    <button onclick="sketchpad.animate(10);" class="btn">Animate</button></p>
    <button onclick="urls();" class="btn">Animate</button></p>
    <script>
        var sketchpad = new Sketchpad({
            element: '#sketchpad',
            width: 500,
            height: 300,
        });
        function urls(){
            var canvas = document.getElementById('sketchpad'),
            dataUrl = canvas.toDataURL(),
            imageFoo = document.createElement('img');
            imageFoo.src = dataUrl;
            // Style your image here
            imageFoo.style.width = '100px';
            imageFoo.style.height = '100px';
            // After you are done styling it, append it to the BODY element
            document.body.appendChild(imageFoo);
        } 
    </script>  --}}
@endsection
 