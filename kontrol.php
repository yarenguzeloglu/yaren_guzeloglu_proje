<?php
session_start();
$baglanti=mysqli_connect("localhost","root","","2018469034");
if($baglanti){
		if($_POST){
			if(strip_tags(trim(isset($_POST["e_posta"])))){
				$e_posta=$_POST["e_posta"];
			}
			if(strip_tags(trim(isset($_POST["parola"])))){
				$parola=$_POST["parola"];
			}
			$sorgu=mysqli_query($baglanti,"SELECT * FROM yonetici
			WHERE e_posta='".$e_posta."' AND parola='".$parola."'");
			if(mysqli_num_rows($sorgu)>0){
				$row=mysqli_fetch_assoc($sorgu);
				session_regenerate_id();
				$_SESSION['loggedin']=FALSE;
				$_SESSION['gelenid']=$row["id"];
				$_SESSION['ad']=$row["yonetici_adi"];
				$_SESSION['soyad']=$row["yonetici_soyadi"];
				$_SESSION['resim']=$row["avatar"];
				echo 1;
			}else{
				echo 0;
			}
			mysqli_close($baglanti);
		}else{
			echo "Veriler gelmedi";
		}
};
?>				