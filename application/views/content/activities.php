
    <div class="activitiesWrapper">
    <div class="slider">
    	<ul class="activities">
    	<?php foreach($activity as $activitys) { ?>
        	<li><a href="<?php echo $activitys['link'];?>" target="_blank">
			<?php if($activitys['img_mobile']!='' && $activitys['image']!=''){ ?><img src="<?php echo base_url('userdata/activity').'/'.$activitys['img_mobile'];?>" class="mobile"><img src="<?php echo base_url('userdata/activity').'/'.$activitys['image'];?>" class="desktop"><?php } else { ?>        	
        	<?php if($activitys['image']==''){ ?><img src="<?php echo base_url('userdata/activity').'/'.$activitys['img_mobile'];?>" class="mobile"><?php } ?>
        	<?php if($activitys['img_mobile']==''){ ?><img src="<?php echo base_url('userdata/activity').'/'.$activitys['image'];?>" class="desktop"><?php } ?>
        	<?php } ?>

        	</a></li>
        <?php } ?>
        </ul>
    </div>
    </div>


