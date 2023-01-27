$(document).on('click', '.manage-cart', function() {
    // واکنش به کنش کاربر
    // alert('hello');

    // console.log($(this).parents('form').attr('action')); // $(this) == .manage-cart - parents('form') == .manage-cart والد فرم از  کلاس - .attr('action') == اتربیوت اکشن از فرم

    var url = $(this).parents('form').attr('action'); // $(this) == .manage-cart - parents == تمام پرنت های this

    // برای ارسال CSRF 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $.ajax({
        url: url,
        method: "POST",
        success: function(res) {
            console.log(res); // پس از  کلیک دکمه افزودن به سبد خرید اجرای تابع manage از کارت کنترلر
        }
    });
});