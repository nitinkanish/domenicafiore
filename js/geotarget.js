// * This js file is enqueued in /inc/geotarget.php

function lowerMainland() {
  // Vancouver, Burnaby, New Westminster, Coquitlam, Port Moody, Surrey, Richmond, Delta, White Rock, North Vancouver, West Vancouver, Langley, Abbotsford, Pitt Meadows, Maple Ridge, Mission, Chilliwack, Hope, Squamish, Whistler, Pemberton, Gibsons, Sechelt
  if (
    geotarget.city == 'Vancouver' ||
    geotarget.city == 'Burnaby' ||
    geotarget.city == 'New Westminster' ||
    geotarget.city == 'Coquitlam' ||
    geotarget.city == 'Port Coquitlam' ||
    geotarget.city == 'Port Moody' ||
    geotarget.city == 'Surrey' ||
    geotarget.city == 'Richmond' ||
    geotarget.city == 'Delta' ||
    geotarget.city == 'White Rock' ||
    geotarget.city == 'North Vancouver' ||
    geotarget.city == 'West Vancouver' ||
    geotarget.city == 'Langley' ||
    geotarget.city == 'Abbotsford' ||
    geotarget.city == 'Pitt Meadows' ||
    geotarget.city == 'Maple Ridge' ||
    geotarget.city == 'Mission' ||
    geotarget.city == 'Chilliwack' ||
    geotarget.city == 'Hope' ||
    geotarget.city == 'Squamish' ||
    geotarget.city == 'Whistler' ||
    geotarget.city == 'Pemberton' ||
    geotarget.city == 'Gibsons' ||
    geotarget.city == 'Sechelt'
  ) { return true; }
}

function showPickupModal() {
  jQuery('#localPickupModal').modal('show');
  jQuery('#localPickupModal').on('hide.bs.modal', function(e) {
    Cookies.set('localPickupModal', 'seen');
  });
}

function showPickupAnnouncement() {
  jQuery('.order-summary-outer .df-checkout-review-table').before('<div class="local-pickup-announcement"></div>');
  jQuery('.order-summary-outer .local-pickup-announcement').html('<div class="inner"></div>');
  jQuery('.order-summary-outer .local-pickup-announcement .inner').html('<p>Choose the Pick Up shipping option to save on shipping, and pick up your online order in downtown Vancouver (595 Burrard Street - Bentall 3 building, retail level across from BMO bank) from November 7 to December 24. Orders will be ready for pick up two business days after order is placed.</p><p>Details will be emailed to you once your purchase is completed.</p>');
}

if ( geotarget.page == 'reserva-500ml-2017' && lowerMainland() ) {
  if ( Cookies.get('localPickupModal') !== 'seen' ) {
    showPickupModal();
  }
}

if ( geotarget.page == 'basket' && geotarget.cartPickupOnly && lowerMainland() ) {
  showPickupModal();
}
