<?php
/*
 * file ini berfungsi untuk mengubah angka menjadi
 * kalimat terbilang dari angka tersebut
 */ 
Class Konversi{
		function Terbilang($satuan){
			$huruf = array("","SATU","DUA","TIGA","EMPAT","LIMA","ENAM","TUJUH","DELAPAN","SEMBILAN","SEPULUH","SEBELAS");
			if($satuan<12)
			return " ".$huruf[$satuan];
			else if($satuan<20)
			return $this->Terbilang($satuan-10)." BELAS";
			else if($satuan<100)
			return $this->Terbilang($satuan/10)." PULUH".$this->Terbilang($satuan%10);
			elseif($satuan<200)
			return " SERATUS".$this->Terbilang($satuan-100);
			elseif($satuan<1000)
			return $this->Terbilang($satuan/100)." RATUS".$this->Terbilang($satuan%100);
			elseif($satuan<2000)
			return "SERIBU ".$this->Terbilang($satuan-1000);
			elseif($satuan<1000000)
			return $this->Terbilang($satuan/1000)." RIBU".$this->Terbilang($satuan%1000);
			elseif($satuan<1000000000)
			return $this->Terbilang($satuan/1000000)." JUTA".$this->Terbilang($satuan%1000000);
			elseif($satuan>=1000000000)
			echo "hasil terbilang tidak dapat di proses, nilai terlalu besar";
}
}
?>
