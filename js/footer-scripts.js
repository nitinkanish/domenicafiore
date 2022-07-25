var $ = jQuery;

$(document).ready(function(){
  Breakpoints({
        xs: {
            min: 0,
            max: 575
        },
        sm: {
            min: 576,
            max: 767
        },
        md: {
            min: 768,
            max: 991
        },
        lg: {
            min: 992,
            max: Infinity
        }
    });

  // Handle Mega Menu in top navbar

  var showMegaMenu = function(menu) {
    $('#' + menu + '-mega-menu').collapse('show');
    $('#' + menu + '-trigger').addClass('active');
  }

  var hideMegaMenu = function(menu) {
    $('#' + menu + '-mega-menu').collapse('hide');
    $('#' + menu + '-trigger').removeClass('active');
  }

  if ( Breakpoints.is('xs') ) {
    showMegaMenu('shop');
  } else {
    $(".df-mega-menu .card-header button").attr("disabled", true);
  }

  $('#shop-trigger').click( function() {

    if ( $('#shop-mega-menu').is(':visible') ) {
      if ( !Breakpoints.is('xs') ) {
        hideMegaMenu('shop');
      }
    } else {
      hideMegaMenu('company');
      showMegaMenu('shop');
    }
    return false;
  });

  $('#company-trigger').click( function() {

    if ( $('#company-mega-menu').is(':visible') ) {
      if ( !Breakpoints.is('xs') ) {
        hideMegaMenu('company');
      }
    } else {
      hideMegaMenu('shop');
      showMegaMenu('company');
    }
    return false;
  });

  var xs = Breakpoints.get('xs');

  xs.on('enter', function() {
    showMegaMenu('shop');
    $(".df-mega-menu .card-header button").attr("disabled", false);
  });

  xs.on('leave', function() {
    hideMegaMenu('shop');
    $(".df-mega-menu .card-header button").attr("disabled", true);
  });




  // Morphing Hamburger Button
  document.querySelector( ".navbar-toggler" )
    .addEventListener( "click", function() {
      this.classList.toggle( "active" );
    });


});
