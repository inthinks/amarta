<div class="menuSideCon">
    <div class="menuSideBox">
        <div class="menuSideContent">
            <div class="menuSideCategory">
                <div class="openCloseButton">
                    <a class="open">Expand all</a>
                    <a class="close">Collapse all</a>
                </div>
                <ul id="accordion">
                    <li>
                        <h3 class="dropDown">Banner</h3>
                        <ul>
                            <li><a href="<?php echo site_url('admin/banner');?>">banner list</a></li>
                            <li><a href="<?php echo site_url('admin/small_banner');?>">Small Banner list</a></li>
                        </ul>
                    </li>
                    <li>
                        <h3 class="dropDown">User</h3>
                        <ul>
                            <li><a href="<?php echo site_url('admin/user');?>">User list</a></li>
                        </ul>
                    </li>
                    <?php $_isRegular = $this->session->userdata('admin_id') > 1;?>
                    <?php if(!$_isRegular){?>
                    <li>
                        <h3 class="dropDown">Filosofi</h3>
                        <ul>
                            <li><a href="<?php echo site_url('admin/filosofi');?>">Filosofi update</a></li>
                        </ul>
                    </li>

                    <li>
                        <h3 class="dropDown">Layout Plan</h3>
                        <ul>
                            <li><a href="<?php echo site_url('admin/plan_item');?>">Plan Item list</a></li>
                            <li><a href="<?php echo site_url('admin/plan_image');?>">Plan Image update</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                     <li>
                        <h3 class="dropDown">Actvity</h3>
                        <ul>
                            <li><a href="<?php echo site_url('admin/activity');?>">Activity list</a></li>
                        </ul>
                    </li>
                     
                    <li>
                        <h3 class="dropDown">Update</h3>
                        <ul>
                            <li><a href="<?php echo site_url('admin/update');?>">Update list</a></li>
                        </ul>
                    </li>

                    <li>
                        <h3 class="dropDown">Inspirasi Desain</h3>
                        <ul>
                            <li><a href="<?php echo site_url('admin/inspire');?>">Inspire list</a></li>
                        </ul>
                    </li>
                    <li>
                        <h3 class="dropDown">Arti Amarta</h3>
                        <ul>
                            <li><a href="<?php echo site_url('admin/about/edit');?>">Arti Amarta list</a></li>
                        </ul>
                    </li> 
                    <li>
                        <h3 class="dropDown">FAQ Contact Us</h3>
                        <ul>
                            <li><a href="<?php echo site_url('admin/contact_us');?>">FAQ list</a></li>
                            <li><a href="<?php echo site_url('admin/contact_us/description');?>">Contact Us</a></li>
                        </ul>
                    </li>
                    <?php if(!$_isRegular){ ?>
                    <li>
                        <h3 class="dropDown">What Around the Office</h3>
                        <ul>
                            <li><a href="<?php echo site_url('admin/current');?>">Current list</a></li>
                        </ul>
                    </li>

                    <li>
                        <h3 class="dropDown">Category What Near</h3>
                        <ul>
                            <li><a href="<?php echo site_url('admin/cat_near');?>">Category list</a></li>
                        </ul>
                    </li>

                    <li>
                        <h3 class="dropDown">What Near Item</h3>
                        <ul>
                            <li><a href="<?php echo site_url('admin/near_item');?>">Near Item list</a></li>
                        </ul>
                    </li>
                    <li>
                        <h3 class="dropDown">How To Reach</h3>
                        <ul>
                            <li><a href="<?php echo site_url('admin/reach');?>">Near How to Reach list</a></li>
                            <li><a href="<?php echo site_url('admin/reach_item');?>">Near How to Reach Item List</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                    <li>
                        <h3 class="dropDown">Image Category</h3>
                        <ul>
                            <li><a href="<?php echo site_url('admin/image_category');?>">Category list</a></li>
                        </ul>
                    </li>
                    <li>
                        <h3 class="dropDown">Image Item</h3>
                        <ul>
                            <li><a href="<?php echo site_url('admin/image_item');?>">Image Item list</a></li>
                        </ul>
                    </li>

                    <li>
                        <h3 class="dropDown">Content Element</h3>
                        <ul>
                            <li><a href="<?php echo site_url('admin/content_element');?>">Content list</a></li>
                        </ul>
                    </li>
                    <li>
                        <h3 class="dropDown">Question</h3>
                        <ul>
                            <li><a href="<?php echo site_url('admin/question');?>">Question list</a></li>
                        </ul>
                    </li>
                    <li>
                        <h3 class="dropDown">Answer</h3>
                        <ul>
                            <li><a href="<?php echo site_url('admin/answer');?>">Answer list</a></li>
                        </ul>
                    </li>
                    <?php if(!$_isRegular){ ?>
                    <li>
                        <h3 class="dropDown">User Point</h3>
                        <ul>
                            <li><a href="<?php echo site_url('admin/point');?>">Point List</a></li>
                        </ul>
                    </li>
                    <li>
                        <h3 class="dropDown">Game Setting</h3>
                        <ul>
                            <li><a href="<?php echo site_url('admin/game');?>">Edit Limit</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                </ul>
              
            </div>
        </div>
        <a href="#" class="slideBtn"></a>
        <a href="#" class="flagOverlayBtn"></a>
    </div>
</div>