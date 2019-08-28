<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
</head>
<body>

<div style="margin: 100px auto; width: 50%;">
	<div style="font-weight: bold; text-transform: uppercase; margin-bottom: 10px;">Please! Enter your name and submit it to help you.</div>

	<div class="form-group">
	   <label for="name">Enter Your Name</label>
	   <input type="text" class="form-control" id="name" placeholder="Enter your name here...">
	</div>
	<button onclick="getLocation()" type="submit" class="btn btn-info">Submit</button>
	<div id="demo"></div>

</div>

<script>
var x = document.getElementById("demo");
var n = document.getElementById("name");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
	var name=n.value
  	var url='http://localhost/geo/save.php?lat='+position.coords.latitude+'&long='+position.coords.longitude+'&name='+name
  window.location.assign(url)
}
</script>

</body>
</html>