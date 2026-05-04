$('#menu-item-29').click(function(){
	$('#contact').show();
})

jQuery(document).ready(function($) {
  $(document).on('click', '#contact_button', function() {
    $('#contact').show();
  });
});

$(document).on('click', '#popup-close', function(){
    $('#contact').hide();
});

jQuery(document).ready(function($) {
  $(document).on('click', '#icon', function() {
    $("#nav_header_div2").removeClass("menu_mobile_toRight").addClass("menu_mobile_toLeft");
  });
});

jQuery(document).ready(function($) {
  $(document).on('click', '#icon_mobile', function() {
    $("#nav_header_div2").removeClass("menu_mobile_toLeft").addClass("menu_mobile_toRight");
  });
});

if (document.getElementById('hide')){
  var ref = document.getElementById('hide').value;
  document.querySelector("input[name=your-subject]").value = ref;
}

var swiper = new Swiper(".mySwiper", {
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });





