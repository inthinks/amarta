<body id="login">
	<div class="wrapper">
    	<header>
        	<div class="headerBox">
            	<h1><a href="#" id="logo">Amarta</a></h1>
                <h1><a href="#" id="logo_unilever">Unilever</a></h1>
            </div>
        </header>
        <section>
            
        	<div class="loginWrapper">
            <form action="<?php echo site_url('forget_password/do_forget_password');?>" method="post">
                <input id="username" type="text" name="username1" placeholder="Username">
                <!-- <label style="color:#F00"><?php if($this->session->flashdata('notif')) { echo $this->session->flashdata('notif');}?> </label><br/> -->
                <a href="#" onclick="document.forms[0].submit();return false;" class="blueBtn">Submit</a>
                <div class="registerBox">
                	<a href="<?php echo site_url('login');?>">Login</a>
                </div>
                <input type="submit" style="visibility: hidden;" />
            </form>
            </div>
            
        </section>
    </div>
</body>

<?php if($this->session->flashdata('notif')){?>
<script>
    alert('<?php echo $this->session->flashdata('notif')?>');
</script>
<?php }?>
