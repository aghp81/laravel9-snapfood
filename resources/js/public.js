$(document).on('click', '.manage-cart', function() {
    // واکنش به کنش کاربر
    // alert('hello');

    // console.log($(this).parents('form').attr('action')); // $(this) == .manage-cart - parents('form') == .manage-cart والد فرم از  کلاس - .attr('action') == اتربیوت اکشن از فرم
    var element = $(this);
    var type = element.attr('value');
    var form = element.parents('form');
    var url = form.attr('action'); // $(this) == .manage-cart - parents == تمام پرنت های this

    // برای ارسال CSRF 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $.ajax({
        url: url,
        method: "POST",
        data: {
            type: type,
        },
        success: function(res) { // پس از  کلیک دکمه افزودن به سبد خرید اجرای تابع manage از کارت کنترلر
            var inCartDiv = form.children('.in-cart'); // بین چیلدرن های فرم بگرد و کلاس in-cart رو پیدا کن. 
            var notInCartDiv = form.children('.not-in-cart');
            inCartDiv.show(); // وقتی به سبد خرید اضافه شد show شود.
            notInCartDiv.hide();
            // console.log(res.count);
            // نمایش تعداد محصول موجود در سبد خرید
            form.find('.cart-count').text(res.count); //.text() == تغییر محتوای المنت
        }
    });
});