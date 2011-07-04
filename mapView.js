/**
 * 
 */

(function( $ ){

    $.fn.mapView = function( options ) { 
    	
        var _dom = $(this).get(0);
        
        var _settings = {
            "config": {
                "latlng" : new google.maps.LatLng(52,21),
                "address" : null,
                "categories" : {
                    "icons" : null,
                    "show" : null,
                    "showAll" : false
                },
                "markerClusterer" : 
                {
                    "gridSize": 50,
                    "maxZoom": 15
                }

            },
            "event" :{
                "alert_click" : null,
                "alert_mouserout" : null,
                "alert_mouserover" : null,
                "alert_dragend" :  null,
  
  
                "polygon_click" :  null,
                "polygon_dblclick" :  null,
                "polygon_mousedown" :  null,
                "polygon_mousemove" :  null,
                "polygon_mouseout" :  null,
                "polygon_mouseover" :  null,
                "polygon_mouseup" :  null,
                "polygon_rightclick" : null
            },
            "buttons" : [
            {
                "label" : "Nazwa przycisku",
                "controlPosition" : google.maps.ControlPosition.BOTTOM_CENTER,
                "click" : null
            },
            {
                "label" : "Nazwa przycisku",
                "controlPosition" : google.maps.ControlPosition.BOTTOM_CENTER,
                "click" : null
            },
    
            ]
        };
        
        var methods = {
            init : function( options ) {
                return this.each(function(){
                    if ( options )  
                        $.extend( _settings, options );
                    
                    var latlng = new google.maps.LatLng(-34.397, 150.644);
                    var mapOptions = {
                        zoom: 6,
                        center: _settings.config.latlng,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };

                    $(this).data('_map', new google.maps.Map(_dom, mapOptions));
        
                    $(this).data('markerClusterer',
                        new MarkerClusterer($(this).data('_map'), [], {
                            gridSize : 30,
                            maxZoom : 15
                        }));
                        
                    var controlUI = document.createElement('DIV');
                        
                         controlUI.style.backgroundColor = 'white';
                          controlUI.style.borderStyle = 'solid';
                          controlUI.style.borderWidth = '2px';
                          controlUI.style.cursor = 'pointer';
                          controlUI.style.textAlign = 'center';
                          controlUI.innerHTML = 'Home';


                        //_map.controls[google.maps.ControlPosition.RIGHT_TOP].push(controlUI);
    
                    var _map = $(this).data('_map');    
                    $.each(_settings.buttons, function(key, button){
                        var controlUI = document.createElement('DIV');
                        
                         
                          controlUI.className = 'map-control';
                          controlUI.innerHTML = button.label;


                        _map.controls[button.controlPosition].push(controlUI);

                    }); 
                });
            },
            map : function ( options ){
                return  $(this).data('_map');
            },
            addAlerts : function ( alerts) { 
                // TODO sprawdzanie czy Alert
                var batch = [];
					
                $.map(alerts, function(singleAlert) {
                    batch.push(new google.maps.Marker({
                        position : new google.maps.LatLng(singleAlert['lat'], singleAlert['lng']),
                        title : singleAlert['name']
                        
                    }));
                   
                });
	
                $(this).data('markerClusterer').addMarkers(batch, 3);
            },
            addAlert : function ( singleAlert ) {
                // TODO sprawdzanie czy Alert
                $(this).data('markerClusterer', new google.maps.Marker({
                    position : new google.maps.LatLng(singleAlert['lat'], singleAlert['lng']),
                    title : singleAlert['name']
                        
                }));
            },
            clearAlerts : function (){
                $(this).data('markerClusterer').clearAlerts();
            }
             
        };
	
        // Method calling logic
        if ( methods[options] ) {
            return methods[ options ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof options === 'object' || ! options ) {
            return methods.init.apply( this, arguments );
        } else {
            $.error( 'Method ' +  options + ' does not exist on jQuery.tooltip' );
        }  
	
    };


})( jQuery );