<!Doctype html>
<html>
	<head>
		<title>
			Create New Game
		</title>
	    <link rel="stylesheet" type="text/css" href="styles/mainStyles.css" />
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
	</head>

	<body>
		<form action="newGame.php" method="post" style="text-align: center; margin-top: 5%">
			<h1> Create New Game </h1>
			<p style="margin-top: 1%">Game Name: <textarea rows="1" cols="20" name="gameName"></textarea></p>
			<input type="checkbox" id="singlePlayer" name="single" style="margin-top: 1%"> Single Player? <br/>
			<input type="submit" value="Create New Game" name="btn" style="margin-top: 1%"/>
		</form>

 		<?php
 			session_start();
 			$name = null;
 			$single = null;
			if($_SERVER['REQUEST_METHOD'] == "POST")
			{
				if(empty($_POST['gameName']))
				{
					echo "<p style=\"text-align: center; color: red\">Please enter a name for your game </p><br/>";
				}
				else
				{
					$name = $_POST['gameName'];
					if(isset($_POST['single']))
					{
						$_SESSION['singleGameName'][] = $name;
					}	
					else
					{
						$_SESSION['multiGameName'][] = $name;
					}

					header("Location: mainpage.php");
					exit;
				}
			}
		?>
	</body>
</html>