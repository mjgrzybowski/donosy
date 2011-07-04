/**
 * 
 */

(function( $ ){

    $.mapView = function( options ) {  

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
    };

    return this.each(function() {        
        if ( options ) { 
            $.extend( _settings, options );
        }


    });


})( jQuery );