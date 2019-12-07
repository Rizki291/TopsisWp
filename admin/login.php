<?php
include_once 'include/config.php';

$config = new Config();
$db = $config->getConnection();
	
if($_POST){
	
	include_once 'include/login.inc.php';
	$login = new Login($db);

	$login->userid = $_POST['username'];
	$login->passid = md5($_POST['password']);
	
	if($login->login()){
		echo "<script>location.href='form_home.php'</script>";
	}
	
	else{
		echo "<script>alert('Gagal Total')</script>";
	}
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Glance Design Dashboard an Admin Panel Category Flat Bootstrap Responsive Website Template | Login Page :: w3layouts</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
              SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />

      
    </head> 
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-8">&nbsp;</div>
                <div class="col-xs-12 col-sm-4 col-md-4">

                    <div style="margin-top: 100px;" class="panel panel-default"><div class="panel-body">
                            <div class="text-center"><h4>Member Area</h4></div>
                            <form method="post">
                                <div class="form-group">
                                    <label for="InputUsername1">Username</label>
                                    <input type="text" class="form-control" name="username"  id="InputUsername1" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label for="InputPassword1">Password</label>
                                    <input type="password" class="form-control" name="password" id="InputPassword1" placeholder="Password">
                                </div>
                                <p><small style="color:#999;">Username: admin dan Password: admin</small></p>
                                <button type="submit" class="btn btn-primary">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>

    </div>
</div>

<!-- side nav js -->
<script src='js/SidebarNav.min.js' type='text/javascript'></script>
<script>
    $('.sidebar-menu').SidebarNav()
</script>
<!-- //side nav js -->

<!-- Classie --><!-- for toggle left push menu script -->
<script src="js/classie.js"></script>
<script>
    var menuLeft = document.getElementById('cbp-spmenu-s1'),
            showLeftPush = document.getElementById('showLeftPush'),
            body = document.body;

    showLeftPush.onclick = function () {
        classie.toggle(this, 'active');
        classie.toggle(body, 'cbp-spmenu-push-toright');
        classie.toggle(menuLeft, 'cbp-spmenu-open');
        disableOther('showLeftPush');
    };

    function disableOther(button) {
        if (button !== 'showLeftPush') {
            classie.toggle(showLeftPush, 'disabled');
        }
    }
</script>
<!-- //Classie --><!-- //for toggle left push menu script -->

<!--scrolling js-->
<script src="js/jquery.nicescroll.js"></script>


<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.js"></script>
<!-- //Bootstrap Core JavaScript -->

</body>
</html>