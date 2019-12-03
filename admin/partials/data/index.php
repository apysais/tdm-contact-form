<div class="wrap">
  <h1>Data</h1>

  <div class="bootstra-iso">
    <ul class="list-group" id="accordion">
      <?php foreach($store_db as $k => $v){ ?>
        <li class="list-group-item" >
          <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-<?php echo $k;?>" aria-expanded="true" aria-controls="collapse-<?php echo $k;?>">
            Data # <?php echo $k;?>
          </button>
          <a href="admin.php?page=tcf-data&_method=delete-data&meta_id=<?php echo $v->meta_id;?>&post_id=<?php echo $v->post_id;?>">Delete</a>
          <?php $meta_value = unserialize($v->meta_value); ?>
          <?php if(is_array($meta_value)){ ?>
                  <?php foreach($meta_value as $index_k => $index_v){ ?>
                          <div id="collapse-<?php echo $k;?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <p><?php echo $index_v['label']; ?> : <?php echo $index_v['value']; ?></p>
                          </div>
                  <?php } ?>
          <?php } ?>
        </li>
      <?php } ?>

    </ul>
  </div>
</div>
