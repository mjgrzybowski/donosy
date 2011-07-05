/**
 * 
 */

(function( $ ){

    $.fn.mapView = function( options ) { 
    	
        var _dom = $(this).get(0);
        var _plugin = this;
        var _map;
        var _mc;
            eventhandler : function(event) {
                
                var event2 = event;
                event2 = null;
                alert('YUPI!');
            };
        
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
                "label" : "Przycisk 1",
                "controlPosition" : google.maps.ControlPosition.LEFT_TOP,
                "click" : null
            },
            {
                "label" : "Przycisk 2",
                "controlPosition" : google.maps.ControlPosition.RIGHT_TOP,
                "click" : null
            },
    
            ]
        };
        
        var methods = {
            init : function( options ) {
                return this.each(function(){
                    if ( options )  
                        $.extend( _settings, options );
                    
                    var mapOptions = {
                        zoom: 6,
                        center: _settings.config.latlng,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };

                    
                    _plugin._map = new google.maps.Map(_dom, mapOptions);
                   
                    _plugin._mc =  new MarkerClusterer(_plugin._map, [], {
                        gridSize : 30,
                        maxZoom : 15
                    });
                    // settings events and callbacks    
                    //google.maps.event.addListener(map, 'click', _plugin.eventHandler);
                    
                    
                    // end events and callbacks
                    
    
                        
                    // TODO zrobić to lepiej
                     
                    $.each(_settings.buttons, function(key, button){
                        var controlUI = document.createElement('DIV');
                        
                         
                        controlUI.className = 'map-control';
                        controlUI.innerHTML = button.label;


                        _plugin._map.controls[button.controlPosition].push(controlUI);

                    }); 
                });
            },
            map : function ( options ){
                return  _plugin._map;
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
	
                _plugin._mc.addMarkers(batch, 3);
            },
            addAlert : function ( singleAlert ) {
                // TODO sprawdzanie czy Alert
                
                _plugin._mc.addMarker( new google.maps.Marker({
                    position : new google.maps.LatLng(singleAlert['lat'], singleAlert['lng']),
                    title : singleAlert['name']
                        
                }));
            },
            clearAlerts : function (){
                _plugin._mc.clearAlerts();
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