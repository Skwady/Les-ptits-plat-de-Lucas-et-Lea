document.addEventListener("DOMContentLoaded", function () {
    let commentIcons = document.querySelectorAll(".fa-comment");

    commentIcons.forEach((icon) => {
        icon.addEventListener("click", function (event) {
            event.preventDefault();

            // Trouver les conteneurs associés
            let colContainer = this.closest(".col-md-4");
            let commentContainer = colContainer.querySelector(".comments-container");
            let commentForm = colContainer.querySelector(".comments-form");
            
            // Basculer la visibilité
            let isHidden = commentContainer.style.display === "none" || commentContainer.style.display === "";
            commentContainer.style.display = isHidden ? "block" : "none";
            commentForm.style.display = isHidden ? "block" : "none";
        });
    });
});