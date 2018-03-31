
import java.io.IOException;
import java.io.PrintWriter;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

/**
 * Servlet implementation class projectServlet
 */
@WebServlet("/tutorialServlet")
public class tutorialServlet extends HttpServlet 
{
	private static final long serialVersionUID = 1L;

	private boolean[] tutorialsDone;

	/**
	 * @see HttpServlet#HttpServlet()
	 */
	public tutorialServlet() 
	{
		super();
		tutorialsDone = new boolean[] { false, false, false, false };
		// TODO Auto-generated constructor stub
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse
	 *      response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException 
	{
		response.setContentType("text/html");
		PrintWriter out = response.getWriter();

		HttpSession session = request.getSession();

		if (session.getAttribute("tutorialsFinished") != null)
			tutorialsDone = (boolean[]) session.getAttribute("tutorialsFinished");

		String tutorialFinished = request.getParameter("tutorialName");
		finishTutorial(tutorialFinished);

		session.setAttribute("tutorialsFinished", tutorialsDone);

		out.println("<html>");
		out.println("<head>");
		out.println("<title>Tutorials Finished</title>");
		out.println("<link rel=stylesheet href='styles/mainStyles.css' type='text/css'>");
		out.println("</head>");
		out.println("<body>");
		out.println("    <p>Start Tutorial Finished: " + tutorialsDone[0] + "</p>");
		out.println("    <p>Basic Play Tutorial Finished: " + tutorialsDone[1] + "</p>");
		out.println("    <p>Advanced Techniques Tutorial Finished: " + tutorialsDone[2] + "</p>");
		out.println("    <p>Master Class Tutorial Finished: " + tutorialsDone[3] + "</p>");
		out.println("</body>");
		out.println("</html>");
	}

	private void finishTutorial(String tutorialName) 
	{
		if (tutorialName.equals("startTutorial"))
			tutorialsDone[0] = true;
		else if (tutorialName.equals("basicPlay"))
			tutorialsDone[1] = true;
		else if (tutorialName.equals("advTechniques"))
			tutorialsDone[2] = true;
		else if (tutorialName.equals("masterClass"))
			tutorialsDone[3] = true;
	}
}
