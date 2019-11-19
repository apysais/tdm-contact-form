<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function tcf_dd($arr = [])
{
  echo '<pre>';
  print_r($arr);
  echo '</pre>';
}
function tcf_redirect_to($url) {
	?>
	<script type="text/javascript">
		window.location = '<?php echo $url; ?>';
	</script>
	<?php
	die();
}

function mailtrap($phpmailer) {
  $phpmailer->isSMTP();
  $phpmailer->Host = 'smtp.mailtrap.io';
  $phpmailer->SMTPAuth = true;
  $phpmailer->Port = 2525;
  $phpmailer->Username = '03bb6f02053c14';
  $phpmailer->Password = 'b34291b889be14';
}

add_action('phpmailer_init', 'mailtrap');
