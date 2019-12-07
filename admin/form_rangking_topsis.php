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

        <div id="page-wrapper" >
            <div class="main-page">
                <div class="tables">
                    <h2 class="title1">Perangkingan TOPSIS</h2>
                    <div class="panel-body widget-shadow">
                        <?php
                            //hitung normalisasi
                            $query = "select * from tbl_kriteria";
                            $result = mysqli_query($koneksi, $query);
                            $nisn="";
                            $no=0;
                            $kriterialist = array();
                            $kritlist = array();
                            while ($data = mysqli_fetch_array($result)) {
                                $kriterialist[$no] = $data['nama_kriteria'];
                                $bobot[$no] = $data['bobot'];
                                $kritlist[$no] = $data['tipe_kriteria'];
                                $no++;
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
                                ${'x'.$i} = array();
                                $c = count(${$kriterialist[$i]}); 
                            }
                            //Perhitungan Normalisasi aja
                            for ($i=0; $i < count($kriterialist); $i++) { 
                                for ($b=0; $b < count(${$kriterialist[$i]}); $b++) { 
                                    ${'x'.$i}[$b] = ${$kriterialist[$i]}[$b] * ${$kriterialist[$i]}[$b];
                                }
                                ${'xplus'.$i} = 0;
                            }
                            for ($i=0; $i < count($kriterialist); $i++) { 
                                for ($b=0; $b < count(${$kriterialist[$i]}); $b++) { 
                                    ${'xplus'.$i} += ${'x'.$i}[$b];
                                }
                            }
                            for ($i=0; $i < count($kriterialist); $i++) { 
                                for ($b=0; $b < count(${$kriterialist[$i]}); $b++) { 
                                    ${'xsqrt'.$i} = sqrt(${'xplus'.$i});
                                }
                            }
                            for ($i=0; $i < count($kriterialist); $i++) { 
                                for ($b=0; $b < count(${$kriterialist[$i]}); $b++) { 
                                    ${'R'.$i}[$b] = ${$kriterialist[$i]}[$b]/${'xsqrt'.$i};
                                }
                            }
                             //Perhitungan Normalisasi Terbobot
                            for ($i=0; $i < count($kriterialist); $i++) { 
                                for ($b=0; $b < count(${$kriterialist[$i]}); $b++) { 
                                    ${'r'.$i}[$b] = $bobot[$i] * ${'R'.$i}[$b];
                                }
                            }
                            // Pencarian max min positif dan negatif
                            for ($i=0; $i < count($kriterialist); $i++) {
                                if ($kritlist[$i] == "Benefit" ) {
                                    $YPOS[$i] = max(${'r'.$i}); 
                                    $YNEG[$i] = min(${'r'.$i});
                                }elseif($kritlist[$i] == "Cost"){
                                    $YPOS[$i] = min(${'r'.$i});
                                    $YNEG[$i] = max(${'r'.$i}); 
                                }  
                                ${'P'.$i} = array();
                            }
                            // Perhitungan Positif
                            for ($i=0; $i < $c; $i++) { 
                                ${'D'.$i.'Pos'} = 0;
                                for ($b=0; $b < count($kriterialist); $b++) { 
                                    ${'P'.$i}[$b] = $YPOS[$b] - ${'r'.$b}[$i];
                                    ${'P'.$i}[$b] *= ${'P'.$i}[$b];
                                    ${'D'.$i.'Pos'} += ${'P'.$i}[$b];
                                }
                                ${'hasilD'.$i.'Pos'}= sqrt(${'D'.$i.'Pos'});
                            }
                            // Perhitungan Negatif
                            for ($i=0; $i < $c; $i++) { 
                                ${'D'.$i.'Neg'} = 0;
                                for ($b=0; $b < count($kriterialist); $b++) { 
                                    ${'L'.$i}[$b] =  ${'r'.$b}[$i] - $YNEG[$b];
                                    ${'L'.$i}[$b] *= ${'L'.$i}[$b];
                                    ${'D'.$i.'Neg'} += ${'L'.$i}[$b];
                                }
                                ${'hasilD'.$i.'Neg'}= sqrt(${'D'.$i.'Neg'});
                            }
                            //Hitung V
                            for ($i=0; $i < $c; $i++) { 
                                $V[$i] = ${'hasilD'.$i.'Neg'}/(${'hasilD'.$i.'Neg'}+${'hasilD'.$i.'Pos'});
                            }
                        
                        ?>
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
                        <!--------------------------------------------Ternomralisasi--------------------->
                        <h4>Normalisasi</h4>
                        <table class="table table-bordered" style="font-size: 13px"> <thead>

                            <th width="50%">ID Alternatif</th>                               
                            <?php
                                for ($i=0; $i < count($kriterialist); $i++) { 
                                    echo "<th>C".($i+1)."</th>";
                                }
                            ?>                                   
                            </thead>
                            <tbody>         
                                    <?php 
                                       for ($i=0; $i < $c ; $i++){
                                            echo "<tr>";
                                            echo '<td>'.$nama[$i].'</td>';
                                            for($b=0; $b<=count($kriterialist)-1;$b++){
                                                echo '<td>'.number_format((float)${'R'.$b}[$i], 5, '.', '').'</td>';
                                            }
                                            echo '</tr>';
                                        }
                                    ?>
                                    
                                </tbody> </table> 
                        <h4>Normalisasi Terbobot</h4>
                        <table class="table table-bordered" style="font-size: 13px"> <thead>

                            <th>ID Alternatif</th>                               
                            <?php
                                for ($i=0; $i < count($kriterialist); $i++) { 
                                    echo "<th>C".($i+1)."</th>";
                                }
                            ?>                                   
                            </thead>
                            <tbody>
                                <?php
                                    for ($i=0; $i < $c; $i++) { 
                                        echo "<tr>";
                                        echo '<td>'.$nama[$i].'</td>';
                                        for ($b=0; $b < count($kriterialist); $b++) { 
                                            echo '<td>'.number_format((float)${'r'.$b}[$i], 5, '.', '').'</td>';
                                        }
                                        echo '</tr>';
                                    }
                                    
                                ?>
                            </tbody> 
                        </table> 
                        <h4>Menentukan matrik solusi ideal positif dan negatif</h4>
                        <table class="table table-bordered"> <thead>

                            <th>Kriteria</th>                               
                            <th>A-</th>                                   
                            <th>A+</th>                                   
                            </thead>
                            <tbody>
                                    <?php
                                        for ($i=0; $i < count($kriterialist); $i++) { 
                                            echo "<tr><th>C".($i+1)."</th><td>".number_format((float)$YPOS[$i], 5, '.', '')."</td><td>".number_format((float)$YNEG[$i], 5, '.', '')."</td></tr>";
                                        }
                                    ?>                                    
                                 </tbody> </table> 
                        <h4>Jarak solusi dan nilai preferensi</h4>
                        <table class="table table-bordered"> <thead>

                            <th>ID Alternatif</th>                               
                            <th>D-</th>                                   
                            <th>D+</th>                                   
                            </thead>
                            <tbody>
                                <?php
                                    for ($i=0; $i < $c; $i++) { 
                                        echo "<tr><th>$nama[$i]</th><td>".number_format((float)${'hasilD'.$i.'Pos'}, 5, '.', '')."</td><td>".number_format((float)${'hasilD'.$i.'Neg'}, 5, '.', '')."</td></tr>";
                                    }
                                ?>    
                            </tbody> </table> 
                        <h4>Nilai Prevensi</h4>
                        <table class="table table-bordered"> <thead>

                            <th>ID Alternatif</th>                                                      
                            <th>V</th>                                   
                            </thead>
                            <tbody>
                                <?php
                                    for ($i=0; $i < $c; $i++) { 
                                        echo "<tr><th>$nama[$i]</th><td>".number_format((float)$V[$i], 5, '.', '')."</td><td>";
                                    }
                                ?> 
                            </tbody> </table> 

                        
                            <?php
                            $ordered_values = $V;
                            rsort($ordered_values);
                            $t=0;
                            foreach ($V as $key => $value) {
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
                            <th>Hasil</th>                                   
                            <th>Peringkat</th>                                   
                            </thead>
                            <tbody>
                                <?php
                                for ($i=0; $i < $c; $i++) {
                                    echo "<tr>";
                                    echo "<td>".$nama[$i]."</td>";
                                    echo "<td>".number_format((float)$V[$i], 5, '.', '')."</td>";                                 
                                    echo "<td>".$Peringkat[$i]."</td>";                                 
                                    echo "</tr>"; 
                                }  
                                ?>
                            </tbody> </table> 
                            <div>
                            <!-- Standard button -->
                            <form method="POST" action="form_rangking_topsis.php">
                                <input type="submit" name="input" class="btn btn-primary">
                                <button type="button" class="btn btn-primary">view laporan</button>
                            </form>
                            <?php

                                if(isset($_POST['input'])){
                                    $query1 = mysqli_query($koneksi,"delete from tbl_finis where Banding='TOPSIS'");
                                    for ($i=0; $i < count(${$kriterialist[$i]}); $i++) { 
                                        $query = mysqli_query($koneksi,"insert into tbl_finis values('','".$nama[$i]."','".$V[$i]."','".$Peringkat[$i]."','TOPSIS')");
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


