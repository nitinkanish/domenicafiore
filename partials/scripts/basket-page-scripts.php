<script>
	var $ = jQuery;
	$(document).ready(function() {

		// Cart Section -- Handle Quantity Input

		$('.df-quantity-button.less').click(function(e) {
			var targetQuantityElement = $(this).parent().find('.df-quantity-display .df-quantity');
			var quantity = + targetQuantityElement.val();
			if ( quantity > 1 ) {
				newQuantity = quantity - 1;
				targetQuantityElement.val( newQuantity );
			}
		});

		$('.df-quantity-button.more').click(function(e) {
			targetQuantityElement = $(this).parent().find('.df-quantity-display .df-quantity');
			quantity = + targetQuantityElement.val();
			newQuantity = quantity + 1;
			targetQuantityElement.val( newQuantity );
		});

    $('.df-quantity-button').click(function(e) {
      console.log('click');
      $('#update-cart-button').prop('disabled',false);
    });

		$('.df-add-to-cart').click(function() {
			var quantity = $(this).parent().parent().find('.df-cart-quantity-interface .df-quantity-display .df-quantity').val();
			var id = $(this).data('id');
			window.location.href = window.location.pathname + '?add-to-cart=' + id + '&quantity=' + quantity;
		});


		// Checkout Section -- Handle accordion collapsing
		//
		$('.df-accordion .btn-accordion').click(function(e) {
			e.preventDefault();
			var target = $(e.currentTarget).data('target');
			if ( $(target).hasClass('show') ) {
				$(target).collapse('hide');
				$(e.currentTarget).attr('aria-expanded', 'false');
			} else {
				$('.df-accordion .collapse').collapse('hide');
				$('.df-accordion .btn-accordion').attr('aria-expanded', 'false');
				$(target).collapse('show');
				$(e.currentTarget).attr('aria-expanded', 'true');
			}
		});

		$('button.continue-as-guest').click(function(e) {
			e.preventDefault();
			document.querySelector('.card.account').scrollIntoView();
			$('#checkout-accordion-billing-collapse').collapse('show');
			$('#checkout-accordion-login-collapse').collapse('hide');

			if ( $('.card.account .card-header .btn-accordion').attr('aria-expanded') === 'true' ) {
				$('.card.account .card-header .btn-accordion').attr('aria-expanded', 'false');
				$('.card.billing-shipping .card-header .btn-accordion').attr('aria-expanded', 'true');
			}
		});

		$('button.continue-to-order-review').click(function(e) {
			e.preventDefault();
			document.querySelector('.card.billing-shipping').scrollIntoView();
			$('#checkout-accordion-billing-collapse').collapse('hide');
			$('#checkout-accordion-review-order-collapse').collapse('show');

			if ( $('.card.billing-shipping .card-header .btn-accordion').attr('aria-expanded') === 'true' ) {
				$('.card.billing-shipping .card-header .btn-accordion').attr('aria-expanded', 'false');
				$('.card.review-order .card-header .btn-accordion').attr('aria-expanded', 'true');
			}
		});

	});
</script>
