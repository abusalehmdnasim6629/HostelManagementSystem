<?php
include('connection.php');

?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>

	
	<form action="meal_insert.php"method="post"enctype="multipart/form-data">
	   
	   <table>
	    
		<tr>
			<td>Member Id</td>
			<td><input type="number" name="mid" /></td>
		</tr>
		<tr>
			<td>Meal</td>
			<td><input type="number" name="meal" step=".01" /></td>
		</tr>
		<tr>
			<td>date</td>
			<td><input type="date" name="date" /></td>
		</tr>
		
		
	   
	   </table>
	   <br /><br />
	    <input type="submit" name="submit" value="Go" />
	
	
	</form>
	
	
	
	
	
</body>
</html>
<?php
    if(isset($_POST['submit'])){
		if($_POST['mid']!=null && $_POST['meal']!=null && $_POST['date']!=null){
    $mid = $_POST['mid'];
    $meal = $_POST['meal'];
    $date = $_POST['date'];
	
	$sql1 = "SELECT * FROM `member_details` WHERE `member_id` = '$mid'";
		$run1=mysqli_query($db,$sql1);
		$count1 = mysqli_num_rows($run1);
		if($count1>0){
	         $sql2 = "SELECT `meal` FROM `meal_details` WHERE `member_id` = '$mid'";
			 $run2=mysqli_query($db,$sql2);
			 $count2 =  mysqli_num_rows($run2);
	         if($count2>0){
				  $newmeal=0.00;
				  $addmeal=0.00;
				   while($result = mysqli_fetch_array($run2,MYSQLI_ASSOC))
				   {
					 $addmeal = $result['meal'];
					 
					}
				    $newmeal = $addmeal + $meal;
					
					$sql3="UPDATE `meal_details` SET `meal`= '$newmeal' WHERE `member_id` = '$mid'"; 
				    $run3=mysqli_query($db,$sql3);
					if($run3){
			
							echo "meal has been added";
						}
						else{
							echo "Errorrrrr!!";
						}
	
            }
			else{
				    
					$sql = "INSERT INTO `meal_details`(`member_id`, `meal`,`last update`) VALUES ('$mid','$meal','$date')";
					$run =mysqli_query($db,$sql);
						if($run){
			
							echo "Meal has been added";
						}
						else{
							echo "Error!!";
						}
		
		        }
				
        }
		else{
			echo "Member Id is not registered";
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
?>




