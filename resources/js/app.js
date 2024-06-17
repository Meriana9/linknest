import './bootstrap';
import Alpine from 'alpinejs';
import $ from 'jquery';

window.Alpine = Alpine;
Alpine.start();

// Gestion des boutons de favoris
$(document).ready(function() {
    $('.favorite-btn').on('click', function(e) {
        e.preventDefault(); // Prevent the form from submitting
        var button = $(this);
        var contactId = button.data('id');
        $.ajax({
            url: '/contacts/' + contactId + '/favorite',
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.is_favorite) {
                    button.find('i').removeClass('far fa-star text-gray-400').addClass('fas fa-star text-yellow-500');
                } else {
                    button.find('i').removeClass('fas fa-star text-yellow-500').addClass('far fa-star text-gray-400');
                }
            },
            error: function(xhr, status, error) {
                console.error(error); // Log any errors to the console
            }
        });
    });
});

