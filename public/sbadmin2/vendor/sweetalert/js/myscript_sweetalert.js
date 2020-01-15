// sweetalert sukses
const flashData = $('.flash-data').data('flashdata');

if (flashData) {
    Swal({
        title: 'Success',
        text: flashData,
        type: 'success'
    });
}

// tombol-hapus sweetalert
$('.delete').on('click', function (e) {

    var name = $(this).data('name');
    e.preventDefault();
    // const href = $(this).attr('href');

    Swal({
        title: 'Apa kamu yakin?',
        text: "you will not be able to recover data " + name + "",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus Data!',
        cancelButtonText: 'Batal',
    }).then((result) => {
        if (result.value) {
            // document.location.href = href;
            $(this).closest("form").submit();
        }
    })

});

