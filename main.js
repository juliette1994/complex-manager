function complexe() {
    document.getElementById("button").addEventListener("click", function(){
	    var x = document.querySelectorAll("p");
	    var input1 = document.getElementById('reel').value;
            var input2 = document.getElementById('imaginaire').value;
	      var conjugue = input1 + "- i" + input2;
	    var reel = document.getElementById("rreel");
	    var imaginaire = document.getElementById("iimaginaire");
	    var regex = /^[-]?[+]?[0-9]+[.]?[,]?[0-9]*$/;
	    var non = /^[\w\W]*[0-9]*[a-zA-Z]+[0-9]*[\w\W]*$/;
	    input1 = input1.replace(",", ".");
	    input2 = input2.replace(",", ".");
	    if (input1.match(regex) && input2.match(regex)){
		document.body.style.backgroundImage = "url('f1.jpg')";
		for (var j = 0; j < x.length; j++)
		    x[j].style.color = "blue";
		input1 = parseFloat(input1);
		input2 = parseFloat(input2);
		var module = Math.sqrt(input1*input1 + input2*input2);
		reel.value = input1;
		imaginaire.value = input2;
		document.getElementById('reel').value = "";
		document.getElementById('imaginaire').value = "";
		document.getElementById("conjugue").value = conjugue;
		document.getElementById("module").value = module;                       
		if (input1*input1 + input2*input2 != 0)
		{                     
		  var inv1 = input1/(input1*input1 + input2*input2);
		  var inv2 = input2/(input1*input1 + input2*input2);
		  var inverse = inv1 + "- i" + inv2;
		  alert("Attention!\nLe dénominateur ne doit pas être nul.");                    
		  var argument = Math.atan2(input2, input1);
		  document.getElementById("argument").value = argument;
		  var trig = module + "(cos(" + argument + ") + isin(" + argument + "))";
		  document.getElementById("trigo").value = trig; 
		}
		else
		{
		    e.preventDefault();
		    if (input1.match(non) || input2.match(non) || !input1.match(regex) || !input2.match(regex))
		    {
		      document.body.style.backgroundImage = "url('f2.jpg')";
		      for (var i = 0; i < x.length; i++)
			x[i].style.color = "black";
		      alert("Attention!\nUne valeur ne peut contenir que des chiffres, une virgule ou un point.");
		      if (input1.match(non) || !input1.match(regex))
			document.getElementById('reel').value = "";
                      if (input2.match(non) || !input2.match(regex))
                        document.getElementById('imaginaire').value = "";
                      reel.value = "";
		      imaginaire.value = "";
		    }
		}
	    }
        });
}


function graphisme() {
	    document.getElementById("graph").style.display='inline-block';
	    var input1 = document.getElementById('reel').value;
	    var input2 = document.getElementById('imaginaire').value;
	    function Graph(config) {
		this.canvas = document.getElementById(config.canvasId);
		this.minX = config.minX;
		this.minY = config.minY;
		this.maxX = config.maxX;
		this.maxY = config.maxY;
		this.unitsPerTick = config.unitsPerTick;
		this.axisColor = 'black';
		this.font = '8pt Calibri';
		this.tickSize = 10;

		this.context = this.canvas.getContext('2d');
		this.rangeX = this.maxX - this.minX;
		this.rangeY = this.maxY - this.minY;
		this.unitX = this.canvas.width / this.rangeX;
		this.unitY = this.canvas.height / this.rangeY;
		this.centerY = Math.round(Math.abs(this.minY / this.rangeY) * this.canvas.height);
		this.centerX = Math.round(Math.abs(this.minX / this.rangeX) * this.canvas.width);
		this.iteration = (this.maxX - this.minX) / 1000;
		this.scaleX = this.canvas.width / this.rangeX;
		this.scaleY = this.canvas.height / this.rangeY;

		this.drawXAxis();
		this.drawYAxis();
	    }

	    Graph.prototype.drawXAxis = function() {
		var context = this.context;
		context.save();
		context.beginPath();
		context.moveTo(0, this.centerY);
		context.lineTo(this.canvas.width, this.centerY);
		context.strokeStyle = this.axisColor;
		context.lineWidth = 2;
		context.stroke();

		// draw tick marks
		var xPosIncrement = this.unitsPerTick * this.unitX;
		var xPos, unit;
		context.font = this.font;
		context.textAlign = 'center';
		context.textBaseline = 'top';

		// draw left tick marks
		xPos = this.centerX - xPosIncrement;
		unit = -1 * this.unitsPerTick;
		while(xPos > 0) {
		    context.moveTo(xPos, this.centerY - this.tickSize / 2);
		    context.lineTo(xPos, this.centerY + this.tickSize / 2);
		    context.stroke();
		    context.fillText(unit, xPos, this.centerY + this.tickSize / 2 + 3);
		    unit -= this.unitsPerTick;
		    xPos = Math.round(xPos - xPosIncrement);
		}

		// draw right tick marks
		xPos = this.centerX + xPosIncrement;
		unit = this.unitsPerTick;
		while(xPos < this.canvas.width) {
		    context.moveTo(xPos, this.centerY - this.tickSize / 2);
		    context.lineTo(xPos, this.centerY + this.tickSize / 2);
		    context.stroke();
		    context.fillText(unit, xPos, this.centerY + this.tickSize / 2 + 3);
		    unit += this.unitsPerTick;
		    xPos = Math.round(xPos + xPosIncrement);
		}
	    };

	    Graph.prototype.drawYAxis = function() {
		var context = this.context;
		context.save();
		context.beginPath();
		context.moveTo(this.centerX, 0);
		context.lineTo(this.centerX, this.canvas.height);
		context.strokeStyle = this.axisColor;
		context.lineWidth = 2;
		context.stroke();

		var yPosIncrement = this.unitsPerTick * this.unitY;
		var yPos, unit;
		context.font = this.font;
		context.textAlign = 'right';
		context.textBaseline = 'middle';

		yPos = this.centerY - yPosIncrement;
		unit = this.unitsPerTick;
		while(yPos > 0) {
		    context.moveTo(this.centerX - this.tickSize / 2, yPos);
		    context.lineTo(this.centerX + this.tickSize / 2, yPos);
		    context.stroke();
		    context.fillText(unit, this.centerX - this.tickSize / 2 - 3, yPos);
		    unit += this.unitsPerTick;
		    yPos = Math.round(yPos - yPosIncrement);
		}

		yPos = this.centerY + yPosIncrement;
		unit = -1 * this.unitsPerTick;
		while(yPos < this.canvas.height) {
		    context.moveTo(this.centerX - this.tickSize / 2, yPos);
		    context.lineTo(this.centerX + this.tickSize / 2, yPos);
		    context.stroke();
		    context.fillText(unit, this.centerX - this.tickSize / 2 - 3, yPos);
		    unit -= this.unitsPerTick;
		    yPos = Math.round(yPos + yPosIncrement);
		}
		context.restore();
	    };

	    Graph.prototype.drawEquation = function(x, y, color, thickness) {
		var context = this.context;
		context.save();
		context.save();
		this.transformContext();
		context.beginPath();
		context.moveTo(x, y);
		context.lineTo(0, 0);
		context.fillStyle = "red";
		context.fillRect(x-0.1, y-0.1, 0.2, 0.2);
		context.restore();
		context.lineJoin = 'round';
		context.lineWidth = thickness;
		context.strokeStyle = color;
		context.stroke();
		context.restore();
	    };

	    Graph.prototype.transformContext = function() {
		var context = this.context;
		this.context.translate(this.centerX, this.centerY);
		context.scale(this.scaleX, -this.scaleY);
	    };
	    
	    var myGraph = new Graph({
		    canvasId: 'graph',
		    minX: -10,
		    minY: -11,
		    maxX: 10,
		    maxY: 11,
		    unitsPerTick: 1
		});

	     console.log(input1+input2);
	    myGraph.drawEquation(input1, input2, 'black', 1);
}
