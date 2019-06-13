<?php

include "config/koneksi.php";

$querymenu = "SELECT * FROM modul WHERE  id_parent='0' and aktif='Y' ORDER BY urutan";
$hasil = mysqli_query($konek, $querymenu);
while ($m = mysqli_fetch_array($hasil)){
	echo "<li class='nav-parent'>
		<a href=\"$m[link]\"><i class='fa $m[icons]' aria-hidden='true'></i>
		<span>$m[nama_modul]</span>
		</a>
		<ul class='nav nav-children'>";
			$querysub = "SELECT * FROM modul WHERE id_parent='$m[id_modul]' and aktif='Y' ORDER BY urutan";
			$querymenu_sub = mysqli_query($konek, $querysub);
			while ($querymenu_sub_row = mysqli_fetch_array($querymenu_sub)) {
				if($m['id_modul']==$querymenu_sub_row['id_parent']){ 
				echo "<li>
				<a href='$querymenu_sub_row[link]'>
				<i class='fa $querymenu_sub_row[icons]' aria-hidden='true'></i>
				<span>$querymenu_sub_row[nama_modul]</span></a>
				</li>";
				}
			}
	echo "</ul></li>";
}
?>
