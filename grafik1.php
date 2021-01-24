<?php
setcookie('cookie_name','cookie_value',['samesite' => 'None']);
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>ELYA KOZMETİK</title>
<meta charset="utf-8">
<link href="grafikstyle.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
</head>
<body>
<div class="sidebar">
<div class="sidebarTop"> ELYA KOZMETİK</div>
<div class="info">
	<img id="avatar" src="<?php echo $_SESSION['resim'] ?>">
	<div class="infog">
		<span class="infoName">Yaren Güzeloğlu
		 </span>
		<span class="infoStatus"></span>
	</div>
	<div class="search">
		<input class="arama" type="text">
		<span>
			<a href="#">
				<i id="ara" class="fa fa-search" aria-hidden="true"></i>
			</a>
		</span>
	</div>

</div>
<div class="satislar">

<div class="satis"><a href="main.php">Dashboard</a></div>
<div class="satis"><a href="grafik1.php">Grafikler</a></div>
<div class="satis"><a href="urunEkleIndex.php">Ürün Ekleme</a></div>
<div class="satis"><a href="index.php">Çıkış Yap</a></div>

</div>
</div>
<?php
$baglanti = mysqli_connect("localhost","root","","2018469034");
$urun_sorgu = mysqli_query($baglanti,"SELECT urunler.urun_adi FROM urunler");
$satis_sorgu = mysqli_query($baglanti,"SELECT urunler.urun_adi,SUM(satis.adet) AS adet FROM urunler,satis,magazalar WHERE urunler.urun_id=satis.urun_id AND satis.magaza_id=magazalar.magaza_id AND magazalar.magaza_id LIKE '234' GROUP BY urunler.urun_adi");
?>
<div class="chart">
	<canvas id="urunChart"></canvas>
	<script>
					var miktar=[50,70,100,120,150,170,200,220,250,300];
					var miktar=[<?php while ($sonuc2=mysqli_fetch_assoc($satis_sorgu)) { echo '"' . $sonuc2['adet'] . '",';}?>];
					
					
					
					
					var adlar=[<?php while ($sonuc=mysqli_fetch_assoc($urun_sorgu)) { echo '"' . $sonuc['urun_adi'] . '",';}?>];
		
					var kanvas = document.getElementById('urunChart').getContext('2d');
					var chart = new Chart(kanvas, {
						type: "bar",
						data: { 
							labels: adlar,
							datasets: [{
								label: 'Akdeniz Bölgesi Toplam Ürün Satışı',
								backgroundColor: "rgb(255,207,195)",		
								borderColor: "rgb(255,207,195)",
								data: miktar,
							
				}]
			},
			options: {
				legend:{
					labels: {
						fontColor:'rgb(52,58,64)'
					}
				},
				scales: {
					yAxes: [{
						ticks:{
							fontColor:"rgb(52,58,64)",
							beginAtZero: true,							
						}
					}],
					xAxes:[{
						ticks:{
							fontColor:"rgb(52,58,64)"
						}
					}]
				}
			}
		});
	</script>
	</div>
	<?php
$baglanti = mysqli_connect("localhost","root","","2018469034");
$urun_sorgu3 = mysqli_query($baglanti,"SELECT urunler.urun_adi FROM urunler");
$satis_sorgu3 = mysqli_query($baglanti,"SELECT urunler.urun_adi,SUM(satis.adet) AS adet FROM urunler,satis,magazalar WHERE urunler.urun_id=satis.urun_id AND satis.magaza_id=magazalar.magaza_id AND magazalar.magaza_id LIKE '951' GROUP BY urunler.urun_adi");
?>
<div class="chart3">
	<canvas id="urunChart3"></canvas>
	<script>
					var miktar3=[50,70,100,120,150,170,200,220,250,300];
					var miktar3=[<?php while ($sonuc4=mysqli_fetch_assoc($satis_sorgu3)) { echo '"' . $sonuc4['adet'] . '",';}?>];
					
					
					
					
					var adlar3=[<?php while ($sonuc3=mysqli_fetch_assoc($urun_sorgu3)) { echo '"' . $sonuc3['urun_adi'] . '",';}?>];
		
					var kanvas3 = document.getElementById('urunChart3').getContext('2d');
					var chart3 = new Chart(kanvas3, {
						type: "bar",
						data: { 
							labels: adlar3,
							datasets: [{
								label: 'Ege Bölgesi Toplam Ürün Satışı',
								backgroundColor: "rgb(255,207,195)",		
								borderColor: "rgb(255,207,195)",
								data: miktar3,
							
				}]
			},
			options: {
				legend:{
					labels: {
						fontColor:'rgb(52,58,64)'
					}
				},
				scales: {
					yAxes: [{
						ticks:{
							fontColor:"rgb(52,58,64)",
							beginAtZero: true,							
						}
					}],
					xAxes:[{
						ticks:{
							fontColor:"rgb(52,58,64)"
						}
					}]
				}
			}
		});
	</script>
	</div>
<?php
$baglanti = mysqli_connect("localhost","root","","2018469034");
$urun_sorgu2 = mysqli_query($baglanti,"SELECT urunler.urun_adi FROM urunler");
$satis_sorgu2 = mysqli_query($baglanti,"SELECT urunler.urun_adi,SUM(satis.adet) AS adet FROM urunler,satis,magazalar WHERE urunler.urun_id=satis.urun_id AND satis.magaza_id=magazalar.magaza_id AND magazalar.magaza_id LIKE '123' GROUP BY urunler.urun_adi");
?>
	<div class="chart2">
	<canvas id="urunChart2"></canvas>
	<script>
					var miktar2=[50,70,100,120,150,170,200,220,250,300];
					var miktar2=[<?php while ($sonuc3=mysqli_fetch_assoc($satis_sorgu2)) { echo '"' . $sonuc3['adet'] . '",';}?>];
					
					
					
					
					var adlar2=[<?php while ($sonuc2=mysqli_fetch_assoc($urun_sorgu2)) { echo '"' . $sonuc2['urun_adi'] . '",';}?>];
		
					var kanvas2 = document.getElementById('urunChart2').getContext('2d');
					var chart2 = new Chart(kanvas2, {
						type: "bar",
						data: { 
							labels: adlar2,
							datasets: [{
								label: 'Karadeniz Bölgesi Toplam Ürün Satışı',
								backgroundColor: "rgb(255,207,195)",		
								borderColor: "rgb(255,207,195)",
								data: miktar2,
							
				}]
			},
			options: {
				legend:{
					labels: {
						fontColor:'rgb(52,58,64)'
					}
				},
				scales: {
					yAxes: [{
						ticks:{
							fontColor:"rgb(52,58,64)",
							beginAtZero: true,							
						}
					}],
					xAxes:[{
						ticks:{
							fontColor:"rgb(52,58,64)"
						}
					}]
				}
			}
		});
	</script>
	</div>
	
</body>