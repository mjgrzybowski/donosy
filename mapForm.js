/**
 * 
 */

(function( $ ){

    $.fn.mapForm = function( options ) { 
    	
        var _dom = $(this).get(0);
        
        var _settings = {
            "config" : {
        		"formId" : "mapForm",
        		"mapView" : null,
        		"autocomplete" : false,
        		"geocoder" : null,
        		"bounds" : null
            }
        };
        var _plugin = this;
        var _pluginQ = $(this);
        
        var _geocoder;
        var _bounds;
        var _mapView;
        
        var methods = {
            init : function( options ) {
                return this.each(function(){
                    if ( options )  
                        $.extend( _settings, options );
                 
                    _plugin._mapView = _settings["config"]["mapView"];
                    $(this).data("mapView", _plugin._mapView);
                    _plugin._geocoder = new google.maps.Geocoder();
                    $(this).data("geocoder", _plugin._geocoder);
                    _plugin._bounds = new google.maps.LatLngBounds();
                    $(this).data("bounds", _plugin._bounds );
                    
                    if (_settings['config']['autocomplete']){
                    	$("#address").autocomplete({
              		      //This bit uses the geocoder to fetch address values
              		      source: function(request, response) {
                    		_plugin._geocoder.geocode( {'address': request.term, 'region' : 'pl'}, function(results, status) {
              		          response($.map(results, function(item) {
              		            return {
              		              label:  item.formatted_address,
              		              value: item.formatted_address,
              		              latitude: item.geometry.location.lat(),
              		              longitude: item.geometry.location.lng()
              		            }
              		          }));
              		        })
              		      },
              		      //This bit is executed upon selection of an address
              		      select: function(event, ui) {
              		    	  //zmienic funkcje
              		    	  _plugin.codeAddress(ui.item.value);
              		      }
                    	});
                    }
                    	
                })
        	},
        	geocoder : function ()
            {
            	return $(this).data('geocoder');
            }
        	
        	
        };
        
       
        
        createListElement = function(value){
			$('<div/>', {
				class: 'listElement_'+value[0],
				id: value[0], 
				lat: value[1],
				lng: value[2],
				status: value[3],
				support: value[4],
				category: value[5],
				name: value[6],
				summary: value[7],
				location: value[8],
				user: value[9]
			}).appendTo('#list');
			$('#list .listElement_'+value[0]+'').append(
				'<div class="image"><img width="80px" height="80px" src="zalezne od '+value[0]+' param" alt="'+value[7]+'" /></div>'
				+'<div class="discription"><b>'+value[6]+'</b><br>'+value[8]+'<br>'+value[9]+'</div>'
				+'<div class=""></div>'
			);
		};
		
		getAlerts = function(data){
			data = json_encode(data);
			data = base64_encode(data);
			$.ajax({
				url : 'alertSearch.php',
				dataType: 'json',
				data: 'json='+data,
				success : function(data) {
					_plugin.createMarkersAndListElem(data)
				}
			});
		};
		
		createMarkersAndListElem = function(data)
		{    			
			if (data != undefined)
			{
//			SEARCH.results = data.alerts; 
    			$('#list').html('Znaleziono <span class="size">'+data.alerts.length+'</span> alertów dla podanych kryteriów')
    			$.map(data.alerts, function(value) {
    				singleAlert = {'lat': value[1], 'lng': value[2], 'name': value[6] };
    				_plugin._mapView('addAlert',singleAlert);
    				_plugin._bounds.extend(new google.maps.LatLng(value[1], value[2]));
    				_plugin.createListElement(value);
    			});

    			var map = _plugin._bounds.mapView;
    			map("_map").fitBounds($(this).data('bounds'));
			}
		};
		
		this.codeAddress = function (address) {
			if(!address)
				var address = document.getElementById("address").value;
			$(this).data('geocoder').geocode( {'address' : address}, function(results, status) {
		      if (status == google.maps.GeocoderStatus.OK) {
		    	var map = _plugin._mapView('_map');
		    	
		    	map.setCenter(results[0].geometry.location);
		    	viewport = results[0].geometry.viewport;
		    	map.fitBounds(viewport);
		    	
		    	data = {
		    	'ne' : {
		    			'lat': viewport.getNorthEast().lat(), 
		    			'lng': viewport.getNorthEast().lng()
		    		},
		    	'sw' : {
		    			'lat': viewport.getSouthWest().lat(), 
		    			'lng': viewport.getSouthWest().lng()
		    		}
		    	};
		    	
		    	_plugin.getAlerts(data);
		      }
		    });
		};
	
       
        // Method calling logic
        if ( methods[options] ) {
            return methods[ options ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof options === 'object' || ! options ) {
            return methods.init.apply( this, arguments );
        } else {
            $.error( 'Method ' +  options + ' does not exist on mapForm' );
        }  
	
    };


})( jQuery );