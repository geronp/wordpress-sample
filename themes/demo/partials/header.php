<?php get_header(); ?>
<header class="header">
  <?php include "announcement-bar.php"; ?>
  <?php include "eyebrow-bar.php"; ?>

  <?php

  $header_primary_cta  = get_field('header_primary_cta', 'option');
  $header_secondary_cta = get_field('header_secondary_cta', 'option');
  $see_all_products_button = get_field('header_see_all_products_button', 'option');


  // Industry Submenu Items
  $submenu['real-estate']['parents'] = get_permalink_by_slug('commercial-real-estate', 'page');
  $submenu['precision-location']['parents'] = get_permalink_by_slug('location-intelligence', 'page');
  

  $args = array(
    'hide_empty' => 0,
    'taxonomy' => 'byindustry',
    'orderby' => 'name',
    'order'   => 'ASC'
  );
  $industries = get_categories($args);

  if (is_array($industries) && count($industries)) {
    foreach ($industries as $item) {
      $group = get_field("taxonomy_group", $item);
      if (isset($group['value'])) {
        switch ($group['value']) {
          case 'cre':
            $submenu['real-estate']['children'][] = $item;
            break;
          case 'pl':
            $submenu['precision-location']['children'][] = $item;
            break;
        }
      }
    }
  }

  // Product Submenu Items
  $args = array(
    'hide_empty' => 0,
    'taxonomy' => 'productcategory',
    'orderby' => 'name',
    'order'   => 'ASC'
  );
  $product_cats = get_categories($args);

  foreach ($product_cats as $cat) {
    $args = array(
      'post_type' => 'product',
      'tax_query' => array(
        array(
          'taxonomy' => 'productcategory',
          'field' => 'term_id',
          'terms' => $cat->term_id
        )
      ),
      'orderby' => 'post_title',
      'order'   => 'ASC'
    );
    $query = new WP_Query($args);
    $submenu[$cat->slug] = $query->posts;
  }
  ?>

  <nav id="lightbox-nav" class="navbar navbar-expand-xl navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="<?= home_url(); ?>">
        <?php
        $logo = get_field('logo', 'option'); ?>
        <img class="logo" src="<?= esc_url($logo['url']); ?>" alt="LightBox logo" />
      </a>

      <button class="search-mobile d-xl-none" type="button">
        <img src="/wp-content/themes/lightbox/assets/images/ico-search.svg">
      </button>

      <div class="mob-search-bar ms-auto w-100 d-none" id="mobSearchBar">
        <div class="search-box">
          <?php get_search_form(); ?>
        </div>
      </div>

      <button class="toggle-menu d-xl-none" type="button">
        <i class="icon-bars" title="Menu"></i>
      </button>

      <!-- Mobile -->
      <div class="mobile-menu-wrapper d-xl-none" id="mobile-menu">
        <div class="list-wrapper">
          <ul class="menu level-1">
            <li>
              <a href="" class="nested">Industries & Roles</a>
              <ul class="sub-menu level-2">
                <li>
                  <?php if (isset($submenu['real-estate']['children']) && count($submenu['real-estate']['children'])) { ?>
                      <h6><a href="<?php echo get_permalink_by_slug('commercial-real-estate', 'page'); ?>">Commercial Real Estate</a></h6>
                    <ul>
                      <?php foreach ($submenu['real-estate']['children'] as $item) { ?>
                        <li><a href="/industry/<?= $item->slug ?>/"><?= $item->name ?></a></li>
                      <?php } ?>
                    </ul>
                  <?php } ?>

                  <?php if (isset($submenu['precision-location']['children']) && count($submenu['precision-location']['children'])) { ?>
                      <h6><a href="/industries/location-intelligence/">Location Intelligence</a></h6>
                    <ul class="">
                      <?php foreach ($submenu['precision-location']['children'] as $item) { ?>
                        <li><a href="/industry/<?= $item->slug ?>/"><?= $item->name ?></a></li>
                      <?php } ?>
                    </ul>
                  <?php } ?>
                </li>
              </ul>
            </li>
            <li>
              <a href="" class="nested">Products</a>
              <ul class="sub-menu level-2">
                <li>
                  <?php if (isset($submenu['location-intelligence']) && count($submenu['location-intelligence'])) { ?>
                      <h6><a href="<?=get_term_link( 'location-intelligence', 'productcategory');?>">Location Intelligence</a></h6>
                    <ul>
                      <?php foreach ($submenu['location-intelligence'] as $item) { ?>
                        <li><a href="<?= get_permalink($item->ID) ?>"><?= $item->post_title ?></a></li>
                      <?php } ?>
                    </ul>
                  <?php } ?>

                  <?php if (isset($submenu['due-diligence']) && count($submenu['due-diligence'])) { ?>
                    <h6><a href="<?=get_term_link( 'due-diligence', 'productcategory');?>">Due Diligence</a></h6>
                    <ul class="">
                      <?php foreach ($submenu['due-diligence'] as $item) { ?>
                        <li><a href="<?= get_permalink($item->ID) ?>"><?= $item->post_title ?></a></li>
                      <?php } ?>
                    </ul>
                  <?php } ?>

                  <?php if (isset($submenu['brokers-and-investors']) && count($submenu['brokers-and-investors'])) { ?>
                      <h6><a href="<?=get_term_link( 'brokers-and-investors', 'productcategory');?>">Brokers & Investors</a></h6>
                    <ul class="">
                      <?php foreach ($submenu['brokers-and-investors'] as $item) { ?>
                        <li><a href="<?= get_permalink($item->ID) ?>"><?= $item->post_title ?></a></li>
                      <?php } ?>
                    </ul>
                  <?php } ?>

                  <?php if (isset($submenu['lending']) && count($submenu['lending'])) { ?>
                      <h6><a href="<?=get_term_link( 'lending', 'productcategory');?>">Lending</a></h6>
                    <ul class="">
                      <?php foreach ($submenu['lending'] as $item) { ?>
                        <li><a href="<?= get_permalink($item->ID) ?>"><?= $item->post_title ?></a></li>
                      <?php } ?>
                    </ul>
                  <?php } ?>

                  <a href="/products/" class="all-products">View all</a>
                </li>
              </ul>
            </li>
            <li>
              <a href="" class="nested">Data</a>
              <?php
              wp_nav_menu(
                array(
                  'menu' => 'data-footer',
                  'container' => 'ul',
                  'menu_class' => 'sub-menu level-2',
                )
              );
              ?>
            </li>
            <li>
              <a href="" class="nested">Insights</a>
              <?php
              wp_nav_menu(
                array(
                  'menu' => 'insight-footer',
                  'container' => 'ul',
                  'menu_class' => 'sub-menu level-2',
                )
              );
              ?>
            </li>
            <li>
              <a href="" class="nested">About</a>
              <?php
              wp_nav_menu(
                array(
                  'menu' => 'about-footer',
                  'container' => 'ul',
                  'menu_class' => 'sub-menu level-2',
                )
              );
              ?>
            </li>
            <?php if ($header_primary_cta) { ?>
              <li class="btn-wrapper top">
                <a class="btn btn-primary" href="<?= esc_url($header_primary_cta['url']); ?>" target="<?= esc_attr($header_primary_cta['target']); ?>"><?= esc_html($header_primary_cta['title']); ?></a>
              </li>
            <?php } ?>
            <?php if ($header_secondary_cta) { ?>
              <li class="btn-wrapper bottom">
                <a class="btn btn-outline-light" href="<?= esc_url($header_secondary_cta['url']); ?>" target="<?= esc_attr($header_secondary_cta['target']); ?>"><?= esc_html($header_secondary_cta['title']); ?></a>
                <ul class="sub-menu level-2">
                  <?php if (have_rows('header_login_menu_items', 'option')) : ?>
                    <?php while (have_rows('header_login_menu_items', 'option')) : the_row();
                      $header_login_menu_item  = get_sub_field('header_login_menu_item', 'option');
                      if ($header_login_menu_item) :
                        $header_login_menu_item_url = $header_login_menu_item['url'];
                        $header_login_menu_item_title = $header_login_menu_item['title'];
                        $header_login_menu_item_target = $header_login_menu_item['target'] ? $header_login_menu_item['target'] : '_self';
                    ?>
                        <li class="login-item">
                          <a href="<?= esc_url($header_login_menu_item_url); ?>" target="<?= esc_attr($header_login_menu_item_target); ?>" rel="noopener noreferrer"><?= esc_html($header_login_menu_item_title); ?></a>
                        </li>
                      <?php endif; ?>
                    <?php endwhile; ?>
                  <?php endif; ?>
                  <?php if (have_rows('header_login_menu_items_right_side', 'option')) : ?>
                    <?php while (have_rows('header_login_menu_items_right_side', 'option')) : the_row();
                      $header_login_menu_item  = get_sub_field('header_login_menu_item', 'option');
                      if ($header_login_menu_item) :
                        $header_login_menu_item_url = $header_login_menu_item['url'];
                        $header_login_menu_item_title = $header_login_menu_item['title'];
                        $header_login_menu_item_target = $header_login_menu_item['target'] ? $header_login_menu_item['target'] : '_self';
                    ?>
                        <li class="login-item">
                          <a href="<?= esc_url($header_login_menu_item_url); ?>" target="<?= esc_attr($header_login_menu_item_target); ?>" rel="noopener noreferrer"><?= esc_html($header_login_menu_item_title); ?></a>
                        </li>
                      <?php endif; ?>
                    <?php endwhile; ?>
                  <?php endif; ?>
                  <li>
                    <div class="col-12 col-md-12 all-products">
                      <a class="nav-link" type="button" href="/products/">View All ></a>
                    </div>
                  </li>
                </ul>
              </li>
            <?php } ?>
            <?php if (have_rows('mobile_header_nav_additional_links', 'option')) : ?>
              <?php while (have_rows('mobile_header_nav_additional_links', 'option')) : the_row();
                $mobile_header_nav_additional_link  = get_sub_field('mobile_header_nav_additional_link', 'option');
                if ($mobile_header_nav_additional_link) :
                  $mobile_header_nav_additional_link_url = $mobile_header_nav_additional_link['url'];
                  $mobile_header_nav_additional_link_title = $mobile_header_nav_additional_link['title'];
                  $mobile_header_nav_additional_link_target = $mobile_header_nav_additional_link['target'] ? $mobile_header_nav_additional_link['target'] : '_self';
              ?>
                  <li class="additional-links">
                    <a href="<?= esc_url($mobile_header_nav_additional_link_url); ?>" target="<?= esc_attr($mobile_header_nav_additional_link_target); ?>"><?= esc_html($mobile_header_nav_additional_link_title); ?></a>
                  </li>
                <?php endif; ?>
              <?php endwhile; ?>
            <?php endif;
            if (have_rows('header_nav_featured_products', 'option')) : ?>
              <?php while (have_rows('header_nav_featured_products', 'option')) : the_row();
                $header_nav_featured_product  = get_sub_field('header_nav_featured_product', 'option');
                if ($header_nav_featured_product) :
                  $header_nav_featured_product_url = $header_nav_featured_product['url'];
                  $header_nav_featured_product_title = $header_nav_featured_product['title'];
                  $header_nav_featured_product_target = $header_nav_featured_product['target'] ? $header_nav_featured_product['target'] : '_self';
              ?>
                  <li class="featured-product">
                    <a class="btn btn-outline-light" href="<?= esc_url($header_nav_featured_product_url); ?>" target="<?= esc_attr($header_nav_featured_product_target); ?>"><?= esc_html($header_nav_featured_product_title); ?></a>
                  </li>
                <?php endif; ?>
              <?php endwhile; ?>
            <?php endif; ?>
          </ul>
        </div>
        <div class="list-wrapper">
          <a href="" class="back-one-level">
            <span>Back</span>
          </a>
          <div class="sub-menu-wrapper"></div>
        </div>
        <div class="list-wrapper">
          <a href="" class="back-one-level">
            <span>Back</span>
          </a>
          <div class="sub-menu-wrapper"></div>
        </div>
      </div>

      <!-- Desktop -->
      <div class="collapse navbar-collapse d-none d-xl-block" id="main-menu">

        <div class="nav-search-bar ms-auto w-100 justify-content-end" id="navSearchBar">
          <div class="search-box">
            <?php get_search_form(); ?>
          </div>
        </div>

        <ul id="main-nav" class="nav navbar-nav ms-auto w-100 justify-content-end">
          <li id="menu-item-1" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children dropdown nav-item has-megamenu">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Industries & Roles</a>

            <div class="dropdown-menu megamenu" onclick="event.stopPropagation();">
              <div class="container">
                <div class="row">
                  <div class="col-12 col-md-3 col-xxl-2 d-none">
                    <div class="nav flex-column nav-pills" id="products-pills-tab" role="tablist" aria-orientation="vertical">

                      <a class="nav-link active" id="products-pills-industries-tab" data-bs-toggle="pill" data-bs-target="#products-pills-industries" type="button" role="tab" aria-controls="products-pills-industries" aria-selected="true">Industries &amp; Roles </a>

                      <a class="nav-link d-none" id="products-pills-tasks-tab" data-bs-toggle="pill" data-bs-target="#products-pills-tasks" type="button" role="tab" aria-controls="products-pills-tasks" aria-selected="false">View By Task</a>

                      <a class="nav-link" id="products-pills-all-tab" data-bs-toggle="pill" data-bs-target="#products-pills-all" type="button" role="tab" aria-controls="products-pills-all" aria-selected="false">Products</a>

                      <?php if (have_rows('header_nav_featured_products', 'option')) : ?>
                        <?php while (have_rows('header_nav_featured_products', 'option')) : the_row();
                          $header_nav_featured_product  = get_sub_field('header_nav_featured_product', 'option');
                          if ($header_nav_featured_product) :
                            $header_nav_featured_product_url = $header_nav_featured_product['url'];
                            $header_nav_featured_product_title = $header_nav_featured_product['title'];
                            $header_nav_featured_product_target = $header_nav_featured_product['target'] ? $header_nav_featured_product['target'] : '_self'; ?>
                            <a class="btn btn-outline-light d-none d-md-block" href="<?= esc_url($header_nav_featured_product_url); ?>" target="<?= esc_attr($header_nav_featured_product_target); ?>"><?= esc_html($header_nav_featured_product_title); ?></a>
                          <?php endif; ?>
                        <?php endwhile; ?>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="col">
                    <?php if (isset($submenu['real-estate']['children']) && count($submenu['real-estate']['children'])) { ?>
                        <h6>
                         <?php if(isset($submenu['real-estate']['parents']) && strlen($submenu['real-estate']['parents'])) { ?>
                            <a href="<?=$submenu['real-estate']['parents'] ?>">Commercial Real Estate</a>
                        <?php } else { ?>
                             Commercial Real Estate
                        <?php } ?>
                        </h6>
                      <ul class="submenu-list">
                        <?php foreach ($submenu['real-estate']['children'] as $item) { ?>
                          <li><a href="/industry/<?= $item->slug ?>/"><?= format_superscript_text($item->name) ?></a></li>
                        <?php } ?>
                      </ul>
                    <?php } ?>
                  </div>
                  <div class="col">
                    <?php if (isset($submenu['precision-location']['children']) && count($submenu['precision-location']['children'])) { ?>
                        <h6>
                         <?php if(isset($submenu['precision-location']['parents']) && strlen($submenu['precision-location']['parents'])) { ?>
                            <a href="/industries/location-intelligence/">Location Intelligence</a>
                         <?php } else { ?>
                             Location Intelligence
                         <?php } ?>
                        </h6>
                      <ul class="submenu-list">
                        <?php foreach ($submenu['precision-location']['children'] as $item) { ?>
                          <li><a href="/industry/<?= $item->slug ?>/"><?= format_superscript_text($item->name) ?></a></li>
                        <?php } ?>
                      </ul>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </li>

          <li id="menu-item-2" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children dropdown nav-item has-megamenu">
            <a href="/products/" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Products</a>

            <div class="dropdown-menu megamenu" onclick="event.stopPropagation();">
              <div class="container">
                <div class="row">
                  <div class="col">
                    <?php if (isset($submenu['location-intelligence']) && count($submenu['location-intelligence'])) { ?>
                        <h6><a href="<?=get_term_link( 'location-intelligence', 'productcategory');?>">Location Intelligence</a></h6>
                      <ul class="submenu-list">
                        <?php foreach ($submenu['location-intelligence'] as $item) { ?>
                          <li><a href="<?= get_permalink($item->ID) ?>"><?= format_superscript_text($item->post_title) ?></a></li>
                        <?php } ?>
                      </ul>
                    <?php } ?>
                    <?php if (isset($submenu['due-diligence']) && count($submenu['due-diligence'])) { ?>
                        <h6><a href="<?=get_term_link( 'due-diligence', 'productcategory');?>">Due Diligence</a></h6>
                      <ul class="submenu-list">
                        <?php foreach ($submenu['due-diligence'] as $item) { ?>
                          <li><a href="<?= get_permalink($item->ID) ?>"><?= format_superscript_text($item->post_title) ?></a></li>
                        <?php } ?>
                      </ul>
                    <?php } ?>
                  </div>
                  <div class="col">
                    <?php if (isset($submenu['brokers-and-investors']) && count($submenu['brokers-and-investors'])) { ?>
                        <h6><a href="<?=get_term_link( 'brokers-and-investors', 'productcategory');?>">Brokers & Investors</a></h6>
                      <ul class="submenu-list">
                        <?php foreach ($submenu['brokers-and-investors'] as $item) { ?>
                          <li><a href="<?= get_permalink($item->ID) ?>"><?= format_superscript_text($item->post_title) ?></a></li>
                        <?php } ?>
                      </ul>
                    <?php } ?>
                    <?php if (isset($submenu['lending']) && count($submenu['lending'])) { ?>
                        <h6><a href="<?=get_term_link( 'lending', 'productcategory');?>">Lending</a></h6>
                      <ul class="submenu-list">
                        <?php foreach ($submenu['lending'] as $item) { ?>
                          <li><a href="<?= get_permalink($item->ID) ?>"><?= format_superscript_text($item->post_title) ?></a></li>
                        <?php } ?>
                      </ul>
                    <?php } ?>

                    <a href="/products/" class="all-products">View all</a>
                  </div>
                </div>
              </div>
            </div>
          </li>

          <li id="menu-item-3" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children dropdown nav-item">
            <a href="/data/" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Data</a>
            <?php
            wp_nav_menu(
              array(
                'menu' => 'data-footer',
                'container' => 'ul',
                'menu_class' => 'dropdown-menu',
              )
            );
            ?>
          </li>

          <li id="menu-item-4" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children dropdown nav-item">
            <a href="/insights/" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Insights</a>
            <?php
            wp_nav_menu(
              array(
                'menu' => 'insight-footer',
                'container' => 'ul',
                'menu_class' => 'dropdown-menu',
              )
            );
            ?>
          </li>

          <li id="menu-item-5" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children dropdown nav-item">
            <a href="/about/" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">About</a>
            <?php
            wp_nav_menu(
              array(
                'menu' => 'about-footer',
                'container' => 'ul',
                'menu_class' => 'dropdown-menu',
              )
            );
            ?>
          </li>

          <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children dropdown nav-item">
            <a href="#" class="nav-link search-desktop">
              <img src="/wp-content/themes/lightbox/assets/images/ico-search.svg" />
            </a>
          </li>
        </ul>

        <?php
        if ($header_secondary_cta) :
          $header_secondary_cta_url = $header_secondary_cta['url'];
          $header_secondary_cta_title = $header_secondary_cta['title'];
          $header_secondary_cta_target = $header_secondary_cta['target'] ? $header_secondary_cta['target'] : '_self';
        ?>
          <ul class="login-menu">
            <li>
              <a class="btn btn-outline-light btn-login dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="<?= esc_url($header_secondary_cta_url); ?>" target="<?= esc_attr($header_secondary_cta_target); ?>"><?= esc_html($header_secondary_cta_title); ?></a>
              <div class="dropdown-menu" onclick="event.stopPropagation();">
                <div class="container">
                  <div class="row content">
                    <div class="col-12 col-md-6">
                      <ul class="">
                        <?php if (have_rows('header_login_menu_items', 'option')) : ?>
                          <?php while (have_rows('header_login_menu_items', 'option')) : the_row();
                            $header_login_menu_item  = get_sub_field('header_login_menu_item', 'option');
                            if ($header_login_menu_item) :
                              $header_login_menu_item_url = $header_login_menu_item['url'];
                              $header_login_menu_item_title = $header_login_menu_item['title'];
                              $header_login_menu_item_target = $header_login_menu_item['target'] ? $header_login_menu_item['target'] : '_self';
                          ?>
                              <li class="login-item">
                                <a href="<?= esc_url($header_login_menu_item_url); ?>" target="<?= esc_attr($header_login_menu_item_target); ?>" rel="noopener noreferrer"><?= esc_html($header_login_menu_item_title); ?></a>
                              </li>
                            <?php endif; ?>
                          <?php endwhile; ?>
                        <?php endif; ?>
                      </ul>
                    </div>

                    <div class="col-12 col-md-6">
                      <ul class="">
                        <?php if (have_rows('header_login_menu_items_right_side', 'option')) : ?>
                          <?php while (have_rows('header_login_menu_items_right_side', 'option')) : the_row();
                            $header_login_menu_item  = get_sub_field('header_login_menu_item', 'option');
                            if ($header_login_menu_item) :
                              $header_login_menu_item_url = $header_login_menu_item['url'];
                              $header_login_menu_item_title = $header_login_menu_item['title'];
                              $header_login_menu_item_target = $header_login_menu_item['target'] ? $header_login_menu_item['target'] : '_self';
                          ?>
                              <li class="login-item">
                                <a href="<?= esc_url($header_login_menu_item_url); ?>" target="<?= esc_attr($header_login_menu_item_target); ?>" rel="noopener noreferrer"><?= esc_html($header_login_menu_item_title); ?></a>
                              </li>
                            <?php endif; ?>
                          <?php endwhile; ?>
                        <?php endif; ?>
                      </ul>
                    </div>

                    <div class="col-12 col-md-12 all-products">
                      <a class="nav-link" type="button" href="/products/">View All ></a>
                    </div>
                  </div>

                </div>
                <ul class="dropdown-menu">
                  <?php if (have_rows('header_login_menu_items', 'option')) : ?>
                    <?php while (have_rows('header_login_menu_items', 'option')) : the_row();
                      $header_login_menu_item  = get_sub_field('header_login_menu_item', 'option');
                      if ($header_login_menu_item) :
                        $header_login_menu_item_url = $header_login_menu_item['url'];
                        $header_login_menu_item_title = $header_login_menu_item['title'];
                        $header_login_menu_item_target = $header_login_menu_item['target'] ? $header_login_menu_item['target'] : '_self';
                    ?>
                        <li class="login-item">
                          <a href="<?= esc_url($header_login_menu_item_url); ?>" target="<?= esc_attr($header_login_menu_item_target); ?>" rel="noopener noreferrer"><?= esc_html($header_login_menu_item_title); ?></a>
                        </li>
                      <?php endif; ?>
                    <?php endwhile; ?>
                  <?php endif; ?>
                  <li class="login-item"><a href="<?= esc_url($header_secondary_cta_url); ?>" type="button">View All ></a></li>
                </ul>
              </div>
            </li>
          </ul>
        <?php endif;
        $header_primary_cta  = get_field('header_primary_cta', 'option');
        if ($header_primary_cta) :
          $header_primary_cta_url = $header_primary_cta['url'];
          $header_primary_cta_title = $header_primary_cta['title'];
          $header_primary_cta_target = $header_primary_cta['target'] ? $header_primary_cta['target'] : '_self';
        ?>
          <a class="btn btn-primary mb-0" href="<?= esc_url($header_primary_cta_url); ?>" target="<?= esc_attr($header_primary_cta_target); ?>"><?= esc_html($header_primary_cta_title); ?></a>
        <?php endif; ?>
      </div>
    </div>
  </nav>

    <?php // Optional Subnav
        include "sub-nav.php";
    ?>

</header>
