
// ==== HAPUS ALLERT CUSTOMER

function hapusCustomer(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data akan dihapus secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#06AF81',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteDataCustomer(id);
        }
    });
}

function deleteDataCustomer(id) {
    $.ajax({
        type: "POST",
        url: "./crud/hapusCustomer.php",
        data: {
            pelangganID: id
        },
        success: function(response) {
            location.reload();
        }
    });
}