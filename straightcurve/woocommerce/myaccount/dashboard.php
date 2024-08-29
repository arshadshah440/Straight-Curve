<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);

$resources = get_field('resources');
$reps = get_field('reps_section');
?>

<?php if ($resources && count($resources) > 0) : ?>
	<div class="c-account__resources">
		<?php foreach ($resources as $item) : ?>
			<?php if (isset($item['file']['url'])) : ?>
				<div class="c-account__resource">
					<?php if (isset($item['thumb']['url'])) : ?>
						<div class="c-account__resource-thumb" >
							<img src="<?php echo ASSETS; ?>/img/1x1.trans.gif" data-src="<?php echo $item['thumb']['url']; ?>">
						</div>
					<?php endif; ?>
					<div class="c-account__resource-content">
						<h3><?php echo $item['title']; ?></h3>
						<p><?php echo $item['copy']; ?></p>
					</div>
					<a class="o-btn" href="<?php echo $item['file']['url']; ?>" target="_blank">Download</a>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>

<?php if (isset($reps['reps'][0])) : ?>
	<div class="c-account__rep-sec">
		<?php if (isset($reps['title']) && $reps['title']) : ?>
			<h2><?php echo $reps['title']; ?></h2>
		<?php endif; ?>


		<div class="c-account__reps">
			<?php foreach ($reps['reps'] as $item) : ?>
				<div class="c-account__rep">
					<div class="c-account__rep-inner">
						<div class="c-account__rep-thumb-wrap">
							<div class="c-account__rep-thumb" data-src="<?php echo $item['image']['url']; ?>"></div>
						</div>
						<div class="c-account__rep-info">
							<h3><?php echo $item['name']; ?></h3>
							<p class="c-account__rep-copy"><?php echo $item['copy']; ?></p>
							<?php if ($item['phone']) : ?>
								<span class="phone"><a href="tel:<?php echo $item['phone']; ?>"><?php echo $item['phone']; ?></a></span>
							<?php endif; ?>
							<?php if ($item['email']) : ?>
								<span class="email"><a href="mailto:<?php echo $item['email']; ?>"><?php echo $item['email']; ?></a></span>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
