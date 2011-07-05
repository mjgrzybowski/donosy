
<!DOCTYPE html>
<html style="width: 100%; height: 100%;">
  <head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="http://code.jquery.com/jquery-1.6.2.js" type="text/javascript"></script> 
    <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script> 
    <script src="http://google-maps-utility-library-v3.googlecode.com/svn/tags/markermanager/1.0/src/markermanager.js" type="text/javascript"></script> 
    <script src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer.js" type="text/javascript"></script> 
	<script src="mapView.js" type="text/javascript"></script>
	<script type="text/javascript">
				var map = null;
				var polyLine;
				var tmpPolyLine;
				var markers = [];
				var vmarkers = [];
				var g = google.maps;

				var initMap = function(mapHolder) {
					markers = [];
					vmarkers = [];
					var mapOptions = {
						zoom: 6,
						center: new g.LatLng(52.00, 21.00), 
						mapTypeId: g.MapTypeId.ROADMAP,
						draggableCursor: 'auto',
						draggingCursor: 'move',
						disableDoubleClickZoom: true
					};
					map = new g.Map(document.getElementById(mapHolder), mapOptions);
					g.event.addListener(map, "click", mapLeftClick);
					mapHolder = null;
					mapOptions = null;
				};

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> parent of 04e4e5d... .
				var initPolyline = function() {
					var polyOptions = {
						strokeColor: "#3355FF",
						strokeOpacity: 0.8,
						strokeWeight: 4
					};
					var tmpPolyOptions = {
						strokeColor: "#3355FF",
						strokeOpacity: 0.4,
						strokeWeight: 4
					};
					polyLine = new g.Polygon(polyOptions);
					polyLine.setMap(map);
<<<<<<< HEAD
					tmpPolyLine = new g.Polyline(tmpPolyOptions);
					tmpPolyLine.setMap(map);
				};
=======
            var initPolyline = function() {
                var polyOptions = {
                    strokeColor: "#3355FF",
                    strokeOpacity: 0.8,
                    strokeWeight: 4
                };
                var tmpPolyOptions = {
                    strokeColor: "#3355FF",
                    strokeOpacity: 0.4,
                    strokeWeight: 4
                };
                activePoly = new g.Polyline(polyOptions);
                activePoly.setMap(map);
                tmpPolyLine = new g.Polyline(tmpPolyOptions);
                tmpPolyLine.setMap(map);
                var polygonOptions = {
                    strokeColor: "#3355FF",
                    strokeOpacity: 0.8,
                    strokeWeight: 4
                };
                polygon = new g.Polygon(polygonOptions);
                polygon.setMap(map);
                
                
            };
>>>>>>> 04e4e5d8053715d93206186934e0fac1b6212c88
=======
					tmpPolyLine = new g.Polygon(tmpPolyOptions);
					tmpPolyLine.setMap(map);
				};
>>>>>>> parent of 04e4e5d... .

				var mapLeftClick = function(event) {
					if (event.latLng) {
						var marker = createMarker(event.latLng);
						markers.push(marker);
						if (markers.length != 1) {
							var vmarker = createVMarker(event.latLng);
							vmarkers.push(vmarker);
							vmarker = null;
						}
						var path = polyLine.getPath();
						path.push(event.latLng);
						marker = null;
					}
					event = null;
				};

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> parent of 04e4e5d... .
				var createMarker = function(point) {
					var imageNormal = new g.MarkerImage(
						"square.png",
						new g.Size(11, 11),
						new g.Point(0, 0),
						new g.Point(6, 6)
					);
					var imageHover = new g.MarkerImage(
						"square_over.png",
						new g.Size(11, 11),
						new g.Point(0, 0),
						new g.Point(6, 6)
					);
					var marker = new g.Marker({
						position: point,
						map: map,
						icon: imageNormal,
						draggable: true
					});
					g.event.addListener(marker, "mouseover", function() {
						marker.setIcon(imageHover);
					});
					g.event.addListener(marker, "mouseout", function() {
						marker.setIcon(imageNormal);
					});
					g.event.addListener(marker, "drag", function() {
						for (var m = 0; m < markers.length; m++) {
							if (markers[m] == marker) {
								polyLine.getPath().setAt(m, marker.getPosition());
								moveVMarker(m);
								break;
							}
						}
						m = null;
					});
					g.event.addListener(marker, "click", function() {
						for (var m = 0; m < markers.length; m++) {
							if (markers[m] == marker) {
								marker.setMap(null);
								markers.splice(m, 1);
								polyLine.getPath().removeAt(m);
								removeVMarkers(m);
								break;
							}
						}
						m = null;
					});
					return marker;
				};
<<<<<<< HEAD

				var createVMarker = function(point) {
					var prevpoint = markers[markers.length-2].getPosition();
					var imageNormal = new g.MarkerImage(
						"square_transparent.png",
						new g.Size(11, 11),
						new g.Point(0, 0),
						new g.Point(6, 6)
					);
					var imageHover = new g.MarkerImage(
						"square_transparent_over.png",
						new g.Size(11, 11),
						new g.Point(0, 0),
						new g.Point(6, 6)
					);
					var marker = new g.Marker({
						position: new g.LatLng(
							point.lat() - (0.5 * (point.lat() - prevpoint.lat())),
							point.lng() - (0.5 * (point.lng() - prevpoint.lng()))
						),
						map: map,
						icon: imageNormal,
						draggable: true
					});
					g.event.addListener(marker, "mouseover", function() {
						marker.setIcon(imageHover);
					});
					g.event.addListener(marker, "mouseout", function() {
						marker.setIcon(imageNormal);
					});
					g.event.addListener(marker, "dragstart", function() {
						for (var m = 0; m < vmarkers.length; m++) {
							if (vmarkers[m] == marker) {
								var tmpPath = tmpPolyLine.getPath();
								tmpPath.push(markers[m].getPosition());
								tmpPath.push(vmarkers[m].getPosition());
								tmpPath.push(markers[m+1].getPosition());
								break;
							}
						}
						m = null;
					});
					g.event.addListener(marker, "drag", function() {
						for (var m = 0; m < vmarkers.length; m++) {
							if (vmarkers[m] == marker) {
								tmpPolyLine.getPath().setAt(1, marker.getPosition());
								break;
							}
						}
						m = null;
					});
					g.event.addListener(marker, "dragend", function() {
						for (var m = 0; m < vmarkers.length; m++) {
							if (vmarkers[m] == marker) {
								var newpos = marker.getPosition();
								var startMarkerPos = markers[m].getPosition();
								var firstVPos = new g.LatLng(
									newpos.lat() - (0.5 * (newpos.lat() - startMarkerPos.lat())),
									newpos.lng() - (0.5 * (newpos.lng() - startMarkerPos.lng()))
								);
								var endMarkerPos = markers[m+1].getPosition();
								var secondVPos = new g.LatLng(
									newpos.lat() - (0.5 * (newpos.lat() - endMarkerPos.lat())),
									newpos.lng() - (0.5 * (newpos.lng() - endMarkerPos.lng()))
								);
								var newVMarker = createVMarker(secondVPos);
								newVMarker.setPosition(secondVPos);//apply the correct position to the vmarker
								var newMarker = createMarker(newpos);
								markers.splice(m+1, 0, newMarker);
								polyLine.getPath().insertAt(m+1, newpos);
								marker.setPosition(firstVPos);
								vmarkers.splice(m+1, 0, newVMarker);
								tmpPolyLine.getPath().removeAt(2);
								tmpPolyLine.getPath().removeAt(1);
								tmpPolyLine.getPath().removeAt(0);
								newpos = null;
								startMarkerPos = null;
								firstVPos = null;
								endMarkerPos = null;
								secondVPos = null;
								newVMarker = null;
								newMarker = null;
								break;
							}
						}
					});
					return marker;
				};
				
				var move
=======
            var createMarker = function(point) {
                var imageNormal = new g.MarkerImage(
                "square.png",
                new g.Size(11, 11),
                new g.Point(0, 0),
                new g.Point(6, 6)
            );
                var imageHover = new g.MarkerImage(
                "square_over.png",
                new g.Size(11, 11),
                new g.Point(0, 0),
                new g.Point(6, 6)
            );
                var marker = new g.Marker({
                    position: point,
                    map: map,
                    icon: imageNormal,
                    draggable: true
                });
                g.event.addListener(marker, "mouseover", function() {
                    marker.setIcon(imageHover);
                });
                g.event.addListener(marker, "mouseout", function() {
                    marker.setIcon(imageNormal);
                });
                g.event.addListener(marker, "drag", function() {
                    for (var m = 0; m < markers.length; m++) {
                        if (markers[m] == marker) {
                            activePoly.getPath().setAt(m, marker.getPosition());
                            moveVMarker(m); // na bieżaco przesuwa Vmarkery
                            break;
                        }
                    }
                    m = null;
                });
                g.event.addListener(marker, "click", function() {
                    if(marker == markers[0] || marker == markers.length-1){
                        allowCreation = false;
                        mvcArray = activePoly.getPath();
                        activePoly.setPath(new google.maps.MVCArray);
                        polygon.setPath(mvcArray);
                        activePoly = polygon;
                        console.log('kliknięty ostatni lub pierwszy marker');
                    } else {
                        for (var m = 0; m < markers.length; m++) {
                        if (markers[m] == marker) {
                            marker.setMap(null);
                            markers.splice(m, 1);
                            activePoly.getPath().removeAt(m);
                            removeVMarkers(m);
                            break;
                        }
                    }
                    }
                    
                    m = null;
                });
                return marker;
            };

            var createVMarker = function(point) {
                var prevpoint = markers[markers.length-2].getPosition();
                var imageNormal = new g.MarkerImage(
                "square_transparent.png",
                new g.Size(11, 11),
                new g.Point(0, 0),
                new g.Point(6, 6)
            );
                var imageHover = new g.MarkerImage(
                "square_transparent_over.png",
                new g.Size(11, 11),
                new g.Point(0, 0),
                new g.Point(6, 6)
            );
                var marker = new g.Marker({
                    position: new g.LatLng(
                    point.lat() - (0.5 * (point.lat() - prevpoint.lat())),
                    point.lng() - (0.5 * (point.lng() - prevpoint.lng()))
                ),
                    map: map,
                    icon: imageNormal,
                    draggable: true
                });
                g.event.addListener(marker, "mouseover", function() {
                    marker.setIcon(imageHover);
                });
                g.event.addListener(marker, "mouseout", function() {
                    marker.setIcon(imageNormal);
                });
                g.event.addListener(marker, "dragstart", function() {
                    for (var m = 0; m < vmarkers.length; m++) {
                        if (vmarkers[m] == marker) {
                            var tmpPath = tmpPolyLine.getPath();
                            tmpPath.push(markers[m].getPosition());
                            tmpPath.push(vmarkers[m].getPosition());
                            tmpPath.push(markers[m+1].getPosition());
                            break;
                        }
                    }
                    m = null;
                });
                g.event.addListener(marker, "drag", function() {
                    for (var m = 0; m < vmarkers.length; m++) {
                        if (vmarkers[m] == marker) {
                            tmpPolyLine.getPath().setAt(1, marker.getPosition());
                            break;
                        }
                    }
                    m = null;
                });
                g.event.addListener(marker, "dragend", function() {
                    for (var m = 0; m < vmarkers.length; m++) {
                        if (vmarkers[m] == marker) {
                            var newpos = marker.getPosition();
                            var startMarkerPos = markers[m].getPosition();
                            var firstVPos = new g.LatLng(
                            newpos.lat() - (0.5 * (newpos.lat() - startMarkerPos.lat())),
                            newpos.lng() - (0.5 * (newpos.lng() - startMarkerPos.lng()))
                        );
                            var endMarkerPos = markers[m+1].getPosition();
                            var secondVPos = new g.LatLng(
                            newpos.lat() - (0.5 * (newpos.lat() - endMarkerPos.lat())),
                            newpos.lng() - (0.5 * (newpos.lng() - endMarkerPos.lng()))
                        );
                            var newVMarker = createVMarker(secondVPos);
                            newVMarker.setPosition(secondVPos);//apply the correct position to the vmarker
                            var newMarker = createMarker(newpos);
                            markers.splice(m+1, 0, newMarker);
                            activePoly.getPath().insertAt(m+1, newpos);
                            marker.setPosition(firstVPos);
                            vmarkers.splice(m+1, 0, newVMarker);
                            tmpPolyLine.getPath().removeAt(2);
                            tmpPolyLine.getPath().removeAt(1);
                            tmpPolyLine.getPath().removeAt(0);
                            newpos = null;
                            startMarkerPos = null;
                            firstVPos = null;
                            endMarkerPos = null;
                            secondVPos = null;
                            newVMarker = null;
                            newMarker = null;
                            break;
                        }
                    }
                });
                return marker;
            };
>>>>>>> 04e4e5d8053715d93206186934e0fac1b6212c88
=======

				var createVMarker = function(point) {
					var prevpoint = markers[markers.length-2].getPosition();
					var imageNormal = new g.MarkerImage(
						"square_transparent.png",
						new g.Size(11, 11),
						new g.Point(0, 0),
						new g.Point(6, 6)
					);
					var imageHover = new g.MarkerImage(
						"square_transparent_over.png",
						new g.Size(11, 11),
						new g.Point(0, 0),
						new g.Point(6, 6)
					);
					var marker = new g.Marker({
						position: new g.LatLng(
							point.lat() - (0.5 * (point.lat() - prevpoint.lat())),
							point.lng() - (0.5 * (point.lng() - prevpoint.lng()))
						),
						map: map,
						icon: imageNormal,
						draggable: true
					});
					g.event.addListener(marker, "mouseover", function() {
						marker.setIcon(imageHover);
					});
					g.event.addListener(marker, "mouseout", function() {
						marker.setIcon(imageNormal);
					});
					g.event.addListener(marker, "dragstart", function() {
						for (var m = 0; m < vmarkers.length; m++) {
							if (vmarkers[m] == marker) {
								var tmpPath = tmpPolyLine.getPath();
								tmpPath.push(markers[m].getPosition());
								tmpPath.push(vmarkers[m].getPosition());
								tmpPath.push(markers[m+1].getPosition());
								break;
							}
						}
						m = null;
					});
					g.event.addListener(marker, "drag", function() {
						for (var m = 0; m < vmarkers.length; m++) {
							if (vmarkers[m] == marker) {
								tmpPolyLine.getPath().setAt(1, marker.getPosition());
								break;
							}
						}
						m = null;
					});
					g.event.addListener(marker, "dragend", function() {
						for (var m = 0; m < vmarkers.length; m++) {
							if (vmarkers[m] == marker) {
								var newpos = marker.getPosition();
								var startMarkerPos = markers[m].getPosition();
								var firstVPos = new g.LatLng(
									newpos.lat() - (0.5 * (newpos.lat() - startMarkerPos.lat())),
									newpos.lng() - (0.5 * (newpos.lng() - startMarkerPos.lng()))
								);
								var endMarkerPos = markers[m+1].getPosition();
								var secondVPos = new g.LatLng(
									newpos.lat() - (0.5 * (newpos.lat() - endMarkerPos.lat())),
									newpos.lng() - (0.5 * (newpos.lng() - endMarkerPos.lng()))
								);
								var newVMarker = createVMarker(secondVPos);
								newVMarker.setPosition(secondVPos);//apply the correct position to the vmarker
								var newMarker = createMarker(newpos);
								markers.splice(m+1, 0, newMarker);
								polyLine.getPath().insertAt(m+1, newpos);
								marker.setPosition(firstVPos);
								vmarkers.splice(m+1, 0, newVMarker);
								tmpPolyLine.getPath().removeAt(2);
								tmpPolyLine.getPath().removeAt(1);
								tmpPolyLine.getPath().removeAt(0);
								newpos = null;
								startMarkerPos = null;
								firstVPos = null;
								endMarkerPos = null;
								secondVPos = null;
								newVMarker = null;
								newMarker = null;
								break;
							}
						}
					});
					return marker;
				};
>>>>>>> parent of 04e4e5d... .

				var moveVMarker = function(index) {
					var newpos = markers[index].getPosition();
					if (index != 0) {
						var prevpos = markers[index-1].getPosition();
						vmarkers[index-1].setPosition(new g.LatLng(
							newpos.lat() - (0.5 * (newpos.lat() - prevpos.lat())),
							newpos.lng() - (0.5 * (newpos.lng() - prevpos.lng()))
						));
						prevpos = null;
					}
					if (index != markers.length - 1) {
						var nextpos = markers[index+1].getPosition();
						vmarkers[index].setPosition(new g.LatLng(
							newpos.lat() - (0.5 * (newpos.lat() - nextpos.lat())), 
							newpos.lng() - (0.5 * (newpos.lng() - nextpos.lng()))
						));
						nextpos = null;
					}
					newpos = null;
					index = null;
				};

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> parent of 04e4e5d... .
				var removeVMarkers = function(index) {
					if (markers.length > 0) {//clicked marker has already been deleted
						if (index != markers.length) {
							vmarkers[index].setMap(null);
							vmarkers.splice(index, 1);
						} else {
							vmarkers[index-1].setMap(null);
							vmarkers.splice(index-1, 1);
						}
					}
					if (index != 0 && index != markers.length) {
						var prevpos = markers[index-1].getPosition();
						var newpos = markers[index].getPosition();
						vmarkers[index-1].setPosition(new g.LatLng(
							newpos.lat() - (0.5 * (newpos.lat() - prevpos.lat())),
							newpos.lng() - (0.5 * (newpos.lng() - prevpos.lng()))
						));
						prevpos = null;
						newpos = null;
					}
					index = null;
				};
<<<<<<< HEAD
				
				
				window.onload = function() {
					initMap('map');
					initPolyline();
				};
	</script>
  </head>
  <body  style="width: 100%; height: 100%; margin: 0;">
    <div id="map" style="width: 100%; height: 100%;"></div> 
<?php echo $_POST ?>
  </body>
=======
            var removeVMarkers = function(index) {
                if (markers.length > 0) {//clicked marker has already been deleted
                    if (index != markers.length) {
                        vmarkers[index].setMap(null);
                        vmarkers.splice(index, 1);
                    } else {
                        vmarkers[index-1].setMap(null);
                        vmarkers.splice(index-1, 1);
                    }
                }
                if (index != 0 && index != markers.length) {
                    var prevpos = markers[index-1].getPosition();
                    var newpos = markers[index].getPosition();
                    vmarkers[index-1].setPosition(new g.LatLng(
                    newpos.lat() - (0.5 * (newpos.lat() - prevpos.lat())),
                    newpos.lng() - (0.5 * (newpos.lng() - prevpos.lng()))
                ));
                    prevpos = null;
                    newpos = null;
                }
                index = null;
            };
=======
>>>>>>> parent of 04e4e5d... .

				window.onload = function() {
					initMap('map');
					initPolyline();
				};
	</script>
  </head>
  <body  style="width: 100%; height: 100%; margin: 0;">
    <div id="map" style="width: 100%; height: 100%;"></div> 

<<<<<<< HEAD
    </body>
>>>>>>> 04e4e5d8053715d93206186934e0fac1b6212c88
=======
  </body>
>>>>>>> parent of 04e4e5d... .
</html>
