<?php

  $badWords = array("fuck", "bitch", "shit", "ass", "bastard");


  //get request
  $gameName = strtolower($_GET["name"]);
  $profane = false;

  foreach($badWords as $word)
  {
      if(strpos($gameName, $word) !== false)
      {
          $profane = true;
          break;
      }
  }

  if($profane === true)
    print "Your Game Name is Profane. Please Change It";
  else
    print "Your Game Name is Clean";  
?>