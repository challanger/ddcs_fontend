function initMap() {
    var mapContainer = jQuery("#map"); 
    var mapPostion = {lat: mapContainer.data().lat,lng:mapContainer.data().lng};
    
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: mapPostion
    });
    var marker = new google.maps.Marker({
        position: mapPostion,
        map: map
    }); 

    var infowindow = new google.maps.InfoWindow({
        content: mapContainer.data().address
    });

    infowindow.open(map,marker); 

    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });


}