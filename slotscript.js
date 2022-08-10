//Matt Beres, August 2022
//simple slot machine

//deposit and withdraw funds
//generates 3 random numbers with a range of 0-5 and determining if all 3 numbers are equal
//gives rewards for wins and keeps track of earnings/losses


$(document).ready(function() {
	let total = 69;
	let bet = 10;

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

	//withdraw
	const Withdraw = document.getElementById("withbut");
	
	Withdraw.addEventListener("click", (w) => {
		w.preventDefault();
		var input1 = document.getElementById("inputNum").value;
		if (input1 <= total && input1 > -1){
			total = +total - +input1;
			document.getElementById("totalNum").innerHTML = "Total: " + total;
		}
		else if (input1 > total) {
			alert("Insufficient Funds");
		}
	})

	//deposit
	const Deposit = document.getElementById("depobut");

	Deposit.addEventListener("click", (d) => {
		d.preventDefault();
		var input = document.getElementById("inputNum").value;
		if (input > -1){
		total = +total + +input;
		document.getElementById("totalNum").innerHTML = "Total: " + total;
		}

	})

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

	//spin slot 1 proper amount
	async function spinAnimation1(slot1Distance, slot1Destination, slotStart1){
		
		//for each number from previous slot to the next slot
		for (let i = 0; i <= slot1Distance; i++){
			nextSlot = (slotStart1 + i) % 6;
			nextImage = nextSlot + ".png";

			//setting up initial images
			document.getElementById("slot1").src = "img/" + nextImage;
			await sleep(90);

			//DEBUG IMAGES
			//console.log("Image 1 = " + nextImage);
		}
	}

	//spin slot 2 proper amount
	async function spinAnimation2(slot2Distance, slot2Destination, slotStart2){
		
		//for each number from previous slot to the next slot + 6
		for (let i = 0; i <= slot2Distance + 6; i++){
			nextSlot = (slotStart2 + i) % 6;
			nextImage = nextSlot + ".png";

			//setting up initial images in loop
			document.getElementById("slot2").src = "img/" + nextImage;
			await sleep(90);

			//DEBUG IMAGES
			//console.log("Image 2 = " + nextImage);
		}
	}

	//spin slot 3 proper amount
	async function spinAnimation3(slot3Distance, slot3Destination, slotStart3, num1, num2){
		
		//for each number from previous slot to the next slot + 12
		for (let i = 0; i <= slot3Distance + 12; i++){
			nextSlot = (slotStart3 + i) % 6;
			nextImage = nextSlot + ".png";

			//setting up initial images
			document.getElementById("slot3").src = "img/" + nextImage;
			await sleep(90);

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