<?php
  $login_section = get_field('login_section');
?>

<?php if ( !is_user_logged_in() ) : ?>

  <!-- Sign In / Create Accout Form -->
  <div class="container-fluid sign-in" id="become-a-member">

    <?php get_template_part('woocommerce/myaccount/form-login-ooc'); ?>

  </div>

<?php else : ?><!-- User is logged in -->

  <!-- If user is already a member -->
  <?php
    $user_id = get_current_user_id();
    $current_user= wp_get_current_user();
    $customer_email = $current_user->email;
    $old_membership_plan_id = 572;
    $membership_plan_id = 6229;
    $membership_renewal_plan_id = 1798;

    if ( wc_memberships_is_user_active_member( $user_id, $membership_plan_id ) ||  wc_memberships_is_user_active_member( $user_id, $old_membership_plan_id ) ) {

      if ( wc_memberships_is_user_active_member( $user_id, $membership_plan_id ) || wc_memberships_is_user_active_member( $user_id, $old_membership_plan_id ) ) {

        // User is a member who has purchased an oil selection within the last year
        get_template_part('partials/olive-oil-club/oil-selection-member-no-purchase');

      } else {

        // User is a member who HAS NOT purchased an oil selection within the last year
        get_template_part('partials/olive-oil-club/oil-selection');

      }

    } else {

      // User is not a member
      get_template_part('partials/olive-oil-club/oil-selection');

    }
  ?>

<?php endif; ?>
