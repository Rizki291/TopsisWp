<?php
include '../crud/koneksi.php';

$query = "select * from tbl_admin where id_admin=" . $_GET['kode'];
$result = mysqli_query($koneksi, $query);
$show = mysqli_fetch_array($result)
?>
<html>
    <head>
        <title>Glance Design Dashboard an Admin Panel Category Flat Bootstrap Responsive Website Template | Blank Page :: w3layouts</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
              SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

        <!-- Bootstrap Core CSS -->
        <link href="../web/css/bootstrap.css" rel='stylesheet' type='text/css' />

        <!-- Custom CSS -->
        <link href="../web/css/style.css" rel='stylesheet' type='text/css' />

        <!-- font-awesome icons CSS -->
        <link href="../web/css/font-awesome.css" rel="stylesheet"> 
        <!-- //font-awesome icons CSS -->

        <!-- side nav css file -->
        <link href='../web/css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css'/>
        <!-- side nav css file -->

        <!-- js-->
        <script src="../web/js/jquery-1.11.1.min.js"></script>
        <script src="../web/js/modernizr.custom.js"></script>

        <!--webfonts-->
        <link href="//../web/fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
        <!--//webfonts--> 

        <!-- Metis Menu -->
        <script src="../web/js/metisMenu.min.js"></script>
        <script src="../web/js/custom.js"></script>
        <link href="../web/css/custom.css" rel="stylesheet">
        <!--//Metis Menu -->

    </head> 
    <body class="cbp-spmenu-push">
        <div class="main-content">
            <div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
                <!--left-fixed -navigation-->
                <?php include '../include/menu.php' ?>; 
            </div>
            <!--left-fixed -navigation-->
            <div id="page-wrapper">
                <div class="main-page">
                    <div class="forms">
                        <h2 class="title1"></h2>
                        <div class="form-grids row widget-shadow" data-example-id="basic-forms"> 
                            <div class="form-title">
                                <h4>Ubah Data Admin</h4>
                            </div>
                            <div class="form-body">
                                <form action="../crud/edit_admin.php" method="post" role="form"> 
                                    <div class="form-group">
                                        <label for="">No :
                                        </label> 
                                        <input value="<?php echo $show ['id_admin']; ?>" type="text " class="form-control" id="id_admin" name="id_admin" placeholder=""readonly="readonly">
                                    </div>
                                    <div class="form-group"> <label for="">Nama Lengkap :
                                        </label>
                                        <input value=""<?php echo $show ['nama_lengkap']; ?> type="text" class="form-control" id="nama_lengkap"name="nama_lengkap" placeholder="">
                                    </div>
                                    <div class="form-group"> <label for="">Username:
                                        </label> 
                                        <input value=""<?php echo $show ['username']; ?> type="text" class="form-control" id="username"name="username" placeholder="">
                                    </div> 
                                    <div class="form-group"> <label for="">Password:
                                        </label>
                                        <input value=""<?php echo $show ['password']; ?> type="password" class="form-control" id="exampleInputPassword"name="password" placeholder="">
                                    </div> 

                                    <button type="submit" name="submit"class="btn btn-success">Ubah</button>         
                                  <button type="button" onclick="location.href='form_admin.php'" class="btn btn-success">Kembali</button>
                                </form> 
                            </div>
                        </div>
                    </div>
                    <!-- side nav js -->
                    <script src='../web/js/SidebarNav.min.js' type='text/javascript'></script>
                    <script>
                        $('.sidebar-menu').SidebarNav()
                    </script>
                    <!-- //side nav js -->

                    <!-- Classie --><!-- for toggle left push menu script -->
                    <script src="../web/js/classie.js"></script>
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
                    <script src="../web/js/jquery.nicescroll.js"></script>
                    <script src="../web/js/scripts.js"></script>
                    <!--//scrolling js-->

                    <!-- Bootstrap Core JavaScript -->
                    <script src="../web/js/bootstrap.js"></script>
                </div>
                <?php include '../include/foter.php' ?>:     
            </div>
        </div>
    </body>
</html>



