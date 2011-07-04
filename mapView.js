/**
 * 
 */

(function( $ ){

    $.fn.mapView = function( options ) { 
    	var _map;
    	var _dom = $(this);
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

            }
        };
        
 	var methods = {
	     init : function( options ) {
	       return this.each(function(){
	    	   if (options )
	    		   $.extend( _settings, options );
	    	   else
	    		   options = _settings;
	    	   
	    	   $(this).data('map', _map = new google.maps.Map(_dom[0], options));
	    	   console.log(_map);
	       });
	     },
	     map : function ( options )
	     {
	    	 console.log($(this).data('map'));
	    	 return  $(this).data('map');
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