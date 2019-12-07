<?php
include '../crud/koneksi.php';

$query = "select * from tbl_admin ";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Glance Design Dashboard an Admin Panel Category Flat Bootstrap Responsive Website Template | Tables :: w3layouts</title>
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
            </div>
            <?php include '../include/menu.php' ?>;  
        </div>
        <!--left-fixed -navigation-->

        <div class="clearfix"></div>				
        <div class="clearfix"> </div>	
        <!-- //header-ends -->
        <!-- main content start-->

        <div id="page-wrapper">
            <div class="main-page">
                <div class="tables">
                    <h2 class="title1">Tabel Data Admin</h2>
                    <div class="panel-body widget-shadow">

                        <h4>Data Admin</h4>
                        <table class="table table-bordered"> <thead>
                            <th>NO</th> 
                            <th>Nama Lengkap</th> 
                            <th>Username</th> 
                            <th>Aksi</th>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($data = mysqli_fetch_array($result)) {
                                    ?>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $data ['nama_lengkap']; ?></td>
                                <td><?php echo $data ['username']; ?></td>
                                <td>
                                    <a href="ubah_data_admin.php?kode=<?php echo $data ['id_admin']; ?>" >
                                        <button type="button" class="btn btn-primary btn-flat "><i class="fa fa-edit" aria-hidden="true"></i></button>
                                        <a href="../crud/hapus_admin.php?id= <?php echo $data['id_admin'] ?>" onclick="return confirm('Anda Yakin Menghapus Data ini ?')">
                                            <button type="button" class="btn btn-warning btn-flat "><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>
                                   </td>
                                </tr> 
                            <?php } ?>
                            </tbody> 
                        </table> 
                        <div>
                            <!-- Standard button -->

                            <a href="form_tambah_admin.php" type="button" class="btn btn-success">Tambah Data</a>
                        </div>
                    </div>
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
        <?php include '../include/foter.php' ?>:     
    </body>
</html>

