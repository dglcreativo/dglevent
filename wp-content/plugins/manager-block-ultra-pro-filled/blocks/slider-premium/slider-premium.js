jQuery(document).ready(function ($) {
    
    let slides = $(".figure-s-premium");
    let index = 0;

    function changeImage() {
        slides.eq(index).removeClass("active"); // Oculta la imagen actual
        index = (index + 1) % slides.length; // Pasa a la siguiente
        slides.eq(index).addClass("active"); // Muestra la nueva
    }

    setInterval(changeImage, 4000); // Cambia cada 3 segundos
    
});

