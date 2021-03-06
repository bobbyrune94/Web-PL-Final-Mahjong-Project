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
import org.w3c.dom.Document;
import org.w3c.dom.NodeList;
import org.w3c.dom.Node;
import org.w3c.dom.Element;

@WebServlet("/servletLogin")
public class servletLogin extends HttpServlet 
{

   String msg = "";
      // create a DOM object
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
      
      HttpSession session = request.getSession();
      String username = request.getParameter("user");      
      
      boolean userExists = false;
      boolean correctPass = false;
      if (username != null)
      {    
          
          try {
             Document doc = create_DOM_from_file("C:\\Users\\bobby\\OneDrive\\KennyStuff\\CompSci\\UVA\\CS4640 Web PL\\InClass\\WebPLProject\\WebContent\\WEB-INF\\data\\login.xml");

             NodeList nList = doc.getElementsByTagName("user");
             // iterate children of nList 
             for (int i = 0; i < nList.getLength(); i++) 
             {
                Node nd = nList.item(i);
            
                // check if nd is an XML element, get values of its attributes and children
                if (nd.getNodeType() == Node.ELEMENT_NODE) 
                {
                   Element ele = (Element)nd;
//                   System.out.println(ele.getElementsByTagName("name").item(0).getTextContent());
               
                   if (username.compareTo(ele.getElementsByTagName("name").item(0).getTextContent()) == 0) {
                	   System.out.println("Found");
                	   userExists = true;
//                	   System.out.println(request.getParameter("pass"));
//                	   System.out.println(ele.getElementsByTagName("pass").item(0).getTextContent());
                	   if ((request.getParameter("pass") != null) && (request.getParameter("pass").compareTo(ele.getElementsByTagName("pass").item(0).getTextContent()) == 0)) {
                		    correctPass = true;  
                		    break;
                	   }
                   }
                                  
                }
             }
          } catch (Exception e) {
        	  e.printStackTrace();
          } 
      }
      if (userExists && correctPass) {
	      session.setAttribute("username", username);
	  
    	  //response.sendRedirect("http://localhost:80/CS4640Project/mainpage.php");
          out.println("<html>");
          out.println("<head>");
          out.println("<title>Redirect</title>");
          out.println("</head>");
          out.println("<body onload='setTimeout(function() { document.form.submit() }, 1)'>");
          out.println("    <form action='http://localhost:80/CS4640Project/mainpage.php' method='post' name='form' onsubmit='return true'>");
          out.println("        <input type='text' name='user' value='" + username + "'/>");
          out.println("    </form>");
          out.println("</body>");
          out.println("</html>");
          out.close();
      }
      else {
      String this_html =
          "<!DOCTYPE html>" +
          "<html lang='en'>" +
          "<head>" +
          "    <meta name='viewport' content='width=device-width, initial-scale=1'>" +  
	      "        <link rel='stylesheet' type='text/css' href='styles/mainStyles.css' />" +
	      "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' />" +
          "    <title>Mahjong | Login</title>" +
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
          "        <!-- the below column holds the login form -->" +
          "        <div class='col-md-5'>" +
          "        <form action='http://localhost:8080/WebPLProject/servletLogin' method='post' style='text-align: left' class='container'> " +
          "           <label>Username: </label> <input type='text' name='user' autofocus required />" +
          "           <!-- user-msg is used to inform users of invalid username entries -->" +
          "           <div style='color:red' id='user-msg'>";
//          if (!userExists) {
//        	  this_html += "User does not exist";
//          }
          this_html +=
    	  "</div>" +
          "           <br/>" +
          "           <label>Password: </label> <input type='password' id ='pass' name='pass' required />" +
          "          <br/>" +
          "          <input type='checkbox' id='showPass'> Show password" +
          "          <!-- pass-msg is used to inform users of an incorrect password entry -->" +
          "          <div style='color:red' id='pass-msg'>";
          if (userExists && !correctPass) {
        	  this_html +=
        			  "Incorrect Password";
          }
          this_html +=
          "</div>" +
          "          <br/>" +
          "          <input class='btn btn-primary btn-lg' type='submit' value='Log in'/> <br>" +
          "      <a class=\"brn btn-primary btn-lg\" href=\"register\" role=\"button\" style=\"margin-top: 50%\"> No Account? Click Here to Register </a>" +
          "      </form>" +
          
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
      	  " //check password accuracy-- later we will have a database call here" +
          " if (password === 'password'){" +
          "        return true;" +
          " }" +
          " //inform of incorrect password if given password is not 'password' " +
          " document.getElementById('pass-msg').innerHTML = 'Incorrect password';" +
          " document.getElementById('pass').focus();" +
          " return false;" +
          "}" +
          "</script>" +
          "</body>" +
          "</html>";
          out.println(this_html);
      
      out.close();
      }
   }
   public void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException 
   {
	   doPost(request, response);
   }
}