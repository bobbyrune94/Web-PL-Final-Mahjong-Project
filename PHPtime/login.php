<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">  
	    <link rel="stylesheet" type="text/css" href="styles/mainStyles.css" />
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <title>Mahjong | Login</title>  
        <style>
            label {
      	        display: block;
            }
        </style>  
    </head>
    
    <body> 
        <div class="container" style="text-align: center">
            <br/>
            <div class="row">
                <!-- the below column was added so that the form would be centered until the window became too small -->
                <div class="col-md-5">
                </div>
                <!-- the below column holds the login form -->
                <div class="col-md-3">
                    <form action="mainpage.php" method="post" style="text-align: left" class="container" onsubmit="return (validateLogin())">
                        <label>Username: </label> <input type="text" id="user" name="user" autofocus required />
                        <!-- user-msg is used to inform users of invalid username entries -->
                        <div style="color:red" id="user-msg"></div>
                        <br/>
                        <label>Password: </label> <input type="password" id="pass" required />
                        <br/>
                        <input type="checkbox" id="showPass"> Show password
                        <!-- pass-msg is used to inform users of an incorrect password entry -->
                        <div style="color:red" id="pass-msg"></div>
                        <br/>
                        <input type="submit" value="Log in"/>
                    </form>
                </div>
            </div>
        </div>

        <script>

            // checks to see if the box is checked for Show password and either shows or hides the password text field depending on if the box was checked or not, respectively
            (function() {
            	//fetch elements for password and show password fields
                var password = document.getElementById("pass");
                var show = document.getElementById("showPass");
                //monitor the show password field
                show.addEventListener("change", function(){
                	//show or hide password text based on the show password field
        	        if (show.checked)
        		        password.type="text";
        	        else
        		        password.type="password";
                }, false);
            }());


            // checks the given login for length and displays a warning when a given username is too short
            // also checks the given password against "password", directing to the main page only if the two strings are equal
            function validateLogin(){
            	//fetch the given username and password
                var username = document.getElementById("user").value;
                var password = document.getElementById("pass").value;
                //check validity of username through length
                if (username.length <= 5){
                	//inform of invalid username if given username is too short
        	        document.getElementById("user-msg").innerHTML = "Username is too short";
        	        document.getElementById("user").focus();
      	            return false;
      	        }
      	        //check password accuracy-- later we will have a database call here
                if (password === "password"){
        	        return true;
                }
                //inform of incorrect password if given password is not "password"
                document.getElementById("pass-msg").innerHTML = "Incorrect password";
                document.getElementById("pass").focus();
                return false;
            }

        </script>
    </body>
</html>