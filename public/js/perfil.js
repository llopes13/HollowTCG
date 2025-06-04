document.addEventListener("DOMContentLoaded", function () {
    const editButton = document.getElementById("edit-profile-btn");
    const profileForm = document.getElementById("profile-form");

    if (editButton && profileForm) {
        editButton.addEventListener("click", function () {
            profileForm.classList.remove("hidden");
            editButton.classList.add("hidden");
        });
    }
});
