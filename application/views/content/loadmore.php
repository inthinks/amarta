
<?php foreach($data as $row) {?>
<?php 
      if(!empty($row['data'])){
          $p =  $row['data'];
          $a = explode("/", $p);
          $b = str_replace('watch?v=','',$a[3]);
?>
<li>
  <div class="galleryImgBox">
      <div class="galleryImg">
      <a href="#" onClick="show_popup_video(<?php echo $row['id'];?>);"><img src="http://img.youtube.com/vi/<?php echo $b; ?>/mqdefault.jpg"></a>
      </div>
  </div>
  <div class="galleryName">
    <a href="#" onClick="show_popup_gallery(<?php echo $row['id'];?>);"><?php echo $row['name'];?></a>
  </div>
</li>
<?php } else { ?>

<li>
	<div class="galleryImgBox">
      <div class="galleryImg">
        <a href="javascript:void(0);" onClick="show_popup_gallery(<?php echo $row['id'];?>);">
        <img src="<?php echo base_url('userdata/image_item/thumbs')."/".$row['image'];?>">
      </a>
      </div>
    </div>
    <div class="galleryName">
        <a href="javascript:void(0);" onClick="show_popup_video(<?php echo $row['id'];?>);"><?php echo $row['name'];?></a>
    </div>
</li>
<?php } } ?>	