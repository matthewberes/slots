//Matt Beres, August 2022
//simple slot machine

//works with a mysql database named "slots" and a table named "logininfo"
//5 columns in the table: int usersId, varchar usersName, varchar usersPwd, int usersBal, usersDate

//deposit and withdraw funds
//generates 3 random numbers with a range of 0-5 and determining if all 3 numbers are equal
//gives rewards for wins and keeps track of earnings/losses


$(document).ready(function() {
	//initializing variables
	let total = 69;
	let bet = 10;
	//set to 1 if an account is logged in, updates database with balance
	let loggedIn = 0;
	//set to 1 if log in failed, prevents deposit/withraw
	let logInError = 0;

	//initial scroll upon startup
	let previousSlot1 = Math.floor(Math.random() * 6);
	let previousSlot2 = Math.floor(Math.random() * 6);
	let previousSlot3 = Math.floor(Math.random() * 6);

	//for continuous tracking(used in distance)
	var lastSlot1 = previousSlot1;
	var lastSlot2 = previousSlot2;
	var lastSlot3 = previousSlot3;

	//for initial images
	var prevSlot1 = "img/" + previousSlot1 + ".png";
	var prevSlot2 = "img/" + previousSlot2 + ".png";
	var prevSlot3 = "img/" + previousSlot3 + ".png";

	//setting up initial images
	document.getElementById("slot1").src = prevSlot1;
	document.getElementById("slot2").src = prevSlot2;
	document.getElementById("slot3").src = prevSlot3;

	//setting up funds info
	document.getElementById("totalNum").innerHTML = "Total: " + total;
	document.getElementById("curBet").innerHTML = "Bet: " + bet;

	//setting up transaction history
	const p = document.getElementById("dynamicPara");

	//deposit/withdraw cell

	//deposit
	const Deposit = document.getElementById("depobut");

	Deposit.addEventListener("click", (d) => {
		d.preventDefault();

		if (logInError > 0){
			return
		}

		var input = document.getElementById("inputNum").value;
		if (input > 0){
			total = +total + +input;
			document.getElementById("totalNum").innerHTML = "Total: " + total;

			//update transaction history
			let html = "<span style='color:green'> +" + input + "</span><br>";
			p.insertAdjacentHTML('afterbegin', html);


			//update database
			if (loggedIn > 0){
				updateBal();
			}
		}

	})

	//withdraw
	const Withdraw = document.getElementById("withbut");
	
	Withdraw.addEventListener("click", (w) => {
		w.preventDefault();

		if (logInError > 0){
			return
		}

		var input = document.getElementById("inputNum").value;
		if (input <= total && input > 0){
			total = +total - +input;
			document.getElementById("totalNum").innerHTML = "Total: " + total;

			//update transaction history
			let html = "<span style='color:red'> -" + input + "</span><br>";
			p.insertAdjacentHTML('afterbegin', html);

			//update database
			if (loggedIn > 0){
				updateBal();
			}
		}
		else if (input > total) {
			alert("Insufficient Funds");
		}
	})

	//bet cell

	//raise bet
	document.getElementById("add1").onclick = function() {add1()};
	function add1() {
		
		if (bet > -1){
			bet++;
			document.getElementById("curBet").innerHTML = "Bet: " + bet;
		}
	}
	
	//lower bet
	document.getElementById("sub1").onclick = function() {sub1()};
	function sub1() {
		
		if (bet != 0){
			bet--;
			document.getElementById("curBet").innerHTML = "Bet: " + bet;
		}
	}

	//spin/pull cell

	//spin
	document.getElementById("pull").onclick = function() {RNG()};
	function RNG() {

		if (bet > total){
			alert("Insufficient Funds");
		}
		else if (bet == 0){
			alert("Place a Bet");
		}
		else{
			//update balance
			total = +total - +bet
			document.getElementById("totalNum").innerHTML = "Total: " + total;

			//update database
			if (loggedIn > 0){
				updateBal();
			}

			//RNG for next slot
			var num1 = Math.floor(Math.random() * 6);
			var num2 = Math.floor(Math.random() * 6);
			var num3 = Math.floor(Math.random() * 6);

			//DEBUG NEXT SLOTS AT START
			//console.log("num1 " + num1)
			//console.log("num2 " + num2)
			//console.log("num3 " + num3)
			
			//calculate distance
			var dist1 = distanceCalc(lastSlot1, num1);
			var dist2 = distanceCalc(lastSlot2, num2);
			var dist3 = distanceCalc(lastSlot3, num3);

			//DEBUG SLOT DISTANCE
			//console.log("dist1 = "+ dist1)
			//console.log("dist2 = "+ dist2)
			//console.log("dist3 = "+ dist3)

			//animate slots
			spinAnimation1(dist1, num1, lastSlot1);
			spinAnimation2(dist2, num2, lastSlot2);
			spinAnimation3(dist3, num3, lastSlot3, num1, num2);
			
			//keep track of previous slot for distanceCalc
			lastSlot1 = num1;
			lastSlot2 = num2;
			lastSlot3 = num3;
		}
	}

	//account cell

	//forgot your password
	document.getElementById("fyp").onclick = function() {FYP()};
	function FYP() {
		document.getElementById("error").innerHTML = "Remember it this time.";
		document.getElementById("error").style.color = "red";
		document.getElementById("error").style.display = "block";

		//switch back to sign up
		document.getElementById("logInTitle").innerHTML = "Sign Up";
		var l = document.getElementById("logInPage");
		var s = document.getElementById("signUpPage");

		l.style.display = "none";
		s.style.display = "block";
	}

	//switch to sign up
	document.getElementById("su").onclick = function() {SU()};
	function SU() {
		document.getElementById("logInTitle").innerHTML = "Sign Up";
		var l = document.getElementById("logInPage");
		var s = document.getElementById("signUpPage");
		var e = document.getElementById("error");

		l.style.display = "none";
		s.style.display = "block";
		e.style.display = "none";
	}

	//switch to log in
	document.getElementById("aha").onclick = function() {AHA()};
	function AHA() {
		document.getElementById("logInTitle").innerHTML = "Log in";
		var l = document.getElementById("logInPage");
		var s = document.getElementById("signUpPage");
		var e = document.getElementById("error");

		l.style.display = "block";
		s.style.display = "none";
		e.style.display = "none";
	}

	//log out
	document.getElementById("logOutButton").onclick = function() {LO()};
	function LO() {
		var l = document.getElementById("logInPage");
		var s = document.getElementById("signUpPage");
		var o = document.getElementById("loggedInPage");

		l.style.display = "block";
		s.style.display = "none";
		o.style.display = "none";

		total = 69;
		loggedIn = 0;
		logInError = 0;

		document.getElementById("logInTitle").innerHTML = "Log in";
		document.getElementById("totalNum").innerHTML = "Total: " + total;
		document.getElementById("dynamicPara").innerHTML = "";
	}

	//log in
	document.getElementById("logInSubmit").onclick = function() {LI()};
	function LI(){
		//makes sure displays are for log out
		const but = document.getElementById("logOutButton");

		but.value = "Log out";
		document.getElementById("userSince").style.display = "block";

		var userName = document.getElementById("usernameL").value;
		var passWord = document.getElementById("passwordL").value;

		//check if inputs are empty
		if (typeof userName === 'string' && userName.length === 0 || typeof passWord === 'string' && passWord.length === 0 ){
			document.getElementById("error").innerHTML = "Empty input";
			document.getElementById("error").style.color = "red";
			document.getElementById("error").style.display = "block";
			document.getElementById("userSince").style.display = "none";
			document.getElementById('logOutButton').value = "Try again";
		}

		//updates logInTitle
		$.ajax({
			url: "usernameAJAX.php",
			method: "post",
			data:{usersName: userName, usersPwd: passWord},
			dataType: "text",
			success: function(data){
				//log in title changes
				$('#logInTitle').html(data);
				logInError = document.getElementById("passValue").innerHTML;
			}
		});

		//updates balance and profile display
		$.ajax({
			url: "balanceAJAX.php",
			method: "post",
			data:{usersName: userName, usersPwd: passWord},
			dataType: "text",
			success: function(data){
				
				var l = document.getElementById("logInPage");
				var s = document.getElementById("signUpPage");
				var o = document.getElementById("loggedInPage");
				var b = document.getElementById("totalNum");

				//balance changes
				$('#totalNum').html(data);

				//display loggedInPage div
				l.style.display = "none";
				s.style.display = "none";
				o.style.display = "block";

				//transaction history
				document.getElementById("dynamicPara").innerHTML = "";
				
				//balance
				var str = document.getElementById("totalNum").innerHTML;
				var res = str.replace(/\D/g, "");
				total = +res
				
				//allows database updates from updateBal()
				loggedIn = 1;							
			}
		});

		//updates userSince
		$.ajax({
			url: "dateAJAX.php",
			method: "post",
			data:{usersName: userName},
			dataType: "text",
			success: function(data){
				//log in title changes to username
				$('#userSince').html(data);
				logInError = document.getElementById("passValue").innerHTML;
			}
		});
	}

	//if user is signed in, this keeps track of balance
	function updateBal(){
		var userName = document.getElementById("usernameL").value;

		$.ajax({
			url: "updateAJAX.php",
			method: "post",
			data:{usersName: userName, usersBal: total},
			dataType: "text",
			success: function(data){
			}
		});
	}

	//remove error msgs
	document.getElementById("username").onclick = function() {removeError()};
	function removeError(){
		var e = document.getElementById("error");
		e.style.display = "none";
	}

	document.getElementById("usernameL").onclick = function() {removeError()};

	document.getElementById("password").onclick = function() {removeError()};

	document.getElementById("passwordL").onclick = function() {removeError()};

	//spin slot 1 proper amount
	async function spinAnimation1(slot1Distance, slot1Destination, slotStart1){
		
		//for each number from previous slot to the next slot + 1 full spin
		for (let i = 0; i <= slot1Distance + 6; i++){
			nextSlot = (slotStart1 + i) % 6;
			nextImage = nextSlot + ".png";

			//setting up initial images
			document.getElementById("slot1").src = "img/" + nextImage;
			await sleep(60);

			//DEBUG IMAGES
			//console.log("Image 1 = " + nextImage);
		}
	}

	//spin slot 2 proper amount
	async function spinAnimation2(slot2Distance, slot2Destination, slotStart2){
		
		//for each number from previous slot to the next slot + 2 full spins
		for (let i = 0; i <= slot2Distance + 12; i++){
			nextSlot = (slotStart2 + i) % 6;
			nextImage = nextSlot + ".png";

			//setting up initial images in loop
			document.getElementById("slot2").src = "img/" + nextImage;
			await sleep(60);

			//DEBUG IMAGES
			//console.log("Image 2 = " + nextImage);
		}
	}

	//spin slot 3 proper amount
	async function spinAnimation3(slot3Distance, slot3Destination, slotStart3, num1, num2){
		
		//for each number from previous slot to the next slot + 3 full spins
		for (let i = 0; i <= slot3Distance + 18; i++){
			nextSlot = (slotStart3 + i) % 6;
			nextImage = nextSlot + ".png";

			//setting up initial images
			document.getElementById("slot3").src = "img/" + nextImage;
			await sleep(60);

			//DEBUG IMAGES
			//console.log("Image 3 = " + nextImage);

		}
		//see if you win
		calcWinnings(num1, num2, slot3Destination);
	}

	//wait function
	const sleep = (ms) =>{
		return new Promise(res => setTimeout(res, ms))
	}

	//calculate distance from last slot to new slot
	function distanceCalc(lastSlot, nextSlot){
		var distance;

		//DEBUG DISTANCE CALCULATION
		//console.log("lastSlot = " + lastSlot);
		//console.log("nextSlot = " + nextSlot);

		distance = (6 - lastSlot + nextSlot) % 6;
		return distance;

	}

	//check if all 3 numbers are equal and delivers reward
	function calcWinnings(num1, num2, num3){
			
		//DEBUG SLOTS AT END
		console.log("slot 1 = "+num1)
		console.log("slot 2 = "+num2)
		console.log("slot 3 = "+num3)

		//if all 3 numbers are the same
		if (num1 == num2 && num1 == num3){
		console.log("you won")
			
		//calculate winnings
		var multi = +num1 + 1;
		var winnings = +bet * +multi;

		//display win message
		alert("You won: " + winnings);

		//update balance
		total = +total + +winnings
		document.getElementById("totalNum").innerHTML = "Total: " + total;
		}		
	}
});