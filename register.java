import java.io.*;
import java.util.*;
import java.text.SimpleDateFormat;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

// libraries for parsing and manipulating XML file
import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.parsers.DocumentBuilder;
import javax.xml.transform.Transformer;
import javax.xml.transform.TransformerFactory;
import javax.xml.transform.dom.DOMSource;
import javax.xml.transform.stream.StreamResult;
import org.w3c.dom.Document;
import org.w3c.dom.NodeList;
import org.w3c.dom.Node;
import org.w3c.dom.Element;
import org.w3c.dom.NamedNodeMap;

@WebServlet("/register")
public class register extends HttpServlet 
{
  private Document create_DOM_from_file(String fname) throws Exception 
	   {
	      try {
	         File datafile = new File(fname);
	         DocumentBuilderFactory dbfactory = DocumentBuilderFactory.newInstance();
	         DocumentBuilder dbuilder = dbfactory.newDocumentBuilder();
	         Document doc = dbuilder.parse(datafile);
	         return doc;
	      } catch (Exception e) {
	         e.printStackTrace();
	      }
	      return null;
  } 
  
  public void doPost(HttpServletRequest request, HttpServletResponse response) 
            throws ServletException, IOException 
  {
	response.setContentType("text/html");
    PrintWriter out = response.getWriter();
    String username = request.getParameter("user");
    
    if (username != null) {
    	try {
            Document doc = create_DOM_from_file("/../WebContent/WebINF/data/login.xml");
            Node users = doc.getFirstChild();
            Element newUser = doc.createElement("user");
            Element newUsername = doc.createElement("name");
            newUsername.appendChild(doc.createTextNode(username));
            newUser.appendChild(newUsername);
            Element password = doc.createElement("pass");
            password.appendChild(doc.createTextNode(request.getParameter("pass")));
            newUser.appendChild(password);
            users.appendChild(newUser);
            
            TransformerFactory transformFactory = TransformerFactory.newInstance();
            Transformer transform = transformerFactory.newTransformer();
            DOMSource docSource = new DOMSource(doc);
            StreamResult result = new StreamResult(new file("/../WebContent/WebINF/data/login.xml"));
            transform.transform(docSource, result);
            
         } catch (Exception e) {
        e.printStackTrace();
         }
    }
    else {
	  String this_html =
          "<!DOCTYPE html>" +
          "<html lang='en'>" +
          "<head>" +
          "    <meta name='viewport' content='width=device-width, initial-scale=1'>" +  
	      "        <link rel='stylesheet' type='text/css' href='styles/mainStyles.css' />" +
	      "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' />" +
          "    <title>Mahjong | Register</title>" +
          "    <style>" +
          "        label {" +
      	  "            display: block;" +
          "        }" +
          "    </style>" +  
          "</head>" +  
          "<body>" +
          "    <div class='container' style='text-align: center'>" +
          "    <br/>" +
          "    <div class='row'>" +
          "        <!-- the below column was added so that the form would be centered until the window became too small -->" +
          "        <div class='col-md-5'>" +
          "        </div>" +
          "        <!-- the below column holds the registration form -->" +
          "        <div class='col-md-3'>" +
          "        <form action='http://localhost:8080/WebPLProject/register' method='post' style='text-align: left' class='container'> " +
          "           <label>Username: </label> <input type='text' name='user' autofocus required />" +
          "           <!-- user-msg is used to inform users of invalid username entries -->" +
          "           <div style='color:red' id='user-msg'></div>" +
          "           <br/>" +
          "           <label>Password: </label> <input type='password' id ='pass' name='pass' required />" +
          "          <br/>" +
          "          <input type='checkbox' id='showPass'> Show password" +
          "          <br/>" +
          "          <input class='btn btn-primary btn-lg' type='submit' value='Log in'/>" +
          "      </form>" +
          "      <a class=\"brn btn-primary btn-lg\" href=\"register.java\" role=\"button\"> No Account? Click Here to Register </a>"
          "  </div>" +
          "</div>" +
          "</div>" +
          "<script>" +
          "// checks to see if the box is checked for Show password and either shows or hides the password text field depending on if the box was checked or not, respectively" +
          "(function() {" +
          "//fetch elements for password and show password fields" +
          "  var password = document.getElementById('pass');" +
          "  var show = document.getElementById('showPass');" +
          "  //monitor the show password field" +
          "  show.addEventListener('change', function(){" +
          "  	//show or hide password text based on the show password field" +
          "        if (show.checked)" +
          "	        password.type='text';" +
          "        else" +
          "	        password.type='password';" +
          " }, false);" +
          "}());" +
          "// checks the given login for length and displays a warning when a given username is too short" +
          "// also checks the given password against 'password', directing to the main page only if the two strings are equal" +
          "function validateLogin(){" +
          "//fetch the given username and password" +
          " var username = document.getElementByName('user').value;" +
          " var password = document.getElementById('pass').value;" +
          " //check validity of username through length" +
          " if (username.length <= 5){ " +
          " 	//inform of invalid username if given username is too short" +
          "        document.getElementById('user-msg').innerHTML = 'Username is too short';" +
          "        document.getElementByName('user').focus();" +
      	  "     return false; " +
      	  " }" +
      	  " return true;" +
          "}" +
          "</script>" +
          "</body>" +
          "</html>";
          out.println(this_html);
      
      out.close();
    }
  }
}

public void doGet(HttpServletRequest request, HttpServletResponse response)
		   throws ServletException, IOException 
{
	   doPost(request, response);
}
}