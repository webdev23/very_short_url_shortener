<?php

//~ Very short url shortener! 

ini_set('display_errors', 'Off');
// error_reporting(E_ALL);
error_reporting(0);

$toshort = $_POST["bigurl"];

$name = $_POST["name"];

$host = "http://$_SERVER[HTTP_HOST]$_SERVER[SCRIPT_NAME]";

$bookmarklet = 'javascript:void(window.location=&#39;'.$host.'?to_short=&#39+encodeURIComponent(window.location.href));';

echo '<h1>';

if (empty ($toshort)) {

	echo'<big><a id="hi" href="index.php">Hello!</a></big><br>I am very short url shortener<br>

	I need urls to exist<br><i>Feed me now</i><br>Or use: <a href="'.$bookmarklet.'" onclick="alrt()">the bookmarklet</a> !
	
	<p>';

    echo'
        <textarea style="display:none" id="bktxt">'.$bookmarklet.'</textarea>

        <form method="post">

	<input type="input" name="bigurl" autofocus placeholder="//url, or whatever" value="'.$_REQUEST["to_short"].'" /><br>
	
	<input type="input" name="name" placeholder="Optional: give a name" value="'.$_REQUEST["name"].'" /><br>

	<input type="submit" value="Shorten with_very_short_url_shortener" id="shr"/>
	
	</form>';

	}

if (!empty ($toshort)) {
	
	$token = bin2hex(openssl_random_pseudo_bytes(2));
	
    }
	
if (!empty ($name)) {
		
	$token = $name;
		
    }

if (!empty ($toshort)) {	

	file_put_contents($token, $toshort . PHP_EOL, FILE_APPEND);

	echo $toshort;

	echo'<h1><br>is now linked to:<br>';

	echo'<a href="?s='.$token.'">?s='.$token.'</a></h1>';

    }

if (!empty ($_GET["s"])) {	

	echo"<br>";

	$sid = $_GET["s"];
	
	$linked = file_get_contents($sid);
	
    if (get_headers($linked) === false) {
		
       header("Location: $sid");
    
        die();

     } 

    if (empty ($linked)) {

        echo"Error 404 gone to party.";

     }

     if (!empty ($linked)) {			

	     echo'
	        You are going to be redirected to:<p>   
	          
	        <a href="'.$linked.'" id="lnk">'.$linked.'</a>';
	
     echo'
	<script>
		window.onload = function() {
			setTimeout(function() {
			document.getElementById("lnk").click();
	                         }, 1400)};
			   </script>';
       }	
};

if (!empty ($_REQUEST["to_short"])) {

     echo'
	 <script>
	        window.onload = function() {
			setTimeout(function() {
                        document.getElementById("shr").click();
		                 }, 2000)};
		    </script>';
        }
?>

<script>
	function alrt() {alert(document.getElementById("bktxt").innerHTML)};
    </script>
		
 <style>
		body{
			text-align:center;
			font:caption;
			background-color:#f5b041;
			padding:12%;
			max-width:100%
		        }
		input{
			font-size:1.1em;
			margin:3px
			}
		input,a{
			transition:.44s ease-out
			}
		a:hover{
			padding:8;
			font-size:1.04em
			}
	        input:hover{
			background-color:#f5b041;
			padding:0 5 5 5;
			margin:0 5 5 5
			}
	        input[type=submit]:hover{
			cursor:pointer
			}
	        #hi{
			font-size:1.8em;margin:12
			}
</style>
		
 <small>
    <a title="Fourchette moi sur Github" href="https://github.com/webdev23/very_short_url_shortener">🍴 </a>
       </small>
      
      
	
