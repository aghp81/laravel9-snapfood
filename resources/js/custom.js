// انتخاب دکمه حذف فروشگاه
var deleteBtns = document.querySelectorAll('.delete-record');

deleteBtns.forEach((item, i) => {
    // event handler یا  Event Listener
    item.addEventListener('click', function () {
        // console.log('salam' + i);

        //swal
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              swal("Poof! Your imaginary file has been deleted!", {
                icon: "success",
              });
            } else {
              swal("Your imaginary file is safe!");
            }
          });
    });

});
