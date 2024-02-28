function editForm(produkID) {
    $.ajax({
        type: 'POST',
        url: './crud/get_menu.php',
        data: { produkID: produkID },
        dataType: 'json',
        success: function (data) {
            console.log(data); 
            document.getElementById('editMenuForm').elements['namaProduk'].value = data.namaProduk;
            document.getElementById('editMenuForm').elements['harga'].value = data.harga;
            document.getElementById('editMenuForm').elements['stok'].value = data.stok;
            document.getElementById('editProdukID').value = produkID;
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
            alert('Terjadi kesalahan saat mengambil data. Silakan coba lagi.');
        }
    });

    document.getElementById('editForm').classList.remove('hidden');
}


    function closeEditForm() {
        document.getElementById('editForm').classList.add('hidden');
    }

    function closeEditForm() {
        document.getElementById('editForm').classList.add('hidden');
    }

    function saveChanges() {
        var formData = $('#editMenuForm').serialize();
    
        $.ajax({
            type: 'POST',
            url: './crud/update_menu.php',
            data: formData,
            dataType: 'json',
            success: function (response) {
                console.log(response);
                Toastify({
                    text: response.success,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "#06AF81",
                    stopOnFocus: true 
                }).showToast();
                closeEditForm();
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert('Terjadi kesalahan saat menyimpan perubahan. Silakan coba lagi.');
            }
        });
    }
    