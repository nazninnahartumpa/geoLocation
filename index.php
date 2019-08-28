<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">




<!-- Leaflet map resource CDN starts here -->
<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css"/>
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<!-- Leaflet map resource CDN ends here -->
<div class="col-md-12">
<?php
include_once('db.php');
$obj=new Database();
$obj->dbInfo('localhost', 'root','','geo');
$conn=$obj->connect();
$data=$obj->getlocation($conn,'user');
while ($r=mysqli_fetch_assoc($data)) {
?>

<div style="font-weight: bold; margin: 10px; text-transform: uppercase; color: green;"><?php echo 'User Name : '.$r['name']?></div>
<div id="map<?php echo $r['id'] ?>" style="height:50%; margin: 10px auto; width: 70%;"></div>
<script>
var map = L.map("map<?php echo $r['id'] ?>",{attributionControl: false}).setView([<?php echo $r['position'] ?>], 15);

L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
	attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

var myFeatureGroup = L.featureGroup().addTo(map).on("mouseover", groupClick);
var marker, test;

test = "<p ><img src='data:image/png;base64,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' width='50' height='50'><br><b><?php echo $r['name'] ?></b> </p>";
marker = L.marker([<?php echo $r['position'] ?>]).addTo(myFeatureGroup).bindPopup(test);
marker.test = test;

function groupClick(event) {
	console.log("Clicked on marker " + event.layer.test);
}
</script>
<?php } ?>
</div>

<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>