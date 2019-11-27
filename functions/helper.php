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

/**
* Split string by new line and store as array.
* @param string $string
* @return array
**/
function tcf_split_by_newline($string) {
	return preg_split("/\r\n|\n|\r/", $string);
}

function tcf_get_contact_form_inputs($string)
{
  $inputObj = new TCF_ContactForm_Input_Input;
  $inputObj->setFieldInput($string);
  $get = $inputObj->getFieldInput();

  $arr_get = [];
  if(isset($get[1])){
    $arr_get = $get[1];
  }

  $parseObj = new TCF_ContactForm_Input_Parse;
  $parse_fields = $parseObj->get($arr_get);

  $replaceObj = new TCF_ContactForm_Input_Replace;
  $replace = $replaceObj->replace($parse_fields);
  $form_content = str_replace($replace['search'], $replace['replace'], $string);

  return html_entity_decode($form_content);
}

function tcf_get_form_inputs($post_id)
{
	$form_input = TCF_ContactForm_MetaBox_PostMeta::get_instance()->form_input([
		'post_id' => $post_id,
		'action' => 'r',
		'single' => 1,
	]);
	return wpautop($form_input);
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
