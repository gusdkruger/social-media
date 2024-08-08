function showOverlay() {
    document.getElementById("postOverlay").style.display = "flex";
    document.body.classList.add("no-scroll");
}

function closeOverlay() {
    document.getElementById("postOverlay").style.display = "none";
    document.getElementById("postOverlay").innerHTML = "";
    document.body.classList.remove("no-scroll");
}
