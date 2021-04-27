<?php
	$host="us-cdbr-iron-east-05.cleardb.net";
    $user="be790e4eb7458b";
    $password="78c739da";
    $db="heroku_0a876b33f00670d";
    
    $conn = mysqli_connect($host,$user,$password,$db);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    session_start();

	$usertype = $_SESSION['login_usertype'];

	if(isset($_POST['btn-return'])) {
		if($usertype == 'Student'){
			header("location: home3.php");
		} elseif($usertype == 'Teacher') {
			header("location: home4.php");
		} else {
			header("location: home5.php");
		}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="css/chat.css"/>
    <script type="text/javascript" src="js/librarychatindex.js" ></script>
    <script type="text/javascript" src="js/librarychatconstant.js" ></script>
    <script type="text/javascript" src="js/librarychatspeech.js" ></script>
	<title>The Library Bot Online Chatting Page</title>
	<style>
	input[type=submit] {
      border: none;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      margin: 4px 2px;
      cursor: pointer;
      font-size: 17px;
      width: 18em;
      height: 3em;
    }

    input[type=submit]:hover {
    background-color: #45a049;
    }

	.buttonHolder{ 
      text-align: right;
      margin: 4px 2px;
      padding-top: 5px; 
    }
	</style>
	<link rel="icon" href="img/bot.png" />
</head>

<body>
	<div id="container" class="container">
		<div id="chat" class="chat">
			<div id="messages" class="messages"></div>
			<input id="input" type="text" placeholder="Say something..." autocomplete="off" autofocus="true" />

			<form action="librarychat.php" method="POST">
				<div class="buttonHolder">
				<input type="submit" value="Back To The Homepage" name="btn-return" style="background-color: #4CAF50;">
				</div>
			</form>
		</div>
		<img src="img/bot.png" alt="Robot cartoon" height="500vh">
	</div>
</body>


</html>