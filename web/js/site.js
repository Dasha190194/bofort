$(document).ready(function() {

    $('#login, #login-register, #login-button').on('click', function(){
        $.ajax({
            url: '/user/login',
            type: "GET",
            success: function (data) {
                $('.modal-content').html(data);
                $('#my-modal').modal({show:true});
            }
        });
    });

    $('body').on('submit', '#login-form', function (e){
        e.preventDefault();

        var form = $(this);
        $.ajax({
            url: '/user/login',
            type: "POST",
            data: form.serialize(),
            success: function (data) {
                $('.modal-content').html(data);
            }
        });
    });

    $('#my-modal').on('click', '#registration', function(){
        var pathname = window.location.pathname;
        if (pathname != '/') {
            localStorage.setItem('makeRegistration', true);
            window.location.replace('/');
        } else {
            $('#my-modal').modal('hide');
            $('html,body').animate({scrollTop: document.body.scrollHeight},"slow");
        }
    });

    if (localStorage.getItem('makeRegistration') != null) {
        $('html,body').animate({scrollTop: document.body.scrollHeight},"slow");
        localStorage.removeItem('makeRegistration');
    }

    $('.service').on('click', function(){
        var thiss = $(this);
        var id = thiss.data('id');
        var order_id = $('#payform-order_id').val();
        var payform_services = $('#payform-services');
        var array = payform_services.val();

        if (thiss.hasClass('active')) {
            $.ajax({
                url: '/order/remove-service',
                type: 'GET',
                data: {
                    'order_id' : order_id,
                    'service_id' : id
                },
                success: function(data) {
                  //  if (data == true) {
                        array = array.split(',');
                        array = arrayRemove(array, id);
                        array = (array.length === 0)?'':array.join(',');
                        payform_services.val(array);
                        thiss.removeClass('active');
                        $('#toPay').html(data);
                //    }
                }
            });
        } else {
            $.ajax({
                url: '/order/add-service',
                type: 'GET',
                data: {
                    'order_id' : order_id,
                    'service_id' : id
                },
                success: function(data) {
                  //  if (data == true) {
                        array = (array.length !== 0)?array.split(','):[];
                        array.push(id);
                        payform_services.val(array.join(','));
                        thiss.addClass('active');
                        $('#toPay').html(data);
                  //  }
                }
            });
        }
    });

    $('#promo-apply').on('click', function(){
        $.ajax({
            url: '/order/apply-promo',
            type: "GET",
            data: {
                'order_id': $('#payform-order_id').val(),
                'word': $('#word').val()
            },
            success: function (data) {
               if (data == false) alert('Не удалось применить промокод!');
               location.reload();
            }
        });
    });

    $('#show-carousel-modal').on('click', function(){
        $('#carousel-modal').modal({show:true});
        $("#carousel").carousel();
    });

    function orderRefund(id) {
        $.ajax({
            url: '/order/refund',
            type: 'GET',
            data: {
                'id': id
            },
            success: function(result) {
                location.reload();
            }
        });
    }

    $('.admin-orders-container .order-refund').on('click', function () {
        if (confirm('Вы уверены, что хотите вернуть заказ?')) {
            var id = $(this).data('id');
            orderRefund(id);
        }
    });


    function arrayRemove(arr, value) {
        return arr.filter(function(ele){
            return ele != value;
        });
    };
});

