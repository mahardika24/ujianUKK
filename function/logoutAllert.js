document.addEventListener("DOMContentLoaded", function() {
    var logoutButton = document.getElementById("logoutButton");

    logoutButton.addEventListener("click", function() {
        Swal.fire({
            title: "Yakin ingin logout?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#06AF81",
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "./multi-user/logout.php";
            }
        });
    });
});

