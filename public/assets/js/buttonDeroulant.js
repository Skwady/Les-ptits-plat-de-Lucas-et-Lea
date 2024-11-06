function toggleText(button) {
    let target = button.getAttribute("data-target");
    let dots = document.getElementById("dots" + target);
    let moreText = document.getElementById("more" + target);
    let btnText = button;

    if (dots.style.display === "none") {
        dots.style.display = "inline";
        btnText.innerText = "Lire la suite"; 
        moreText.style.display = "none";
    } else {
        dots.style.display = "none";
        btnText.innerText = "Lire moins"; 
        moreText.style.display = "inline";
    }
}