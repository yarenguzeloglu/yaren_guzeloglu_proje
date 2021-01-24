<?php
$baglanti=mysqli_connect("localhost","root","","2018469034");
if($baglanti){

			
			$res=mysqli_query($baglanti,"SELECT urunler.urun_adi as urun_adi, SUM(satis.adet) as urun_sayisi FROM urunler,satis WHERE urunler.urun_id=satis.urun_id GROUP BY urunler.urun_id HAVING urun_sayisi=(SELECT MIN(toplam) FROM (SELECT SUM(satis.adet) as toplam FROM urunler,satis WHERE urunler.urun_id=satis.urun_id GROUP BY urunler.urun_id)as sonuc)");
			$row=mysqli_fetch_assoc($res);
			$sum=$row['urun_adi'];
			echo $sum;


			mysqli_close($baglanti);
		}else{
			die("Veriler gelmedi");
		}
?>			