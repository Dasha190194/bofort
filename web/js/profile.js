$(document).ready(function() {

    var profileBlock = $('.profileBlock');

    function updateContainer(actionName) {
        $.ajax({
            url: '/user/get'+actionName,
            type: 'GET',
            success: function (data) {
                $('.profileBlock').html(data);
            }
        })
    }

    $(".list-group-item").on('click', function(){
        $('.active').removeClass('active');
        $(this).addClass('active');
    });

    $('.profileMenu li').on('click', function(){
        var actionName = $(this).data('container');
        updateContainer(actionName);
    });

    profileBlock.on('click', '.mainCard', function(){
         var id = $(this).data('id');

         $.ajax({
            url: '/user/change-card-state',
            data: {
                'id': id,
                'state': 1
            },
             success: function (data) {
                 if (data.result === false) alert('Ошибка!');
                 else profileBlock.html(data);
             }
         });
    });

    profileBlock.on('click', '.removeCard', function(){
        var id = $(this).data('id');

        $.ajax({
            url: '/user/remove-card',
            data: {
                'id': id,
            },
            success: function (data) {
                if (data.result === false) alert('Ошибка!');
                else profileBlock.html(data);
            }
        });
    });

    profileBlock.on('click', '#confirm-add-new-card', function() {
        $('#add-new-card-modal').modal('hide');

        var widget = new cp.CloudPayments();
        widget.charge({
                publicId: cloud_id,
                description: 'Привязка карты',
                amount: 1,
                currency: 'RUB',
                invoiceId: 111111,
                accountId: user_id,
            },
            function (options) {
                updateContainer('cards');
            },
            function (reason, options) {
                alert(reason);
            });
    });


    profileBlock.on('submit', '#confirm-phone', (function(e) {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            success: function(data) {
                if (data.success === true) {
                    $('#phone-code').modal('hide');
                    updateContainer('account');
                } else {
                    $('#code-error').html('Неверный код!');
                }
            }
        });

    }));

    profileBlock.on('submit', '#account-form', function (e) {
        e.preventDefault();

        var form = $(this);
        $.ajax({
            url: '/default/account-edit',
            type: "POST",
            data: form.serialize(),
            success: function (data) {
                $('#phone-code .modal-content').html(data);
                $('#phone-code').modal('show');
            }
        });
    });

    profileBlock.on('click', '.order-more-info', function() {
        var id = $(this).data('id');

        $.ajax({
            url: '/order/info',
            type: 'GET',
            data: {
                'id': id
            },
            success: function(result) {
                $('#order-info-modal .modal-content').html(result);
                $('#order-info-modal').modal({show:true});
            }
        });
    });

    profileBlock.on('click', '.notification-panel',function () {
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
                    $('#count').text(result.result.count);
                    panel.removeClass('noOpen');
                }
            }
        });
    });

    profileBlock.on('click', '#clear-notifications', function(){
        $.ajax({
            url: '/notifications/clear-all',
            type: 'GET',
            success: function (result) {
                result = JSON.parse(result);
                if (result.success === true) {
                    $('.badge').remove();
                    updateContainer('notifications');
                }
            }
        });
    });

    profileBlock.on('click', '.order-refund-modal', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '/order/refund-modal',
            type: 'GET',
            data: {
                'id': id
            },
            success: function(result) {
                $('#order-info-modal .modal-content').html(result);
                $('#order-info-modal').modal({show:true});
            }
        });
    });

    function orderRefund(id) {
        $.ajax({
            url: '/order/refund',
            type: 'GET',
            data: {
                'id': id
            },
            success: function(result) {
                updateContainer('booking');
            }
        });
    }

    profileBlock.on('click', '.order-refund', function(){
        var id = $(this).data('id');
        orderRefund(id);
    });

    profileBlock.on('click', '.order-refund-no', function(){
        $('#order-info-modal').modal('hide');
    });

    // jQuery.fn.preventDoubleSubmission = function() {
    //     $(this).on('submit',function(e){
    //         var $form = $(this);
    //
    //         if ($form.data('submitted') === true) {
    //             e.preventDefault();
    //         } else {
    //             $form.data('submitted', true);
    //             var url = $form.attr('action');
    //
    //             $.ajax({
    //                 type: "POST",
    //                 url: url,
    //                 data: $form.serialize(),
    //                 success: function(data) {
    //                     $('#phone-code .modal-content').html(data);
    //                     $('#phone-code').modal({show:true});
    //                 }
    //             });
    //         }
    //     });
    //
    //     return this;
    // };
    //
    // $("#account-form").preventDoubleSubmission();
});




