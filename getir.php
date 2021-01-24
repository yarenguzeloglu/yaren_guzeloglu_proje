<?php
$baglanti=mysqli_connect("localhost","root","","2018469034");
if($baglanti){

			
			$res=mysqli_query($baglanti,"SELECT SUM(satis.adet) AS count FROM satis");
			$row=mysqli_fetch_assoc($res);
			$sum=$row['count'];
			echo $sum;


			mysqli_close($baglanti);
		}else{
			die("Veriler gelmedi");
		}
?>			