<html>   
   <body>
      <?php
	  session_start();
	  	$feedback=FALSE;
		$sessionid=FALSE;
		if (isset($_POST['submit']))
		{
			$message=NULL;
			if (empty($_POST['feedback']))
			{
				$feedback=FALSE;
				$sessionid=FALSE;
				$message.='<p>Feedback field is empty!';
			}
			else
			{
				$feedback = $_POST['feedback'];	
				$sessionid = $_SESSION['account_id'];
				header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/feedbackland.php");
			}

		if (isset($message))
		{
			echo '<font color="red">'.$message. '</font>';
		}

		require_once('../mysql_connect.php');
		$query="insert into customer_feedback (client_id, feedback) 
        		values ('{$sessionid}', '{$feedback}')";
		$result=mysqli_query($dbc,$query);
		}
        ?>
   
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<table>
			
            <tr>
               <td>Feedback:</td>
               <td><textarea name = "feedback" rows = "5" cols = "40"></textarea></td>
            </tr>
		
            <tr>
               <td>
                  <input type = "submit" name = "submit" value = "Submit"> 
               </td>
            </tr>
         </table>
      </form>
	  <a href = "customermenu.php"><button>Back To Main Menu</button></a>
   </body>
</html>