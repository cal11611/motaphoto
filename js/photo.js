// Variables globales 
const photoIds = []; // init tableau d'id
let currentIndex = -1; // init index tableau

jQuery(document).ready(function($) {
  
  // Recueille les id 
  function updatePhotoIds() {
    photoIds.length = 0; // vide le tableau
    $('#ajax_return .moitie').each(function() {
      const id = $(this).find('.bigger').attr('id');
      if (id) photoIds.push(parseInt(id));
    });
  }

  // Charge une photo dans la ightbox avec id en paramétre 
  function loadPhoto(photoId) {
    $('#loader').show();
    $('#ajax_image_return').empty();

    let formData = new FormData();
    formData.append('action', 'lightbox_photos');
    formData.append('id', photoId);

    fetch(photo_js.ajax_url, {
      method: 'POST',
      body: formData,
    })
    .then(response => response.json())
    .then(data => {
      $('#loader').hide();
      if (data.success) {
        $('#ajax_image_return').html(data.data.html);
        updateControls();
      } else {
        $('#ajax_image_return').empty();
      }
    })
    .catch(error => {
      $('#loader').hide();
      console.error('Fetch error:', error);
    });
  }

  // Boutons précédent suivant
  function updateControls() {
    $('#prev-photo').prop('disabled', currentIndex <= 0);
    $('#next-photo').prop('disabled', currentIndex >= photoIds.length - 1);
  }

  // Gestion lightbox avec événements délégués sur contenu dynamique 
  
  function setupLightboxEvents() {
    // Ouverture lightbox sur clic .bigger (contenu dynamique ou initial)
    $('main').on('click', '.bigger', function(event) {
      event.preventDefault();
      $('.lightbox').addClass('lightbox_visible');

      let myId = parseInt($(this).attr('id'));
      currentIndex = photoIds.indexOf(myId);

      loadPhoto(myId);
    });
  }

  setupLightboxEvents();

  // Fermeture lightbox
  $('#close-photo').on('click', function() {
    $('.lightbox').removeClass('lightbox_visible');
    $('#ajax_image_return').empty();
  });

  // Navigation lightbox
  $('#prev-photo').on('click', function() {
    if (currentIndex > 0) {
      currentIndex--;
      loadPhoto(photoIds[currentIndex]);
    }
  });

  $('#next-photo').on('click', function() {
    if (currentIndex < photoIds.length - 1) {
      currentIndex++;
      loadPhoto(photoIds[currentIndex]);
    }
  });

  
/**************************************************************************/
  // Chargement photos selon filtres
  // Variables d'état filtres
  let currentCategory = '';
  let currentTag = '';
  let currentOrder = 'ASC';
  let currentPage = 1;

  function loadPhotos(append = false) {
    let formData = new FormData();
    formData.append('action', 'request_photos');
    formData.append('category', currentCategory);
    formData.append('tag', currentTag);
    formData.append('sens', currentOrder);
    formData.append('paged', currentPage);

    fetch(photo_js.ajax_url, {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        if (append) {
          $('#ajax_return').append(data.data.html);
        } else {
          $('#ajax_return').html(data.data.html);
        }

        updatePhotoIds(); // Recrée le tableau d'id <-Très important !

        // Mise à jour du bouton "charger plus"
        if (data.data.current_page >= data.data.max_pages || data.data.max_pages === 0) {
          $('#load-more').prop('disabled', true).text('The end');
        } else {
          $('#load-more').prop('disabled', false).text('Charger plus');
        }
      }
    })
    .catch(error => {
      console.error(error);
    });
  }

  // selects
  $('#category-select').on('change', function() {
    currentCategory = $(this).val();
    currentPage = 1;
    $('#load-more').prop('disabled', false).text('Charger plus');
    loadPhotos(false);
  });

  $('#tag-select').on('change', function() {
    currentTag = $(this).val();
    currentPage = 1;
    $('#load-more').prop('disabled', false).text('Charger plus');
    loadPhotos(false);
  });

  $('#order-select').on('change', function() {
    currentOrder = $(this).val();
    currentPage = 1;
    $('#load-more').prop('disabled', false).text('Charger plus');
    loadPhotos(false);
  });

  // charger +
  $('#load-more').on('click', function() {
    currentPage++;
    loadPhotos(true);
  });

  // Initialisation : chargement des photos lors du chargement de la page
  loadPhotos();
  // Gestion des animations en hover sur contenu rechargé
  function ajaxReturn() {
    $('#ajax_return').on('mouseenter', '.moitie', function() {
      $(this).children('.child-element').stop(true, true).fadeIn();
    }).on('mouseleave', '.moitie', function() {
      $(this).children('.child-element').stop(true, true).fadeOut();
      $(this).children('.infos').removeClass('visible');
    });

    $('#ajax_return').on('click', '.eye', function() {
      $(this).siblings().addClass("visible");
    });
  }

  ajaxReturn();
});






