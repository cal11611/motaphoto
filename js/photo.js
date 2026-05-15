jQuery(document).ready(function($) {
  let current_page = 1; // La page 1 est déjà affichée

  $('#load-more').on('click', function() {
    current_page++; // on passe à la page suivante

    let formData = new FormData();
    formData.append('action', 'load_more');
    formData.append('paged', current_page);

    $(this).prop('disabled', true).text('Chargement...');

    fetch(photo_js.ajax_url, {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        $('#ajax_return').append(data.data.html);
        if (data.data.is_last_page) {
          $('#load-more').prop('disabled', true).text('The end');
        } else {
          $('#load-more').prop('disabled', false).text('Charger plus');
        }
      }
    })
    .catch(error => {
      console.error(error);
      $('#load-more').prop('disabled', false).text('Charger plus');
    });
  });
});






jQuery(document).ready(function($) {
  $('#cat-select').change(function() {
    let formData = new FormData();
    formData.append('action', 'request_photos');
    formData.append('category', $(this).val());

    fetch(photo_js.ajax_url, {
      method: 'POST',
      body: formData,
    })
    .then(response => {
      if (!response.ok) throw new Error('Network response error.');
      return response.json();
    })
    .then(data => {
      if (data.success) {
        $('#ajax_return').html(data.data.html);
      } else {
        $('#ajax_return').empty();
      }
    })
    .catch(error => {
      console.error('Fetch error:', error);
    });
  });

  ajaxReturn();
});


jQuery(document).ready(function($) {
  $('#format-select').change(function() {
    let formData = new FormData();
    formData.append('action', 'request_photos');
    formData.append('tag', $(this).val());

    fetch(photo_js.ajax_url, {
      method: 'POST',
      body: formData,
    })
    .then(response => {
      if (!response.ok) throw new Error('Network response error.');
      return response.json();
    })
    .then(data => {
      if (data.success) {
        $('#ajax_return').html(data.data.html);
      } else {
        $('#ajax_return').empty();
      }
    })
    .catch(error => {
      console.error('Fetch error:', error);
    });
  });

  ajaxReturn();
});

function ajaxReturn () {
  $('#ajax_return').on('mouseenter', '.moitie', function() {
    $(this).children('.child-element').stop(true, true).fadeIn();
  }).on('mouseleave', '.moitie', function() {
    $(this).children('.child-element').stop(true, true).fadeOut();
    $(this).children('.infos').removeClass('visible');
  });

  $('#ajax_return').on('click', '.eye', function() {
    $(this).siblings().addClass("visible");
  })
}






