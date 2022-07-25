<?php
  $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );
  if( !empty( $languages ) ) :
?>
<div class="language-select dropdown d-none d-sm-block">
  <div class="btn-group">
    <button type="button" class="language-select-button dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php foreach( $languages as $language ){ ?>
          <?php if ($language['active']) { ?>
            <span class="language-flag">
              <img src="<?php echo $language['country_flag_url']; ?>" alt="<?php echo $language['native_name']; ?>" width="18" height="12">
            </span>
            <span class="language-abbrev"><?php echo ucwords($language['language_code']); ?></span>
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
</div><!-- .language-select.dropdown -->
<?php endif; ?>
