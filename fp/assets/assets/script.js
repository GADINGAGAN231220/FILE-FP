document.addEventListener("DOMContentLoaded", function() {
    // Validasi form registrasi
    const registerForm = document.getElementById("registerForm");
    registerForm.addEventListener("submit", function(e) {
        const username = document.getElementById("register_username").value.trim();
        const password = document.getElementById("register_password").value.trim();

        if (username === "" || password === "") {
            alert("Field tidak boleh kosong!");
            e.preventDefault();
        }
    });

    // Validasi form login
    const loginForm = document.getElementById("loginForm");
    loginForm.addEventListener("submit", function(e) {
        const username = document.getElementById("login_username").value.trim();
        const password = document.getElementById("login_password").value.trim();

        if (username === "" || password === "") {
            alert("Field tidak boleh kosong!");
            e.preventDefault();
        }
    });
});
