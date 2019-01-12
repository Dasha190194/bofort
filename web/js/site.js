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

    function arrayRemove(arr, value) {
        return arr.filter(function(ele){
            return ele != value;
        });
    }

});

