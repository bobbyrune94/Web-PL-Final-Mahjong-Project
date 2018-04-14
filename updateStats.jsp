<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
	pageEncoding="ISO-8859-1"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	    <link rel="stylesheet" type="text/css" href="styles/mainStyles.css" />
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
		<title>Stats</title>
	</head>
	<body style="text-align: center;">
		<jsp:useBean id="stats" class="beans.statsBean" scope="session"/>		
		<p>
		<%
			String param = request.getParameter("play");
			String singleIndex = request.getParameter("singleIndex");
			String multiIndex = request.getParameter("multiIndex");
			
			if (param != null)
			{
				out.println("Playing Game" + singleIndex + " " + multiIndex);
				%>
				<jsp:setProperty property="gamesPlayed" name="stats" value = "1"/>
				<%
				
				if(playGame())
				{
					out.println("<h1>You Won!</h1>");
					%>
					<jsp:setProperty property="gamesWon" name="stats" value = "1"/>
					<%
				}
				else
				{
					out.println("<h1>You Lost!</h1>");
					%>
					<jsp:setProperty property="gamesLost" name="stats" value = "1"/>
					<%
				}
			}
			%>
		</p>
		
		
		<h1>Stats</h1>
		<p> Games Played: <jsp:getProperty property="gamesPlayed" name="stats"/></p>
		<p> Games Won: <jsp:getProperty property="gamesWon" name="stats"/></p>
		<p> Games Lost: <jsp:getProperty property="gamesLost" name="stats"/></p>
		
		<%
			int gamesPlayed = stats.getGamesPlayed();
			int gamesWon = stats.getGamesWon();
			int gamesLost = stats.getGamesLost();
		%>
		
		<form action="http://localhost:80/CS4640Project/mainpage.php" method="post" style="text-align: center" class="container">
        	<input type="hidden" name="stats" value="Stats">
        	<input type="hidden" name="played" value=<%=gamesPlayed %>>
        	<input type="hidden" name="won" value=<%=gamesWon %>>
        	<input type="hidden" name="lost" value=<%=gamesLost %>>
        	<input type="hidden" name="removeSingleIndex" value=<%=singleIndex %>>
        	<input type="hidden" name="removeMultiIndex" value=<%=multiIndex %>>
            <input class="btn btn-primary btn-lg" type="submit" value="Return to Main Page"/>
        </form>
		<%@page import="java.util.*" %>
		<%!
			public boolean playGame()
			{
				return (Math.random()*4) < 2; 
			}
		%>
		
	</body>
</html>