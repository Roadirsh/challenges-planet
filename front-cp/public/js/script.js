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

    $('#form-signup').isHappy({
    fields: {
      // reference the field you're talking about, probably by `id`
      // but you could certainly do $('[name=name]') as well.
      '#sign-up-email': {
        required: true,
        message: 'Without an email, how can we identify you ?'
      },
      '#sign-up-password': {
        required: true,
        message: 'Affraid to put a password ? For sure it will be our secret'
      },
    },
    happy: function () { }
  });

  $( ".wrapper" ).hover(
    function() {
      $(this).find(".hover").toggleClass( "active" );
  });


  $(function() {
      $( '.progress-team-done' ).progressbar({
        value: 100
      });
    });


  $('.progress-team').each(function() {
    percent = $(this).data("percent");
    $(this).progressbar({
      value: percent
    });
  });



  $('.tabs .tab-links a').on('click', function(e)  {
    var currentAttrValue = $(this).attr('href');
   
    $('.tabs ' + currentAttrValue).show().fadeIn(400).siblings().hide();

    $(this).parent('li').addClass('active').siblings().removeClass('active');

    e.preventDefault();
  });
});