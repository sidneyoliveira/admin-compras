const body = document.querySelector("body"),
      sidebar = body.querySelector(".sidebar"),
      titulo = body.querySelector(".header-text"),
      image = body.querySelector(".image"),
      icon = body.querySelector(".nav-link"),
      text = body.querySelector(".nav-text"),
      toggle = body.querySelector(".toggle")


toggle.addEventListener("click", () =>{
    sidebar.classList.toggle("close");
    titulo.classList.toggle("close");
    image.classList.toggle("close");
    icon.classList.toggle("close");
    text.classList.toggle("close");
    toggle.classList.toggle("close");
} );