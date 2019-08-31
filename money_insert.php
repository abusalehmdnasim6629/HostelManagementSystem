<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	
	<form action="money_insert.php"method="post" enctype="mulipart/form-data">
	   
	   <table>
	     
			<tr>
				<td>Member Id</td>
				<td><input type="number" name="mid"/></td>
			</tr>
			<tr>
				<td>Amount</td>
				<td><input type="number" name="amount"/></td>
			</tr>
	   
	   </table>
	   
	   <br /><br />
	   <input type="submit" name="submit" value="Add Ammount" />
	   <input type="submit" name="diposit" value="Show given money" />
	   <input type="submit" name="rb" value="Remaining Balance" />
	
	
	
	</form>
	
</body>
</html>
<?php
    include('connection.php');
	if(isset($_POST['submit'])){
		if($_POST['mid']!=null && $_POST['amount']!=null){
		$mid = $_POST['mid'];
		$amount = $_POST['amount'];
		$sql1 = "SELECT * FROM `member_details` WHERE `member_id` = '$mid'";
		$run1=mysqli_query($db,$sql1);
		$count1 = mysqli_num_rows($run1);
		if($count1>0){
			 $sql2 = "SELECT `amount` FROM `deposit_details` WHERE `member_id` = '$mid'";
			 $run2=mysqli_query($db,$sql2);
			 $count2 =  mysqli_num_rows($run2);
			 if($count2>0){
				  $newamount=0;
				  $addamount=0;
				   while($result = mysqli_fetch_array($run2,MYSQLI_ASSOC))
				   {
					 $addamount = $result['amount'];
					 
					}
				    $newamount = $addamount + $amount;
					$sql3="UPDATE `deposit_details` SET `amount`= '$newamount' WHERE `member_id` = '$mid'"; 
				    $run3=mysqli_query($db,$sql3);
					if($run3){
			
							echo "amount has been added";
						}
						else{
							echo "Errorrrrr!!";
						}
			 }
			 else{
					$sql = "INSERT INTO `deposit_details`(`member_id`, `amount`) VALUES ('$mid','$amount')";
					$run =mysqli_query($db,$sql);
						if($run){
			
							echo "Amount has been added";
						}
						else{
							echo "Error!!";
						}
		
		        }
		}
		else{
			echo "Member Id is not registered";
		}
			 
			
			
			
		
		}else{
			
			?>
			<script type="text/javascript">
			
			alert('Please fill all the blanks');
			
			</script>
			<?php
		}	
	}
	
	if(isset($_POST['diposit'])){
         
			$sql9 = "SELECT * FROM `deposit_details`";
			 $run9=mysqli_query($db,$sql9);
			 
			 ?>
		  <table border="1">
		<tr>
		  <td><b>Member Id</b></td>
		  
		  <td><b>Amount</b></td>
		  
		
		</tr>
		  <?php
		  
		  
         while($r9=mysqli_fetch_array($run9)){
			  
			  echo "<tr>
		            <td>".$r9['member_id']."</td>
		            
		            <td>".$r9['amount']."</td>
		  
		    
		  
		
		           </tr><br /><br />";
			  
		  }
		  ?>
         </table>
		  <?php
			 
			 

    }
	
	
	if(isset($_POST['rb'])){
		
		  $sql10="SELECT sum(amount) AS total_cost FROM `bazar_details`";
		  $run10=mysqli_query($db,$sql10);
		  $totalcost = 0;
		  while($r=mysqli_fetch_array($run10)){
			  $totalcost = $r['total_cost'];
			  
		  }
		  
		     $sql11 = "SELECT sum(amount) AS total_money FROM `deposit_details`";
			 $run11=mysqli_query($db,$sql11);
			 $totalmoney = 0;
		    while($r11=mysqli_fetch_array($run11)){
			     $totalmoney = $r11['total_money'];
			  
		         }
	echo "Total Balance : ".$totalmoney."<br /><br />";
	echo "Total Cost : ".$totalcost."<br /><br />";
	$rm = $totalmoney - $totalcost;
	echo "Remaing Balance : ".$rm;
	
	
	
	}
?>