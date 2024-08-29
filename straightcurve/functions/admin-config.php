<?php

// Remove widgets from admin dashboard
function site_remove_dashboard_widgets() {
	$remove_defaults_widgets = array(
		'dashboard_incoming_links' => array(
			'page'    => 'dashboard',
			'context' => 'normal'
		),
		'dashboard_right_now' => array(
			'page'    => 'dashboard',
			'context' => 'normal'
		),
		'dashboard_recent_drafts' => array(
			'page'    => 'dashboard',
			'context' => 'side'
		),
		'dashboard_quick_press' => array(
			'page'    => 'dashboard',
			'context' => 'side'
		),
		'dashboard_plugins' => array(
			'page'    => 'dashboard',
			'context' => 'normal'
		),
		'dashboard_primary' => array(
			'page'    => 'dashboard',
			'context' => 'side'
		),
		'dashboard_secondary' => array(
			'page'    => 'dashboard',
			'context' => 'side'
		),
		'dashboard_recent_comments' => array(
			'page'    => 'dashboard',
			'context' => 'normal'
		),
		'dashboard_activity' => array(
			'page'    => 'dashboard',
			'context' => 'normal'
		)
	);

	foreach ( $remove_defaults_widgets as $widget_id => $options ) {
		remove_meta_box( $widget_id, $options['page'], $options['context'] );
	}

	// remove welcome panel
	remove_action( 'welcome_panel', 'wp_welcome_panel' );
}
add_action('wp_dashboard_setup', 'site_remove_dashboard_widgets' );

function register_site_dashboard_widget() {
	add_meta_box(
		'welcome_dashboard_widget',
		'Welcome!',
		'welcome_dashboard_widget_display',
		'dashboard',
		'normal',
		'high'
	);
}

function welcome_dashboard_widget_display() {
	$current_user = wp_get_current_user();
	$name = $current_user->user_login;
	if ( $current_user->user_firstname ) {
		$name = $current_user->user_firstname;
	}
	$output = '';
	$output .= 'Hello ' . $name . ' and welcome to your dashboard.';
	$output .= '<p>To edit or generate content within your website, simply select <strong>Posts</strong> or <strong>Pages</strong> from the menu on the left.</p>';
	$output .= '<p>Should you have any problems in using the editor, or issues with the website itself, please don&rsquo;t hesitate to contact one of the <strong>Accounts team</strong> on the details below. </p><br />';
	$output .= '<style>
			#welcome_dashboard_widget .inside {
				overflow: hidden;
				clear: both;
			}
			#welcome_dashboard_widget .inside h3 {
				padding: 0;
				line-height: 1;
				margin-bottom: 3px;
			}
			.credit__logo {
				width: 62px;
				height: auto;
				float: left;
			}
			.credit__card {
				float: left;
				margin-left: 24px;
				font-size: 11px;
				line-height: 1.4;
			}
		</style>';
	$output .= '<img class="credit__logo" src="http://rockagency.com.au/content/wp/logo@2x.png" />';
	$output .= '<div class="credit__card">';
	$output .= '<h3></h3>';
	$output .= 'Office: +61 (03) 8840 0841';
	$output .= '<br />Email: <a href="mailto:hello@rockageny.com.au" title="Email Rock Agency">hello@rockageny.com.au</a>';
	$output .= '<br />Website: <a href="http://rockagency.com.au" title="Visit Rock Agency website">rockagency.com.au</a>';
	$output .= '</div>';
	echo $output;
}

add_action( 'wp_dashboard_setup', 'register_site_dashboard_widget' );



add_action( 'login_enqueue_scripts', 'ra_login_logo' );
function ra_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo ASSETS; ?>/img/logo.png);
			width: 320px;
			height: 51px;
			background-size: 320px 51px;
			background-repeat: no-repeat;
        	padding-bottom: 0;
			pointer-events: none;
        }
		.wp-core-ui #login .button,
		.wp-core-ui #login .button-secondary {
			color: #d97924;
		}
		.wp-core-ui #login .button-primary {
			border-color: #d97924;
			background-color: #d97924;
			color: #FFFFFF;
		}
		#login a {
			color: #d97924;
		}
		#login a:hover,
		#login #backtoblog a:hover,
		#login #nav a:hover,
		#login h1 a:hover {
			color: #d97924;
		}
    </style>
<?php }

?>