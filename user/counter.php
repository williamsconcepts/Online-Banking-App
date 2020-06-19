<?php
$con=mysqli_connect("localhost","root","","bank");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
$me = $row['uname'];
$sql="SELECT * FROM message WHERE reci_name='$me'";

if ($result=mysqli_query($con,$sql))
  {
  // Return the number of rows in result set
  $rowcount=mysqli_num_rows($result);
  
  // Free result set
  mysqli_free_result($result);
  
	  
}

mysqli_close($con);
?>
