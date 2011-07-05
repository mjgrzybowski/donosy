
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
      $(document).ready(function () {
			    var map = new google.maps.Map(document.getElementById('map'), { center: new google.maps.LatLng(21.17, -86.66), zoom: 9, mapTypeId: google.maps.MapTypeId.HYBRID, scaleControl: true });
			    var isClosed = false;
			    var poly = new google.maps.Polyline({ map: map, path: [], strokeColor: "#FF0000", strokeOpacity: 1.0, strokeWeight: 2 });
			    google.maps.event.addListener(map, 'click', function (clickEvent) {
			        if (isClosed)
			            return;
			        var isFirstMarker = poly.getPath().length === 0;
			        var marker = new google.maps.Marker({ map: map, position: clickEvent.latLng, draggable: true });
			        if (isFirstMarker) {
			            google.maps.event.addListener(marker, 'click', function () {
			                if (isClosed)
			                    return;
			                var path = poly.getPath();
			                poly.setMap(null);
			                poly = new google.maps.Polygon({ map: map, path: path, strokeColor: "#FF0000", strokeOpacity: 0.8, strokeWeight: 2, fillColor: "#FF0000", fillOpacity: 0.35 });
			                isClosed = true;
			            });
			        }
			        google.maps.event.addListener(marker, 'drag', function (dragEvent) {
			            poly.getPath().setAt(markerIndex, dragEvent.latLng);
			        });
			        poly.getPath().push(clickEvent.latLng);
			    });
			});
    </script> 
  </body>
</html>
