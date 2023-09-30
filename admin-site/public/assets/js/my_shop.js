let getsidebarlink = document.querySelectorAll(".links");
getsidebarlink.forEach((sidebarlink) => {
    sidebarlink.addEventListener("click", function () {
        document.querySelector(".active")?.classList.remove("active");
        this.classList.add("active");
    });
});

// password change modal
let getmodalbox = document.getElementById("passwordmodals");
let getmodalbtn = document.getElementById("modalbtns");
let getclosemodal = document.getElementById("closemodalbtns");

window.onclick = function (e) {
    if (e.target == getmodalbox) {
        closemodal();
    }
};

getmodalbtn.addEventListener("click", openmodal);

getclosemodal.addEventListener("click", closemodal);

function openmodal() {
    getmodalbox.style.display = "block";
}

function closemodal() {
    getmodalbox.style.display = "none";
}
