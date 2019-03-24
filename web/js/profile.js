$(document).ready(function() {

    var profileBlock = $('.profileBlock');

    $(".list-group-item").on('click', function(){
        $('.active').removeClass('active');
        $(this).addClass('active');


    });

    $('.profileMenu li').on('click', function(){
        var actionName = $(this).data('container');

        $.ajax({
            url: '/user/get'+actionName,
            type: 'GET',
            success: function (data) {
                $('.profileBlock').html(data);
            }
        })
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
});

