<?php

function tcf_get_recaptcha_site_key()
{
  return TCF_ReCaptcha_Options::get_instance()->site_key([
    'action' => 'r'
  ]);
}

function tcf_get_recaptcha_secret_key()
{
  return TCF_ReCaptcha_Options::get_instance()->secret_key([
    'action' => 'r'
  ]);
}

function tcf_get_recaptcha_score()
{
  return TCF_ReCaptcha_Options::get_instance()->score([
    'action' => 'r',
    'default_value' => '0.5'
  ]);
}
