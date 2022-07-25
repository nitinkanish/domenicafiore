<?php
  // Get menus
  $premium_oils_items     = df_get_menu_items('main-shop-premium-oils');
  $everyday_oils_items    = df_get_menu_items('main-shop-everyday-oils');
  $tomato_sauces_items    = df_get_menu_items('main-shop-tomato-sauces');
  $vinegars_items         = df_get_menu_items('main-shop-vinegars');
  // $honey_items            = df_get_menu_items('main-shop-honey');
  $gift_baskets_items     = df_get_menu_items('main-shop-gift-baskets');
  $olive_oil_club_items   = df_get_menu_items('main-shop-olive-oil-club');
  $account_items          = df_get_menu_items('main-shop-account');

  $company_about_items    = df_get_menu_items('main-company-about');
  $company_second_items   = df_get_menu_items('main-company-second');
  $company_third_items    = df_get_menu_items('main-company-third');
  $company_fourth_items   = df_get_menu_items('main-company-fourth');
  $company_fifth_items    = df_get_menu_items('main-company-fifth');

  // var_dump( $premium_oils_items );
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-sm">
  <button class="navbar-toggler m-top-0 m-bottom-auto" type="button" data-toggle="collapse" data-target="#navbar-first-level" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span></span>
  </button>

  <div class="collapse navbar-collapse" id="navbar-first-level">
    <ul class="navbar-nav mr-auto">
      <!-- Shop Tab -->
      <li class="nav-item">
        <a class="nav-link" id="shop-trigger" href="#shop-mega-menu" role="button"><?php _e( 'Shop', 'domenicafiore' ); ?></a>
      </li>
      <!-- Company Tab -->
      <li class="nav-item">
        <a class="nav-link" id="company-trigger" href="#company-mega-menu" role="button"><?php _e( 'About', 'domenicafiore' ); ?></a>
      </li>
      <li class="nav-item d-none d-sm-block">
        <a class="nav-link" href="<?php echo df_get_translated_permalink_by_slug('contact'); ?>"><?php _e( 'Contact', 'domenicafiore' ); ?></a>
      </li>
    </ul>

    <!-- Shop "Mega" Menu -->
    <div class="container-fluid collapse df-mega-menu" id="shop-mega-menu" data-parent="#navbar-first-level">
      <div class="row">

        <div class="col df-mega-menu-column">
          <!-- Premium Olive Oils -->
          <div class="card premium-olive-oils">
            <div class="card-header" id="premium-olive-oils-header">
              <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#premium-olive-oils-collapse" aria-expanded="false" aria-controls="premium-olive-oils-collapse">
                  <span class="text"><?php _e( 'Premium Olive Oils', 'domenicafiore' ); ?></span>
                  <div class="collapse-arrow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/collapse-arrow.svg" width="16"></div>
                </button>
              </h5>
            </div>
            <div id="premium-olive-oils-collapse" class="df-mega-collapse collapse navbar-expand-sm" aria-labelledby="premium-olive-oils-header" data-parent="#shop-mega-menu">
              <div class="card-body">
                <ul class="df-mega-menu-submenu">
                  <?php if (isset($premium_oils_items)): foreach ( (array) $premium_oils_items as $key => $menu_item ) : ?>
                    <?php $menu_item_classes = implode( '', $menu_item->classes ); ?>
                    <li class="df-mega-menu-link <?php echo $menu_item_classes; ?>">
                      <a href="<?php echo $menu_item->url; ?>">
                        <?php echo $menu_item->title; ?>
                      </a>
                    </li>
                  <?php endforeach; endif; ?>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="col df-mega-menu-column">
          <!-- Tomato Sauces -->
          <div class="card tomato-sauces">
            <div class="card-header" id="tomato-sauces-header">
              <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#tomato-sauces-collapse" aria-expanded="false" aria-controls="tomato-sauces-collapse">
                  <span class="text"><?php _e( 'Tomatoes', 'domenicafiore' ); ?></span>
                  <div class="collapse-arrow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/collapse-arrow.svg" width="16"></div>
                </button>
              </h5>
            </div>
            <div id="tomato-sauces-collapse" class="df-mega-collapse collapse navbar-expand-sm" aria-labelledby="tomato-sauces-header" data-parent="#shop-mega-menu">
              <div class="card-body">
                <ul class="df-mega-menu-submenu">
                  <?php if (isset($tomato_sauces_items)): foreach ( (array) $tomato_sauces_items as $key => $menu_item ) : ?>
                    <?php $menu_item_classes = implode( '', $menu_item->classes ); ?>
                    <li class="df-mega-menu-link <?php echo $menu_item_classes; ?>">
                      <a href="<?php echo $menu_item->url; ?>">
                        <?php echo $menu_item->title; ?>
                      </a>
                    </li>
                  <?php endforeach; endif; ?>
                </ul>
              </div>
            </div>
          </div>
          <!-- Vinegars -->
          <div class="card vinegars">
            <div class="card-header" id="vinegars-header">
              <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#vinegars-collapse" aria-expanded="false" aria-controls="vinegars-collapse">
                  <span class="text"><?php _e( 'Vinegars', 'domenicafiore' ); ?></span>
                  <div class="collapse-arrow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/collapse-arrow.svg" width="16"></div>
                </button>
              </h5>
            </div>
            <div id="vinegars-collapse" class="df-mega-collapse collapse navbar-expand-sm" aria-labelledby="vinegars-header" data-parent="#shop-mega-menu">
              <div class="card-body">
                <ul class="df-mega-menu-submenu">
                  <?php if (isset($vinegars_items)): foreach ( (array) $vinegars_items as $key => $menu_item ) : ?>
                    <?php $menu_item_classes = implode( '', $menu_item->classes ); ?>
                    <li class="df-mega-menu-link <?php echo $menu_item_classes; ?>">
                      <a href="<?php echo $menu_item->url; ?>">
                        <?php echo $menu_item->title; ?>
                      </a>
                    </li>
                  <?php endforeach; endif; ?>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="col df-mega-menu-column">
          <!-- Gift Collections -->
          <div class="card gift-collections">
            <div class="card-header" id="gift-collections-header">
              <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#gift-collections-collapse" aria-expanded="false" aria-controls="gift-collections-collapse">
                  <span class="text"><?php _e( 'Gifting', 'domenicafiore' ); ?></span>
                  <div class="collapse-arrow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/collapse-arrow.svg" width="16"></div>
                </button>
              </h5>
            </div>
            <div id="gift-collections-collapse" class="df-mega-collapse collapse navbar-expand-sm" aria-labelledby="gift-collections-header" data-parent="#shop-mega-menu">
              <div class="card-body">
                <ul class="df-mega-menu-submenu">
                  <?php if (isset($gift_baskets_items)): foreach ( (array) $gift_baskets_items as $key => $menu_item ) : ?>
                    <li class="df-mega-menu-link">
                      <a href="<?php echo $menu_item->url; ?>">
                        <?php echo $menu_item->title; ?>
                      </a>
                    </li>
                  <?php endforeach; endif; ?>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="col df-mega-menu-column">
          <!-- Subscriptions (Olive Oil Club) -->
          <div class="card subscriptions">
            <div class="card-header" id="subscriptions-header">
              <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#subscriptions-collapse" aria-expanded="false" aria-controls="subscriptions-collapse">
                  <span class="text"><?php _e( 'Subscriptions', 'domenicafiore' ); ?></span>
                  <div class="collapse-arrow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/collapse-arrow.svg" width="16"></div>
                </button>
              </h5>
            </div>
            <div id="subscriptions-collapse" class="df-mega-collapse collapse navbar-expand-sm" aria-labelledby="subscriptions-header" data-parent="#shop-mega-menu">
              <div class="card-body">
                <ul class="df-mega-menu-submenu">
                  <?php if (isset($olive_oil_club_items)): foreach ( (array) $olive_oil_club_items as $key => $menu_item ) : ?>
                    <?php $menu_item_classes = implode( '', $menu_item->classes ); ?>
                    <li class="df-mega-menu-link <?php echo $menu_item_classes; ?>">
                      <a href="<?php echo $menu_item->url; ?>">
                        <?php echo $menu_item->title; ?>
                      </a>
                    </li>
                  <?php endforeach; endif; ?>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="col df-mega-menu-column account-column">
          <ul class="df-mega-menu-submenu account">
            <?php if (isset($account_items)): foreach ( (array) $account_items as $key => $menu_item ) : ?>
              <?php $menu_item_classes = implode( '', $menu_item->classes ); ?>
              <li class="df-mega-menu-link <?php echo $menu_item_classes; ?>">
                <a href="<?php echo $menu_item->url; ?>">
                  <?php echo $menu_item->title; ?>
                </a>
              </li>
            <?php endforeach; endif; ?>
          </ul>
        </div>
      </div>
    </div>

    <!-- Company Mega Menu -->
    <div class="container-fluid collapse df-mega-menu" id="company-mega-menu"  data-parent="#navbar-first-level">
      <div class="row">

        <div class="col df-mega-menu-column">
          <!-- About -->
          <div class="card">
            <div class="card-header" id="about-header">
              <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#about-collapse" aria-expanded="false" aria-controls="about-collapse">
                  <span class="text"><?php _e( 'About', 'domenicafiore' ); ?></span>
                  <div class="collapse-arrow"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/collapse-arrow.svg" width="16"></div>
                </button>
              </h5>
            </div>
            <div id="about-collapse" class="df-mega-collapse collapse navbar-expand-sm" aria-labelledby="about-header" data-parent="#company-mega-menu">
              <div class="card-body">
                <ul class="df-mega-menu-submenu">
                  <?php if (isset($company_about_items)): foreach ( (array) $company_about_items as $key => $menu_item ) : ?>
                    <?php $menu_item_classes = implode( '', $menu_item->classes ); ?>
                    <li class="df-mega-menu-link">
                      <a href="<?php echo $menu_item->url; ?>">
                        <?php echo $menu_item->title; ?>
                      </a>
                    </li>
                  <?php endforeach; endif; ?>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="col df-mega-menu-column">
          <?php if (isset($company_second_items)): foreach ( (array) $company_second_items as $key => $menu_item ) : ?>
            <div class="df-mega-menu-link">
              <a href="<?php echo $menu_item->url; ?>"><?php echo $menu_item->title; ?></a>
            </div>
          <?php endforeach; endif; ?>
        </div>

        <div class="col df-mega-menu-column">
          <?php if (isset($company_third_items)): foreach ( (array) $company_third_items as $key => $menu_item ) : ?>
            <div class="df-mega-menu-link">
              <a href="<?php echo $menu_item->url; ?>"><?php echo $menu_item->title; ?></a>
            </div>
          <?php endforeach; endif; ?>
        </div>

        <div class="col df-mega-menu-column">
          <?php if (isset($company_fourth_items)): foreach ( (array) $company_fourth_items as $key => $menu_item ) : ?>
            <div class="df-mega-menu-link">
              <a href="<?php echo $menu_item->url; ?>"><?php echo $menu_item->title; ?></a>
            </div>
          <?php endforeach; endif; ?>
        </div>

        <div class="col df-mega-menu-column">
          <?php if (isset($company_fifth_items)): foreach ( (array) $company_fifth_items as $key => $menu_item ) : ?>
            <div class="df-mega-menu-link">
              <a href="<?php echo $menu_item->url; ?>"><?php echo $menu_item->title; ?></a>
            </div>
          <?php endforeach; endif; ?>
        </div>

      </div>
    </div>

    <div class="social-copyright-container d-sm-none">
  		<div class="social-media-links">
  			<!-- Facebook -->
  			<a href="http://www.facebook.com/pages/Domenica-Fiore-Organic-Olive-Oil">
  				<i class="fab fa-facebook"></i>
  			</a>
  			<!-- Instagram -->
  			<a href="https://www.instagram.com/domenica_fiore/">
  				<i class="fab fa-instagram"></i>
  			</a>
  			<!-- Twitter -->
  			<a href="https://twitter.com/domenica_fiore">
  				<i class="fab fa-twitter"></i>
  			</a>
  			<!-- YouTube -->
  			<a href="https://www.youtube.com/channel/UCJbsomOB_TtxPjuBGcG-9yg">
  				<i class="fab fa-youtube"></i>
  			</a>
  		</div>
  		<p class="copyright">&copy; <?php echo date('Y'); ?> Domenica Fiore</p>
  	</div>

  </div> <!-- #navbar-first-level (collapse) -->

  <div class="navbar-brand">
    <a href="<?php echo df_get_translated_permalink_by_slug('home'); ?>">
      <img class="logo-sm d-none d-sm-block" src="<?php echo get_stylesheet_directory_uri(); ?>/img/domenica-fiore-logo.svg" alt="Domenica Fiore" width="85">
      <img class="logo-xs d-sm-none" src="<?php echo get_stylesheet_directory_uri(); ?>/img/domenica-fiore-wordmark.svg" alt="Domenica Fiore" width="91">
    </a>
  </div>

  <ul class="secondary-nav navbar-nav ml-auto">
    <li class="nav-item search">
      <!-- Search -->
      <a id="search-link" class="nav-link" data-toggle="collapse" href="#nav-search-collapse" role="button" aria-expanded="false" aria-controls="nav-search-collapse">
        <span class="nav-link-label d-none d-sm-inline-block"><?php _e( 'Search', 'domenicafiore' ); ?> </span>
        <div class="nav-icon search">
          <img class="d-sm-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/img/nav-search.svg" width="13" alt="Search">
        </div>
      </a>
      <div id="nav-search-collapse" class="search-dropdown collapse">
        <?php get_search_form(); ?>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo df_get_translated_permalink_by_slug('account'); ?>">
        <span class="nav-link-label d-none d-sm-inline-block"><?php _e( 'Account', 'domenicafiore' ); ?> </span>
        <div class="nav-icon account">
          <img class="d-sm-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/img/nav-account.svg" width="9" alt="Account">
        </div>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo df_get_translated_permalink_by_slug('basket'); ?>">
        <span class="nav-link-label d-none d-sm-inline-block"><?php _e( 'Basket', 'domenicafiore' ); ?> </span>
        <div class="nav-icon basket">
          <img class="d-sm-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/img/nav-basket.svg" width="14" alt="Basket">
          <?php if( WC()->cart->get_cart_contents_count() > 0 ) : ?>
            <div class="basket-badge">
              <?php echo WC()->cart->get_cart_contents_count(); ?>
            </div>
          <?php endif; ?>
        </div>
      </a>
    </li>
    <!-- Language Switcher (Mobile Only) -->
    <?php
      $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );
      if( !empty( $languages ) ) :
    ?>
    <li class="nav-item language d-sm-none">
      <div class="language-select dropdown">
        <div class="btn-group">
          <button type="button" class="language-select-button dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php foreach( $languages as $language ){ ?>
                <?php if ($language['active']) { ?>
                  <span class="language-flag">
                    <img src="<?php echo $language['country_flag_url']; ?>" alt="<?php echo $language['native_name']; ?>" width="18" height="12">
                  </span>
                <?php } ?>
              <?php } ?>
          </button>
          <div class="dropdown-menu dropdown-menu-right">
            <?php foreach( $languages as $language ){ ?>
              <a href="<?php echo $language['url']; ?>" class="dropdown-item">
                <span class="language-flag">
                  <img src="<?php echo $language['country_flag_url']; ?>" alt="<?php echo $language['native_name']; ?>">
                </span>
                <span class="language-abbrev"><?php echo $language['native_name']; ?></span>
              </a>
            <?php } ?>
          </div>
        </div>
      </div>
    </li>
    <?php endif; ?>
  </ul>
</nav>
