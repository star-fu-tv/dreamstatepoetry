<!-- EDIT SONG INFO-->

<div class="container edit-song-fragments">
  <nav class="row edit-song-fragments-nav">
    <ul class="nav nav-tabs">
      <li role="presentation" class="active"><a href="">Content</a></li>
      <li role="presentation"><a href="#">Senses</a></li>
      <li role="presentation"><a href="#">Thoughts</a></li>
    </ul>    
  </nav>
 
    <? 
      //pretty_var_dump($impressions);
      //pretty_var_dump($descriptors);
      $row_count = 0;
     ?>
    <? foreach($descriptors as $descriptor) { ?>
      
      <? if($row_count%3 == 0) { ?>
        <div class="row">
          <h3><?=$descriptor['descriptor_type']?></h3>
        </div>
        <div class="row row-eq-height">
      <? } ?>

        <div class="col-lg-4 descriptor-wrap descriptor-type-<?=$descriptor['descriptor_type']?>" data-descriptor-id="<?=$descriptor['id'];?>">
          <div class="panel panel-default">

            <div class="panel-heading">
              <h3 class="panel-title"><?=$descriptor['name']?></h3>
            </div>

            <div class="panel-body">

              <? foreach($impressions as $impression) { ?>
                
                <? if($impression['descriptor_id'] == $descriptor['id']) { ?>
                  <a href="ww"><?=$impression['fragment_text']?></a>
                <? } ?>  

              <? } ?>  

            </div>

            <div class="panel-footer">
              <form class="add-fragment-input-form row" id="add-fragment-<?=strtolower($descriptor['name']);?>" data-descriptor-id="<?=$descriptor['id']?>">
                <div class="input-group col-lg-12">
                  <input type="text" class="form-control" placeholder="New phrase or word..." id="add-fragment-input-<?=$descriptor['id']?>">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="submit"  id="add-fragment-submit-<?=$descriptor['id']?>">
                      <span class="glyphicon glyphicon-plus"></span>
                    </button>
                  </span>
                </div><!-- /input-group -->

              </form>

            </div>

          </div>      
        </div>  

      <? if($row_count%3 == 2) { ?>
        </div><!-- /row -->
      <? }
      $row_count++;
     } ?>     

  

</div><!-- /container -->

