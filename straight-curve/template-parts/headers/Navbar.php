<?php
?>

<header class=" desktop-header" id="header">
    <div class="topheader_wrapper">
        <div class="container_ar_mi">
            <div class="top_header_ar_mi">
                <div class="topheaderbtn_ar">
                    <div class="login_btn">
                        <a href="<?php echo get_field('top_header_login_button_link', 'option'); ?>"><?php echo get_field('top_header_login_button_text', 'option'); ?> <span><i class="fa-solid fa-arrow-right"></i></span></a>
                    </div>
                    <div class="login_btn">
                        <a href="<?php echo get_field('top_header_pro_account_button_link', 'option'); ?>"><?php echo get_field('top_header_pro_account_button_text', 'option'); ?> <span><i class="fa-solid fa-arrow-right"></i></span></a>
                    </div>
                </div>
                <div class="netsites_ar">

                </div>
            </div>
        </div>
    </div>
    <div class="container_ar_mi" id="container_ar_mi_navheader">
        <nav>
            <div class="straight_logo_header_ar">
               <a href="<?php echo home_url(); ?>"> <img src="<?php echo get_field('header_logo', 'option'); ?>" alt="Straight Curve Logo"></a> 
            </div>
            <div class="header_menu_ar hide_mobile_ar" id="mobile_nav_ar">
                <div class="close_btn_ar" id="close_btn_ar">
                    &times;
                </div>
                <div class="dropdown">
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <ul class="mainmenulist">
                            <?php
                            // Specify the menu location
                            $menu_location = 'header_menu';
                            $svg_path = get_template_directory() . '/assets/img/chevronbottom.svg';
                            $chevronlink = $svg_content = get_svg_content($svg_path);
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
                                            $subitemarray = array("id" => $menu_item->menu_item_parent, "item" => $menu_item);
                                            array_push($subitems, $subitemarray);
                                        }
                                    }

                                    $currentitemid = '';
                                    foreach ($menu_items as $index => $menu_item) {
                                        // Get the text and link (URL) of the menu item
                                        $text = $menu_item->title;
                                        $link = $menu_item->url;
                                        // Output or use the text and link as needed
                                        if ($menu_item->menu_item_parent == '0') {
                                            if ($menu_items[$index + 1]->menu_item_parent == '0') {
                                                echo '<li><a class="dropdown-item" href="' . esc_html($link) . '">' . esc_html($text) . '</a> </li>';
                                            } else {
                                                echo '<li><a class="dropdown-item" href="' . esc_html($link) . '">' . esc_html($text) . ' <span>' . $chevronlink . '</span></a>';
                                            }
                                        } else {

                                            if ($menu_item->menu_item_parent === $currentitemid) {
                                                continue;
                                            } else {
                                                echo "<ul class='submenulist'>";
                                                foreach ($subitems as $subitem) {
                                                    if ($subitem["id"] == $menu_item->menu_item_parent) {
                                                        echo '<li> <a class="dropdown-item" href="' . esc_html($subitem['item']->url) . '">' . esc_html($subitem['item']->title) . '</a> </li>';
                                                    }
                                                }
                                            }
                                            echo "</ul> </li>";
                                            $currentitemid = $menu_item->menu_item_parent;
                                        }
                                    }
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="cta_header_ar show_mobile_ar">
                    <a href="<?php echo get_field('header_cta_link', 'option'); ?>">
                        <?php echo get_field('header_cta_text', 'option'); ?>
                    </a>
                </div>
            </div>
            <div class="cta_header_ar hide_mobile_ar">
                <a href="<?php echo get_field('header_cta_link', 'option'); ?>">
                    <?php echo get_field('header_cta_text', 'option'); ?>
                </a>
            </div>
            <div class="mobile_menu_toggler_ar" id="mobile_menu_toggler_ar">
                <?php include get_template_directory() . '/assets/img/toggle.svg' ?>
            </div>
        </nav>
    </div>
</header>