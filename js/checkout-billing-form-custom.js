//
// Add message container to billing form
// & show a message when Canada is the selected country.
//

setTimeout( addMessageElement, 1000 );
function addMessageElement() {
  $('.woocommerce-billing-fields__field-wrapper').after('<div class="df-billing-message">Message goes here</div>');
  $('#billing_address_1_field').before('<div class="df-billing-country-note">' + objectL10n.contact_for_international_shipping + '</div>');
  showPOBoxMessage();
}

function showPOBoxMessage() {
  $('.df-billing-message').addClass('show');
  $('.df-billing-message').html(objectL10n.no_po_boxes);
}

function handleCountryChange() {
  showPOBoxMessage();
}
