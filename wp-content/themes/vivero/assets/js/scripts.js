jQuery(document).ready(function ($) {

    //Preloader inicial
    var random = Math.floor(Math.random() * 1000) + 1000;
    $(document).ready(function () {
        setTimeout(function () {
            $("body").addClass("loaded");
        }, random);
    });
    
    /* Post Types Slider */
    let slides = $('.vivero-slider');
    let currentIndex = 0;

    function showSlide(index) {
        slides.removeClass('active');
        slides.eq(index).addClass('active');
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % slides.length;
        showSlide(currentIndex);
    }

    showSlide(currentIndex); // Muestra el primero

    setInterval(nextSlide, 8000); // Cambia cada 5 segundos
    
    
    /*Slider Premium Block Gutenberg*/
    let slides_S = $(".figure-s-premium");
    let index = 0;

    function changeImage() {
        slides_S.eq(index).removeClass("active"); // Oculta la imagen actual
        index = (index + 1) % slides_S.length; // Pasa a la siguiente
        slides_S.eq(index).addClass("active"); // Muestra la nueva
    }

    setInterval(changeImage, 3000); // Cambia cada 3 segundos

});




