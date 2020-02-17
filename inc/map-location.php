//intialize the map
<?php extract($map) ?>
function initialize() {

	var mapOptions = {
		zoom: 14,
		center: new google.maps.LatLng(<?php echo $latitude ?>, <?php echo $longitude ?>)
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
	var contentString = '<div class="info-box"><p><?php echo $name ?></p></div>';

	var infowindow = new google.maps.InfoWindow({ content: contentString });

	google.maps.event.addListener(marker, 'click', function() {
	    infowindow.open(map,marker);
	  });

}

google.maps.event.addDomListener(window, 'load', initialize);