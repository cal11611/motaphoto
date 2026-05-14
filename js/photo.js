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

  // Délégation du hover et click sur eye comme avant
  $('#ajax_return').on('mouseenter', '.moitie', function() {
    $(this).children('.child-element').stop(true, true).fadeIn();
  }).on('mouseleave', '.moitie', function() {
    $(this).children('.child-element').stop(true, true).fadeOut();
    $(this).children('.infos').removeClass('visible');
  });

  $('#ajax_return').on('click', '.eye', function() {
    $(this).siblings().addClass("visible");
  })
});