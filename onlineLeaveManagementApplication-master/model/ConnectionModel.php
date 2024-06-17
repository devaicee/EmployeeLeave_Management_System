
<?php
	
	session_Start();
	class Connection
	{
		
		var $con;
		
		function dbConnection()
		{
			$serverName = "localhost";
			$userName = "root";
			$password = "";
			$con = mysqli_connect($serverName, $userName, $password);
			
			if (!$con)
            {
							die('Could not connect: ' . mysqli_error($this->con));
            }
			
			mysqli_select_db($con, "leaveapp");
			$this->con=$con;
		}
		
		function dbCloseConnection()
		{	 
			mysqli_close($this->con);
		}
		
	}
	
?>