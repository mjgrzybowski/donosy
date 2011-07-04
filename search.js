/**
 * 
 */
$(document).ready(
		
	function() {
		fxMap = {};
		
		SEARCH = {};
		SEARCH.myOptions = {
			zoom : 4,
			center : new google.maps.LatLng(51.25, 21.00),
			mapTypeId : google.maps.MapTypeId.ROADMAP
		};
		
		var mapObject = $('#map');
		mapObject.mapView(SEARCH.myOptions);
		
		SEARCH.map = mapObject.mapView('map');
		SEARCH.geocoder = new google.maps.Geocoder();
		
		SEARCH.mcOptions = {
			gridSize : 30,
			maxZoom : 15
		};
		SEARCH.mc = new MarkerClusterer(SEARCH.map, [], SEARCH.mcOptions);
		SEARCH.bounds = new google.maps.LatLngBounds();

		SEARCH.getAlerts = function(ne, sw){
			$.ajax({
				url : 'alertSearch.php',
				dataType: 'json',
				data: { 'ne': ne, 'sw': sw },
				success : function(data) {
					var batch = [];
					$('#list').html('Znaleziono <span class="size">'+data.alerts.length+'</span> alertów dla podanych kryteriów')
					$.map(data.alerts, function(value) {
						batch.push(new google.maps.Marker({
							position : new google.maps.LatLng(value[1],
									value[2]),
							title : value[6],
							flat : true
						}));
						SEARCH.bounds.extend(new google.maps.LatLng(value[1], value[2]));
						SEARCH.createListElement(value);
					});
	
					SEARCH.mc.addMarkers(batch, 3);
					SEARCH.map.fitBounds(SEARCH.bounds);
				}
			});
		};	

		SEARCH.markers = {};
		google.maps.event.addListener(SEARCH.map, 'idle', function() {

		});

		this.getRandomPoint = function() {
			var lat = 48.25 + (Math.random() - 0.5) * 14.5;
			var lng = 11.00 + (Math.random() - 0.5) * 36.0;
			return new google.maps.LatLng(Math.round(lat * 10) / 10, Math
					.round(lng * 10) / 10);
		};

		SEARCH.getWeatherMarkers = function(n) {
			var batch = [];
			for ( var i = 0; i < n; ++i) {

				batch.push(new google.maps.Marker({
					position : SEARCH.getRandomPoint(),

					title : 'Weather marker'
				}));
			}
			return batch;
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
		
		SEARCH.codeAddress = function () {
		    var address = document.getElementById("address").value;
		    SEARCH.geocoder.geocode( {'address' : address}, function(results, status) {
		      if (status == google.maps.GeocoderStatus.OK) {
		    	SEARCH.map.setCenter(results[0].geometry.location);
		    	SEARCH.map.fitBounds(results[0].geometry.viewport);
		    	SEARCH.getAlerts()
		      }
		    });
		};
		
		
		$("#address").autocomplete({
		      //This bit uses the geocoder to fetch address values
		      source: function(request, response) {
		        geocoder.geocode( {'address': request.term }, function(results, status) {
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
		        SEARCH.map.setCenter(ui.item.location);
		        SEARCH.map.fitBounds(ui.item.bounds);
		      }
		 });
		
		
		
		
});