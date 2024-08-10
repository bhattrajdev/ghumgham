<div id="map" style="height: 400px; width: 100%;"></div>

<script>
    function initMap() {
        // Default location: Kathmandu
        var defaultPosition = {
            lat: 27.7172,
            lng: 85.3240
        };

        // Check if latitude and longitude are provided
        var latitude = parseFloat(@json($latitude));
        var longitude = parseFloat(@json($longitude));

        // Use provided location if available, otherwise use default location
        var initialPosition = {
            lat: isNaN(latitude) || !isFinite(latitude) ? defaultPosition.lat : latitude,
            lng: isNaN(longitude) || !isFinite(longitude) ? defaultPosition.lng : longitude
        };

        var mapOptions = {
            center: initialPosition,
            zoom: 12,
            draggable: true
        };

        var map = new google.maps.Map(document.getElementById('map'), mapOptions);

        var marker = null;
        var isEditable = @json($isEditable);

        // Show marker at initial position if latitude and longitude are provided
        if (latitude && longitude) {
            marker = new google.maps.Marker({
                position: initialPosition,
                map: map,
                draggable: isEditable
            });

            // Update hidden fields when the marker is dragged
            if (isEditable) {
                marker.addListener('position_changed', function() {
                    var position = marker.getPosition();
                    document.getElementById('latitude').value = position.lat();
                    document.getElementById('longitude').value = position.lng();
                });
            }
        }

        // Allow creating a marker on click if editable
        if (isEditable) {
            map.addListener('click', function(event) {
                var clickedLatLng = event.latLng;

                // Remove existing marker if any
                if (marker) {
                    marker.setMap(null);
                }

                // Place a new marker at the clicked location
                marker = new google.maps.Marker({
                    position: clickedLatLng,
                    map: map,
                    draggable: true
                });

                // Update hidden input fields with the new position
                document.getElementById('latitude').value = clickedLatLng.lat();
                document.getElementById('longitude').value = clickedLatLng.lng();

                // Update hidden fields when the new marker is dragged
                marker.addListener('position_changed', function() {
                    var position = marker.getPosition();
                    document.getElementById('latitude').value = position.lat();
                    document.getElementById('longitude').value = position.lng();
                });
            });
        }
    }

    function loadGoogleMapsAPI() {
        var script = document.createElement('script');
        script.src = `https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap&libraries=places`;
        script.async = true;
        script.defer = true;
        document.head.appendChild(script);
    }

    loadGoogleMapsAPI();
</script>

<input type="hidden" id="latitude" name="latitude" value="{{ $latitude }}">
<input type="hidden" id="longitude" name="longitude" value="{{ $longitude }}">
