
<div class="homeBanner">
        <div id="slider" class="owl-carousel owl-theme">
            <?php foreach ($banner as $banners ) { ?>
            <div class="sliderBox">
                    <a href="<?php echo $banners['link'];?>" class="desktop"><img src="<?php echo base_url('userdata/banner/')."/".$banners['image'];?>"></a>
                    <a href="<?php echo $banners['link'];?>" class="mobile"><img src="<?php echo base_url('userdata/banner/')."/".$banners['image'];?>"></a>
            </div>
            <?php } ?>
        </div>
        <div class="actionBtn">
                <div class="prevButton"></div>
                <div class="nextButton"></div>
            </div>
</div>
<div class="smallBanner">
    <ul>
        <?php foreach ($small as $smalls ) { ?>
        <li>
            <div class="imageBannerBox" >
                <div class="imageBanner">
                    <img src="<?php echo base_url('userdata/small_banner/')."/".$smalls['image']; ?>">
                </div>
            </div>
            <div class="imageInfo">
                <div class="imageInfoBox">
                    <a href="<?php echo $smalls['link'];?>" class="imageInfowrapp" <?php if($smalls['behavior']==1){ echo 'target="_blank"';}?> >
                        <h3><?php echo $smalls['title']?></h3>
                        <?php echo $smalls['description']?>
                    </a>
                </div>
            </div>
        </li>
        <?php } ?>
    </ul>
</div>
 
<script type="text/javascript">
 
function show_popup_updates(){
    $('.popupWrapper, #popup_updates').fadeIn();
    return false;
}
function update_content(id){
    $.ajax({
    url : '<?php echo base_url('home/showPopup');?>'+'/'+id,
    type : "POST",
    data:{"id":id},
    success: function(data){
        $('#popup_updates').html(data);
        show_popup_updates();
        $('.closeBtn, .overlay').click(function(){
        hide_popup();
    })
    },
})
};
</script>