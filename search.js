/**
 * 
 */
$(document).ready(
	function() {
		fxMap = {};
		
		var SEARCH = {};

		SEARCH.myOptions = {
			zoom : 4,
			center : new google.maps.LatLng(51.25, 21.00),
			mapTypeId : google.maps.MapTypeId.ROADMAP
		};

		SEARCH.map = new google.maps.Map(document.getElementById('map'), SEARCH.myOptions);
		SEARCH.mcOptions = {
			gridSize : 30,
			maxZoom : 15
		};
		SEARCH.mc = new MarkerClusterer(SEARCH.map, [], SEARCH.mcOptions);
		SEARCH.bounds = new google.maps.LatLngBounds();

		$.ajax({
			url : 'alerts.php',
			success : function(data) {
				var batch = [];

				$.map(data.alerts, function(value) {
					batch.push(new google.maps.Marker({
						position : new google.maps.LatLng(value[0],	value[1]),
						title : 'Weather marker',
						flat : true
					}));
					SEARCH.bounds.extend(new google.maps.LatLng(value[0], value[1]));
				});

				SEARCH.mc.addMarkers(batch, 3);
				SEARCH.map.fitBounds(SEARCH.bounds);
			}
		});

		SEARCH.markers = {};
		google.maps.event.addListener(SEARCH.map, 'idle', function() {

		});

		SEARCH.getRandomPoint = function() {
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
		
		
});