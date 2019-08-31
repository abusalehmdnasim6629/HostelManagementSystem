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
	<form action="Bazar_insert.php"method="post"enctype="multipart/form-data">
	
		<table>
		
			<tr>
				<td>Date</td>
				<td>Goods</td>
				<td>Amount</td>
				<td>Signature</td>
			</tr>
			
			<tr>
				<td><input type="date" name="date" /></td>
				<td><input type="text" name="goods" /></td>
				<td><input type="number"name="amount" step="0.01" /></td>
				<td><input type="text"name="sign" /></td>
			</tr>
		
		</table>
		<br /><br />
		<input type="submit" name="submit" value="Add Amount" />
		<input type="submit" name="cost" value="Total Cost" />
		<input type="submit" name="mealrate" value="Meal Rate" />
		<input type="submit" name="bazarlist" value="Show Bazar List" />
		<input type="submit" name="mcost" value="Individual meal cost" />
	
	</form>
	
	
</body>
</html>
<?php

      if(isset($_POST['submit'])){
		  if($_POST['date']!=null && $_POST['goods']!=null && $_POST['amount']!=null && $_POST['sign']!=null){
		  
		  $date = $_POST['date'];
		  $goods = $_POST['goods'];
		  $amount = $_POST['amount'];
		  $sign = $_POST['sign'];
		  
		  $sql = "INSERT INTO `bazar_details`(`date`, `goods`, `amount`, `signature`) VALUES ('$date','$goods','$amount','$sign')";
		  $run =mysqli_query($db,$sql);
		  if($run){
			  echo "Add successfully";
		  }
		  else{
			  echo "Add unsuccessfull";
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
	  if(isset($_POST['cost'])){
		  
		  $sql1="SELECT sum(amount) AS total_cost FROM `bazar_details`";
		  $run1=mysqli_query($db,$sql1);
		  
		  while($r=mysqli_fetch_array($run1)){
			  echo $r['total_cost'];
			  
		  }
		  
		  
	  }
	  if(isset($_POST['mealrate'])){
	 
	      $sql2="SELECT sum(meal) AS total_meal FROM `meal_details`";
		  $run2=mysqli_query($db,$sql2);
		  $tmeal=0;
	      while($r=mysqli_fetch_array($run2)){
			   $tmeal = $r['total_meal'];
			   echo "Total meal = ".$tmeal."<br />"."<br />";
			  
		  }
		  
		  $sql3="SELECT sum(amount) AS total_cost FROM `bazar_details`";
		  $run3=mysqli_query($db,$sql3);
		  $totalcost = 0;
		  while($r=mysqli_fetch_array($run3)){
			  $totalcost = $r['total_cost'];
			  
		  }
		  $meal_rate = $totalcost/$tmeal;
		  echo "Meal rate = ".$meal_rate;
		  
	 
	 
	 
	 
	 }
     if(isset($_POST['bazarlist'])){
        

          
        $sql4="SELECT * FROM `bazar_details`";
		  $run4=mysqli_query($db,$sql4);
		  ?>
		  <table border="1">
		<tr>
		  <td><b>Date</b></td>
		  <td><b>Goods</b></td>
		  <td><b>Amount</b></td>
		  <td><b>Signature</b></td>
		
		</tr>
		  <?php
		  
		  
         while($r1=mysqli_fetch_array($run4)){
			  
			  echo "<tr>
		  <td>".$r1['date']."</td>
		  <td>".$r1['goods']."</td>
		  <td>".$r1['amount']."</td>
		  <td>".$r1['signature']."</td>
		  
		
		  </tr><br /><br />";
			  
		  }
		  ?>
         </table>
         <?php




	 }
	 if(isset($_POST['mcost'])){
		 
		  $sql2="SELECT sum(meal) AS total_meal FROM `meal_details`";
		  $run2=mysqli_query($db,$sql2);
		  $tmeal=0;
	      while($r=mysqli_fetch_array($run2)){
			   $tmeal = $r['total_meal'];
			   echo "Total meal = ".$tmeal."<br />"."<br />";
			  
		  }
		  
		  $sql3="SELECT sum(amount) AS total_cost FROM `bazar_details`";
		  $run3=mysqli_query($db,$sql3);
		  $totalcost = 0;
		  while($r=mysqli_fetch_array($run3)){
			  $totalcost = $r['total_cost'];
			  
		  }
		  $meal_rate = $totalcost/$tmeal;
		  
		  $sql8="SELECT * FROM `meal_details`";
		  $run8=mysqli_query($db,$sql8);
		  ?>
		  <table border="1">
		<tr>
		  <td><b>Member Id</b></td>
		  <td><b>Meal Cost</b></td>
		  <td><b>Calculation</b></td>
		  
		
		</tr>
		  <?php
		  
		  
         while($r8=mysqli_fetch_array($run8)){
			  
			  echo "<tr>
		  <td>".$r8['member_id']."</td>
		  <td>".$r8['meal']*$meal_rate."</td>
		  
		    <td></td>
		  
		
		  </tr><br /><br />";
			  
		  }
		  ?>
         </table>
		  <?php
		 
		 
	 }



?>
