
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	
	  <form action="member_insert.php" method="post" enctype="multipart/form-data">
	  
		<table>
		
			<tr>
				<td>Member ID</td>
				<td><input type="number" name="mid"/></td>
			
			</tr>
			
			<tr>
				<td>First Name</td>
				<td><input type="text" name="fname"/></td>
			
			</tr>
			<tr>
				<td>Last Name</td>
				<td><input type="text" name="lname"/></td>
			
			</tr>
			<tr>
				<td>Age</td>
				<td><input type="number" name="age"/></td>
			
			</tr>
			<tr>
				<td>District</td>
				<td><input type="text" name="dname"/></td>
			
			</tr>
			<tr>
				<td>Mobile no.</td>
				<td><input type="text" name="mno"/></td>
			
			</tr>
			
			<tr>
				<td>Date</td>
				<td><input type="date" name="date"/></td>
			
			</tr>
			
		
		
		</table>
		
		<br /><br />
         <input type="submit" name="submit" value="Save"/>		
         <input type="submit" name="show" value="Show registered member"/>		
	  
	  
	  </form>
	
	
</body>
</html>

<?php
    include('connection.php');
	
	if(isset($_POST['submit'])){
		if($_POST['mid']!= null && $_POST['fname']!=null && $_POST['lname'] != null && $_POST['age'] != null && $_POST['dname'] != null && $_POST['mno'] != null && $_POST['date'] != null){
    $mid =$_POST['mid'];
	$fname =$_POST['fname'];
	$lname =$_POST['lname'];
	$age =$_POST['age'];
	$dname =$_POST['dname'];
	$mno =$_POST['mno'];
	$date =$_POST['date'];		
	
	$sql = "INSERT INTO `member_details`(`member_id`, `first_name`, `last_name`, `district`, `age`, `mobile_no`, `including_date`) VALUES ( '$mid','$fname','$lname','$dname','$age','$mno','$date')";  
	$run = mysqli_query($db,$sql);
	
	if ($run){
		echo "Successfully Saved";
	}
	else{
		echo "Error!!!";
		
	}
		}
		else{
			?>
			<script type="text/javascript">
			
			alert('Please fill all the blanks');
			
			</script>
			<?php
		}
	} 
	
	if(isset($_POST['show'])){
		
		$sql5="SELECT * FROM `member_details`";
		  $run5=mysqli_query($db,$sql5);
		  ?>
		  <table border="1">
		<tr>
		  <td><b>Member_id</b></td>
		  <td><b>First_name</b></td>
		  <td><b>Last_name</b></td>
		  <td><b>Age</b></td>
		
		  <td><b>District</b></td>
		  <td><b>/Mobile_no</b></td>
		    <td><b>Including_date</b></td>
		
		</tr>
		  <?php
		  
		  
         while($r5=mysqli_fetch_array($run5)){
			  
			  echo "<tr>
		  <td>".$r5['member_id']."</td>
		  <td>".$r5['first_name']."</td>
		  <td>".$r5['last_name']."</td>
		  <td>".$r5['age']."</td>
		  <td>".$r5['district']."</td>
		  <td>".$r5['mobile_no']."</td>
		  <td>".$r5['including_date']."</td>
		  
		
		  </tr><br /><br />";
			  
		  }
		  ?>
         </table>
         <?php
		
	}
		
		
?>