<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function tcf_search_replace_subject($string, $arr_post_values)
{
  $objParseMailInput = new TCF_Mail_ParseMailInput;
  $ret = $objParseMailInput->extractBracket($string, $arr_post_values);

  return $objParseMailInput->replace($ret['search'], $ret['replace'], $string);
}

function tcf_search_replace_message($string, $arr_post_values)
{
  $objParseMailInput = new TCF_Mail_ParseMailInput;
  $ret = $objParseMailInput->extractBracket($string, $arr_post_values);

  return $objParseMailInput->replace($ret['search'], $ret['replace'], $string);
}
