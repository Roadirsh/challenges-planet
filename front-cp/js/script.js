$(document).ready(function(){

  $('.slider').slick({
      dots: true,
      infinite: true,
      speed: 500,
      fade: true,
      arrows: true,
      slide: 'div',
      cssEase: 'linear',
      autoplay: true
    });

    $('.popup-with-form').magnificPopup({
        type: 'inline',
        preloader: false,
        removalDelay: 300,
        mainClass: 'mfp-fade',
        focus: '#name',
        callbacks: {
        beforeOpen: function() {
          if($(window).width() < 700) {
            this.st.focus = false;
            } else {
              this.st.focus = '#name';
            }
          }
        }
    });


  $(function() {
      $('#date-from, #date-to').datepicker();
  });

  $( ".wrapper" ).hover(
    function() {
      $(this).find(".hover").toggleClass( "active" );
  });


  $(function() {
      $( '#progressteam1' ).progressbar({
        value: 100
      });
    });

  $(function() {
      $( '#progressteam2' ).progressbar({
        value: 95
      });
    });

  $(function() {
      $( '#progressteam3' ).progressbar({
        value: 53
      });
    });

  $(function() {
      $( '#progressteam4' ).progressbar({
        value: 53
      });
    });

  $(function() {
      $( '#progressteam5' ).progressbar({
        value: 10
      });
    });

  $(function() {
      $( '#progressteam6' ).progressbar({
        value: 1
      });
    });

  $(function() {
      $( '#progressteam7' ).progressbar({
        value: 13
      });
    });

  $(function() {
      $( '#progressteam8' ).progressbar({
        value: 0
      });
    });

  $('.tabs .tab-links a').on('click', function(e)  {
    var currentAttrValue = $(this).attr('href');
   
    $('.tabs ' + currentAttrValue).show().fadeIn(400).siblings().hide();

    $(this).parent('li').addClass('active').siblings().removeClass('active');

    e.preventDefault();
  });
});