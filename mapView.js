/**
 * 
 */

(function( $ ){

  $.mapView = function( options ) {  

    var settings = {
    		
    };

    return this.each(function() {        
      if ( options ) { 
        $.extend( settings, options );
      }


    });

  };
})( jQuery );