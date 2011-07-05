/**
 * 
 */
$(document).ready(
		
	function() {		
		SEARCH = {};
		SEARCH.myOptions = {
			zoom : 4,
			center : new google.maps.LatLng(51.25, 21.00),
			mapTypeId : google.maps.MapTypeId.ROADMAP
		};
		
		var mapObject = $('#map');
		var mapO = mapObject.mapView(SEARCH.myOptions);
		
		var form = $('#navigationForm');
		form.mapForm({"config" : {
			"mapView" : mapO,
			"autocomplete" : true
		}});
		
		SEARCH.results = {};
		
		SEARCH.createMarkersAndListElem = function(data)
		{
			var batch = [];
			
			SEARCH.results = data.alerts; 
			$('#list').html('Znaleziono <span class="size">'+data.alerts.length+'</span> alertów dla podanych kryteriów')
			$.map(data.alerts, function(value) {
				singleAlert = {'lat': value[1], 'lng': value[2], 'name': value[6] };
				mapObject.mapView('addAlert',singleAlert);

				SEARCH.bounds.extend(new google.maps.LatLng(value[1], value[2]));
				SEARCH.createListElement(value);
			});

			SEARCH.map.fitBounds(SEARCH.bounds);
		}
		
		
		SEARCH.getAlerts = function(data){
			data = json_encode(data);
			data = base64_encode(data);
			$.ajax({
				url : 'alertSearch.php',
				dataType: 'json',
				data: 'json='+data,
				success : function(data) {
					
					SEARCH.createMarkersAndListElem(data)
					
			
				}
			});
		};	

			
		SEARCH.createListElement = function(value){
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
		
		SEARCH.codeAddress = function (address) {
			if(!address)
				var address = document.getElementById("address").value;
		    SEARCH.geocoder.geocode( {'address' : address}, function(results, status) {
		      if (status == google.maps.GeocoderStatus.OK) {
		    	SEARCH.map.setCenter(results[0].geometry.location);
		    	viewport = results[0].geometry.viewport;
		    	SEARCH.map.fitBounds(viewport);
		    	
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
		    	
		    	SEARCH.getAlerts(data);
		      }
		    });
		};
		
/*		
		$("#address").autocomplete({
		      //This bit uses the geocoder to fetch address values
		      source: function(request, response) {
		    	  SEARCH.geocoder.geocode( {'address': request.term, 'region' : 'pl'}, function(results, status) {
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
		    	  SEARCH.codeAddress(ui.item.value);
		      }
		 },
	     {
	    	  'scrollHeight' : '150px'
	     }
	     );
		*/
		
		
		
});