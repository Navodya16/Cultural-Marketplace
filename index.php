<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    include('header.php');
    include('admin/db_connect.php');
    $_SESSION['has_logged'] = 0;

	$query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
	foreach ($query as $key => $value) {
		if(!is_numeric($key))
			$_SESSION['setting_'.$key] = $value;
	}
    ?>

    <style>
    	header.masthead {
		  background: url(assets/img/<?php echo $_SESSION['setting_cover_img'] ?>);
		  background-repeat: no-repeat;
		  background-size: cover;
      background-position: center center;
		}

    

    .modal-dialog.modal-full-height.modal-md {
  position: absolute;
  width: 40vw;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -webkit-transition: right 0.4s ease-out !important;
     -moz-transition: right 0.4s ease-out !important;
       -o-transition: right 0.4s ease-out !important;
          transition: right 0.4s ease-out !important;
}

.modal.show .modal-dialog.modal-full-height.modal-md {
  right: 0;
  -webkit-transition: right 0.4s ease-out !important;
     -moz-transition: right 0.4s ease-out !important;
       -o-transition: right 0.4s ease-out !important;
          transition: right 0.4s ease-out !important;
}

.modal .modal-dialog.modal-full-height.modal-md {
  right: -27vw;
}




    </style>
    <body id="page-top">
        <!-- Navigation-->
        <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white">
        </div>
      </div>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container">
              <!--<img src="assets/img/sampleLogo.png" width = "60" height = "50" alt="Logo" class="logo-img">--> <!-- Add this line -->
                <a class="navbar-brand js-scroll-trigger" href="./">
                  <?php echo $_SESSION['setting_name'] ?></a>
                <button class="navbar-toggler navbar-toggler-right justify-content-end " type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto my-2 my-lg-0 ">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=home">Home</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=cart_list"><span> <span class="badge badge-danger item_count">0</span> <i class="fa fa-shopping-cart"></i>  </span>Cart</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=Courses">Learn to Sell</a></li>
                        <?php if(isset($_SESSION['login_user_id'])): ?>
                          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="javascript:void(0)" id="my_profile" data-id="<?php echo $_SESSION['login_user_id']; ?>" >Profile</a></li>
                          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=orders">Orders</a></li>
                          <!--<li class="nav-item"><a class="nav-link js-scroll-trigger" href="javascript:void(0)" id="add_product" data-id="<?php //echo $_SESSION['login_user_id']; ?>" >My Products</a></li>-->
                          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=my_products">My Products</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="admin/ajax.php?action=logout2"><?php echo "Welcome, ". "" . $_SESSION['login_first_name'].' '.$_SESSION['login_last_name'] ?> <i class="fa fa-power-off"></i></a></li>
                        
                      <?php else: ?>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="javascript:void(0)" id="login_now">Login</a></li>
                      <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
       
        <?php 
        $page = isset($_GET['page']) ?$_GET['page'] : "home";
        include $page.'.php';
        ?>
       

<div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; background-color: red;">
          <!--span class="fa fa-arrow-righ t"></!--span> -->
          <span aria-hidden="true">&times;</span> <!-- Cross icon -->
        </button>
      </div>
      <div class="modal-body">
      </div>
      </div>
    </div>
  </div>
        <footer class="bg-light py-5">
            <div class="container"><div class="small text-center text-muted">Copyright © 2023</div></div>
        </footer>
        
       <?php include('footer.php') ?>
    </body>

    <?php $conn->close() ?>

</html>
