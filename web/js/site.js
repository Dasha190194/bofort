$(document).ready(function() {

    $(".list-group-item").on('click', function(){
        $('.active').removeClass('active');
        $(this).addClass('active');
        var container = $(this).data('container');
        $('.profile-container').addClass('hidden');
        $('.'+container+'-container').removeClass('hidden');

    });

    $('#login, #login-register').on('click', function(){
        $.ajax({
            url: '/user/login',
            type: "GET",
            success: function (data) {
                $('.modal-body').html(data);
                $('#my-modal').modal({show:true});
            }
        });
    });

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
                        thiss.find('i').addClass('hidden');
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
            success: function () {
                location.reload();
            }
        });
    });

    $('.notification-panel').on('click', function () {
        var id = $(this).data('id');
        var panel = $(this);

        $.ajax({
            url: '/notifications/open',
            type: 'GET',
            data: {
                'id': id
            },
            success: function (result) {
                result = JSON.parse(result);
                if (result.success === true) {
                    $('.badge').text(result.result.count);
                    panel.removeClass('noOpen');
                }
            }
        });
    });

    $('#clear-notifications').on('click', function(){
        $.ajax({
            url: '/notifications/clear-all',
            type: 'GET',
            success: function (result) {
                result = JSON.parse(result);
                if (result.success === true) {
                    $('.badge').remove();
                    $('.notifications-container').html('<strong>У вас нет новых уведомлений</strong>');
                }
            }
        });
    });

    $('#show-carousel-modal').on('click', function(){
        $('#carousel-modal').modal({show:true});
    });

    $('.order-more-info').on('click', function() {

        var id = $(this).data('id');
        $.ajax({
            url: '/order/info',
            type: 'GET',
            data: {
                'id': id
            },
            success: function(result) {
                $('#order-info-modal .modal-body').html(result);
                $('#order-info-modal').modal({show:true});
            }
        });
    });

    $('.order-refund').on('click', function(){

        var id = $(this).data('id');
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
    });

    function arrayRemove(arr, value) {
        return arr.filter(function(ele){
            return ele != value;
        });
    };

    $("#phone-code").on('submit', '#confirm-phone', (function(e) {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            success: function(data) {
                if (data.success === true) {
                    location.reload();
                } else {
                    $('#code-error').html('Неверный код!');
                }
            }
        });

    }));

    jQuery.fn.preventDoubleSubmission = function() {
        $(this).on('submit',function(e){
            var $form = $(this);

            if ($form.data('submitted') === true) {
                e.preventDefault();
            } else {
                $form.data('submitted', true);
                var url = $form.attr('action');

                $.ajax({
                    type: "POST",
                    url: url,
                    data: $form.serialize(),
                    success: function(data) {
                        $('#phone-code .modal-body').html(data);
                        $('#phone-code').modal({show:true});
                    }
                });
            }
        });

        return this;
    };

    $("#account-form").preventDoubleSubmission();
});

