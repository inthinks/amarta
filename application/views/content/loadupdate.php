<?php foreach ($updates as $update) {?>
	<div class="smallUpdates">
    	<div class="smallUpdatesImg">
        	<a href="javascript:void(0);" onClick="update_content(<?= $update['id']?>);"><img src="<?php echo base_url('userdata/update/')."/".$update['image'];?>"></a>
        </div>
        <div class="smallUpdatesInfo">
            <h4><a href="javascript:void(0);" onClick="update_content(<?= $update['id']?>);"><?php echo $update['title']; ?></a></h4>
            <p><?php echo substr($update['short_desc'],0,300)."..."; ?></p>
            <a href="javascript:void(0);" class="readMore" id="read" onClick="update_content(<?= $update['id']?>);">Read more</a>
        </div>
    </div>
<?php } ?>