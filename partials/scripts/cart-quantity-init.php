<script>
	var $ = jQuery;
	$(document).ready(function() {
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

		$('.df-add-to-cart').click(function() {
			var quantity = $(this).parent().parent().find('.df-cart-quantity-interface .df-quantity-display .df-quantity').val();
			var id = $(this).data('id');
			window.location.href = window.location.pathname + '?add-to-cart=' + id + '&quantity=' + quantity;
		});
	});
</script>
