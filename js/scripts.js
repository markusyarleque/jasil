$(document).ready(function () {
    // Función que se ejecuta cada vez que cambia el carrusel
    $('#my_slider').on('slide.bs.carousel', function (e) {
        var newBackgroundImage = '';
        switch (e.to) {
            case 0: // Primer ítem
                newBackgroundImage = 'url(images/banner-bg.png)'; // Cambia esto por la imagen de fondo real
                break;
            case 1: // Segundo ítem
                newBackgroundImage = 'url(images/banner-bg-aqua.jpg)'; // Cambia esto por la imagen de fondo real
                break;
            // Añade más casos según la cantidad de ítems en tu carrusel
        }
        // Cambiar el fondo del header_section
        $('.header_section').css('background-image', newBackgroundImage);
    });
    //Función para registrar correo de suscripción
    $('#subscribeButton').on('click', function (e) {
        e.preventDefault();
        var formData = {
            email: $('#email').val(),
            recaptcha: $('#g-recaptcha').val(),
        };
        if (formData['email'].length >= 1) {
            $.ajax({
                type: 'POST',
                url: 'subscribe.php',
                data: formData,
                dataType: 'json',
                encode: true,
                success: function (response) {
                    if (response.status !== 'exists') {
                        $('#email').val('');
                    }
                    alert(response.message);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error: ', errorThrown); // Muestra el error en la consola
                    console.log('Detalles: ', jqXHR.responseText); // Muestra la respuesta del servidor
                    alert('Error al procesar la solicitud.');
                }
            });
        } else {
            alert('Por favor, introduce un correo válido.');
        }
    });
});
