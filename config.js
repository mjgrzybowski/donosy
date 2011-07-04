var options = {
  "config": {
    "latlng" : "52.12324,21.242155",
    "address" : "Polska, Warszawa, św. Franciszka Salezego 6",
    "categories" : {
      "icons" : [
      {
        1 : "icon1.png"
      },
      {
        2 : "icon2.png"
      },
      {
        3 : "car-accident.png"
      },
        
      ],
      "show" : [1,4,5,6,8,9,10,14],
      "showAll" : false
    }
    
  },
  
  "alerts" : {
	  'id' : 123, //int
	  'lat' : 52.234567, //float
	  'lng' : 21.234567, //float
	  'status' : 1, // int
	  'support' : 22, //int
	  'category' : 16, //int
	  'name' : 'Przykładowa nazwa',  //string
	  'summary' : 'Lorem ipsum dolor sit amet...', // string (140)
	  'location' : 'Warszawa, Wojciecha Górskiego 42a', //string
	  'user' : 'Paweł Mikołajczuk'  //string
  },
  "polygons" : [
    {
      "paths" : [
      [52.123425,21.2425],
      [52.123425,21.2425],
      [52.123425,21.2425],
      [52.123425,21.2425],
      
      ],
      "strokeColor" : "#FF0000",
      "strokeOpacity" : 0.8,
      "strokeWeight" : 2,
      "fillColor" : "#FF0000",
      "fillOpacity" : 0.35,
      "zIndex" : 0
    }
  ],
  "buttons" : [
    {
      "label" : "Nazwa przycisku",
      "controlPosition" : google.maps.ControlPosition.BOTTOM_CENTER,
      "click" : function(button){}
    },
    {
      "label" : "Nazwa przycisku",
      "controlPosition" : google.maps.ControlPosition.BOTTOM_CENTER,
      "click" : function(button){}
    },
    
  ],
  
  
  "alert_click" : function(alert){},
  "alert_mouserout" : function(alert){},
  "alert_mouserover" : function(alert){},
  "alert_dragend" : function(alert){},
  
  
  "polygon_click" : function(polygon){},
  "polygon_dblclick" : function(polygon){},
  "polygon_mousedown" : function(polygon){},
  "polygon_mousemove" : function(polygon){},
  "polygon_mouseout" : function(polygon){},
  "polygon_mouseover" : function(polygon){},
  "polygon_mouseup" : function(polygon){},
  "polygon_rightclick" : function(polygon){}
}
