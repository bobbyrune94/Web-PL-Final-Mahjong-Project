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
                            	if(isset($_SESSION['user'])) //if there is already a user, then use that
                            		echo $_SESSION['user'];
                            	else
                            	{
                            		if(isset($_POST['user'])) //if the user just logged in with a username
                            		{
                            			$_SESSION['user'] = $_POST['user']; //save the username
                            		}
                            		else //if the user logged in without a username
                            		{
                            			$_SESSION['user'] = "Guest"; //save the user as a guest
                            		}
                            		echo $_SESSION['user'];
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
	      						if(isset($_SESSION['singleGameName']))
	      						{
	      							createNewGameElement();
	      						}

	      						function createNewGameElement()
	      						{
	      							foreach($_SESSION['singleGameName'] as $gameName)
	      							{
	      								echo "<div class=\"gamesElement\">";
		      							echo "<p class=\"gameName\">". $gameName . " </p>";
		      							echo "<a class=\"btn btn-primary btn-lg\" href=\"empty.html\" role=\"button\">Resume Game</a>";
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
	      						if(isset($_SESSION['multiGameName']))
	      						{
	      							createNewOpenElement($_SESSION['multiGameName']);
	      						}

	      						function createNewOpenElement($gameName)
	      						{
	      							foreach($_SESSION['multiGameName'] as $gameName)
	      							{
										echo "<div class=\"openElement\">";
		      							echo "<p class=\"gameName\">". $gameName . "</p>";
		      							echo "<p class=\"numPlayers\">(1/4)</p>";
		      							echo "<a class=\"btn btn-primary btn-lg\" href=\"empty.html\" role=\"button\">Join Game</a>";
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
	      				<a class="btn btn-primary btn-lg" href="empty.html" role="button" style="margin-top: 7%;">View Detailed Stats</a>
	      				<div id="stats" style="text-align: left; margin-left: 15%; margin-top: 7%; width: 100%">
	      					<div class="statsElement">
		      					<p>Games Played: </p>
		      					<p id="gamesPlayedStat">201</p>
		      				</div>
		      				<div class="statsElement">
		      					<p>Games Won: </p>
		      					<p id="gamesWonStat">80</p>
		      				</div>
		      				<div class="statsElement">
		      					<p>Games Lost: </p>
		      					<p id="gamesLostStat">119</p>
		      				</div>
		      				<div class="statsElement">
		      					<p>Longest Game: </p>
		      					<p id="longestGameStat">22 hrs</p>
		      				</div>
		      				<div class="statsElement">
		      					<p>Shortest Game: </p>
		      					<p id="shortestGameStat">1 min</p>
		      				</div>
	      				</div>
	      			</div>
	    		</div>      
	  		</div>
		</div>
  	</body>
</html>