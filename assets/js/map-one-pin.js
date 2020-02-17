//intialize the map
function initialize() {

	var mapOptions = {
		zoom: 15,
		center: new google.maps.LatLng(6.428917, 3.429756)
	};

	var map = new google.maps.Map(document.getElementById('map-location'),mapOptions);


	// MARKERS
	/****************************************************************/

	//add a marker1
	var marker = new google.maps.Marker({
	    position: map.getCenter(),
	    map: map,
	    icon: 'assets/images/icon-pin.png'
	});



	// INFO BOXES
	/****************************************************************/

	//show info box for marker1
	var contentString = '<div class="info-box"><p>Welcome to Blissville</p></div>';

	var infowindow = new google.maps.InfoWindow({ content: contentString });

	google.maps.event.addListener(marker, 'click', function() {
	    infowindow.open(map,marker);
	  });

}



google.maps.event.addDomListener(window, 'load', initialize);