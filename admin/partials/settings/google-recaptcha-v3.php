<h3>Recaptcha V3</h3>
<table class="form-table" role="presentation">
  <tbody>
    <tr>
      <th scope="row"><label for="">Site Key</label></th>
      <td>
        <input name="tcf_recaptcha_v3_site_key" type="text" id="tcf_recaptcha_v3_site_key" class="regular-text" value="<?php echo $data['recaptcha']['site_key'];?>">
        <p class="description" id="tagline-description">Put in Recaptcha v3 site key</p>
      </td>
    </tr>
    <tr>
      <th scope="row"><label for="">Secret Key</label></th>
      <td>
        <input name="tcf_recaptcha_v3_secret_key" type="text" id="tcf_recaptcha_v3_secret_key" value="<?php echo $data['recaptcha']['secret_key'];?>" class="regular-text">
        <p class="description" id="tagline-description">Put in Recaptcha v3 Secret key</p>
      </td>
    </tr>
    <tr>
      <th scope="row"><label for="">Score</label></th>
      <td>
        <input name="tcf_recaptcha_v3_score" type="text" id="tcf_recaptcha_v3_score" value="<?php echo $data['recaptcha']['score'];?>" class="regular-text">
        <p class="description" id="tagline-description">reCAPTCHA v3 returns a score (1.0 is very likely a good interaction, 0.0 is very likely a bot). Based on the score, you can take variable action in the context of your site. Every site is different, but below are some examples of how sites use the score. As in the examples below, take action behind the scenes instead of blocking traffic to better protect your site.</p>
      </td>
    </tr>
  </tbody>
</table>
