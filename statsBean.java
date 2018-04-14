
public class statsBean 
{
	private int gamesPlayed;
	private int gamesWon;
	private int gamesLost;
	
	public statsBean()
	{
		gamesPlayed = gamesWon = gamesLost = 0;
	}
	
	public int getGamesPlayed()
	{
		return gamesPlayed;
	}
	
	public void setGamesPlayed(int num)
	{
		gamesPlayed = num;
	}
	
	public int getGamesWon()
	{
		return gamesWon;
	}
	
	public void setGamesWon(int num)
	{
		gamesWon = num;
	}
	
	public int getGamesLost()
	{
		return gamesLost;
	}
	
	public void setGamesLost(int num)
	{
		gamesLost = num;
	}	
}
