<?php
session_start();
$baglanti=mysqli_connect("localhost","root","","2018469034");
if($baglanti){
		if($_POST){
			if(strip_tags(trim(isset($_POST["kelime"])))){
				$kelime=$_POST["kelime"];
			}
			
			$sorgu=mysqli_query($baglanti,"SELECT * FROM urunler
			WHERE URUN_ADI='".$kelime."' ");
			if(mysqli_num_rows($sorgu)>0){
			$row=mysqli_fetch_assoc($sorgu);
			echo 1;	
			}
			mysqli_close($baglanti);
		}else{
			echo "Veriler gelmedi";
		}
}else{
	die("Bağlantı sağlanamadı");
	
};





?>