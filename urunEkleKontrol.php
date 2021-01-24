<?php
//error_reporting(0);

$baglanti = mysqli_connect("localhost","root","","2018469034"); 
if($baglanti){ 

	if(isset($_POST)){ 

		if($_POST["magaza_id"] == "" or $_POST["magaza_adi"] == "" or $_POST["il_id"] == ""){ 
			echo "Boş veri girişi";
		} else {

			
			$magaza_id = strip_tags(trim($_POST["magaza_id"]));
			$magaza_adi = strip_tags(trim($_POST["magaza_adi"]));
			$il_id = strip_tags(trim($_POST["il_id"]));
			
			

			
			$sorgu = mysqli_query($baglanti,"INSERT INTO magazalar(magaza_id,magaza_adi,il_id) VALUES ('".$magaza_id."','".$magaza_adi."','".$il_id."')");
			if($sorgu == TRUE){ 

				echo "Kayıt Başarıyla Eklendi";

				

				

		

			

			} else {
				echo "Kayıt hatası...";
			}

		}

		mysqli_close($baglanti);

	} else {
		echo "Post işlemi yaparken bir hata oldu...";
	}
} else {

	die("Veritabanı bağlantısı hatalı...");

}

?>