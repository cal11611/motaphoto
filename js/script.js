
// modale formulaire contact
$(document).ready(function($) {

    $(document).on('click', '#contact_button', function() {
      $('#contact').show();
    });

    $('#menu-item-29').click(function(){
    $('#contact').show();
    });

    $(document).on('click', '#popup-close', function(){
      $('#contact').hide();
    });

});

if (document.getElementById('hide')){
  var ref = document.getElementById('hide').value;
  document.querySelector("input[name=your-subject]").value = ref;
}
// menu mobile
jQuery(document).ready(function($) {

  $(document).on('click', '#icon', function() {
    $("#nav_header_div2").removeClass("menu_mobile_toRight").addClass("menu_mobile_toLeft");
  });

  $(document).on('click', '#icon_mobile', function() {
    $("#nav_header_div2").removeClass("menu_mobile_toLeft").addClass("menu_mobile_toRight");
  });

});

// swiperJs
var swiper = new Swiper(".mySwiper", {
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });

// eye et bigger au survol de la div

jQuery(document).ready(function($) {
  $(".moitie").hover(
    function() {
      $(this).children('.child-element').stop(true, true).fadeIn();
    },
    function() {
      $(this).children('.child-element').stop(true, true).fadeOut();
      $(this).children('.infos').removeClass('visible');
    }
  );
});

// infos sur click eye

jQuery(document).ready(function($) {
  $(".eye").click(
    function() {
      $(this).siblings().addClass("visible");
    }    
  );
});

