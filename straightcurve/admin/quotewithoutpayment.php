 <?php
    // Switch to the blog where the product is located (e.g., blog ID 2)

    // add to cart the product

    function submit_quote()
    {
        // Check if WooCommerce is active
        if (!class_exists('WooCommerce')) {
            wp_send_json_error(array('message' => 'WooCommerce is not active.'));
        }

        // Retrieve data from the AJAX request
        $products = isset($_POST['products']) ? ($_POST['products']) : array();
        $username = isset($_POST['username']) ? ($_POST['username']) : '';
        $email = isset($_POST['email']) ? ($_POST['email']) : '';
        $postalcode = isset($_POST['postalcode']) ? ($_POST['postalcode']) : '';
        $suburb = isset($_POST['suburb']) ? ($_POST['suburb']) : '';
        $profession = isset($_POST['profession']) ? ($_POST['profession']) : '';

        // Create email content in TSV format
        ob_start();

        include get_template_directory() . '/template-parts/emailtemplate.php';

        $tsv_content = ob_get_clean();

        // Email to admin
        $admin_email = get_option('admin_email');
        wp_mail($admin_email, 'New Quote Submission', $tsv_content, array('Content-Type: text/html; charset=UTF-8'));

        // Email to user
        wp_mail($email, 'Your Quote Submission', $tsv_content, array('Content-Type: text/html; charset=UTF-8'));

        $reddirectedurl=home_url('/au/thank-you/');

        wp_send_json_success(array('message' => 'Quote submitted successfully.' ,'redirect' => $reddirectedurl));
    }

    add_action('wp_ajax_submit_quote', 'submit_quote');
    add_action('wp_ajax_nopriv_submit_quote', 'submit_quote');
