<?php
function tcf_dd($arr = [])
{
  echo '<pre>';
  print_r($arr);
  echo '</pre>';
}

function tcf_get_fields_input($string){
  preg_match_all('~\[(.+?)\]~', $string, $matches);
  return $matches;
}

function tcf_get_input_type($str) {
  $accepted_inputs = ['text', 'submit'];
  $type = false;

  preg_match('~input:(.*?)\s~', $str, $output);

  if(isset($output[1]) && $output[1] != '' ){
    $type = $output[1];
  }

  if($type && in_array($type, $accepted_inputs)){
    return $type;
  }

  return false;
}

function tcf_check_if_required($string)
{
  $is_required = false;
  if(preg_match("~\brequire\b~", $string, $matches)){
    return true;
  }
  return false;
}

function tcf_check_if_email($string)
{
  $is_email = false;
  if(preg_match("~\bemail-format\b~", $string, $matches)){
    $is_email = true;
  }
  return $is_email;
}

function tcf_get_input_class($string) {
  $class = false;
  //preg_match('~class:(.*?)\s~', $string, $output);
  preg_match_all('/class:"(.*?)"/', $string, $output);
  if(isset($output[1][0]) && $output[1][0] != '' ){
    $class = $output[1][0];
  }
  return $class;
}

function tcf_get_input_id($string) {
  $id = false;
  preg_match('~id:(.*?)\s~', $string, $output);
  if(isset($output[1]) && $output[1] != '' ){
    $id = $output[1];
  }
  return $id;
}

function tcf_get_name($string) {
  $name = false;
  preg_match('~name:(.*?)\s~', $string, $output);
  if(isset($output[1]) && $output[1] != '' ){
    $name = $output[1];
  }
  return $name;
}

function tcf_get_label($string) {
  $label = false;
  preg_match_all('/label:"(.*?)"/', $string, $output);

  if(isset($output[1][0]) && $output[1][0] != '' ){
    $label = $output[1][0];
  }
  return $label;
}

function convert_field_input($args = []){
  $type = '';
  if(isset($args['type'])){
    $type = $args['type'];
  }

  $name = '';
  if(isset($args['name'])){
    $name = $args['name'];
  }

  $label = '';
  if(isset($args['label'])){
    $label = $args['label'];
  }

  $class = '';
  if(isset($args['class'])){
    $class = $args['class'];
  }

  $id = '';
  if(isset($args['id'])){
    $id = $args['id'];
  }

  $is_require = '';
  if(isset($args['is_require']) && $args['is_require']){
    $is_require = 'require';
  }

  $is_email = 0;
  if(isset($args['is_email']) && $args['is_email']){
    $is_email = 'is_email';
  }

  switch($type) {
    case 'text':
        $type = 'text';
        if($is_email){
          $type = 'email';
        }
        $str_name = $name;
        if($is_require != ''){
          $str_name = 'name:'.$name.',require:y';
        }
        $input = htmlentities('<input type="'.$type.'" name="'.$str_name.'" id="'.$id.'" class="'.$class.'" '.$is_require.' value="">');
        return $input;
      break;
    case 'submit':
      $input = htmlentities('<input type="submit" value="'.$label.'">');
      return $input;
      break;
  }
}

function tcf_parse_each_input($arr_inputs) {
  $data = [];

  if(is_array($arr_inputs)){
    foreach($arr_inputs as $k => $v){
      $white_space_v = ' '.$v.' ';
      $check_valid_input = tcf_get_input_type($white_space_v);
      if($check_valid_input){
        $str = '['.$v.']';
        $white_space_v = ' '.$v.' ';
        $data[] = [
          'input' => $check_valid_input,
          'is_require' => tcf_check_if_required($white_space_v),
          'is_email' => tcf_check_if_email($white_space_v),
          'label' => tcf_get_label($white_space_v),
          'name' => tcf_get_name($white_space_v),
          'class' => tcf_get_input_class($white_space_v),
          'id' => tcf_get_input_id($white_space_v),
          'fields_str' => $str,
          'convert_field' => convert_field_input([
            'type' => $check_valid_input,
            'is_require' => tcf_check_if_required($white_space_v),
            'is_email' => tcf_check_if_email($white_space_v),
            'label' => tcf_get_label($white_space_v),
            'name' => tcf_get_name($white_space_v),
            'class' => tcf_get_input_class($white_space_v),
            'id' => tcf_get_input_id($white_space_v),
          ])
        ];
      }
    }//foreach loop
  }//if

  return $data;
}

function tcf_replace($arr) {
  $search_arr = [];
  $replace_arr = [];
  foreach($arr as $k => $v){
    $search_arr[] = $v['fields_str'];
    $replace_arr[] = $v['convert_field'];
  }
  return $replace = [
    'search' => $search_arr,
    'replace' => $replace_arr,
  ];
}

$string = '<p>hello, </p> <p>[this is not] this is</p> <p>[input:text require name:my-name id:dasdsadasd class:"das dad-dddd" placeholder "asd"]</p>, <p>i am [input:text class:"xxx" require email-format name:email]</p> <p>[input:text name:age]</p> <p>[not valid] years old</p> <p>[input:submit label:"Send THis"]</p>';
$get = tcf_get_fields_input($string);
$arr_get = [];

if(isset($get[1])){
  $arr_get = $get[1];
}
echo $string;
tcf_dd($get[0]);
$parse_fields = tcf_parse_each_input($arr_get);
tcf_dd($parse_fields);
$replace = tcf_replace($parse_fields);
//tcf_dd($replace);
$newphrase = str_replace($replace['search'], $replace['replace'], $string);
//$bodytag = str_replace('[input:text require name:my-name id:dasdsadasd class:das-dasd placeholder "asd"]', '<input type="text">', $string);
echo '<form name="contact" action="test.php" method="post">';
echo html_entity_decode($newphrase);
echo '</form>';
