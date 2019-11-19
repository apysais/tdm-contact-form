<div class="wrap">
  <h1>Settings</h1>
  <form method="post" action="admin.php?page=tcf-settings">
    <input type="hidden" name="_method" value="update-settings">
    <?php TCF_View::get_instance()->admin_partials('settings/google-recaptcha-v3.php', $data); ?>
    <input type="submit" name="Update" value="Update">
  </form>
</div>
