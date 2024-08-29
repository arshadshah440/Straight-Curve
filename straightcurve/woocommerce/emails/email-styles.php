<?php
/**
 * Email Styles
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-styles.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 7.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Load colors.
$bg        = '#FFFDFB';
$bg_alt    = '#FFF4EA';
$body      = '#FFFFFF';
$text      = '#1B4932';
$text_grey = '#636363';
$link_color = '#1B4932';
$footer_text = wc_hex_lighter( $text, 40 );
$border_color  = '#C4C4C4';

// !important; is a gmail hack to prevent styles being stripped if it doesn't like something.
// body{padding: 0;} ensures proper scale/positioning of the email in the iOS native email app.
?>
body {
	padding: 0;
}
html, body, #wrapper {
	background-color: <?php echo esc_attr( $bg ); ?>;
}

#wrapper {
	margin: 0;
	padding: 70px 0;
	-webkit-text-size-adjust: none !important;
	width: 100%;
}

#template_container {
	box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1) !important;
	background-color: <?php echo esc_attr( $body ); ?>;
	border-radius: 3px !important;
}

#template_header_image img {
	margin-left: 0;
	margin-right: 0;
	max-width: 600px;
}

#template_footer td {
	padding: 0;
	border-radius: 6px;
}

#template_footer #credit {
	border: 0;
	color: <?php echo esc_attr( $footer_text ); ?>;
	font-family: Arial, sans-serif;
	font-size: 12px;
	line-height: 150%;
	text-align: center;
	padding: 24px 0;
}

#template_footer #credit p {
	margin: 0 0 16px;
}

#body_content {
	background-color: <?php echo esc_attr( $body ); ?>;
}

#body_content table td {
	padding: 0;
}
#body_content table td table td.wrap {
	padding: 42px 32px 42px;
}

#body_content table .order_item:last-child td {
	border-bottom: 1px solid <?php echo esc_attr( $border_color ); ?>;
}
#body_content table td td,
#body_content table td th {
	padding: 12px;
}
#body_content table tfoot td,
#body_content table tfoot th {
	padding: 3px 12px;
}
#body_content table tfoot .pt {
	padding-top: 18px;
}

#body_content table td td:first-child,
#body_content table td th:first-child {
	padding-left: 0;
}
#body_content table td td:last-child,
#body_content table td th:last-child {
	padding-right: 0;
}

#body_content td ul.wc-item-meta {
	font-size: small;
	margin: 0;
	padding: 0;
	list-style: none;
	color: #636363;
}
#customer_note {
	margin-top: 24px;
}
#advisory_notes {
	margin-top: 24px;
}

#body_content td ul.wc-item-meta li {
	margin: 0;
	padding: 0;
}
#body_content td ul.wc-item-meta li strong {
	font-weight: normal;
}

#body_content td ul.wc-item-meta li p {
	margin: 0;
}

#body_content p {
	margin: 0 0 16px;
}

#body_content_inner {
	color: <?php echo esc_attr( $text ); ?>;
	font-family: Arial, sans-serif;
	font-size: 14px;
	line-height: 18px;
}

.td {
	font-family: Arial, sans-serif;
	color: <?php echo esc_attr( $text ); ?>;
	border: 0;
	vertical-align: middle;
}

.bb {
	border-bottom: 1px solid <?php echo esc_attr( $border_color ); ?>;
}

.th-1 {
	font-family: Arial, sans-serif;
	font-style: normal;
	font-weight: normal;
	font-size: 10px;
	line-height: 11px;
	letter-spacing: 0.05em;
	text-transform: uppercase;
}

.th-2 {
	font-family: Arial, sans-serif;
	font-style: normal;
	font-weight: bold;
	font-size: 14px;
	line-height: 16px;
	text-transform: capitalize;
}

.address {
	font-size: 14px;
	line-height: 20px;
	padding: 0;
	color: <?php echo esc_attr( $text ); ?>;
	border: 0;
	font-style: normal;
}

.text {
	color: <?php echo esc_attr( $text ); ?>;
	font-family: Arial, sans-serif;
}

.link {
	color: <?php echo esc_attr( $link_color ); ?>;
}

#header_wrapper {
	padding: 36px 48px 0;
	display: block;
}

h1, h2, h3, h4, h5, h6 {
	color: <?php echo esc_attr( $text ); ?>;
	font-family: Arial, sans-serif;
	font-style: normal;
}

h1 {
	font-weight: normal;
	font-size: 18px;
	line-height: 21px;
	letter-spacing: -0.02em;
	margin: 0 0 18px;
}

h2 {
	font-size: 16px;
	line-height: 18px;
	font-weight: bold;
	text-transform: uppercase;
	margin: 0 0 18px;
}

h3 {
	font-size: 12px;
	line-height: 14px;
	font-weight: bold;
	text-transform: uppercase;
	margin: 0 0 18px;
}

a {
	color: <?php echo esc_attr( $link_color ); ?>;
	font-weight: normal;
	text-decoration: underline;
}

img {
	border: none;
	display: inline-block;
	font-size: 14px;
	font-weight: bold;
	height: auto;
	outline: none;
	text-decoration: none;
	text-transform: capitalize;
	vertical-align: middle;
	margin-<?php echo is_rtl() ? 'left' : 'right'; ?>: 10px;
	max-width: 100%;
	height: auto;
}

h2.order_details_title {
	margin: 36px 0 18px;
}
h2.order_details_title small {
	color: <?php echo esc_attr( $text_grey ); ?>;
	font-style: normal;
	font-weight: normal;
	font-size: 10px;
	line-height: 11px;
	letter-spacing: 0.05em;
	text-transform: uppercase;
}

#addresses {
	background-color: <?php echo esc_attr( $bg_alt ); ?>;
}
#addresses h2 {
	font-size: 12px;
	line-height: 14px;
	margin: 0 0 6px;
}
.includes_tax {
	display:block;
}

<?php
