<!DOCTYPE html>
<html lang="en">
	<head>
    	<meta charset="utf-8"> 
	    <meta name="viewport" content="width=device-width, initial-scale=1">  
	    <title>Mahjong | Main</title>
	    <link rel="stylesheet" type="text/css" href="styles/mainStyles.css" />
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  	</head>

	<body>
	  	<header style="width: 100%; height: 15%;">
	  		<div class="container">
		  		<div class="row">
		    		<div class="col-md-4" style="text-align: center; min-width: 20%;">
		      			<a class="btn btn-primary btn-lg" href="login.php" role="button" id="logoutButton">Logout</a>
		    		</div>
		    		<div class="col-md-4" style="text-align: center; min-width: 20%;">
		      			<h1 class="heading">Welcome, 
                            <?php
								session_start();
                            		if(isset($_POST['user'])) //if the user just logged in with a username
                            		{
                            			$_SESSION['user'] = $_POST['user']; //save the username
                            			echo $_SESSION['user'];
                            		}
                            		else if(isset($_SESSION['user']))
                            		{
                            			echo $_SESSION['user'];
                            		}
                            		else //if the user logged in without a username
                            		{
                            			echo "Guest"; //save the user as a guest
                            		}
                            ?>!
                        </h1>
		    		</div>
		    		<div class="col-md-4" style="text-align: center; min-width: 20%;">
		      			<a class="btn btn-primary btn-lg" href="tutorialpage.html" role="button" id="tutorialButton">New to Mahjong? <br> Play Some Tutorials!</a>
		    		</div>      
		  		</div>
		  	</div>
	  	</header>

	  	<div class="container" style="height: 100%;">
	  		<div class="row" style="height: 100%;">

	  			<!--This is the column for the list of games that the user can watch-->
	    		<div class="col-md-3" style="height: 100%;">
	      			<h3>Watch</h3>
	      			<div id="leftbox">
	      				<a class="btn btn-primary btn-lg" href="empty.html" role="button" style="margin-top: 7%;">Watch Game</a>
	      				<div id="watchList">
	      					<div class="gamesElement">
		      					<p class="hostName">Host1 </p>
		      					<a class="btn btn-primary btn-lg" href="empty.html" role="button" style="font-size: 75%">Spectate Game</a>
		      				</div>
		      				<div class="gamesElement">
		      					<p class="hostName">HostName2 </p>
		      					<a class="btn btn-primary btn-lg" href="empty.html" role="button" style="font-size: 75%">Spectate Game</a>
		      				</div>
	      				</div>
	      			</div>
	    		</div>

	    		<!--This is the column the user to great games, continue old games, or join existing games-->
	    		<div class="col-md-6" style="height: 100%;">
	      			<h3>Play</h3>
	      			<div id="centerbox">
	      				<a class="btn btn-primary btn-lg" href="newGame.php" role="button" style="margin-top: 3%;">Start New Game</a>
	      				<h4 style="font-weight: bold">Single-Player Games in Progress</h4>
	      				<div class="gamesElement">
	      					<p style="font-weight: bold; font-size: 20px">Game Name</p>
	      				</div>
	      				<div id="unfinishedList" style="height: 30%;overflow: auto">
	      					<?php
	      						if(isset($_POST['removeSingleIndex']) && ($_POST['removeSingleIndex'] != "null"))
                        		{
                        			array_splice($_SESSION['singleGameName'], $_POST['removeSingleIndex'], 1);
                        		}
	      						if(isset($_SESSION['singleGameName']))
	      						{
	      							createNewGameElement();
	      						}

	      						function createNewGameElement()
	      						{
	      							for($i = 0; $i < count($_SESSION['singleGameName']); $i++)
	      							{
	      								echo "<div class=\"gamesElement\">";
		      							echo "<p class=\"gameName\">". $_SESSION['singleGameName'][$i] . " </p>";
		      							echo "<a class=\"btn btn-primary btn-lg\" href=\"http://localhost:8080/WebPLProject/updateStats.jsp?play=yes&singleIndex=" . $i ."\" role=\"button\">Resume Game</a>";
		      							echo "</div>";
	      							}
	      						}
	      					?>
	      				</div>
		      			<h4 style="font-weight: bold">Open Games</h4>
		      			<div class="openElement">
	      					<p style="font-weight: bold; font-size: 20px;">Game Name</p>
	      					<p style="font-weight: bold; font-size: 20px;">Num People</p>
	      				</div>
		      			<div id="openList" style="height: 30%; overflow: auto; overflow-x: hidden;">
		      				<?php
		      					if(isset($_POST['removeMultiIndex']) && ($_POST['removeMultiIndex'] != "null"))
                        		{
                        			array_splice($_SESSION['multiGameName'], $_POST['removeMultiIndex'], 1);
                        		}
	      						if(isset($_SESSION['multiGameName']))
	      						{
	      							createNewOpenElement($_SESSION['multiGameName']);
	      						}

	      						function createNewOpenElement($gameName)
	      						{
	      							for($i = 0; $i < count($_SESSION['multiGameName']); $i++)
	      							{
										echo "<div class=\"openElement\">";
		      							echo "<p class=\"gameName\">". $_SESSION['multiGameName'][$i] . "</p>";
		      							echo "<p class=\"numPlayers\">(1/4)</p>";
		      							echo "<a class=\"btn btn-primary btn-lg\" href=\"http://localhost:8080/WebPLProject/updateStats.jsp?play=yes&multiIndex=" . $i ."\" role=\"button\">Join Game</a>";
		      							echo "</div>";
		      						}
	      						}
	      					?>
		      			</div>
	      			</div>
	    		</div>

	    		<!--This is the column for the user's stats-->
	    		<div class="col-md-3" style="height: 100%;">
		      		<h3>Your Stats</h3>
		      		<div id="rightbox">
	      				<a class="btn btn-primary btn-lg" href="http://localhost:8080/WebPLProject/updateStats.jsp" role="button" style="margin-top: 7%;">View Detailed Stats</a>
	      				<div id="stats" style="text-align: left; margin-left: 15%; margin-top: 7%; width: 100%">
	      					<?php
	      						if(isset($_POST['stats']))
                        		{
                        			$_SESSION['gameStats'] = array($_POST['played'], $_POST['won'], $_POST['lost']);
                        		}
	      						if(isset($_SESSION['gameStats']))
	      						{
	      							gamesPlayedStat($_SESSION['gameStats'][0]);
	      							gamesWonStat($_SESSION['gameStats'][1]);
	      							gamesLostStat($_SESSION['gameStats'][2]);
	      						}
	      						else
	      						{
	      							gamesPlayedStat(0);
	      							gamesWonStat(0);
	      							gamesLostStat(0);
	      						}

	      						function gamesPlayedStat($played)
	      						{
	      							echo "<div class=\"statsElement\">";
	      							echo "<p>Games Played: </p>";
	      							echo "<p>" . $played . "</p>";
	      							echo "</div>";
	      						}

	      						function gamesWonStat($won)
	      						{
	      							echo "<div class=\"statsElement\">";
	      							echo "<p>Games Won: </p>";
	      							echo "<p>" . $won . "</p>";
	      							echo "</div>";
	      						}

	      						function gamesLostStat($lost)
	      						{
	      							echo "<div class=\"statsElement\">";
	      							echo "<p>Games Lost: </p>";
	      							echo "<p>" . $lost . "</p>";
	      							echo "</div>";
	      						}
	      					?>
	      				</div>
	      			</div>
	    		</div>      
	  		</div>
		</div>
  	</body>
</html>