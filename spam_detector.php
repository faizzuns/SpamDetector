<!DOCTYPE html>
<?php
	if (isset($_POST['option']) == "1")
	{
		$category = "bm\n";
		$searchKey = $_POST['searchKey']."\n";
		$spamKey = $_POST['spamKey']."\n";
		$myfile = fopen("input.txt", "w+") or die("Unable to open file!");
		fwrite($myfile, $category);
		fwrite($myfile, $searchKey);
		fwrite($myfile, $spamKey);
		fclose($myfile);
		exec("python twitter.py", $output);
		header("Refresh:0");
	}else if (isset($_POST['option']) == "2"){
		$category = "kmp\n";
		$searchKey = $_POST['searchKey']."\n";
		$spamKey = $_POST['spamKey']."\n";
		$myfile = fopen("input.txt", "w+") or die("Unable to open file!");
		fwrite($myfile, $category);
		fwrite($myfile, $searchKey);
		fwrite($myfile, $spamKey);
		fclose($myfile);
		exec("python twitter.py", $output);
		header("Refresh:0");
	}else if (isset($_POST['option']) == "3"){
		$category = "regex\n";
		$searchKey = $_POST['searchKey']."\n";
		$spamKey = $_POST['spamKey']."\n";
		$myfile = fopen("input.txt", "w+") or die("Unable to open file!");
		fwrite($myfile, $category);
		fwrite($myfile, $searchKey);
		fwrite($myfile, $spamKey);
		fclose($myfile);
		exec("python twitter.py", $output);
		header("Refresh:0");
	}
?>
<html>
<title>SPAM DETECTOR!</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
<style>
body, html {
    height: 100%;
    font-family: "Inconsolata", sans-serif;
}
.bgimg {
    background-position: center top;
    background-size: cover;
    background-image: url("foto.jpg");
    min-height: 100%;
	opacity : 0.7;
}
.menu {
    display: none;
}
</style>
<body>

<!-- Links (sit on top) -->
<div class="w3-top">
  <div class="w3-row w3-padding w3-black">
    <div class="w3-col s3">
      <a href="#" class="w3-button w3-block w3-black">HOME</a>
    </div>
    <div class="w3-col s3">
      <a href="#about" class="w3-button w3-block w3-black">TEAM</a>
    </div>
    <div class="w3-col s3">
      <a href="#menu" class="w3-button w3-block w3-black">SPAM DETECTOR</a>
    </div>
    <div class="w3-col s3">
      <a href="#where" class="w3-button w3-block w3-black">FIND US</a>
    </div>
  </div>
</div>

<!-- Header with image -->
<header class="bgimg w3-display-container w3-grayscale-min" id="home">
  <div class="w3-display-bottomleft w3-center w3-padding-large w3-hide-small">
    <span class="w3-tag">Open from 8pm till drop</span>
  </div>
  <div class="w3-display-middle w3-center">
    <span class="w3-text-white" style="font-size:90px">SAHUPILI<br>TEAM</span>
  </div>
  <div class="w3-display-bottomright w3-center w3-padding-large">
    <span class="w3-text-white">Bandung, Laboratorium Ayam-Ayaman</span>
  </div>
</header>

<!-- Add a background color and large text to the whole page -->
<div class="w3-sand w3-grayscale w3-large">

<!-- About Container -->
<div class="w3-container" id="about">
  <div class="w3-content" style="max-width:700px">
    <h5 class="w3-center w3-padding-64"><span class="w3-tag w3-wide">TEAM</span></h5>
    <p>First, <b>Ahmad Faiz Sahupala</b>, 13516065.
	<br>
	The only man in this group, very curious in technology!</p>
    <p>Second, <b>Yasya Rusyda Aslina</b>, 13516091.
	<br>
	strong woman, because she carried this TASK so easily!</p>
	<p>Lastly, <b>Yuly Haruka</b>, 13516031.
	<br>
	She is our SPARTA Leader! she has a big vision for informatics next generations!</p>
    <div class="w3-panel w3-leftbar w3-light-grey">
      <p><i>"Jangan masuk IF, berat. Kamu ga akan kuat, biar kita saja."</i></p>
      <p>Dilan(da tubes) 2018.</p>
    </div>
  </div>
</div>

<!-- Menu Container -->


<div class="w3-container" id="menu">
  <div class="w3-content" style="max-width:700px">
 
    <h5 class="w3-center w3-padding-48"><span class="w3-tag w3-wide">SPAM DETECTOR</span></h5>
	
	<form method="post">
      <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Username" required name="searchKey"></p>
      <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Spam word" required name="spamKey"></p>
	  <p>
		<select class="w3-select" name="option">
		<option value="" disabled selected>Choose your option</option>
		<option value="1">Booyer Moore</option>
		<option value="2">KMP</option>
		<option value="3">Regex</option>
		</select>
	  </p>
      <p><button class="w3-button w3-black" type="submit">Seach SPAM!</button></p>
    </form>
	<br><br>
  
    <div class="w3-row w3-center w3-card w3-padding">
      <a href="javascript:void(0)" onclick="openMenu(event, 'Eat');" id="myLink">
        <div class="w3-col tablink">Result</div>
      </a>
    </div>

    <div id="Eat" class="w3-container menu w3-padding-48 w3-card">
	  <?php
				//exec("python twitter.py kitty", $output);

		$data = json_decode(file_get_contents("data.txt"), true);
		$text = $data['text'];
		//print_r($text);
		$i = 0;
		while($i<40):
			if ($text[$i]['spam']){
				echo "<p class="."\""."w3-red"."\"".">";
			}else{
				echo "<p class="."\""."w3-text-grey"."\"".">";
			}
			echo "<b>";
			echo "@";
			echo $text[$i]['username'];
			echo "</b>";
			
			echo "<br>";
			
			echo $text[$i]['test'];
			$i += 1;
			echo "</p>";
		endwhile;
	  ?>
    </div>
  </div>
</div>

<!-- Contact/Area Container -->
<div class="w3-container" id="where" style="padding-bottom:32px;">
  <div class="w3-content" style="max-width:700px">
    <h5 class="w3-center w3-padding-48"><span class="w3-tag w3-wide">WHERE TO FIND US</span></h5>
    <p>Find us at :</p>
	<p><b>1. Ding-Dong</b><br>
	<img src="ding.jpg" style="width:100%;max-width:1000px;margin-top:32px;">
	</p>
	<p><b>2. Ayam-Ayaman</b><br>
	<img src="ayam.jpg" style="width:100%;max-width:1000px;margin-top:32px;">
	</p>
	<p><b>3. Rumah Opal</b><br>
	<img src="opal.jpg" style="width:100%;max-width:1000px;margin-top:32px;">
	</p>
	<p><b>4. Kosan Masing-Masing</b>
	<br>
	(*notes : dalam keadaan sedang tertidur)</p>
  </div>
</div>

<!-- End page content -->
</div>

<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-48 w3-large">
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green">w3.css</a></p>
</footer>

<!-- Add Google Maps -->
<script>
function myMap()
{
  myCenter=new google.maps.LatLng(41.878114, -87.629798);
  var mapOptions= {
    center:myCenter,
    zoom:12, scrollwheel: false, draggable: false,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  var map=new google.maps.Map(document.getElementById("googleMap"),mapOptions);

  var marker = new google.maps.Marker({
    position: myCenter,
  });
  marker.setMap(map);
}

// Tabbed Menu
function openMenu(evt, menuName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("menu");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
     tablinks[i].className = tablinks[i].className.replace(" w3-dark-grey", "");
  }
  document.getElementById(menuName).style.display = "block";
  evt.currentTarget.firstElementChild.className += " w3-dark-grey";
}
document.getElementById("myLink").click();
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu-916DdpKAjTmJNIgngS6HL_kDIKU0aU&callback=myMap"></script>
<!--
To use this code on your website, get a free API key from Google.
Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
-->

</body>
</html>
