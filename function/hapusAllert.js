// ==== HAPUS ALLERT MENU ====

function hapusMenu(id) {
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
            deleteDataMenu(id);
        }
    });
}

function deleteDataMenu(id) {
    $.ajax({
        type: "POST",
        url: "./crud/hapusMenu.php",
        data: {
            produkID: id
        },
        success: function(response) {
            location.reload();
        }
    });
}

// ==== END
