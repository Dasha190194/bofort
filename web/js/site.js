$(document).ready(function() {
    $(".list-group-item").on('click', function(){
        $('.active').removeClass('active');
        $(this).addClass('active');
        var container = $(this).data('container');
        $('.profile-container').addClass('hidden');
        $('.'+container+'-container').removeClass('hidden');

    });

    $('#login').on('click', function(){
        $.ajax({
            url: '/user/login',
            type: "GET",
            success: function (data) {
                $('.modal-body').html(data);
                $('#my-modal').modal({show:true});
            }
        });
    });
});