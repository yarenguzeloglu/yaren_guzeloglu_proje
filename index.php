<!DOCTYPE html>
<html>
<head>
<title>ELYA KOZMETİK</title>
<meta charset="utf-8">
<link href="style.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$("#giris").click(function(){
		
		
		
		$.post("kontrol.php",
		{
			e_posta:$("#e_posta").val(),
			parola:$("#parola").val()
		},
		function(data,status){
			if(data==1){
				$(location).attr("href","main.php");
			}else{
				alert("Kullanıcı adı veya parola yanlış");
			}
		}
		);
	});
});
</script>
</head>
<body>
    <h1>ELYA KOZMETİK</h1>
    <div class="girisEkrani">
        <label class="girisyazi">LÜTFEN BİLGİLERİNİZİ GİRİNİZ</label>
        <input type="email" id="e_posta" placeholder="E-Mail">
        <input type="password" id="parola" placeholder="Parola">
        <button id="giris"> OTURUM AÇ</button>
        <a href="#">Şifremi Unuttum</a>
    </div>
</body>
</html>