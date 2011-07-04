<!DOCTYPE html>
<html style="width: 100%; height: 100%;">
  	<head>
    	<title></title>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <script src="http://code.jquery.com/jquery-1.6.2.js" type="text/javascript"></script> 
	    <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script> 
	    <script src="http://google-maps-utility-library-v3.googlecode.com/svn/tags/markermanager/1.0/src/markermanager.js" type="text/javascript"></script> 
	    <script src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer.js" type="text/javascript"></script>
	    <script src="mapView.js" type="text/javascript"></script> 
		<script src="search.js"></script>
  	</head>
	<body style="width: 100%; height: 100%; margin: 0;">
		<div id="navigationForm">
		<form action="#" method="POST">
			<input type="text" name="location" />
			
		</form>
		</div>
		<div id="map" style="width: 60%; height: 100%; float:left;"></div>
		<div id="list" style="width: 40%; height: 200px; float:left;"></div>	
	</body>

</html>
