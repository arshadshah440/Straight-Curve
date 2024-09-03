<?php
?>

<header class=" desktop-header" id="header">
    <div class="topheader_wrapper">
        <div class=" login_country_ar">
            <div class="container_ar_mi">
                <div class="top_header_ar_mi">
                    <div class="topheaderbtn_ar">
                        <div class="login_btn">
                            <a href="<?php echo get_field('top_header_login_button_link', 'option'); ?>"><?php echo get_field('top_header_login_button_text', 'option'); ?>
                                <span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="login_btn">
                            <a href="<?php echo get_field('top_header_pro_account_button_link', 'option'); ?>"><?php echo get_field('top_header_pro_account_button_text', 'option'); ?>
                                <span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                    </div>
                    <?php if (have_rows('country_option', 'option')): ?>
                        <div class="netsites_ar">
                            <div id="custom-dropdown" class="custom-dropdown">
                                <div class="dropdown-selected-option">
                                    <?php
                                    // Get the first row
                                    the_row();
                                    $country_name = get_sub_field('country_name');
                                    $country_flag = get_sub_field('country_flag_icon');
                                    ?>
                                    <img src="<?php echo $country_flag; ?>" alt="<?php echo $country_name; ?>"
                                        class="flag-icon">
                                    <span class="country-name"><?php echo esc_html($country_name); ?> <i
                                            class="fa fa-angle-down"></i></span>
                                </div>
                                <div class="dropdown-options">
                                    <?php
                                    // Loop through all rows
                                    while (have_rows('country_option', 'option')):
                                        the_row();
                                        $country_name = get_sub_field('country_name');
                                        $country_url = get_sub_field('country_url');
                                        $country_flag = get_sub_field('country_flag_icon');
                                    ?>
                                        <div class="dropdown-option" data-url="<?php echo $country_url; ?>">
                                            <img src="<?php echo $country_flag; ?>" alt="<?php echo $country_name; ?>"
                                                class="flag-icon">
                                            <span class="country-name"><?php echo esc_html($country_name); ?></span>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>



                </div>
            </div>

        </div>

        <div class="container_ar_mi" id="container_ar_mi_navheader">
            <nav>
                <div class="straight_logo_header_ar">
                    <a href="<?php echo home_url(); ?>"> <img src="<?php echo get_field('header_logo', 'option'); ?>"
                            alt="Straight Curve Logo"></a>
                </div>
                <div class="header_menu_ar">
                    <div class="flex_mob_pops_wrapper_ar" id="quote_header_ar">


                        <div class="menu_header_mb_ar_close">

                            <div class="dropdown">
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <ul class="mainmenulist">
                                        <?php
                                        // Specify the menu location
                                        $menu_location = 'quote-menu';
                                        $svg_path = get_template_directory() . '/assets/img/chevronbottom.svg';
                                        $chevronlink = get_svg_content($svg_path);

                                        // Get the menu object by location
                                        $menu_object = get_nav_menu_locations();
                                        $menu_id = isset($menu_object[$menu_location]) ? $menu_object[$menu_location] : null;

                                        // Check if the menu ID exists
                                        if ($menu_id) {
                                            // Get menu items from the specified menu
                                            $menu_items = wp_get_nav_menu_items($menu_id);

                                            // Check if there are menu items
                                            if ($menu_items) {
                                                $subitems = [];
                                                foreach ($menu_items as $menu_item) {
                                                    if ($menu_item->menu_item_parent !== '0') {
                                                        $subitems[$menu_item->menu_item_parent][] = $menu_item;
                                                    }
                                                }

                                                $currentitemid = '';
                                                foreach ($menu_items as $index => $menu_item) {
                                                    // Get the text and link (URL) of the menu item
                                                    $text = $menu_item->title;
                                                    $link = $menu_item->url;

                                                    if ($menu_item->menu_item_parent == '0') {
                                                        $next_menu_item = isset($menu_items[$index + 1]) ? $menu_items[$index + 1] : null;
                                                        if ($next_menu_item && $next_menu_item->menu_item_parent == '0') {
                                                            echo '<li><a class="dropdown-item" href="' . esc_url($link) . '">' . esc_html($text) . '</a></li>';
                                                        } else {
                                                            echo '<li><a class="dropdown-item" href="' . esc_url($link) . '">' . esc_html($text) . ' <span><i class="fa-solid fa-chevron-down"></i></span></a>';
                                                            if (isset($subitems[$menu_item->ID])) {
                                                                echo "<ul class='submenulist'>";
                                                                include get_template_directory() . '/assets/img/Polygon_1.svg';
                                                                foreach ($subitems[$menu_item->ID] as $subitem) {
                                                                    echo '<li><a class="dropdown-item" href="' . esc_url($subitem->url) . '">' . esc_html($subitem->title) . '</a></li>';
                                                                }
                                                                echo "</ul>";
                                                            }
                                                            echo "</li>";
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
</header>