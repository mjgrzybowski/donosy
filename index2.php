
<!DOCTYPE html>
<html style="width: 100%; height: 100%;">
  <head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="http://code.jquery.com/jquery-1.6.2.js" type="text/javascript"></script> 
    <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script> 
    <script src="http://google-maps-utility-library-v3.googlecode.com/svn/tags/markermanager/1.0/src/markermanager.js" type="text/javascript"></script> 
    <script src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer.js" type="text/javascript"></script> 


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

      //var mgrOptions = { borderPadding: 50, maxZoom: 15, trackMarkers: true };
      var mgr = new MarkerManager(map);
      var mcOptions = {gridSize: 30, maxZoom: 15};
      var mc = new MarkerClusterer(map, [], mcOptions);
      var bounds = new google.maps.LatLngBounds();
      google.maps.event.addListener(mgr, 'loaded', function(){
          alert('cos');
        $.ajax({
          url: 'alerts.php',
          success: function(data){
            var batch = [];
            
            $.map(data.alerts, function(value){
              
              batch.push(new google.maps.Marker({
                position: new google.maps.LatLng(value[0], value[1]),
                title: 'Weather marker',
                flat: true
              }));
              bounds.extend(new google.maps.LatLng(value[0], value[1]));
              
            });
          
           
            mc.addMarkers(batch, 3);  
            map.fitBounds(bounds);
            
          }
        })
                  
      }); 
      
     
      
      
      var markers = {};
      
      
      google.maps.event.addListener(map, 'idle', function(){
        
        
      });

      
      function getRandomPoint() {
        var lat = 48.25 + (Math.random() - 0.5) * 14.5;
        var lng = 11.00 + (Math.random() - 0.5) * 36.0;
        return new google.maps.LatLng(Math.round(lat * 10) / 10, Math.round(lng * 10) / 10);
      }

      function getWeatherMarkers(n) {
        var batch = [];
        for (var i = 0; i < n; ++i) {
        
          batch.push(new google.maps.Marker({
            position: getRandomPoint(),
            
            title: 'Weather marker'
          })
        );        
        }
        return batch;
      }
       
      

      
      
      
    </script> 
  </body>
</html>
