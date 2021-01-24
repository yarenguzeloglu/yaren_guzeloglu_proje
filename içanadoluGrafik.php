<?php
setcookie('cookie_name','cookie_value',['samesite' => 'None']);
session_start();
?>


<!DOCTYPE html>
<html>
<head>
<title>ELYA KOZMETİK</title>
<meta charset="utf-8">
<link href="içanadoluGrafik.css" rel="stylesheet">
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
<div class="acilirmenu">
            <ul>                
                <li><a href="#">Grafikler</a>
                    <ul>
                        <li><a href="egeGrafik.php">Ege</a></li>
                        <li><a href="akdenizGrafik.php">Akdeniz</a></li>
                        <li><a href="karadenizGrafik.php">Karadeniz</a></li>
						<li><a href="içanadoluGrafik.php">İç Anadolu</a></li>
						<li><a href="marmaraGrafik.php">Marmara</a></li>
                    </ul>
                </li>                
            </ul>
            
        </div>
<div class="satis"><a href="urunEkleIndex.php">Mağaza Ekleme</a></div>
<div class="satis"><a href="index.php">Çıkış Yap</a></div>

</div>
</div>
<?php
$baglanti = mysqli_connect("localhost","root","","2018469034");
$urun_sorgu = mysqli_query($baglanti,"SELECT urunler.urun_adi FROM urunler");
$satis_sorgu = mysqli_query($baglanti,"SELECT urunler.urun_adi,SUM(satis.adet) AS adet FROM urunler,satis,magazalar WHERE urunler.urun_id=satis.urun_id AND satis.magaza_id=magazalar.magaza_id AND magazalar.magaza_id LIKE '345' GROUP BY urunler.urun_adi");
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
								label: 'İç Anadolu Bölgesi Toplam Ürün Satışı',
								backgroundColor: "rgb(215,183,181)",		
								borderColor: "rgb(215,183,181)",
								data: miktar,
							
				}]
			},
			options: {
				legend:{
					labels: {
						fontColor:'rgb(215,183,181)'
					}
				},
				scales: {
					yAxes: [{
						ticks:{
							fontColor:"rgb(215,183,181)",
							beginAtZero: true,							
						}
					}],
					xAxes:[{
						ticks:{
							fontColor:"rgb(215,183,181)"
						}
					}]
				}
			}
		});
	</script>
	</div>