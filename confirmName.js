var xmlhttp

function confirm (str)
{
   if (str.length == 0)
   {
      document.getElementById ("txtHint").innerHTML = "";
      return;
   }
   xmlhttp = GetXmlHttpObject();
   if (xmlhttp == null)
   {
      alert ("Your browser does not support XMLHTTP!");
      return;
   }

	   
   // specify a backend handler that will response software component
   var url = "confirmation.php";  
   
   // How to configure XMLHttpRequest object?
   // Register the callback function named "stateChanged"
   xmlhttp.onreadystatechange = stateChanged;    // notice, stateChanged without () because we don't want the function to run rightaway
     
   // make an asynchronous request
   xmlhttp.open ("POST", url, true);
   xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   
   // the request is sent to the server
   xmlhttp.send ("gameName="+str);
}

function stateChanged()
{
   // The callback function processes the response from the server	
   if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
   {
	  // the HTML DOM is updated
      document.getElementById ("confirmation").innerHTML = xmlhttp.responseText;
   }
}

function GetXmlHttpObject()
{
   // Create an XMLHttpRequest object?
	
   if (window.XMLHttpRequest)
   {  // code for IE7+, Firefox, Chrome, Opera, Safari
      return new XMLHttpRequest();
   }
   if (window.ActiveXObject)
   { // code for IE6, IE5
     return new ActiveXObject ("Microsoft.XMLHTTP");
   }
   return null;
}
