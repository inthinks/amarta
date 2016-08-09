<?php if($this->uri->segment(2)=="login"){?> 
<header>
    <div class="logo"><a href="<?php echo site_url('admin/login');?>"><?php /*?><img width="200px" src="<?php echo base_url();?>templates/images/logo.png"><?php */?></a></div>
</header>
<?php }else{?>
<header class="headerMenu">
    <div class="topMenuContent">
        <h1><a href="<?php echo site_url('admin/home');?>" id="topMenuLogo"><img src="<?php echo base_url();?>templates/images/logo.png"></a></h1>
        <span id="date_time"></span>
        <div class="rightTopLink">
            <span>Hi, <a href="#" class="loginName"><?php echo $this->session->userdata('admin_username');?>!</a></span>
            <div class="optionButton">
                <div class="optionCon">
                    <a href="#" class="option"></a>
                    <div class="optionWrap">
                        <div class="optionBox">
                            <ul>
                                <?php /*?><li><a href="<?php echo site_url('lwsecurityadmin/change_password');?>">Change Password</a></li><?php */?>
                                <li><a href="<?php echo site_url('admin/home/logout');?>">Logout</a></li>
                            </ul>
                        </div>
                        <div class="pointerBox">
                            <div class="pointer"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<?php }?>