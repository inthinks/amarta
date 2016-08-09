<div class="howtoreachWrapper">
                <div class="howtoreachBox">
                    <h2>How To Reach The Office</h2>
                    <ul>
                    <?php  foreach($reach as $reaches) { ?>
                        <li>
                            <div class="cityWrapper">
                                <div class="cityBox">
                                    <a href="#" class="cityListBox" onClick="reach_popup(<?php echo $reaches['id']?>);"> 
                                        <div class="cityList">
                                          <?php echo $reaches['title'];?>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                    </ul>
                </div>
</div>


<div class="popupWrapper">
        <div class="overlay"></div>
        <div class="popupBox" id="popup_htr">
            
        </div>
    </div>

<script type="text/javascript">
    function reach_popup(id){
    $.ajax({
    url : '<?php echo base_url('reach/showPopup');?>'+'/'+id,
    type : "POST",
    data:{"id":id},
    success: function(data){
        $('#popup_htr').html(data);
        show_popup_htr();
        $('.closeBtn, .overlay').click(function(){
        hide_popup();
        });
        $("table tr td:first-child").css({
        "width":"20%",
        "color":"#1969a3",
        "font-size":"20px",
        "font-weight":"700",
        "text-transform":"uppercase",
        });
        $("table tr td").css({
        "padding-bottom": "20px",
        });

    },
})
};  
</script>