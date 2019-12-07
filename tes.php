@extends("index")
@section("content")
<script src="/b-soft.js"></script>
<div class="">
    <h1>PROSES PERHITUNGAN</h1>
    <div class="panel panel-primary" id='print'>
        <div class="panel-heading">PERHITUNGAN AHP</div>
        <div class="panel-body panel-danger">
            {{--Membuat Matrix--}}
            <?php $count_matrix = count(\App\kriteria::all()) + 1; ?>
            @for($b=1;$b<$count_matrix;$b++)
            @for($k=1;$k<$count_matrix;$k++)
            <?php $matrix[$b][$k] = 0; ?>
            @if($b==$k) <?php $matrix[$b][$k] = 1; ?> @endif
            @endfor
            @endfor
            {{--Membaca Kritaria Matrix--}}
            @foreach(\App\bobot_kriteria::all() as $i=> $bobot_kriteria)
            <?php
            $matrix[$bobot_kriteria->IdKriteria1][$bobot_kriteria->IdKriteria2] = $bobot_kriteria->Bobot;
            ?>
            @endforeach
            {{--todo:Menentukan Matrix Pembagai 1--}}
            @foreach(\App\bobot_kriteria::all() as $i=> $bobot_kriteria)
            <?php
            $matrix[$bobot_kriteria->IdKriteria2][$bobot_kriteria->IdKriteria1] = 1 / $bobot_kriteria->Bobot;
            ?>
            @endforeach
            {{--todo:Summery Matrix Kolom Step 1--}}
            @for($b=1;$b<$count_matrix;$b++)
            <?php
            $sum_matrix[$b] = array_sum($matrix[$b]);
            ?>
            @endfor
            {{--todo:Matrix Awal Kriteria--}}
            <div class="panel panel-default">
                <div class="panel-heading">Matriks Perbandingan Kriteria</div>
                <div class="panel-body">
                    <p> Pertama-tama menyusun hirarki dimana diawali dengan tujuan, kriteria dan
                        alternatif-alternatif lokasi pada tingkat paling bawah. Selanjutnya menetapkan perbandingan
                        berpasangan antara kriteria-kriteria dalam bentuk matrik. Nilai diagonal matrik untuk
                        perbandingan suatu elemen dengan elemen itu sendiri diisi dengan bilangan (1) sedangkan isi
                        nilai perbandingan antara (1) sampai dengan (9) kebalikannya, kemudian dijumlahkan perkolom.
                        Data matrik tersebut seperti terlihat pada tabel berikut.</p>
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>KODE</th>
                                @foreach(\App\kriteria::all() as $kriteria)
                                <?php $alias_kriteria[$kriteria->IdKriteria] = $kriteria->Alias ?>
                                <th>{{$alias_kriteria[$kriteria->IdKriteria]}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @for($b=1;$b<$count_matrix;$b++)
                            <tr>
                                <td style="font-weight: bold">{{$alias_kriteria[$b]}}</td>
                                @for($k=1;$k<$count_matrix;$k++)
                                <td>{{round($matrix[$k][$b],2)}}</td>
                                @endfor
                            </tr>
                            @endfor
                            <tr>
                                <td style="font-weight: bold">TOTAL</td>
                                @for($k=1;$k<$count_matrix;$k++)
                                <td>{{round($sum_matrix[$k],2)}}</td>
                                @endfor
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            {{--todo:Langkah 2 Membuat Matrix Keputusan Ternormalisasi--}}
            @for($b=1;$b<$count_matrix;$b++)
            @for($k=1;$k<$count_matrix;$k++)
            <?php $matrix_keputusan[$b][$k] = $matrix[$b][$k] / $sum_matrix[$b]; ?>
            @endfor
            @endfor
            {{--todo:Summery Matrix Keputusan ternaromalisasi--}}
            @for($b=1;$b<$count_matrix;$b++)
            <?php $sum_matrix_keputusan[$b] = 0; ?>
            @for($k=1;$k<$count_matrix;$k++)
            <?php $sum_matrix_keputusan[$b] += $matrix_keputusan[$k][$b]; ?>
            @endfor
            @endfor
            {{--todo:mendapatkan prioritas awal ternormailsasi--}}
            @for($b=1;$b<$count_matrix;$b++)
            <?php $prioritas[$b] = $sum_matrix_keputusan[$b] / ($count_matrix - 1); ?>
            @endfor
            {{--todo:mencetak matrix keputusan ternormalisasi--}}
            <div class="panel panel-default">
                <div class="panel-heading">Matriks Bobot Prioritas Kriteria</div>
                <div class="panel-body">
                    <p>Setelah terbentuk matrik perbandingan maka dilihat bobot prioritas untuk perbandingan
                        kriteria. Dengan cara membagi isi matriks perbandingan dengan jumlah kolom yang bersesuaian,
                        kemudian menjumlahkan perbaris setelah itu hasil penjumlahan dibagi dengan banyaknya
                        kriteria sehingga ditemukan bobot prioritas seperti terlihat pada berikut.</p>
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>KODE</th>
                                @foreach(\App\kriteria::all() as $kriteria)
                                <?php $alias_kriteria[$kriteria->IdKriteria] = $kriteria->Alias ?>
                                <th>{{$alias_kriteria[$kriteria->IdKriteria]}}</th>
                                @endforeach
                                <th>JUMLAH</th>
                                <th>PRIORITAS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($b=1;$b<$count_matrix;$b++)
                            <tr>
                                <td style="font-weight: bold">{{$alias_kriteria[$b]}}</td>
                                @for($k=1;$k<$count_matrix;$k++)
                                <td>{{round($matrix_keputusan[$k][$b],2)}}</td>
                                @endfor
                                <td>{{round($sum_matrix_keputusan[$b],2)}}</td>
                                <td>{{round($prioritas[$b],2)}}</td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
            {{--todo:Mencari λ max--}}
            @for($b=1;$b<$count_matrix;$b++)
            @for($k=1;$k<$count_matrix;$k++)
            <?php $matrix_max[$b][$k] = $prioritas[$b] * $matrix_keputusan[$b][$k]; ?>
            @endfor
            @endfor
            {{--todo:Summery λ max--}}
            @for($b=1;$b<$count_matrix;$b++)
            <?php $sum_matrix_max[$b] = 0; ?>
            @for($k=1;$k<$count_matrix;$k++)
            <?php $sum_matrix_max[$b] += $matrix_max[$k][$b]; ?>
            @endfor
            @endfor
            {{--todo:Summery λ max--}}
            @for($b=1;$b<$count_matrix;$b++)
            <?php $sum_max[$b] = $sum_matrix_max[$b] / $prioritas[$b];
            ?>
            @endfor
            {{--todo:Mendapatkan nilai CI DAN CR--}}
            <?php
            $n = ($count_matrix - 1);
            $ci = (array_sum($sum_max) - $n) / ($n - 1);
            $index_random = index_random_consistency($ci);
            $cr = $ci / $index_random;
            ?>
            {{--todo:Mencetak Max--}}
            <div class="panel panel-default">
                <div class="panel-heading">Mencari λ max</div>
                <div class="panel-body">
                    <p>Untuk mengetahui konsisten matriks perbandingan dilakukan perkalian seluruh isi kolom matriks
                        A perbandingan dengan bobot prioritas kriteria A, isi kolom B matriks perbandingan dengan
                        bobot prioritas kriteria B dan seterusnya. Kemudian dijumlahkan setiap barisnya dan dibagi
                        penjumlahan baris dengan bobot prioritas bersesuaian seperti terlihat pada tabel
                        berikut.</p>
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>KODE</th>
                                @foreach(\App\kriteria::all() as $kriteria)
                                <?php $alias_kriteria[$kriteria->IdKriteria] = $kriteria->Alias ?>
                                <th>{{$alias_kriteria[$kriteria->IdKriteria]}}</th>
                                @endforeach
                                <th>JUMLAH</th>
                                <th>λ MAX</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($b=1;$b<$count_matrix;$b++)
                            <tr>
                                <td style="font-weight: bold">{{$alias_kriteria[$b]}}</td>
                                @for($k=1;$k<$count_matrix;$k++)
                                <td>{{round($matrix_max[$k][$b],4)}}</td>
                                @endfor
                                <td>{{round($sum_matrix_max[$b],2)}}</td>
                                <td>{{round($sum_max[$b],2)}}</td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                    <h4>Berikut tabel ratio index berdasarkan ordo matriks.</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ORDO MATRIX</th>
                                    @foreach(bSoft::getRefrance("select * from ratio_index") as $ratio)
                                    <td>{{$ratio->OrdoMatrix}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>RATIO INDEX</th>
                                    @foreach(bSoft::getRefrance("select * from ratio_index") as $ratio)
                                    <td>{{$ratio->RatioIndex}}</td>
                                    @endforeach
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="panel panel-danger">
                        {{--<div class="panel-heading">HASIL PROSES AHP</div>--}}
                        <div class="panel-body bg-warning">
                            @foreach(\App\kriteria::all() as $i=> $kriteria)
                            @endforeach
                            λ MAX : {{round(array_sum($sum_max))}}<br>
                            Consistency Index: {{round($ci)}}<br>
                            Ratio Index: {{round($index_random,2)}}<br>
                            Consistency Ratio: @if($cr<=1) {{round($cr,3)}} (konsisten) @else  {{round($cr,3)}}
                            (tidak konsisten) @endif<br>
                        </div>
                    </div>
                </div>
            </div>

            {{--todo : Matrix ternormalisai--}}
            @foreach(\App\alternatif::all() as $b=> $alternatif)
            <?php $idalternatif = $alternatif->IdAlternatif; ?>
            @foreach(bSoft::getRefrance("select * from bobot_alternatif where idalternatif='$idalternatif'") as $k=> $bobot)
            <?php
            $matrix_alternatif[$b + 1][$k + 1] = $bobot->Bobot;
            $alias_alternatif[$idalternatif] = $alternatif->Alias;
            ?>
            @endforeach
            @endforeach
            <?php
            $count_alternatif = count(\App\alternatif::all());
            ?>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">PERHITUNGAN TOPSIS</div>
        <div class="panel-body panel-danger">
            <!--                todo:cari disini untuk matrix normalisasi summerynya-->
            @for($k=1;$k<$count_matrix;$k++)
            <?php $sum_alternatif[$k] = 0; ?>
            @for($b=1;$b<=$count_alternatif;$b++)
            <?php
            $nil = $matrix_alternatif[$b][$k];
            $sum_alternatif[$k] += bSoft::Pangkat($nil, 2);
            ?>
            @endfor
            <?php
            $sum_alternatif[$k] = sqrt($sum_alternatif[$k]);
            ?>
            @endfor
            <div class="panel panel-default">
                <div class="panel-heading">HASIL ANALISA</div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ALTERNATIF</th>
                                @foreach(\App\kriteria::all() as $kriteria)
                                <?php $alias_kriteria[$kriteria->IdKriteria] = $kriteria->Alias ?>
                                <th>{{$alias_kriteria[$kriteria->IdKriteria]}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @for($b=1;$b<=$count_alternatif;$b++)
                            <tr>
                                <td style="font-weight: bold">{{$alias_alternatif[$b]}}</td>
                                @for($k=1;$k<$count_matrix;$k++)
                                <td>{{round($matrix_alternatif[$b][$k],2)}}</td>
                                @endfor
                            </tr>
                            @endfor
                            <tr>
                                <th>TOTAL</th>
                                @for($k=1;$k<$count_matrix;$k++)
                                <th>{{round($sum_alternatif[$k],2)}}</th>
                                @endfor
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            {{--todo:Mencari matrix r--}}
            @foreach($matrix_alternatif as $b=>$bs)
            @foreach($bs as $k=> $bobot)
            <?php
            $matrix_r[$b][$k] = $bobot / $sum_alternatif[$k];
            ?>
            @endforeach
            @endforeach
            {{--todo:Mencetak Matrix R--}}
            <div class="panel panel-default">
                <div class="panel-heading">NORMALISASI</div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ALTERNATIF</th>
                                @foreach(\App\kriteria::all() as $kriteria)
                                <?php $alias_kriteria[$kriteria->IdKriteria] = $kriteria->Alias ?>
                                <th>{{$alias_kriteria[$kriteria->IdKriteria]}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @for($b=1;$b<=$count_alternatif;$b++)
                            <tr>
                                <td style="font-weight: bold">{{$alias_alternatif[$b]}}</td>
                                @for($k=1;$k<$count_matrix;$k++)
                                <td>{{round($matrix_r[$b][$k],2)}}</td>
                                @endfor
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
            {{--todo:Membuat normalisasi terbobot dengan menggunakan bobot prioritas pada AHP--}}
            @foreach($matrix_alternatif as $b=>$bs)
            @foreach($bs as $k=> $bobot)
            <?php
            $matrix_y[$b][$k] = $matrix_r[$b][$k] * $prioritas[$k];
            ?>
            @endforeach
            @endforeach
            {{--todo:Mencetak normalisasi terbobot dengan menggunakan bobot prioritas pada AHP--}}
            <div class="panel panel-default">
                <div class="panel-heading">NORMALISASI TERBOBOT</div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ALTERNATIF</th>
                                @foreach(\App\kriteria::all() as $kriteria)
                                <?php $alias_kriteria[$kriteria->IdKriteria] = $kriteria->Alias ?>
                                <th>{{$alias_kriteria[$kriteria->IdKriteria]}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @for($b=1;$b<=$count_alternatif;$b++)
                            <tr>
                                <td style="font-weight: bold">{{$alias_alternatif[$b]}}</td>
                                @for($k=1;$k<$count_matrix;$k++)
                                <td>{{round($matrix_y[$b][$k],2)}}</td>
                                @endfor
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
            {{--todo:Menentukan matriks solusi ideal positif dan negatif--}}
            @for($k=1;$k<$count_matrix;$k++)
            @for($b=1;$b<=$count_alternatif;$b++)
            <?php
            $list[] = $matrix_y[$b][$k];
            ?>
            @endfor
            <?php
            $y_min[$k] = min($list);
            $y_max[$k] = max($list);
            unset($list);
            ?>
            @endfor
            {{--todo:Mencetak normalisasi terbobot dengan menggunakan bobot prioritas pada AHP--}}
            <div class="panel panel-default">
                <div class="panel-heading">Menentukan matriks solusi ideal positif dan negatif</div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>KRITERIA</th>
                                <th>Y-</th>
                                <th>Y+</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($b=1;$b<$count_matrix;$b++)
                            <tr>
                                <td>{{$alias_kriteria[$b]}}</td>
                                <td>{{$y_min[$b]}}</td>
                                <td>{{$y_max[$b]}}</td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
            @for($b=1;$b<=$count_alternatif;$b++)
            <?php
            $d_max[$b] = 0;
            $d_min[$b] = 0;
            ?>
            @for($k=1;$k<$count_matrix;$k++)
            <?php
            $d_max[$b] += bSoft::Pangkat($matrix_y[$b][$k] - $y_max[$k], 2);
            $d_min[$b] += bSoft::Pangkat($matrix_y[$b][$k] - $y_min[$k], 2);
            ?>
            @endfor
            <?php
            $d_max[$b] = sqrt($d_max[$b]);
            $d_min[$b] = sqrt($d_min[$b]);
            ?>
            @endfor
            {{--todo:Terbobot--}}
            <div class="panel panel-default">
                <div class="panel-heading">Jarak Solusi & Nilai Preferensi</div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-hover table-hover">
                        <thead>
                            <tr>
                                <th>ALTERNATIF</th>
                                <th>D-</th>
                                <th>D+</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($b=1;$b<=$count_alternatif;$b++)
                            <tr>
                                <td>{{$alias_alternatif[$b]}}</td>
                                <td>{{$d_min[$b]}}</td>
                                <td>{{$d_max[$b]}}</td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
            {{--todo:mencari hasil--}}
            @for($b=1;$b<=$count_alternatif;$b++)
            @for($k=1;$k<$count_matrix;$k++)
            <?php
            $hasil[$b] = $d_min[$b] / ($d_min[$b] + $d_max[$b]);
            ?>
            @endfor
            @endfor
            <?php
            bSoft::getRefrance("delete from finish");
            ?>
            @for($b=1;$b<=$count_alternatif;$b++)
            <?php
            $row = new \App\finish();
            $row->IdAlternatif = $b;
            $row->Hasil = $hasil[$b];
            $row->save();
            ?>
            @endfor
            {{--todo:Terbobot--}}
            <div class="panel panel-default">
                <div class="panel-heading">PERINGKAT</div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-hover" id="print">
                        <thead>
                            <tr>
                                <th>Alternatif</th>
                                <th>Hasil</th>
                                <th>Peringkat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(bSoft::getRefrance("select * from (finish a inner join alternatif b on a.idalternatif=b.idalternatif) order by hasil desc") as $peringkat=> $finish)
                            <tr @if(max($hasil)==$finish->Hasil) style="color:red" @endif>
                                 <td style="font-weight: bold">{{$finish->Alias}}
                                    -{{$finish->Alternatif}}</td>
                                <td style="font-weight: bold">{{$finish->Hasil}}</td>
                                <td style="font-weight: bold">{{$peringkat+1}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="/grafik" class="btn btn-warning"><span class="glyphicon glyphicon-folder-open"></span> VIEW GERAFIK</a>
                    <a href="/print" class="btn btn-warning"><span class="glyphicon glyphicon-file"></span> LAPORAN</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

function InfoAlternatif($idalternatif) {
    $find = \App\alternatif::find($idalternatif);
    if (count($find) > 0) {
        return $find;
    }
}

function index_random_consistency($ci) {
    $find = bSoft::getRefrance("select * from ratio_index where RatioIndex<=$ci");
    if (count($find) > 0) {
        return $find[0]->OrdoMatrix;
    }
    return 1.24;
}

function index_random_consistency_lama($ci) {
    if ($ci < 0.58) {
        $ir = 1.12;
    } elseif ($ci < 0.90) {
        $ir = 3;
    } elseif ($ci < 1.12) {
        $ir = 4;
    } elseif ($ci < 1.24) {
        $ir = 5;
    } elseif ($ci < 1.32) {
        $ir = 6;
    } elseif ($ci < 1.41) {
        $ir = 7;
    } elseif ($ci < 1.45) {
        $ir = 8;
    } elseif ($ci < 1.49) {
        $ir = 9;
    } elseif ($ci < 1.51) {
        $ir = 10;
    } elseif ($ci < 1.48) {
        $ir = 11;
    } elseif ($ci < 1.56) {
        $ir = 12;
    } elseif ($ci < 1.57) {
        $ir = 13;
    } elseif ($ci < 1.59) {
        $ir = 14;
    } elseif ($ci >= 1.59) {
        $ir = 15;
    }
    return $ir;
}
?>
@endsection