<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="target-densitydpi=device-dpi; width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
<meta name="HandheldFriendly" content="true" />
<title><?php echo $title; ?></title>
<link href="<?php echo base_url()?>favicon.ico" rel="shortcut icon" type="image/x-icon" />
<link href='https://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/css/fontAttach/style.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/css/amarta.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/css/amarta-mobile.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/css/jquery.bxslider.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/css/transitions.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/css/puzzle.css">
<link href="<?php echo base_url();?>templates/css/owl.carousel.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>templates/css/owl.theme.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>templates/css/jquery.jscrollpane.css" rel="stylesheet" type="text/css">

<script type="text/javascript" > var site_url = '<?php echo site_url();?>'</script>
<script type="text/javascript" src="<?php echo base_url();?>templates/js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/js/mwheelIntent.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/js/jquery.jscrollpane.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/js/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/js/jquery.bxslider.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/js/jquery.collagePlus.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/js/jquery.removeWhitespace.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/js/jquery.collageCaption.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/js/main.js"></script>
<?php if($this->uri->segment(1)=="quiz"){ ?>
<script type="text/javascript" src="<?php echo base_url();?>templates/js/puzzle.js"></script>
<?php } ?>
<script src="<?php echo base_url();?>templates/js/owl.carousel.min.js"></script>
<?php if($this->uri->segment(1)=="login"){ ?>
/*<!-- <script type="text/javascript" src="<?php echo base_url();?>templates/js/jquery-1.9.1.min.js"></script> -->*/
<?php } ?>

</head>

<?php if($this->uri->segment(1)=="login"){
	echo $this->load->view($content);
	} else { ?>
    <?php if($this->uri->segment(1)== '' || $this->uri->segment(1)== 'home'){ echo '<body id="noScroll">';}else{echo '<body>';} ?>
	<div class="wrapper">    
        <?php $this->load->view('common/header');?>
        	<?php if($this->uri->segment(1)=="quiz") echo '<section id="puzzle">' ?>
            <?php if($this->uri->segment(1)== '' || $this->uri->segment(1)== 'activities' || $this->uri->segment(1) == 'home'){ ?> <section id="setHeight"> <?php } else { ?> <section> <?php } ?>
                <?php $this->load->view($content);?>
            </section>
		<?php $this->load->view('common/footer');?>		
   </div>
</body>
<?php } ?>
</html>
