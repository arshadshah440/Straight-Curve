<?php

add_action('admin_menu', 'ra_register_upload_users_submenu_page', 10);
function ra_register_upload_users_submenu_page() {
	add_users_page(
		__( 'Upload users', 'upload-users' ),
		__( 'Upload users', 'upload-users' ),
		'manage_options',
		'uploadusers',
		'ra_upload_users'
	);
}
function ra_upload_users() {
	$billing_states = array(
		"" =>"Select State",
		"ACT" => "Australian Capital Territory",
		"NSW" => "New South Wales",
		"NT" => "Northern Territory",
		"QLD" => "Queensland",
		"SA" => "South Australia",
		"TAS" => "Tasmania",
		"VIC" => "Victoria",
		"WA" => "Western Australia",
	);

	$user_types = array( 'Customer', 'Dealer', 'PRO' );

	$errors = array();
	$messages = array();
	$usersCreated = array();
	$errorWhileCreating = array();
	$is_valid = true;

	if ($_POST && $_POST['action'] && $_POST['action'] === 'ra_upload_users' || $_POST['action'] === 'ra_add_user') :
		if ($_POST['action'] === 'ra_upload_users') {
			// Validate Fields
			if ( !isset($_FILES["csv_file"]) || $_FILES["csv_file"]["error"] > 0) {
				$is_valid = false;
				$errors[] = 'Please select a file.';
			}
			if ($is_valid) {
				$tmpName = $_FILES['csv_file']['tmp_name'];
				// $tmpName = ASSETS . '/files/sample-users.csv';
				$csvArray = array_map('str_getcsv', file($tmpName));
				if ($csvArray && count($csvArray) < 2) {
					$is_valid = false;
					$errors[] = 'Invalid file.';
				} else {
					array_walk($csvArray, function(&$a) use ($csvArray) {
						$a = array_combine($csvArray[0], $a);
					});
					array_shift($csvArray);
				}
			}
		} elseif($_POST['action'] === 'ra_add_user') {
			$csvArray = array(
				array(
					'user_type' => $_POST['user_type'],
					'first_name' => $_POST['first_name'],
					'last_name' => $_POST['last_name'],
					'email' => $_POST['email'],
					'phone' => $_POST['phone'],
					'billing_company' => $_POST['billing_company'],
					'billing_address_1' => $_POST['billing_address_1'],
					'billing_city' => $_POST['billing_city'],
					'billing_state' => $_POST['billing_state'],
					'billing_postcode' => $_POST['billing_postcode'],
					'billing_country' => $_POST['billing_country'],
					'warehouse_code' => $_POST['warehouse_code'],
					'username' => $_POST['username'],
					'password' => $_POST['password'],
					'skipconfirmemail' => ($_POST['skipconfirmemail'] === 'on' ? true : false),
				)
			);
		}


		// Validate CSV DATA
		if ($is_valid) {

			$used_emails = array();
			$used_username = array();
			$finalData = array();
			foreach ($csvArray as $key => $row) {
				$row_valid = true;
				$rowData = array();
				foreach ($row as $rowKey => $value) {
					$rowKey = preg_replace('![^a-z0-9_]+!i', '', strtolower( $rowKey ));
					$rowKey = str_replace('expiryddmmyyyy', 'expiry', $rowKey);
					$rowData[$rowKey] = trim($value);
				}
				$rowData['billing_country'] = 'AU';
				$row = $rowData;

				if ($_POST['action'] === 'ra_upload_users') {
					$thisErr = 'ERROR: Row ' . ($key + 1) . ' requires ';
				} else {
					$thisErr = 'ERROR: requires ';
				}
				if (!$row['first_name']) {
					$thisErr .= ($row_valid ? '' : ', ') . '"first_name"';
					$row_valid = false;
				}

				if (!$row['email']) {
					$thisErr .= ($row_valid ? '' : ', ') . '"email"';
					$row_valid = false;
				} elseif (email_exists($row['email'])) {
					$thisErr .= ($row_valid ? '' : ', ') . '"user already exist for email ' . $row['email'] . '"';
					$row_valid = false;
				} elseif (in_array($row['email'], $used_emails)) {
					$thisErr .= ($row_valid ? '' : ', ') . '"email ' . $row['email'] . ' is used more than once"';
					$row_valid = false;
				}

				if ($row['username'] && username_exists( $row['username'] )) {
					$thisErr .= ($row_valid ? '' : ', ') . '"username ' . $row['username'] . ' is already in use"';
					$row_valid = false;
				}

				if (!$row['password']) {
					$row['password'] = wp_generate_password(12, false);
				} elseif ($row['password'] && strlen($row['password']) < 8) {
					$thisErr .= ($row_valid ? '' : ', ') . '"password must be atleast 8 character long"';
					$row_valid = false;
				}

				if (!$row['user_type']) {
					$thisErr .= ($row_valid ? '' : ', ') . '"user_type"';
					$row_valid = false;
				} elseif (!in_array($row['user_type'], $user_types)) {
					$thisErr .= ($row_valid ? '' : ', ') . '"user_type must be one of the following (' . implode(', ', $user_types) . ')"';
					$row_valid = false;
				}


				if ($row_valid) {

					if (!$row['username']) {
						$row['username'] = ra_generate_username($row['first_name']);
						while (in_array($row['username'], $used_username)) {
							$row['username'] = ra_generate_username($prefix[0]);
						}
					}

					$used_emails[] = $row['email'];
					$used_username[] = $row['username'];
					$finalData[] = $row;

				} else {
					$is_valid = false;
					$errors[] = $thisErr;
				}
			}
		}

		// If all above is valid, create Users
		if ($is_valid) {
			foreach ($finalData as $user_data) {
				$result = ra_save_csv_user($user_data);
				if ($result['error']) {
					$errorWhileCreating[] = array(
						'data' => $user_data,
						'error' => $result['message']
					);
				} else {
					$usersCreated[] = array( 'data' => $user_data );
				}
			}

			$messages[] = count($usersCreated) . ' Users added successfully.';

			if ($_POST['action'] === 'ra_add_user' && count($usersCreated) > 0) {
				$_POST = array();
			}
		}

	endif;


	$change_action_on = '';
	if ($_POST['change_action'] && $_POST['change_action'] === 'on') {
		$change_action_on = 'checked';
	}


	$posted_data = array(
		'user_type' => ($_POST['user_type'] ? $_POST['user_type'] : null),
		'first_name' => ($_POST['first_name'] ? $_POST['first_name'] : null),
		'last_name' => ($_POST['last_name'] ? $_POST['last_name'] : null),
		'email' => ($_POST['email'] ? $_POST['email'] : null),
		'phone' => ($_POST['phone'] ? $_POST['phone'] : null),
		'billing_address_1' => ($_POST['billing_address_1'] ? $_POST['billing_address_1'] : null),
		'billing_city' => ($_POST['billing_city'] ? $_POST['billing_city'] : null),
		'billing_state' => ($_POST['billing_state'] ? $_POST['billing_state'] : null),
		'billing_postcode' => ($_POST['billing_postcode'] ? $_POST['billing_postcode'] : null),
		'username' => ($_POST['username'] ? $_POST['username'] : null),
		'password' => ($_POST['password'] ? $_POST['password'] : null),
		'skipconfirmemail' => ($_POST['skipconfirmemail'] === 'on' ? true : false),
	);

	if (!$posted_data['password']) {
		$posted_data['password'] = wp_generate_password(12, false);
	}

?>
<div class="wrap">
	<h1>Upload Users</h1>
	<form method="POST" enctype="multipart/form-data" action="<?php echo admin_url( 'users.php?page=uploadusers' ); ?>">
		<?php if ($errors && count($errors) > 0) : ?>
			<div class="notice notice-error">
				<?php foreach ($errors as $error) : ?>
					<p><?php echo $error; ?></p>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
		<?php if ($messages && count($messages) > 0) : ?>
			<div class="notice notice-success">
				<?php foreach ($messages as $message) : ?>
					<p><?php echo $message; ?></p>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
		<?php if ($usersCreated && count($usersCreated) > 0) : ?>
			<h3>Successfully created users</h3>
			<table class="widefat fixed" style="border-left: 3px solid #00a32a;">
				<thead>
					<tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th>Username</th>
					</tr>
				</thead>
				<?php foreach ($usersCreated as $data) : ?>
					<tr>
						<td><?php echo $data['data']['first_name']; ?></td>
						<td><?php echo $data['data']['last_name']; ?></td>
						<td><?php echo $data['data']['email']; ?></td>
						<td><?php echo $data['data']['username']; ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		<?php endif; ?>
		<?php if ($errorWhileCreating && count($errorWhileCreating) > 0) : ?>
			<h3>Errors while creating users</h3>
			<table class="widefat fixed" style="border-left: 3px solid #d63638;">
				<thead>
					<tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th>Error</th>
					</tr>
				</thead>
				<?php foreach ($errorWhileCreating as $data) : ?>
					<tr>
						<td><?php echo $data['data']['first_name']; ?></td>
						<td><?php echo $data['data']['last_name']; ?></td>
						<td><?php echo $data['data']['email']; ?></td>
						<td><?php echo $data['error']; ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		<?php endif; ?>


		<input type="hidden" name="action" id="user_form_action" value="ra_add_user" />
		<table class="form-table">
			<tr>
				<th><label for="user_form_change_action">Upload users from CSV</label></th>
				<td><input type="checkbox" name="change_action" id="user_form_change_action" <?php echo $change_action_on; ?>></td>
			</tr>
			<tr class="toggleable-field ra_upload_users" hidden>
				<th><label for="user_form_csv_file">CSV File</label></th>
				<td><input type="file" id="user_form_csv_file" name="csv_file"></td>
			</tr>


			<tr class="toggleable-field ra_add_user">
				<th><label for="user_form_user_type">User Type</label></th>
				<td>
					<select id="user_form_user_type" name="user_type">
						<option value="">Select user type</option>
						<?php foreach ($user_types as $item) : ?>
							<option value="<?php echo $item; ?>" <?php echo ($posted_data['user_type'] === $item ? 'selected' : ''); ?>><?php echo $item; ?></option>
						<?php endforeach; ?>
					</select>
				</td>

			</tr>


			<tr class="toggleable-field ra_add_user">
				<th><label for="user_form_first_name">First Name</label></th>
				<td><input type="text" id="user_form_first_name" name="first_name" value="<?php echo $posted_data['first_name']; ?>"></td>
			</tr>
			<tr class="toggleable-field ra_add_user">
				<th><label for="user_form_last_name">Last Name</label></th>
				<td><input type="text" id="user_form_last_name" name="last_name" value="<?php echo $posted_data['last_name']; ?>"></td>
			</tr>
			<tr class="toggleable-field ra_add_user">
				<th><label for="user_form_email">Email Address</label></th>
				<td><input type="email" id="user_form_email" name="email" value="<?php echo $posted_data['email']; ?>"></td>
			</tr>
			<tr class="toggleable-field ra_add_user">
				<th><label for="user_form_phone">Phone</label></th>
				<td><input type="tel" id="user_form_phone" name="phone" value="<?php echo $posted_data['phone']; ?>"></td>
			</tr>
			<tr class="toggleable-field ra_add_user">
				<th><label for="user_form_billing_address_1">Address line 1</label></th>
				<td><input type="text" id="user_form_billing_address_1" name="billing_address_1" value="<?php echo $posted_data['billing_address_1']; ?>"></td>
			</tr>
			<tr class="toggleable-field ra_add_user">
				<th><label for="user_form_billing_city">City</label></th>
				<td><input type="text" id="user_form_billing_city" name="billing_city" value="<?php echo $posted_data['billing_city']; ?>"></td>
			</tr>
			<tr class="toggleable-field ra_add_user">
				<th><label for="user_form_billing_state">State</label></th>
				<td>
					<select id="user_form_billing_state" name="billing_state">
						<?php foreach ($billing_states as $key => $item) : ?>
							<option value="<?php echo $key; ?>" <?php echo ($posted_data['billing_state'] === $key ? 'selected' : ''); ?>><?php echo $item; ?></option>
						<?php endforeach; ?>
					</select>
				</td>

			</tr>
			<tr class="toggleable-field ra_add_user">
				<th><label for="user_form_billing_postcode">Postcode</label></th>
				<td><input type="text" id="user_form_billing_postcode" name="billing_postcode" value="<?php echo $posted_data['billing_postcode']; ?>"></td>
			</tr>
			<tr class="toggleable-field ra_add_user">
				<th><label for="user_form_username">Username</label></th>
				<td><input type="text" id="user_form_username" name="username" value="<?php echo $posted_data['username']; ?>"><br><span>Leave blank to auto generate username from First name</span></td>
			</tr>
			<tr class="toggleable-field ra_add_user">
				<th><label for="user_form_password">Password</label></th>
				<td><input type="text" id="user_form_password" name="password" value="<?php echo $posted_data['password']; ?>"></td>
			</tr>
			<tr class="toggleable-field ra_add_user">
				<th><label for="user_form_skipconfirmemail">Skip Confirmation Email</label></th>
				<td><label><input type="checkbox" id="user_form_skipconfirmemail" name="skipconfirmemail" <?php echo ($posted_data['skipconfirmemail'] ? 'checked' : ''); ?>> Add the user without sending an email that requires their confirmation.</label></td>
			</tr>
			<!-- <tr class="toggleable-field ra_add_user">
				<th><label for="user_form_billing_country">Country code</label></th>
				<td><input type="text" id="user_form_billing_country" name="billing_country"></td>
			</tr> -->
			<!-- <tr class="toggleable-field ra_add_user">
				<th><label for="user_form_warehouse_code">warehouse_code</label></th>
				<td><input type="text" id="user_form_warehouse_code" name="warehouse_code"></td>
			</tr> -->
			<tr>
				<td></td>
				<td><input type="submit" class="button button-primary" value="Upload Users" /></td>
			</tr>
		</table>

		<p>NOTE: All users will be added as <strong>Customer Dealer</strong>.</p>
		<div class="toggleable-field ra_upload_users">
			<p>NOTE: Before uploading the CSV. Please ensure that all headers and relevant data is correct and filled out in your csv. You can access this <a href="<?php echo ASSETS; ?>/files/sample-users.csv" target="_blank">sample csv</a> for reference.</p>
			<p>Once you upload your CSV. and click ‘Upload Users,’ make sure you do not refresh this page as this could lead to users uploading twice.</p>
		</div>
    </form>

	<script>
		var actionField = document.getElementById('user_form_action');
		var checkbox = document.getElementById('user_form_change_action');
		var toggleableFields = document.getElementsByClassName('toggleable-field');

		checkbox.addEventListener('change', (event) => {
			changeAction();
		})

		changeAction();
		function changeAction() {
			var action = 'ra_add_user';
			if (checkbox.checked) {
				var action = 'ra_upload_users';
			}
			actionField.value = action;

			Array.from(toggleableFields).forEach(function (el) {
				if (el.classList.contains(action)) {
					el.removeAttribute('hidden');
				} else {
					el.setAttribute('hidden', 'hidden');
				}
			});
		}
	</script>
</div>
<?php
} // function ra_upload_users

function ra_generate_username( $prefix ){
	$prefix = preg_replace('![^a-z0-9]+!i', '', strtolower( $prefix ));
	if (strlen($prefix) > 15) {
		$prefix = substr($prefix, 0, 15);
	}

	$user_exists = 1;
    do {
       $rnd_str = mt_rand(1000,9999);
       $user_exists = username_exists( $prefix . $rnd_str );
    } while( $user_exists > 0 );
   return $prefix . $rnd_str;
}

function ra_save_csv_user($user_data) {
	$result = null;
	$password = $user_data['password'];
	if (!$password) {
		$password = wp_generate_password(12, false);
	}

	$roles = array(
		'Customer' => 'customer',
		'Dealer' => 'customer_dealer',
		'PRO' => 'customer_professionals'
	);

	$user_role = 'customer';
	if ($roles[$user_data['user_type']]) {
		$user_role = $roles[$user_data['user_type']];
	}

	$insert_user = wp_insert_user(array(
		'user_login' => $user_data['username'],
		'user_email' => $user_data['email'],
		'first_name' => $user_data['first_name'],
		'last_name' => $user_data['last_name'],
		'role' => $user_role,
		'user_pass' => $password
	));

	if(is_wp_error($insert_user)){
		$message = $insert_user->get_error_message();
		$result = array('error' => true, 'message' => $message);
	} else {
		if (!$user_data['skipconfirmemail']) {
			wp_new_user_notification($insert_user, null, 'user');
		}

		if ($user_data['phone']) {
			update_user_meta($insert_user, 'billing_phone', $user_data['phone']);
			update_user_meta($insert_user, 'shipping_phone', $user_data['phone']);
		}
		if ($user_data['billing_company']) {
			update_user_meta($insert_user, 'billing_company', $user_data['billing_company']);
			update_user_meta($insert_user, 'shipping_company', $user_data['billing_company']);
		}
		if ($user_data['billing_address_1']) {
			update_user_meta($insert_user, 'billing_address_1', $user_data['billing_address_1']);
			update_user_meta($insert_user, 'shipping_address_1', $user_data['billing_address_1']);
		}
		if ($user_data['billing_city']) {
			update_user_meta($insert_user, 'billing_city', $user_data['billing_city']);
			update_user_meta($insert_user, 'shipping_city', $user_data['billing_city']);
		}
		if ($user_data['billing_state']) {
			update_user_meta($insert_user, 'billing_state', $user_data['billing_state']);
			update_user_meta($insert_user, 'shipping_state', $user_data['billing_state']);
		}
		if ($user_data['billing_postcode']) {
			update_user_meta($insert_user, 'billing_postcode', $user_data['billing_postcode']);
			update_user_meta($insert_user, 'shipping_postcode', $user_data['billing_postcode']);
		}
		if ($user_data['billing_country']) {
			update_user_meta($insert_user, 'billing_country', $user_data['billing_country']);
			update_user_meta($insert_user, 'shipping_country', $user_data['billing_country']);
		}
		if ($user_data['warehouse_code']) {
			update_user_meta($insert_user, 'ra_warehouse_code', $user_data['warehouse_code']);
		}

		$result = array('success' => true, 'message' => 'User created successfully');
	}

	return $result;
}

?>