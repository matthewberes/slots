<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" type="text/css" href="slotstyle.css" media="screen"/>
<link rel="stylesheet" media='screen and (min-width: 200px) and (max-width: 400px)' href='style1.css' />
<script src="jquery-3.1.1.js"></script>
<script src="slotscript.js"></script>
<title>CL8CKW8RK</title>
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
		<div id="login">
			<td>	
			</td>
		</div>
		<td valign="top">
			<h2 id="winnings">Winnings</h2>
			<p>Bar = 1X Bet<br>Grape = 2X Bet<br>Seven = 3X Bet<br>Dollar = 4X Bet<br>Bell = 5X Bet<br>Lemon = 6X Bet<br>
			</p>
		</td>
		<td valign= "top">	<div style="width:100%; max-height:175px; overflow: auto;"id="transBody" class=scrollable>
			<h2 id="transHist">Transaction History</h2>
			<p id="dynamicPara"></p>
		</td>
	</tbody>
	</div>
</table>

</div>


</body>
</html>