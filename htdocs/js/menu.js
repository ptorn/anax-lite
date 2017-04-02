(function () {
    var button = document.getElementById("mobile-nav-top");
    console.log(button);
    button.addEventListener("click", function() {
        let nav = document.getElementById("mobile-nav-container");
        if (nav.classList.contains("hide")) {
            nav.classList.remove("hide");
        } else {
            nav.classList.add("hide");
        }
    });
})();
