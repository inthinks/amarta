    <div class="galleryWrapper" id="gallery">
    	 <div class="title"><img src="<?php echo base_url();?>templates/images/gallery_title.png"></div>
        <div class="tabWrapper">
            <ul class="tablist">
                <li><a href="<?php echo site_url('gallery/photo')?>" >Photos</a></li>
                <li><a href="<?php echo site_url('gallery/video')?>" >Videos</a></li>
            </ul>
            <div id="tab-1" class="tabContent">
            	<ul id="photos">
              </ul>
                <a href="javascript:void(0);" onClick="load_photos();" id="loadPhoto" class="blueBtn">Load More</a>
            </div>
            <!-- <div id="tab-2" class="tabContent">
              <ul id="videos">
                </ul>
                <a href="javascript:void(0);" onClick="load_videos();" id="loadVideo" class="blueBtn">Load More</a>
            </div> -->
        </div>
    </div>
    <input type="hidden" name="limit" id="limit" value="8"/>
    <input type="hidden" name="offset" id="offset" value="0"/>
    <input type="hidden" name="limit1" id="limit1" value="4"/>
    <input type="hidden" name="offset1" id="offset1" value="0"/>

<div class="overlay"></div>
<div class="popupWrapper">
<div class="popupBox" id="popup_gallery">
         
              
          
            
</div>
<div class="popupBox" id="popup_video">
          
            
            
            
</div>
</div>

<script type="text/javascript">

function tidyImg(){
      $('#tab-1 li .galleryImg').each(function(){
        if($(this).find('img').width() > $(this).find('img').height()){
          $(this).find('img').css('height', '100%');
        }
        else{
          $(this).find('img').css('width', '100%');
        }
      });
    }
    
      $(window).load(function(){
      tidyImg();
    });

function load_photos(offset, limit){
    var offset = $('#offset').val();
    var limit = $('#limit').val();
    if($('#offset').val() <= <?php echo counts('b.name');?>){
    $.ajax({
        url:'<?php echo site_url('gallery/loadphoto') ?>'+'/'+offset+'/'+limit,
        data:{
          offset :$('#offset').val(),
          limit :$('#limit').val(),
        },
        type:'POST', 
        dataType:'json',
        success :function(data){
            $('#photos').append(data.view);
            $('#offset').val(data.offset);
            $('#limit').val(data.limit);
            if((data.offset >= data.count) || (data.off <= limit)) {
              $('#loadPhoto').hide();
              }
            $(".galleryImgBox").css({
              "width":"100%",
              "position":"relative",
              "padding-bottom":"100%",
              "overflow":"hidden",
              "margin-bottom":"5px",
            });
            $(".galleryImg").css({
              "position":"absolute",
              "top":"0",
              "left":"0",
              "width":"100%",
              "height":"100%",
            });
            $(".galleryName").css({
              "font-size":"14px",
              "height":"40px",
              "text-transform": "uppercase",
            });
            tidyImg()
            }
          })
        }
      }

    function load_videos(off, lim){
    var off = $('#offset1').val();
    var lim = $('#limit1').val();

    if($('#offset1').val() <= <?php echo counts('b.name');?>){
    $.ajax({
        url:'<?php echo site_url('gallery/loadvideo') ?>'+'/'+off+'/'+lim,
        data:{
          off :$('#offset1').val(),
          lim :$('#limit1').val(),
        },
        type:'POST', 
        dataType:'json',
        success :function(data){
            $('#videos').append(data.view);
            $('#offset1').val(data.off);
            $('#limit1').val(data.lim);
            $(".galleryImgBox").css({
              "width":"100%",
              "position":"relative",
              "padding-bottom":"100%",
              "overflow":"hidden",
              "margin-bottom":"5px",
            });
            $(".galleryImg").css({
              "position":"absolute",
              "top":"0",
              "left":"0",
              "width":"100%",
              "height":"100%",
            });
            $(".galleryName").css({
              "font-size":"14px",
              "height":"40px",
              "text-transform": "uppercase",
            });
            if((data.off >= data.count) || (data.off <= lim)){
              $('#loadVideo').hide();
            }
            tidyImg();
          }
        })
      }
  }

  load_photos();
  load_videos();

  

  function show_popup_gal(){
    $('.overlay, .popupWrapper, #popup_gallery').fadeIn();
    return false;
  }
  function show_popup_vid(){
    $('.overlay, .popupWrapper, #popup_video').fadeIn();
    return false;
  }
  
function show_popup_gallery(id){
    $.ajax({
    url : '<?php echo base_url('gallery/showPopup');?>'+'/'+id,
    type : "POST",
    data:{"id":id},
    success: function(data){
        $('#popup_gallery').html(data);
        show_popup_gal();
        $('.closeBtn, .overlay').click(function(){
        hide_popup();
        $('#popup_gallery #image').remove();
        $('#popup_gallery a').remove();
    })
    },
})
};

function show_popup_video(id){
    $.ajax({
    url : '<?php echo base_url('gallery/showPopup');?>'+'/'+id,
    type : "POST",
    data:{"id":id},
    success: function(data){
        $('#popup_video').html(data);
        show_popup_vid();
        $('.closeBtn, .overlay').click(function(){
        hide_popup();
        $('#popup_video #video').remove();
        $('#popup_video a').remove();
    })
    },
})
};

    
</script>