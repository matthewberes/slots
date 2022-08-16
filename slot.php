<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" type="text/css" href="slotstyle.css" media="screen"/>
<script src="jquery-3.1.1.js"></script>
<script src="slotscript.js"></script>
<title>Slots</title>
<body>

<div id="title">
<h1>Slot Machine</h1>
</div>


<div id="tableShit">
<table width="100%" border = 2>
	<thead>	
		<td> 
			<img id="slot1" src="img/1.png" alt="didnt work" border=3></img>
		</td>
		<td>
			<img id="slot2" src="img/1.png" alt="didnt work" border=3></img>
		</td>
		<td>
			<img id="slot3" src="img/1.png" alt="didnt work" border=3></img>
		</td>
	</thead>
	<tbody>
		<td> 
			<p></p>
			<form id =inputForm>
				<input type = "number" min = "0" size ="16" maxlength="16" id= "inputNum"><br>  			
  				<input type = "button" name = "depobut" id = "depobut" value = "Deposit" />
  				<input type = "button" name = "withbut" id = "withbut" value = "Withdraw" />
  			</form>
		</td>
		<td>
  			<p id="totalNum"></p>
  			<p id="curBet"></p>
  			<input type="button" name="sub1" id="sub1" value = "-" /> 
  			<input type="button" name="add1" id="add1" value = "+" /> 			
		</td>
		<td>
			<p id ="pull" >PULL</p>
		</td>
	</tbody>
		<tbody>
			<td valign="top">
				<h2 id ="logInTitle">Log In</h2>
				<div id="logInPage" name ="logInPage">
					<form action="login.php" method ="post">
						<input type="text" name="username" id="username" placeholder="username...">
						<br>
						<input type="password" name="password" id="password" value="" placeholder="password...">
						<br>
						<input type="submit" name="logInSubmit">
					</form>
					<br>
					<p id ="fyp" onmouseover="" style="cursor: pointer;"><span style="text-decoration: underline; color: blue;">Forgot your password?</span></p>
					<p id= "su" onmouseover="" style="cursor: pointer;"><span style="text-decoration: underline;">Don't have an account? Sign up.</span></p>
				</div>
				<div id="signUpPage" style="display: none;">
					<form action="signup.php" method ="post">
						<input type="text" name="username" id="username" placeholder="username...">
						<br>
						<input type="password" name="password" id="password" value="" placeholder="password...">
						<br>
						<input type="submit" name="signUpSubmit">
					</form>
					<p id= "aha" onmouseover="" style="cursor: pointer;"><span style="text-decoration: underline;">Already have an account? Log in.</span></p>
				</div>
			</td>
			<td valign="top">
			<h2 id="winnings">Winnings</h2>
			<p>Bar = 1X Bet<br>Grape = 2X Bet<br>Seven = 3X Bet<br>Dollar = 4X Bet<br>Bell = 5X Bet<br>Lemon = 6X Bet<br>
			</p>
		</td>
		<td valign= "top">	<div style="width:100%; max-height:260px; min-height: 260px;overflow: auto;"id="transBody" class=scrollable>
			<h2 id="transHist">Transaction History</h2>
			<p id="dynamicPara"></p>
		</td>
	</tbody>
	</div>
</table>

</div>


</body>
</html>
