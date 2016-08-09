        	<div class="updatesWrapper" id="update">
                <div class="title">
                    <img src="<?php echo base_url();?>templates/images/updates_title.png">
                </div>
            	<div class="updatesBox">
                <div class="updatesContainer">  
                    <div class="updatesContainer">
                    	<div class="updatesLeft">
                        	<div class="bigUpdates">
                            	<a href="javascript:void(0);" onClick="update_content(<?= $update['id']?>);"><img src="<?php echo base_url('userdata/update/')."/".$update['image'];?>"></a>
                                <h3><a href="javascript:void(0);" onClick="update_content(<?= $update['id']?>);"><?php echo $update['title'] ?></a></h3>
                                <p><?php echo substr($update['description'],0,300)."....."; ?></p>
                                <a href="javascript:void(0);" class="readMore" onClick="update_content(<?= $update['id']?>);">Read more</a>
                            </div>
                        </div>
                        <div class="updatesRight">
                            <div id="load">
                        	
                            </div>
                            <div class="buttonWrapper">
                            	<a href="javascript:void(0);" onClick="prev();" id="preview" class="prevBtn">Prev</a>
                                <a href="javascript:void(0);" onClick="next();" id="nextt" class="nextBtn">Next</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <input type="hidden" name="limit1" id="limit" value="2"/>
            <input type="hidden" name="offset1" id="offset" value="0"/>
            <input type="hidden" id="offsetprev" value="0"/>
            
        <div class="popupWrapper">
	          <div class="overlay"></div>
	          <div class="popupBox" id="popup_updates">
        </div>

<script type="text/javascript">
function next(offset, limit){
    var offset = $('#offset').val();
    var offsetprev = $('#offsetprev').val();
    var limit = $('#limit').val();
    $.ajax({
        url:'<?php echo site_url('updates/loadupdate') ?>'+'/'+offset+'/'+limit,
        data:{
          offset :$('#offset').val(),
          offsetprev :$('#offsetprev').val(),
        },
        type:'POST',
        dataType:'json',
        success :function(data){
            $('#load').html(data.view);
            if(data.offset >= <?php echo coun('precedence'); ?>) {
                $('#nextt').hide();
                $('#offsetprev').val(data.offsetprev);
            } else {
                $('#offset').val(data.offset);
                $('#offsetprev').val(data.offsetprev);
                $('#nextt').show();
                $('#preview').show();
            }
            if(data.offset <= 2){
               $('#preview').hide();
            } 
            }
          })
        }
      

function prev(offsetprev, limit){
    var offsetprev = $('#offsetprev').val();
    var offset = $('#offset').val();
    var limit = $('#limit').val();
    if($('#offset').val() <= <?php echo coun('precedence');?>){
    $.ajax({
        url:'<?php echo site_url('updates/loadupdate1') ?>'+'/'+offsetprev+'/'+limit,
        data:{
          offset :$('#offset').val(),
          offsetprev :$('#offsetprev').val(),
        },
        type:'POST', 
        dataType:'json',
        success :function(data){
            $('#load').html(data.view);
            $('#offset').val(data.offset);
            $('#offsetprev').val(data.offsetprev);
           if(data.offsetprev <= -2 ){
                $('#preview').hide();
                $('#offset').val(2)
                $('#offsetprev').val(0);
                } else {
                $('#offset').val(data.offset);
                $('#offsetprev').val(data.offsetprev);
                $('#nextt').show();
                $('#preview').show();
                }
        }
        })
    }
}

next();

$('#preview').hide();

function show_popup_updates(){
    $('.popupWrapper, #popup_updates').fadeIn();
    return false;
}
function update_content(id){
    $.ajax({
    url : '<?php echo base_url('updates/showPopup');?>'+'/'+id,
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