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

    profileBlock.on('click', '#addNewCard', function() {
        $('#add-new-card-modal').modal('show');
    });

    profileBlock.on('click', '#confirm-add-new-card', function() {
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
});

