<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {

var dataPoints = [];

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: false,
	theme: "dark1",
	title: {
		text: "Battery Values"
	},
	axisX: {
		valueFormatString:"HH:mm D/M/Y",
		labelWrap: true,
		labelAngle: -45
	},
	axisY: {
		title: "Milivolts",
		titleFontSize: 24,
		includeZero: false
	},
	data: [{
		type: "spline",
		xValueFormatString:"HH:mm D/M/Y",
		dataPoints: dataPoints
	}]
});

Date.prototype.addHours = function(h) {
  this.setTime(this.getTime() + (h*60*60*1000));
  return this;
}

function addData(data) {
	for (var i = 0; i < data.length; i++) {
		dataPoints.push({
			x: (new Date(data[i].created_at)).addHours(3),
			y: parseFloat(data[i].avg_battery_voltage)
		});
	}
	chart.render();

}

$.getJSON("https://iot.filoxeni.com/api/avg_battery_voltage", addData);

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html