        	<div class="contactWrapper">
            	<div class="title">
	            	<img src="<?php echo base_url(); ?>templates/images/contact_title.png">
                </div>
                <div class="contactBox">
                    <div class="contactContent">
                	<h3>Contact Us</h3>
                    <p>
                    <?php echo $desc['description']; ?>
                    </p>
                    </div>
                    <div class="faqWrapper">
                    	<div class="faqBox scroll-pane">
                        	<ul>
                                <?php foreach($xx as $list) { ?>
                            	<li>
                                	<div class="faqQuestion">
                                    	<b><?php echo $list['question']; ?></b>
                                    </div>
                                    <div class="faqAnswer">
                                    	<?php echo $list['answer']; ?>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
<script>
    $(document).ready(function(){
            $('.scroll-pane').jScrollPane();
        })
        $(window).load(function(){
            var contcatBoxHeight = $('.contactBox').height();
            var contactContent = $('.contactContent').height();
            $('.faqBox').css('max-height',contcatBoxHeight - contactContent - 60);
            $('.scroll-pane').jScrollPane();
        });
</script> 


