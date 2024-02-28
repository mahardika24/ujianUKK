
var userId = '';
// Fungsi untuk menampilkan data produk
function tampilkanDataProduk(namaProduk, harga, stok) {
        var tbody = document.querySelector("#tabelKeranjang tbody");

        var row = tbody.insertRow();

        var cellNo = row.insertCell(0);
        var cellNama = row.insertCell(1);
        var cellQty = row.insertCell(2);
        var cellHarga = row.insertCell(3);
        var cellAksi = row.insertCell(4);

        cellNo.innerHTML = tbody.rows.length;
        cellNo.classList.add("text-center", "text-sm", "text-gray-600", "px-4", "py-2", "border");

        cellNama.innerHTML = namaProduk;
        cellNama.classList.add("text-left", "text-sm", "text-gray-600", "px-3", "py-2", "border");

       cellQty.innerHTML = `
    <div class="flex items-center">
        <button type="button" class="bg-gray-200 text-gray-600 px-2 py-1 rounded-l-md" onclick="kurangiQty(this)">-</button>
        <input type="number" class="input-qty w-16 py-1 px-2 border border-gray-300 rounded-md text-start text-sm text-gray-600" value="1" min="1" onchange="hitungTotalHarga()">
        <button type="button" class="bg-gray-200 text-gray-600 px-2 py-1 rounded-r-md" onclick="tambahQty(this)">+</button>
    </div>
`;

cellAksi.innerHTML = '<button type="button" onclick="hapusBaris(this.parentNode.parentNode)" class="text-center text-sm text-white px-1 rounded-sm font-md bg-red-600">&times;</button>';


        cellHarga.innerHTML = harga;
        cellHarga.classList.add("text-right", "text-sm", "text-gray-600",  "px-4", "py-2", "border");

        cellAksi.innerHTML = '<button onclick="hapusBaris(this.parentNode.parentNode)" class="text-center text-sm text-white px-1 rounded-sm font-md bg-red-600">&times;</button>';
        cellAksi.classList.add("text-center", "text-sm", "text-gray-600", "py-2", "border");

        hitungTotalHarga(); //  fungsi hitungTotalHarga setiap kali menambahkan item
    }

    // Fungsi untuk menambah jumlah barang
    function tambahQty(button) {
        var input = button.parentNode.querySelector('input[type="number"]');
        var currentValue = parseInt(input.value);
        input.value = currentValue + 1;
        hitungTotalHarga(); // fungsi hitungTotalHarga setiap kali menambah jumlah barang
    }

    // Fungsi untuk mengurangi jumlah barang
    function kurangiQty(button) {
        var input = button.parentNode.querySelector('input[type="number"]');
        var currentValue = parseInt(input.value);
        if (currentValue > 1) {
            input.value = currentValue - 1;
            hitungTotalHarga(); //  fungsi hitungTotalHarga setiap kali mengurangi jumlah barang
        }
    }

    function hapusBaris(row) {
        row.parentNode.removeChild(row);
        hitungTotalHarga(); //  fungsi hitungTotalHarga setiap kali sebuah baris dihapus
    }
    

    // Fungsi untuk menghitung total harga
    function hitungTotalHarga() {
        var tbody = document.querySelector("#tabelKeranjang tbody");
        var totalHarga = 0;

        //  setiap baris tabel dan hitung total harga
        for (var i = 0; i < tbody.rows.length; i++) {
            var row = tbody.rows[i];
            var qty = parseInt(row.cells[2].querySelector('input[type="number"]').value);
            var harga = parseInt(row.cells[3].innerText);
            totalHarga += qty * harga;
        }

        // Update nilai input total harga
        document.getElementById("totalHarga").value = totalHarga;
    }

    function addPelanggan(namaPelanggan,idPelanggan) {
        document.getElementById('customerInput').value = namaPelanggan;
        userId = idPelanggan;
    }

    function simpanTransaksi() {
        // Ambil data dari formulir
        const tanggalPenjualan = document.getElementById("tanggalPenjualan").value;
        const totalHarga = document.getElementById("totalHarga").value;

        document.getElementById("forDebug").innerHTML = totalHarga;
        // let pelangganNama = document.getElementById("customerInput").value;

        // Kirim data ke file PHP menggunakan AJAX
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "/ujianUKK/crud/tambahKasir.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert(xhr.responseText); 
            }
        };
        xhr.send("tanggalPenjualan=" + tanggalPenjualan + "&totalHarga=" + totalHarga + "&pelangganID=" + userId);
    }
    