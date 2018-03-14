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
			Game Name:
			<textarea rows="1" cols="20" name="gameName"></textarea> <br/>
			<input type="checkbox" id="singlePlayer" name="single"> Single Player? <br/>
			<input type="submit" value="Create New Game" name="btn"/>
		</form>

 		<?php
 			$name = null;
 			$single = null;
			if($_SERVER['REQUEST_METHOD'] == "POST")
			{
				if(empty($_POST['gameName']))
				{
					echo "Please enter a name for your game <br/>";
				}
				else
				{
					$name = $_POST['gameName'];
					if(isset($_POST['single']))
					{
						$_SESSION['singleGames'][] = $name;
					}	
					else
					{
						$_SESSION['multiGames'][] = $name;
					}

					header("Location: mainpage.php");
					exit;
				}
			}
		?>
	</body>
</html>