<!Doctype html>
<html>
	<head>
		<title>
			Create New Game
		</title>
	    <link rel="stylesheet" type="text/css" href="styles/mainStyles.css" />
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
	    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular.min.js"></script>
	</head>

	<body ng-app="newGameApp">
		<div ng-controller="newGameController">
			<form action="newGame.php" method="post" style="text-align: center; margin-top: 5%">
				<h1> Create New Game </h1>
				<p style="margin-top: 1%">Game Name: <input type="text" name="gameName" ng-model="name" ng-blur="checkProfane()"/></p>
				<input type="checkbox" id="singlePlayer" name="single" style="margin-top: 1%" ng-click="changePlayers()"> Single Player? <br/>
				<input class="btn btn-primary btn-lg" type="submit" value="Create New Game" name="btn" style="margin-top: 1%"/>
			</form>

			<br><br><br><br>

			<div style="text-align: center;">
				<h2>Confirmation</h2>
				Your Game Name is: {{ name }} <br>
				{{playerNum}} <br>
				{{data}}
			</div>

		</div>
		
		<script>
	      var ngApp = angular.module('newGameApp', []);

	      ngApp.controller('newGameController', function($scope, $http) 
	      {
			    var onSuccess = function(data, status, headers, config)
		        {
		          $scope.data = data;
		        };

		        var onError = function(data, status, headers, config)
		        {
		          $scope.error = status;
		        };

	      		$scope.playerNum = "Multi Player";

	      		$scope.changePlayers = function()
	      		{
	      			if($scope.playerNum === "Single Player")
	      			{
	      				$scope.playerNum = "Multi Player";
	      			}
	      			else
	      			{
	      				$scope.playerNum = "Single Player";
	      			}
	      		}

	      		$scope.checkProfane = function()
	      		{
	      			var promise = $http.get("profanity.php?name=" + $scope.name);
		            promise.success(onSuccess);
		            promise.error(onError);
	      		}
	      	});
	   </script>

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