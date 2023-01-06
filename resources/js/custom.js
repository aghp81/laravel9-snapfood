// انتخاب دکمه حذف فروشگاه
var deleteBtns = document.querySelectorAll('.delete-record');

deleteBtns.forEach((item, i) => {
    // event handler یا  Event Listener
    item.addEventListener('click', function () {
        // console.log('salam' + i);

        //swal
        swal({
            title: "آیا مطمئن هستید؟",
            text: "در صورت پاک کردن امکان بازیابی اطلاعات وجود ندارد!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            buttons: {
                cancel: "انصراف",
                ok: "تایید",
            },
          })
          .then((willDelete) => {
            if (willDelete) {
              swal("آیتم موردنظر حذف شد!", {
                icon: "success",
              });
            } else {
              swal("چیزی پاک نشد!");
            }
          });
    });

});
