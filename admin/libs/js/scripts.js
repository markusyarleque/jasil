$(document).ready(function () {
    // Manejar la navegación del menú
    $('.offcanvas-body ul li a').click(function (e) {
        e.preventDefault();
        var target = $(this).attr('href');

        if (target.startsWith('#')) {
            var $targetElement = $(target);

            if ($targetElement.length) {
                // Ocultar todas las secciones antes de mostrar la nueva
                $('.section').addClass('hidden');

                // Cargar el nuevo contenido y mostrar la sección
                $targetElement.removeClass('hidden').load('includes/load_content.php', { section: target.substring(1) });

                // Animar la vista a la nueva sección
                $('html, body').animate({
                    scrollTop: $targetElement.offset().top
                }, 800);
            } else {
                console.error('Elemento de destino no encontrado:', target);
            }
        } else {
            console.error('El valor de href no es un ID válido:', target);
        }
    });

    // Manejar el botón de toggle del sidebar
    $('#sidebar-toggle').click(function () {
        $('#sidebar').toggleClass('hidden');
        $('.content').toggleClass('shifted');
    });
});
