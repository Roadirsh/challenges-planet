$(document).ready(function(){

  // get vars
    var searchEl = document.querySelector("#input");
    var labelEl = document.querySelector("#label");

    // register clicks and toggle classes
    labelEl.addEventListener("click",function(){
        if (classie.has(searchEl,"focus")) {
            classie.remove(searchEl,"focus");
            classie.remove(labelEl,"active");
        } else {
            classie.add(searchEl,"focus");
            classie.add(labelEl,"active");
        }
    });

    // register clicks outisde search box, and toggle correct classes
    document.addEventListener("click",function(e){
        var clickedID = e.target.id;
        if (clickedID != "search-terms" && clickedID != "search-label") {
            if (classie.has(searchEl,"focus")) {
                classie.remove(searchEl,"focus");
                classie.remove(labelEl,"active");
            }
        }
    });

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