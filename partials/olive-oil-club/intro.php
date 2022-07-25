<?php
  $hero_section = get_field('hero_section');
  $details_section = get_field('details_section');
  $show_button = true;
  if ( is_user_logged_in() ) :
    $user_id = get_current_user_id();
    $membership_plan_id = 572;
    $membership_renewal_plan_id = 1798;
    if ( wc_memberships_is_user_active_member( $user_id, $membership_renewal_plan_id ) ) :
      $show_button = false;
    elseif ( !wc_memberships_is_user_active_member( $user_id, $membership_renewal_plan_id ) && !wc_memberships_is_user_active_member( $user_id, $membership_plan_id ) ) :
      $show_button = false;
    endif;
  endif;
?>

<div class="container-fluid hero">
  <div class="row">
    <div class="col-12 hero-column">
      <div class="container-size-element"></div>
      <div class="image-container-desktop d-none d-sm-block" style="background-image:url('<?php echo $hero_section['hero_image_desktop'] ?>');"></div>
      <div class="image-container-mobile d-block d-sm-none" style="background-image:url('<?php echo $hero_section['hero_image_mobile'] ?>');"></div>
      <div class="text-container">
        <h1><?php echo $hero_section['hero_title'] ?></h1>
        <p><?php echo $hero_section['intro_text'] ?></p>
        <?php if ( $show_button) : ?>
          <a class="btn btn-green" href="<?php echo $hero_section['button']['url'] ?>"><?php echo $hero_section['button']['title'] ?></a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid details">
  <div class="row">
    <div class="col-12 content-column">
      <div class="first-section">
        <?php echo $details_section['first_section_content']; ?>
      </div>
      <div class="image-mobile d-block d-lg-none">
        <img src="<?php echo $details_section['image_mobile']; ?>">
      </div>
      <div class="second-section">
        <?php echo $details_section['second_section_content']; ?>
        <a class="btn-become-a-member" href="<?php echo $hero_section['button']['url'] ?>">
          <?php echo $hero_section['button']['title'] ?>
          <svg class="button-arrow" width="16" height="25" viewBox="0 0 16 25">
            <polygon class="arrow" points="16 13.16 0 25 0 0 16 13.16"/>
          </svg>
          </a>
      </div>
    </div>
    <div class="desktop-image-column d-none d-lg-block">
      <img class="desktop-image" src="<?php echo $details_section['image_desktop']; ?>">
      <img class="large-desktop-image" src="<?php echo $details_section['image_large_desktop']; ?>">
    </div>
  </div>
</div>
