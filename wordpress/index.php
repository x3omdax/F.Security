<html>
<head>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<title>Wordpress Scanner</title>
</head>
<body>

<center>
	
   <div id="outPopUp">
<form action="scan.php" method="post"><font color="white">
Target: </font><input type="text" name="target"><br>
<input type="submit" value="Scan">
<select name="option">
  <option value="">Scan For Exploits</option>
  <option value="--enumerate u">Find Users</option>
  <option value="--enumerate t">Find Themes</option>
  <option value="--enumerate p">Find Plugins</option>
  <option value="--enumerate tt">Find TimThumbs</option>
</select>
</form>
</div>
<canvas id="c"></canvas>
<style>
#outPopUp {
  position: absolute;
  width: 190px;
  height: 20px;
  z-index: 15;
  top: 50%;
  left: 50%;
  margin: -100px 0 0 -150px;
  background: black;
}
</style>
<style>
/*basic reset*/

* {margin: 0; padding: 0;}
/*adding a black bg to the body to make things clearer*/
body {background: black;}
canvas {display: block;}
</style>
<script>var c = document.getElementById("c");
var ctx = c.getContext("2d");

//making the canvas full screen
c.height = window.innerHeight;
c.width = window.innerWidth;

//chinese characters - taken from the unicode charset
var chinese = "田由甲申甴电甶男甸甹町画甼甽甾甿畀畁畂畃畄畅畆畇畈畉畊畋界畍畎畏畐畑";
//converting the string into an array of single characters
chinese = chinese.split("");

var font_size = 10;
var columns = c.width/font_size; //number of columns for the rain
//an array of drops - one per column
var drops = [];
//x below is the x coordinate
//1 = y co-ordinate of the drop(same for every drop initially)
for(var x = 0; x < columns; x++)
	drops[x] = 1; 

//drawing the characters
function draw()
{
	//Black BG for the canvas
	//translucent BG to show trail
	ctx.fillStyle = "rgba(0, 0, 0, 0.05)";
	ctx.fillRect(0, 0, c.width, c.height);
	
	ctx.fillStyle = "#0F0"; //green text
	ctx.font = font_size + "px arial";
	//looping over drops
	for(var i = 0; i < drops.length; i++)
	{
		//a random chinese character to print
		var text = chinese[Math.floor(Math.random()*chinese.length)];
		//x = i*font_size, y = value of drops[i]*font_size
		ctx.fillText(text, i*font_size, drops[i]*font_size);
		
		//sending the drop back to the top randomly after it has crossed the screen
		//adding a randomness to the reset to make the drops scattered on the Y axis
		if(drops[i]*font_size > c.height && Math.random() > 0.975)
			drops[i] = 0;
		
		//incrementing Y coordinate
		drops[i]++;
	}
}

setInterval(draw, 33);
</script>
</center>
</body>
</html>
