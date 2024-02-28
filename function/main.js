
// ==== FLOAT MENU KASIR ==== 
document.addEventListener('DOMContentLoaded', function() {
    const searchCustomerButton = document.getElementById('searchCustomerButton');
    const floatMenu = document.getElementById('floatMenu');
    const overlay = document.getElementById('overlay');
    const closeButton = document.getElementById('closeButton');

    searchCustomerButton.addEventListener('click', function() {
        floatMenu.classList.toggle('hidden');
        overlay.classList.toggle('hidden');
    });

    closeButton.addEventListener('click', function() {
        floatMenu.classList.add('hidden');
        overlay.classList.add('hidden');
    });
});


// value customer

function closeFloatMenu() {
    document.getElementById('floatMenu').classList.add('hidden');
    document.getElementById('overlay').classList.add('hidden');
}

function showFloatMenu() {
    document.getElementById('floatMenu').classList.remove('hidden');
    document.getElementById('overlay').classList.remove('hidden');
}

// ==== END ====


// ==== FUNGSI DROPDOWN NAVBAR
document.addEventListener("DOMContentLoaded", function() {
    const dropdownToggle = document.getElementById("dropdownToggle");
    const dropdownIcon = document.getElementById("dropdownIcon");
    const dropdownMenu = document.getElementById("dropdownMenu");

    dropdownToggle.addEventListener("click", function() {
        dropdownMenu.classList.toggle("hidden");
    });

    document.addEventListener("click", function(event) {
        if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add("hidden");
        }
    });
});
// ==== END 


// ==== FUNGSI MUNCUL TAMBAH DATA ====
function toggleForm() {
    var form = document.getElementById("addForm");
    form.classList.toggle("hidden");
}

document.addEventListener("DOMContentLoaded", function() {
    var form = document.getElementById("addForm");
    form.classList.add("hidden");
});

document.addEventListener("keydown", function(event) {
    if (event.key === "Escape") {
        var form = document.getElementById("addForm");
        form.classList.add("hidden");
    }
});

// ke 2
function toggleForm2() {
    var form = document.getElementById("addForm2");
    form.classList.toggle("hidden");
}

document.addEventListener("DOMContentLoaded", function() {
    var form = document.getElementById("addForm2");
    form.classList.add("hidden");
});

document.addEventListener("keydown", function(event) {
    if (event.key === "Escape") {
        var form = document.getElementById("addForm2");
        form.classList.add("hidden");
    }
});

// ke 3
function toggleForm3() {
    var form = document.getElementById("addForm3");
    form.classList.toggle("hidden");
}

document.addEventListener("DOMContentLoaded", function() {
    var form = document.getElementById("addForm3");
    form.classList.add("hidden");
});

document.addEventListener("keydown", function(event) {
    if (event.key === "Escape") {
        var form = document.getElementById("addForm3");
        form.classList.add("hidden");
    }
});
// ==== END ====

// ===== TABLE ====
$(document).ready(function() {
    $('#barangTable').DataTable({
        info: false,
        lengthChange: false,
        ordering: false,
        pageLength: 5,
        language: {
            zeroRecords: "Data yang anda cari tidak ada!"
        }
    });
});

// ==== CETAK PDF ==== 
function printPDF() {
    window.print();
}
// ==== END
