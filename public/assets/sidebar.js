document.addEventListener("DOMContentLoaded", function () {
    const bio = document.getElementById("bio");
    const toggle = document.getElementById("toggleBio");

    if (bio && toggle) {
        toggle.addEventListener("click", function () {
            bio.classList.toggle("expanded");
            toggle.textContent = bio.classList.contains("expanded") ? "See less" : "See more";
        });
    }
});