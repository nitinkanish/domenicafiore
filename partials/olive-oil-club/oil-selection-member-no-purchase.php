<?php
  $user_id = get_current_user_id();
  $membership_plan_id = 572;
  $old_membership_plan_id = 6229;

  if ( wc_memberships_is_user_active_member( $user_id, $old_membership_plan_id ) ) {
    $membership = wc_memberships_get_user_membership( $user_id, 'olive-oil-club' );
  } else {
    $membership = wc_memberships_get_user_membership( $user_id, 'olive-oil-club-2019' );
  }

  $membership_start =  date('F j, Y', strtotime($membership->get_start_date()));
  $membership_expiry = date('F j, Y', strtotime($membership->get_end_date()));
?>

<div class="container oil-selection member-no-purchase">
  <div class="row">
    <div class="col-12">
      <h4><?php _e( 'Your Membership', 'domenicafiore' ); ?></h4>
    </div>
  </div>
  <div class="row">
    <div class="member-since col-12 col-sm-6">
      <p><?php printf( __( 'Member since %s', 'domenicafiore' ), $membership_start ); ?></p>
    </div>
    <div class="your-oil-selection col-12 col-sm-6">
      <p><?php printf( __( 'Your next annual oil selection can be purchased on %s', 'domenicafiore' ), $membership_expiry ); ?></p>
    </div>
  </div>
</div>
