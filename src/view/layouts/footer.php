    
    </div>
    <!-- see more toggle on bio -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const bio = document.querySelector(".bio-text");
            const toggle = document.querySelector(".bio-toggle");

            if (bio && toggle) {
                // Add truncated class initially
                bio.classList.add("truncated");

                toggle.addEventListener("click", () => {
                    bio.classList.toggle("truncated");
                    toggle.textContent = bio.classList.contains("truncated") ? "See more" : "See less";
                });
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTFyMGUHv+zmB5BUhzjoK/r+SEJgHRasowEKgB4XhW+LEwH7" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlcooxfXHpKWOo9jsZzvsWPbPXMFLVcqsNFyQYSLcHP2mk8CKI" crossorigin="anonymous"></script>

    </body>



</html>