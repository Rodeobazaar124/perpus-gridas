<?php
echo "
<div style='float:left'>";
include 'config/koneksi.php';
include 'config/bar128.php';
echo "<div style='background-image:url(images/bgkartu.jpg);width:280px;height:190px;'>";

$profil = (mysqli_query(KONEKSI, 'SELECT * FROM profil '));
while ($d = mysqli_fetch_array($profil)) {
    echo "
    <div style='color:#FFF;border-bottom-width: 2px;
	border-bottom-style: solid;
	border-bottom-color: #F60;height:60px;	'>
	<div style='float:left; width:20%;margin-top:-5px;'><img src=images/$d[logo] width='40px' style='margin-top:7px;margin-left:10px;'></div><div style='width:80%;float:left;'>
	<p align=center style='margin-top:2px'><font size=-1 ><strong>$d[nama_perpus]</strong> <br>$d[alamat]</font></p></div>
	</div>";
}
echo "<div style='clear:both;'></div>";
$sql = (mysqli_query(KONEKSI, "SELECT * FROM anggota where id = '$_GET[id]' "));
while ($k = mysqli_fetch_array($sql)) {
    $perpus = bar128(stripslashes($k['noanggota']));
    echo "
	
	<div style='float:left; width:30%;'>
	<img src=images/photo.jpg width='70px' style='margin-top:7px;margin-left:6px;'>
	</div>
	<div style='width:70%;float:left;margin-top:-5px;'>
	<table style='color:#FFF;'><font size=-1 >
	<tr><td><font size=-2 ><strong>No. Anggota</strong></font> </td><td>:</td><td><font size=-2 > <strong>$k[noanggota]</strong> </font> </td></tr>
	<tr><td><font size=-2 ><strong>Nama </strong></font></td><td>:</td><td> <font size=-2 ><strong>$k[nama]</strong></font> </td></tr>
	<tr><td><font size=-2 ><strong>Kelas </strong></font> </td><td>:</td><td> <font size=-2 ><strong>$k[pekerjaan]</font> </td></tr>
	
	
	</font>
	
	</table>
	
	</div>
	<div style='clear:both;'></div>
	<div  style=' width:105px;height:38px;background:#FFF;border: 3px double #ababab; padding: 5px; margin-left :auto;margin-right:auto; margin-top:-20px; '> $perpus </div>
	</div>
	";

}

echo '</div>
</div>

';

?>
<?php
echo "
<div style='float:left;margin-top:-1px'>";
echo "<div style='background-image:url(images/bgkartu.jpg);padding-left:8px;padding-right:2px;width:270px;height:190px;color:#FFFFF'>";

echo " <h4 align=center style='margin-top:1px;padding-top:1px' ><font color='white'  style='margin-top:1px;padding-top:1px' >
Tata Tertib : </font></h4>  
<hr>
<font size=-1 color='white'>
        1. Kartu tidak boleh digunakan oleh orang lain. <br>
        2. Kartu harap dibawa saat meminjam buku. <br>
        3. Lama peminjaman 7 hari dan dapat diperpanjang max 1x  			dalam bulan yang sama. <br>
	  4. Keterlambatan di denda Rp.500,-/hari/buku<br>
	  5. Buku yang hilang/rusak wajib mengganti dengan buku yg sama atau denda sesuai nilai buku.
</font>


 
	";

echo '</div></div>


';

?>

