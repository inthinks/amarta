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
            <form action="<?php echo site_url('login/do_login');?>" method="post">
            	<input type="text" name="email" placeholder="Email">
                <input id="password" type="password" name="password" placeholder="Password">
                <label><input type="checkbox">Lihat kata sandi</label>
                <!-- <label style="color:#F00"><?php if($this->session->flashdata('notif')) { echo $this->session->flashdata('notif');}?> </label><br/> -->
                <a href="#" onclick="document.forms[0].submit();return false;" class="blueBtn">Login</a>
                <div class="registerBox">
                	<a href="<?php echo site_url('register') ?>">Register</a>- or - <a href="<?php echo site_url('forget_password') ?>">Forget Password</a>
                </div>
                <input type="submit" style="visibility: hidden;" />
            </form>
            </div>
            
        </section>
    </div>
    <script>
        $(document).ready(function(){
            $("input[type='checkbox']").click(function(){
                if($( "input[type='checkbox']" ).prop("checked")){
                    $('#password').prop("type", "text");
                }
                else{
                    $('#password').prop("type", "password");
                }
            })
        });
    </script>
    <?php if($this->session->flashdata('check')){?>
    <script>
    alert('<?php echo $this->session->flashdata('check')?>');
    </script>
<?php }?>
</body>
