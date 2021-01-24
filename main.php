<?php
setcookie('cookie_name','cookie_value',['samesite' => 'None']);
session_start();
?>


<!DOCTYPE html>
<html>
<head>
<title>ELYA KOZMETİK</title>
<meta charset="utf-8">
<link href="mainstyle.css" rel="stylesheet">
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
<div class="content">

<div class="icerik">
<div class="boxes">
	<div id="box1" class="box"></div>
	<div id="box2" class="box"></div>
	<div id="box3" class="box"></div>
</div>
<?php
$baglanti = mysqli_connect("localhost","root","","2018469034");
$urun_sorgu = mysqli_query($baglanti,"SELECT urunler.urun_adi FROM urunler ");
$satis_sorgu = mysqli_query($baglanti,"SELECT urunler.urun_adi,SUM(satis.adet) as adet FROM urunler,satis WHERE urunler.urun_id=satis.urun_id GROUP BY urunler.urun_id");
?>
<div class="chart">
	<canvas id="urunChart"></canvas>
	<script>
					var miktar=[100,200,300,400,500,600,700,800,900,1000];
					var miktar=[<?php while ($sonuc2=mysqli_fetch_assoc($satis_sorgu)) { echo '"' . $sonuc2['adet'] . '",';}?>];
					
					
					
					
					var adlar=[<?php while ($sonuc=mysqli_fetch_assoc($urun_sorgu)) { echo '"' . $sonuc['urun_adi'] . '",';}?>];
		
					var kanvas = document.getElementById('urunChart').getContext('2d');
					var chart = new Chart(kanvas, {
						type: "bar",
						data: { 
							labels: adlar,
							datasets: [{
								label: 'Toplam Ürün Satışı',
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
</div>
</div>

</body>

<script>

$(document).ready(function(){
	$.post("getir.php",
	function(data,status){
		console.log("Toplam Satılan Ürün Adedi:"+data);
		$("#box1").html("Toplam Satılan Ürün Adedi: "+data);
	});
	$.post("getirFSatan.php",
	function(data,status){
		console.log("En Fazla Satılan Ürün: "+data);
		$("#box2").html("En Fazla Satılan Ürün: "+data);
	});
	$.post("getirASatan.php",
	function(data,status){
		console.log("En Az Satılan Ürün:"+data);
		$("#box3").html("En Az Satılan Ürün: "+data);
	});
	
	$("#ara").click(function(){
	$.post("ara.php",{
		kelime:$(".arama").val()
	},
	function(data,status){
		console.log(data);
	}
	)
});
});

</script>

</html>
