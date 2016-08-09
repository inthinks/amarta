<div class="aboutWrapper inspirasi">
	<div class="aboutImage imageInspirasi">
    	<img class="desktop" src="<?php echo base_url();?>templates/images/inspirasi_design.jpg">
    	<img class="mobile" src="<?php echo base_url();?>templates/images/inspirasi_design_mobile.jpg">
    </div>
    <div class="aboutInfoBox idBox">
        <div class="idContent">
            <?php foreach ($inspires as $list) { ?>
            <h4><?php echo $list['title']; ?></h4>
            <p><?php echo $list['description']; ?></p>            
            <?php } ?>
        </div>
    </div>
</div>

