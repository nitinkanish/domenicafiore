function setCountrySelectPlaceholder() {
  if ( $('.select2-selection__placeholder').is(':empty') ) {
    $('.select2-selection__placeholder').html('Select a country...')
  }
}

function setStateSelectPlaceholder() {
  if ( $('#billing_state option:first-child').html() == 'Select an option…' ) {
    $('#billing_state option:first-child').html('Select a State/Province');
  }
  if ( $('input#billing_state').attr('placeholder') == 'Select an option…' ) {
    $('input#billing_state').attr('placeholder', 'Select a State/Province');
  }
  if ( $('#billing_state_field input.input-text').attr('value') == '' ) {
    $('#billing_state_field input.input-text').attr('value', 'Select a State/Province');
  }
}

function setStateSelectColour() {
  if ( $('#billing_state').val().length == 0 ) {
    $('#billing_state').addClass('grey');
  } else {
    $('#billing_state').removeClass('grey');
  }
}

$(document).ready(function() {

  $("input#shipping_method_0_1782").prop( "checked", true );
	$("input#shipping_method_0_1779").prop( "checked", true );

  setCountrySelectPlaceholder();
  setStateSelectPlaceholder()
  setStateSelectColour();

  $('#billing_state').on('change',function(){
    setStateSelectColour();
  });

  var observer = new MutationObserver(function() {
    if ( $('#select2-billing_country-container .select2-selection__placeholder').length ) {
      setCountrySelectPlaceholder();
      setStateSelectPlaceholder();
    }
  });

  observer.observe(document.body, {attributes:true});

});
