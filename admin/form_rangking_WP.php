<?php 
    include '../crud/koneksi.php';
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
                    <h2 class="title1">Perangkingan WP</h2>
                    <div class="panel-body widget-shadow">
                        <h4>Data Rangking</h4>
                        <table class="table table-bordered"> <thead>

                            <th>No</th> 
                            <th>NISN</th> 
                            <th>Alternatif</th> 
                             
                            <?php 
                                $query2 = "select * from tbl_kriteria";
                                $result2 = mysqli_query($koneksi, $query2);
                                while($dt1 = mysqli_fetch_array($result2)){
                                    echo "<th>$dt1[nama_kriteria]</th>";
                                }
                            ?>
                            </thead>
                            <tbody>
                                <?php
                                $query = "select * from tbl_peringkat ";
                                $result = mysqli_query($koneksi, $query);
                                $no = 1;
                                $nisn = "";
                                while ($data = mysqli_fetch_array($result)) {
                                    if($nisn == $data['nisn']){

                                    }else{
                                        $query3 = "select * from tbl_peringkat where nisn='".$data['nisn']."' ";
                                        $result3 = mysqli_query($koneksi, $query3);
                                ?>
                                        <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $data ['nisn']; ?></td>
                                        <td><?php echo $data ['nama_peserta']; ?></td>
                                <?php 
                                        while ($dt2 = mysqli_fetch_array($result3)){
                                            echo '<td>'.$dt2 ['nilai'].'</td>';
                                        } 
                                ?>
                                    </tr> 
                                <?php 
                                    } 
                                $nisn = $data['nisn'];
                                
                                }
                                
                                ?>

                            </tbody>
                            </table>
<?php
        $query = "select * from tbl_kriteria";
        $result = mysqli_query($koneksi, $query);
        $nisn="";
        $no=0;
        $kriterialist = array();
        $kritlist = array();
        $hasilP =0;
        while ($data = mysqli_fetch_array($result)) {
            $kriterialist[$no] = $data['nama_kriteria'];
            $bobot[$no] = $data['bobot'];
            $kritlist[$no] = $data['tipe_kriteria'];
            $no++;
        }
        $hasilW=0;
        for ($i=0; $i < count($bobot) ; $i++) { 
            $hasilW += $bobot[$i];
        }
        for ($i=0; $i < count($bobot) ; $i++) { 
            $w[$i] = $bobot[$i] / ($hasilW);
        }

        
        for ($i=0; $i < count($kriterialist);$i++) { 
            ${$kriterialist[$i]} = array();
            $query2 = "select * from tbl_peringkat where nama_kriteria='".$kriterialist[$i]."'";
            $result2 = mysqli_query($koneksi, $query2);
            $no=0;
            while ($dt1 = mysqli_fetch_array($result2)) {
                ${$kriterialist[$i]}[$no]= $dt1['nilai'];
                $nama[$no] = $dt1['nisn'];
                $no++;
            }
            $c = count(${$kriterialist[$i]}); 
            #echo ${'HasilS'.$i}.'<br>';
        }

        for ($i=0; $i < $c; $i++) { 
            ${'S'.$i}=1;
            echo $i;
            for ($b=0; $b < count($kriterialist); $b++) { 
                if ($kritlist[$b]=="Cost") {
                    ${'S'.$i} *= pow(${$kriterialist[$b]}[$i],-($w[$b]));
                }else{
                    ${'S'.$i} *= pow(${$kriterialist[$b]}[$i],$w[$b]);
                }
            }       
        }
        $hasil=0;
        for ($i=0; $i < $c; $i++) { 
            $hasil += ${'S'.$i};
        }
        $v=array();
        for ($i=0; $i < $c; $i++) { 
            $v[$i] = ${'S'.$i}/$hasil;
        }
    ?>

                        <h4>Vektor S</h4>
                        <table class="table table-bordered"> <thead>

                            <th>ID Alternatif</th>                               
                            <th>VectorS</th> 
                            <th>VectorV</th>                                   
                            </thead>
                            <tbody>
                                <?php
                                    for ($i=0; $i < $c; $i++) { 
                                        echo "<tr>";
                                        echo "<td>$nama[$i]</td>";
                                        echo "<td>".number_format((float)${'S'.$i}, 5, '.', '')."</td>";
                                        echo "<td>".number_format((float)$v[$i], 5, '.', '')."</td>";
                                        echo "</tr>";
                                    }
                                ?>
                                 </tbody> </table> 
                            <?php
                            $ordered_values = $v;
                            rsort($ordered_values);
                            $t=0;
                            foreach ($v as $key => $value) {
                                foreach ($ordered_values as $ordered_key => $ordered_value) {
                                    if ($value === $ordered_value) {
                                        $key = $ordered_key;
                                        break;
                                    }

                                }
                                //echo $value . '- Rank: ' . ((int) $key + 1) . '<br/>';
                                $Peringkat[$t]= ((int) $key + 1);
                                $t++;
                            }
                            ?>
                            <h4>Peringkat</h4>
                            <table class="table table-bordered"> <thead>

                            <th>ID Alternatif</th>                               
                            <th> Hasil</th>                                   
                            <th> Peringkat</th>                                   
                            </thead>
                            <tbody>
                                <?php
                                    for ($i=0; $i < $c; $i++) { 
                                        echo "<tr>";
                                        echo "<td>$nama[$i]</td>";
                                        echo "<td>".number_format((float)$v[$i], 5, '.', '')."</td>";
                                        echo "<td>".$Peringkat[$i]."</td>";
                                        echo "</tr>";
                                    }
                                ?>                            
                                </tbody> </table> 
                            <div>
                            <!-- Standard button -->
                            <form method="POST" action="form_rangking_WP.php">
                                <input type="submit" name="input" class="btn btn-primary">
                                <button type="button" class="btn btn-primary">view laporan</button>
                            </form>
                            <?php


                                if(isset($_POST['input'])){
                                    $query1 = mysqli_query($koneksi,"delete from tbl_finis where Banding='WP'");
                                    for ($i=0; $i < $c; $i++) { 
                                        $query = mysqli_query($koneksi,"insert into tbl_finis values('','".$nama[$i]."','".$v[$i]."','".$Peringkat[$i]."','WP')");
                                    }   
                                }
                            ?>
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


