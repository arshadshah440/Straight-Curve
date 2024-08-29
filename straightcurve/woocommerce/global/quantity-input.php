<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 *
 * @var bool   $readonly If the input should be set to readonly mode.
 * @var string $type     The input type attribute.
 */

defined( 'ABSPATH' ) || exit;

if ( $max_value && $min_value === $max_value ) {
	?>
	<div class="quantity hidden">
		<input type="hidden" id="<?php echo esc_attr( $input_id ); ?>" class="qty" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $min_value ); ?>" />
	</div>
	<?php
} else {
	/* translators: %s: Quantity. */
	$label = ! empty( $args['product_name'] ) ? sprintf( esc_html__( '%s ', 'woocommerce' ), wp_strip_all_tags( $args['product_name'] ) ) : '';
	?>
	<div class="quantity c-quantity">
		<?php do_action( 'woocommerce_before_quantity_input_field' ); ?>
		<label class="" for="<?php echo esc_attr( $input_id ); ?>"><span class="screen-reader-text"><?php echo esc_attr( $label ); ?></span><?php echo ra_lang('Quantity') ?>:</label>
		<div class="c-quantity__field">
			<a href="javascript:void(0);" class="js-qty c-quantity__action minus" data-action="minus">-</a>
			<input
				type="number"
				id="<?php echo esc_attr( $input_id ); ?>"
				class="<?php echo esc_attr( join( ' ', (array) $classes ) ); ?>"
				step="<?php echo esc_attr( $step ); ?>"
				min="<?php echo esc_attr( $min_value ); ?>"
				max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
				name="<?php echo esc_attr( $input_name ); ?>"
				value="<?php echo esc_attr( $input_value ); ?>"
				title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ); ?>"
				size="4"
				placeholder="<?php echo esc_attr( $placeholder ); ?>"
				inputmode="<?php echo esc_attr( $inputmode ); ?>" />
			<?php do_action( 'woocommerce_after_quantity_input_field' ); ?>
			<a href="javascript:void(0);" class="js-qty c-quantity__action plus" data-action="plus">+</a>
		</div>
	</div>
	<?php
}
