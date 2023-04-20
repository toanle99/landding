(function($) {
    "use strict";  
    
    //* Form js
    function verificationForm(){
        //jQuery time
        var validate_ok = true, phone2, sum_gthd, enable_2tr=false;
        var current_fs, next_fs, previous_fs; //fieldsets
        var left, opacity, scale; //fieldset properties which we will animate
        var animating; //flag to prevent quick multi-click glitches

        $(".next").click(function () {
            validate_ok = true;
            if (animating) return false;
            animating = true;

            current_fs = $(this).parent();
            next_fs = $(this).parent().next(); 

            var isValid = $('#msform')[0].checkValidity();
            console.log('fieldset current->'+$("fieldset").index(current_fs)); 
            
            $('#fieldset_'+$("fieldset").index(current_fs)+' input[type="text"]:required').each(function (){
                $(this).removeClass('error-validate');
                if($(this).val()== '') {
                    $(this).addClass('error-validate');
                    validate_ok = false;
                    console.log('input ' + $(this).val());
                } 
                if($(this).attr('name') == 'dob' && $(this).val().length !=4){
                    $(this).addClass('error-validate');
                    validate_ok = false;
                    console.log('input ' + $(this).val());
                }
            })
            $('#fieldset_'+$("fieldset").index(current_fs)+' select:required').each(function (){
                $(this).parents('.form-group').children('.select2-container').removeClass('error-validate');
                if($(this).val()== '') {
                    $(this).parents('.form-group').children('.select2-container').addClass('error-validate');
                    validate_ok = false;
                    console.log('select ' + $(this).val());
                } 
            })
            $('#fieldset_'+$("fieldset").index(current_fs)+' input[type="radio"]:required').each(function(){ 
                // var name = $(this).attr('name'); 
                $(this).parents('.input-group-2').removeClass('error-validate');
                
                if(!$("input[type='radio'][name='"+$(this).attr('name')+"']:checked").val()) {
                    $(this).parents('.input-group-2').addClass('error-validate');
                    validate_ok = false;
                    console.log('radio ' + $(this).val());
                } 
            }) 
            if(validate_ok) { // validate 
                // ghi người dùng khi xong 2 fildset, nếu có thì lấy tổng giá trị hóa dơn
                if($("fieldset").index(current_fs) == 2) { 
                    // step 2 xử lí riêng
                    var step_2_ok = false;
                    var frm = $('#msform');  
                    $.ajax({
                        type: frm.attr('method'),
                        url: frm.attr('action'),
                        data: frm.serialize(),
                        success: function (data) {
                            if(data.status == '4'){ 
                                step_2_ok = true; 
                                $('.number-hoadon').text( new Intl.NumberFormat('vi-VN').format(data.member_gthd));
                                // $('.number-hoadon').text(data.member_gthd); 
                                $('.phone-hoadon').text(data.phone);  
                                $('#msform').attr('data-member_id', data.member_id);           
                                // 
                                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                                next_fs.show();
                                current_fs.animate({
                                    opacity: 0
                                }, {
                                    step: function (now, mx) {
                                        scale = 1 - (1 - now) * 0.2;
                                        left = (now * 50) + "%";
                                        opacity = 1 - now;
                                        current_fs.css({
                                            'transform': 'scale(' + scale + ')',
                                            'position': 'relative'
                                        });
                                        next_fs.css({
                                            'left': left,
                                            'opacity': opacity
                                        });
                                    },
                                    duration: 800,
                                    complete: function () {
                                        current_fs.hide();
                                        animating = false;
                                    },
                                    easing: 'easeInOutBack'
                                }); 
                            } 
                            if(data.status == '1') { 
                                // đã đki, [phone, member_id, member_gthd, message]
                                step_2_ok = true; 
                                $('.number-hoadon').text( new Intl.NumberFormat('vi-VN').format(data.member_gthd));
                                // $('.number-hoadon').text(data.member_gthd); 
                                // đủ 2tr 
                                if(data.member_gthd >= 2000000) {enable_2tr = true; validate_ok = true;}
                                $('.phone-hoadon').text(data.phone);    
                                $('#msform').attr('data-member_id', data.member_id); 
                                //
                                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                                next_fs.show();
                                current_fs.animate({
                                    opacity: 0
                                }, {
                                    step: function (now, mx) {
                                        scale = 1 - (1 - now) * 0.2;
                                        left = (now * 50) + "%";
                                        opacity = 1 - now;
                                        current_fs.css({
                                            'transform': 'scale(' + scale + ')',
                                            'position': 'relative'
                                        });
                                        next_fs.css({
                                            'left': left,
                                            'opacity': opacity
                                        });
                                    },
                                    duration: 800,
                                    complete: function () {
                                        current_fs.hide();
                                        animating = false;
                                    },
                                    easing: 'easeInOutBack'
                                });  
                            } 
                            if(data.status == '0') {
                                step_2_ok = false;
                                swal({
                                    title: "Không thành công !",
                                    text: data.message,
                                    icon: "warning",
                                    buttons: false,
                                    dangerMode: false
                                }); 
                            } 
                        },
                        error: function (data) {
                            validate_ok = false;
                            swal({
                                title: "Lỗi !",
                                text: "Không thể kết nối !",
                                icon: "error",
                                buttons: false,
                                dangerMode: false
                            }); 
                        }, 
                    });  
                } else { 
                    console.log($("fieldset").index(current_fs));
                    if($("fieldset").index(current_fs) == 3) {
                        // ghi hóa đơn, 
                        if($('.number-hoadon').text().replaceAll('.', "")>=2000000) enable_2tr = true;
                        if(!enable_2tr){
                            swal({
                                title: "Tổng hóa đơn chưa đủ 2tr !",
                                text: "Bạn phải có tổng hóa đơn có giá trị từ 2.000.000 trở lên!",
                                icon: "warning",
                                buttons: false,
                                dangerMode: true
                            }); 
                            animating = false;
                            return false;
                        } else {
                            var member_id = $('#msform').attr('data-member_id');
                            var url  = $('#msform').attr('data-url_savehd');
                            var _token = $('#msform').attr('data-_token'); 
                            $('.child-hoadon').each(function(){
                                console.log('data - ' + $(this).find('input.gthd').val()+' - '+ $(this).find('select.hoadon').val());
                                //// sum_gthd Thêm hóa đơn, nhiều hóa đơn -> tổng giá trị trên 2tr
                                var gthd = $(this).find('input.gthd').val().replaceAll('.', "");
                                var cuahang = $(this).find('select.hoadon').val();
                                
                                if(gthd > 0 && member_id > 0 && cuahang > 0) {
                                    $.ajax({
                                        type: 'post',
                                        url: url,
                                        data: {'cuahang_id': cuahang, 'member_id': member_id, 'cost': gthd , _token: _token},
                                        success: function (data) {
                                            if(data.status == '4'){
                                                phone2 = data.phone;
                                                // $('.number-hoadon').text( new Intl.NumberFormat('vi-VN').format(data.member_gthd));
                                                // $('.number-hoadon').text(data.member_gthd); 
                                                $('.phone-hoadon').text(data.phone);  
                                                // if( data.member_gthd >=2000000) { enable_2tr = true; validate_ok = true;}  
                                            }
                                            console.log('--------'+data);
                                        },
                                        error: function (data) { 
                                            swal({
                                                title: "Lỗi !",
                                                text: "Không thể kết nối!",
                                                icon: "error",
                                                buttons: false,
                                                dangerMode: false
                                            }); 
                                            return false;
                                        }, 
                                    });
                                }
                            });
                            //
                            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                            next_fs.show();
                            current_fs.animate({
                                opacity: 0
                            }, {
                                step: function (now, mx) {
                                    scale = 1 - (1 - now) * 0.2;
                                    left = (now * 50) + "%";
                                    opacity = 1 - now;
                                    current_fs.css({
                                        'transform': 'scale(' + scale + ')',
                                        'position': 'relative'
                                    });
                                    next_fs.css({
                                        'left': left,
                                        'opacity': opacity
                                    });
                                },
                                duration: 800,
                                complete: function () {
                                    current_fs.hide();
                                    animating = false;
                                },
                                easing: 'easeInOutBack'
                            }); 
                        }
                       
                    }  
                
                    console.log(' show ingn ');
                    // thêm hóa đơn, => thành công -> next || bạn đã tham gia chương trình || lọc theo sđt
                    if($("fieldset").index(current_fs) == 2) {
                        validate_ok = false; 
                    } 

                    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                    next_fs.show();
                    current_fs.animate({
                        opacity: 0
                    }, {
                        step: function (now, mx) {
                            scale = 1 - (1 - now) * 0.2;
                            left = (now * 50) + "%";
                            opacity = 1 - now;
                            current_fs.css({
                                'transform': 'scale(' + scale + ')',
                                'position': 'relative'
                            });
                            next_fs.css({
                                'left': left,
                                'opacity': opacity
                            });
                        },
                        duration: 800,
                        complete: function () {
                            current_fs.hide();
                            animating = false;
                        },
                        easing: 'easeInOutBack'
                    }); 
                }
            } else {
                swal({
                    title: "Thiếu thông tin!",
                    text: "Bạn phải điền đầy đủ thông tin!",
                    icon: "warning",
                    showCancelButton: false,
                    showConfirmButton: true,
                    dangerMode: true
                });
                animating = false;
            }  
        });

        $(".previous").click(function () {
            if (animating) return false;
            animating = true; 
            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev(); 
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active"); 
            previous_fs.show(); 
            current_fs.animate({
                opacity: 0
            }, {
                step: function (now, mx) { 
                    scale = 0.8 + (1 - now) * 0.2; 
                    left = ((1 - now) * 50) + "%"; 
                    opacity = 1 - now;
                    current_fs.css({
                        'left': left
                    });
                    previous_fs.css({
                        'transform': 'scale(' + scale + ')',
                        'opacity': opacity
                    });
                },
                duration: 800,
                complete: function () {
                    current_fs.hide();
                    animating = false;
                },
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });
        });

        $(".submit").click(function () {
            return false;
        })
        // $('input.gthd').change(function(){
        //     var values = $(this).val().replaceAll('.', "");
        //     if(isNaN(values)){
        //         $(this).val(''); 
        //     }else{
        //         const formated = new Intl.NumberFormat('vi-VN').format(values);
        //         console.log(formated); 
        //         $(this).val(formated);  
        //     } 
        // })
        
        // $('.add-hoadon').click(function(){
        //     // sum_gthd Thêm hóa đơn, nhiều hóa đơn -> tổng giá trị trên 2tr
        //     var gthd = $('#fieldset_3 input#gthd').val().replaceAll('.', "");
        //     var cuahang = $('#fieldset_3 select#cuahang').val();
        //     var member_id = $('#msform').attr('data-member_id');
        //     var url  = $('#msform').attr('data-url_savehd');
        //     var _token = $('#msform').attr('data-_token'); 
        //     if(gthd > 0 && member_id > 0 && cuahang > 0) {
        //         $.ajax({
        //             type: 'post',
        //             url: url,
        //             data: {'cuahang_id': cuahang, 'member_id': member_id, 'cost': gthd , _token: _token},
        //             success: function (data) {
        //                 if(data.status == '4'){
        //                     phone2 = data.phone;
        //                     $('.number-hoadon').text( new Intl.NumberFormat('vi-VN').format(data.member_gthd));
        //                     // $('.number-hoadon').text(data.member_gthd); 
        //                     $('.phone-hoadon').text(data.phone);  
        //                     if( data.member_gthd >=2000000) { enable_2tr = true; validate_ok = true;}                        
        //                     swal({
        //                         title: "Thành công !",
        //                         text: data.message,
        //                         icon: "success",
        //                         buttons: false,
        //                         dangerMode: false
        //                     }); 
        //                 } 
        //                 if(data.status == '0') { 
        //                     swal({
        //                         title: "Không thành công !",
        //                         text: data.message,
        //                         icon: "warning",
        //                         buttons: false,
        //                         dangerMode: false
        //                     }); 
        //                 }
        //             },
        //             error: function (data) { 
        //                 swal({
        //                     title: "Lỗi !",
        //                     text: "Không thể kết nối!",
        //                     icon: "error",
        //                     buttons: false,
        //                     dangerMode: false
        //                 }); 
        //             }, 
        //         });
        //     } else {
        //         swal({
        //             title: "Lỗi !",
        //             text: "Không đủ thông tin!",
        //             icon: "error",
        //             buttons: false,
        //             dangerMode: false
        //         });
        //     }
        // });
        $('.remove-hoadon').click(function(){
            console.log('reomev clock');
            $('input#gthd').val('');
            $("#cuahang").val('').trigger('change') ; 
            
        });
    };  
    /*Function Calls*/  
    verificationForm (); 
})(jQuery);