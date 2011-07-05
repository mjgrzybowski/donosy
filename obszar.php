
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
  </head>
  <body  style="width: 100%; height: 100%; margin: 0;">
    <div id="map" style="width: 100%; height: 100%;"></div> 

    <script type="text/javascript"> 
      var myOptions = {
        zoom: 4,
        center: new google.maps.LatLng(51.25, 21.00),
        mapTypeId: google.maps.MapTypeId.ROADMAP
      };
      var map = new google.maps.Map(document.getElementById('map'), myOptions);

      var polyOptions = {
			    strokeColor: '#000000',
			    strokeOpacity: 1.0,
			    strokeWeight: 3
			  }
			var poly = new google.maps.Polygon(polyOptions);
			
			poly.setMap(map);

			  // Add a listener for the click event
			google.maps.event.addListener(map, 'click', addLatLng);
			google.maps.event.addListener(map, 'dragend', editLatLng);
       
      

      
      function addLatLng(event) {

			  var path = poly.getPath();

			  // Because path is an MVCArray, we can simply append a new coordinate
			  // and it will automatically appear
			  path.push(event.latLng);

			  // Add a new marker at the new plotted point on the polyline.
			  var marker = new google.maps.Marker({
			    position: event.latLng,
			    title: '#' + path.getLength(),
			    map: map,
					draggable: true,
					clickable: true,
			  });
			}
      
    </script> 
  </body>
</html>
