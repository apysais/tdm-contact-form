<?php if($notify){ ?>
  <ul>
    <?php foreach($notify as $k => $v){ ?>
            <li class="warning"><?php echo $v;?></li>
    <?php } ?>
  </ul>
<?php } ?>
