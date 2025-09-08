document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    if (form) {
        form.addEventListener("submit", function (e) {
            const profile = document.querySelector('input[name="profile_name"]').value;
            const password = document.querySelector('input[name="password"]').value;

            if (!profile || !password) {
                alert("Bitte alle Felder ausfüllen.");
                e.preventDefault();
            }
        });
    }
});
