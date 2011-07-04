/**
 * 
 */

(function( $ ){

    $.fn.mapView = function( options ) { 
    	var _map;
    	var _dom = $(this).get(0);
        var _settings = {
            "config": {
                "latlng" : null,
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
            }
        };
        
 	var methods = {
	     init : function( options ) {
	       return this.each(function(){
	    	   if (options )
	    		   $.extend( _settings, options );
	    	   else
	    		   options = _settings;
	    	   
	    	   $(this).data('map', _map = new google.maps.Map(_dom, options));
	       });
	     },
	     map : function ( options ){return  $(this).data('map');}
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