<form action="<?php the_permalink(); ?>" method="post" autocomplete="off" name="tcf-contact-form" id="contactFormSimple" class="tcf-contact-form">
  <?php TCF_ContactForm_Notification::get_instance()->getNotifyError(); ?>
  <?php TCF_ContactForm_Notification::get_instance()->getNotifyInfo(); ?>

  <?php TCF_View::get_instance()->public_partials('shortcode/basic-input.php', $data); ?>

  <?php TCF_View::get_instance()->public_partials('shortcode/honeypot-input.php', $data); ?>
  <input type="hidden" name="tcf-form-submit" value="1">
  <input type="hidden" name="tcf-form-post-id" value="<?php echo $contact_post_id;?>">
  <?php wp_nonce_field( 'tcf_submit_form_action_' . $contact_post_id, 'tcf_submit_nonce_field' ); ?>
  <?php do_action('tcf_bottom_form_inside'); ?>
</form>
