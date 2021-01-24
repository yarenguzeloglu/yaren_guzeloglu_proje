
<!DOCTYPE html>
<html>
<head>
	<title>Mağaza Ekleme</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
	<script>
		$(document).ready(function(){

			$("#button-islem").click(function(){ 
				$.ajax({
					type: "POST", 
					url: "urunEkleKontrol.php", 
					data: $('#form-islem').serialize(), 
					success: function(sonuc){
						$("#sonuc").show().html(sonuc); 
						$("#form-islem")[0].reset(); 
					}
				});
			});

		});
	</script>

	<style>
	
body{
	font-family: 'Graphik','Arial';
	display:flex;
    height:1024px;
	background-color:#67686d;
    background-image: url(img/3.jpg);
	padding:0;
	margin:0;
}
.sidebar{
	width:13%;
	background-color:#d7b7b5;
	display:flex;
	flex-direction:column;
}
.sidebar .sidebarTop{
	width:100%;
	height:50px;
	background-color:#67686d;
	color:white;
	display:flex;
	align-items:center;
	justify-content:center;
	font-size:20px;
}
.content{
	flex:1;
	background-color:#67686d;
}
#avatar{
	width:60px;
	height:60px;
	border-radius:50px;
	margin;10px;
	
}
.info{
	display:inline-block;
	width:100%;
	height:100px;
	margin-top:15px;
	padding-left:10px;
	
}
.infoName{
	font-style:italic;
	font-family: fantasy;
	font-size:20px;
	width:100px;
	color:#67686d;
	font-weight:bold;
	padding-bottom:10px;
	
}
.search{
	display:flex;
}
.arama{
	width:80%;
	margin-top:23px;
	background-color:white;
	border:none;
}
.sidebar .search i{
	margin-top:23px;
	margin-left:4px;
	color:#67686d;
	
}
.satislar{
	display:flex;
	flex-direction:column;
	font-weight:bold;
	margin-top:20px;
	
	
}.sidebar .satislar .satis{
	width:100%;
	height:25px;
	margin-top:40px;
	margin-left:15px;
	text-decoration:none;
	
}
.acilirmenu{
    width:100%;
	height:25px;
	margin-top:40px;
	margin-left:15px;
	text-decoration:none;
}
.acilirmenu ul{
    width:180px;
    margin:0;	
    padding:0;
    list-style-type:none;   
}
.acilirmenu li{
    position: relative;
}
.acilirmenu li ul{
    position:absolute;
	margin-left:10px;
    list-style-type:none;
	margin-top: 30px;
    left:-10px;
    width:180px;
    display:none;
    top:0;  
	background-color:#d7b7b5;
    color:#FFF;
    font:500 15px Verdana;
    padding:5px;
    border:1px solid #FFF;
    border-bottom:0; 
    text-align: center;
    line-height: 30px;
}
.acilirmenu li a{
    font-style:italic;
	font-family: sans-serif;
	font-size:25px;
	text-decoration:none;
	color:#67686d;
}
.acilirmenu li a:hover{
    background-color:#67686d;
    color:#FF0;
}
.acilirmenu li:hover ul{
    display:block;
}
.sidebar .satislar .satis a{
	font-style:italic;
	font-family: sans-serif;
	font-size:25px;
	text-decoration:none;
	color:#67686d;
}
body{
	font-family: arial;
	font-size: 20px;
	background-color:#67686d;
}
		.genel{
			margin: 60px auto;
			width: 500px;
		}
		.baslik{
			padding-right:100px;
			padding-bottom:20px;
			font-weight:bold;
			color:#d7b7b5;
		}
		.input{
			padding: 10px;
			outline: none;
			font-family: arial;
			color:#black;
			width: 70%;
			box-sizing: border-box;
			margin-bottom: 10px;
			margin-top: 3px;
		}
		.button{
			padding: 10px;
			font-size: 18px;
			font-weight: bold;
			font-family: arial;
			cursor: pointer;
			color:black;
			background-color:#d7b7b5;
		}
		.sonuc{
			width: 100%;
			box-sizing: border-box;
			background-color: #d7b7b5;
			color: #8b658b;
			font-size: 27px;
			padding: 15px;
			margin-top: 25px;
			text-align: center;
		}
	</style>

</head>

<body>
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
	<i id="ara" class="fa fa-search" aria-hidden="true"></i>
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

	<div class="genel">
		<form id="form-islem" method="POST">
			<div class="baslik">MAĞAZA EKLEME</div>
			MAĞAZA ID:<br><input type="text" class="input" name="magaza_id"> 
			<br>
			MAĞAZA ADI:<br><input type="text" class="input" name="magaza_adi">
			<br>
			<br>

			
			İL ID:<br><input type="text" class="input" name="il_id">
			<br>
			
			<br>
			<br>

			
			

			<input type="button" class="button" id="button-islem" value="MAĞAZA EKLE">

			<div id="sonuc" class="sonuc" hidden=""></div> 
		</form>
	</div>

</body>
</html>