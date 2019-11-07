var automaticGeoLocation = false;

var lastClickedMarker;
var searchClicked;
var mapAutoZoom;
var map;

// Hero Map on Home ----------------------------------------------------------------------------------------------------

function heroMap(_latitude,_longitude, element, markerTarget, sidebarResultTarget, showMarkerLabels, mapDefaultZoom){
    if( document.getElementById(element) != null ){

        // Create google map first -------------------------------------------------------------------------------------

        if( !mapDefaultZoom ){
            mapDefaultZoom = 14;
        }

        if( !optimizedDatabaseLoading ){
            var optimizedDatabaseLoading = 0;
        }

        var mapZoomAttr = $('#map').attr('data-map-zoom');
        var mapScrollAttr = $('#map').attr('data-map-scroll');
        if (typeof mapZoomAttr !== typeof undefined && mapZoomAttr !== false) {
            var zoomLevel = parseInt(mapZoomAttr);
        } else {
            var zoomLevel = 5;
        }
        if (typeof mapScrollAttr !== typeof undefined && mapScrollAttr !== false) {
            var scrollEnabled = parseInt(mapScrollAttr);
        } else {
            var scrollEnabled = false;
        }

        map = new google.maps.Map(document.getElementById(element), {
            zoom: mapDefaultZoom,
            scrollwheel: scrollEnabled,
            center: new google.maps.LatLng(_latitude, _longitude),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            zoomControl: false,
            mapTypeControl: false,
            scaleControl: false,
            panControl: false,
            navigationControl: false,
            streetViewControl: false,
            styles: [{
                "featureType": "poi",
                "elementType": "labels.text.fill",
                "stylers": [{
                    "color": "#747474"
                }, {
                    "lightness": "23"
                }]
            }, {
                "featureType": "poi.attraction",
                "elementType": "geometry.fill",
                "stylers": [{
                    "color": "#f38eb0"
                }]
            }, {
                "featureType": "poi.government",
                "elementType": "geometry.fill",
                "stylers": [{
                    "color": "#ced7db"
                }]
            }, {
                "featureType": "poi.medical",
                "elementType": "geometry.fill",
                "stylers": [{
                    "color": "#ffa5a8"
                }]
            }, {
                "featureType": "poi.park",
                "elementType": "geometry.fill",
                "stylers": [{
                    "color": "#c7e5c8"
                }]
            }, {
                "featureType": "poi.place_of_worship",
                "elementType": "geometry.fill",
                "stylers": [{
                    "color": "#d6cbc7"
                }]
            }, {
                "featureType": "poi.school",
                "elementType": "geometry.fill",
                "stylers": [{
                    "color": "#c4c9e8"
                }]
            }, {
                "featureType": "poi.sports_complex",
                "elementType": "geometry.fill",
                "stylers": [{
                    "color": "#b1eaf1"
                }]
            }, {
                "featureType": "road",
                "elementType": "geometry",
                "stylers": [{
                    "lightness": "100"
                }]
            }, {
                "featureType": "road",
                "elementType": "labels",
                "stylers": [{
                    "visibility": "off"
                }, {
                    "lightness": "100"
                }]
            }, {
                "featureType": "road.highway",
                "elementType": "geometry.fill",
                "stylers": [{
                    "color": "#ffd4a5"
                }]
            }, {
                "featureType": "road.arterial",
                "elementType": "geometry.fill",
                "stylers": [{
                    "color": "#ffe9d2"
                }]
            }, {
                "featureType": "road.local",
                "elementType": "all",
                "stylers": [{
                    "visibility": "simplified"
                }]
            }, {
                "featureType": "road.local",
                "elementType": "geometry.fill",
                "stylers": [{
                    "weight": "3.00"
                }]
            }, {
                "featureType": "road.local",
                "elementType": "geometry.stroke",
                "stylers": [{
                    "weight": "0.30"
                }]
            }, {
                "featureType": "road.local",
                "elementType": "labels.text",
                "stylers": [{
                    "visibility": "on"
                }]
            }, {
                "featureType": "road.local",
                "elementType": "labels.text.fill",
                "stylers": [{
                    "color": "#747474"
                }, {
                    "lightness": "36"
                }]
            }, {
                "featureType": "road.local",
                "elementType": "labels.text.stroke",
                "stylers": [{
                    "color": "#e9e5dc"
                }, {
                    "lightness": "30"
                }]
            }, {
                "featureType": "transit.line",
                "elementType": "geometry",
                "stylers": [{
                    "visibility": "on"
                }, {
                    "lightness": "100"
                }]
            }, {
                "featureType": "water",
                "elementType": "all",
                "stylers": [{
                    "color": "#d2e7f7"
                }]
            }]
        });

        // Load necessary data for markers using PHP (from database) after map is loaded and ready ---------------------

        var allMarkers;

        //  When optimization is enabled, map will load the data in Map Bounds every time when it's moved. Otherwise will load data at once

        if( optimizedDatabaseLoading == 1 ){
            google.maps.event.addListener(map, 'idle', function(){
                if( searchClicked != 1 ){
                    var ajaxData = {
                        optimized_loading: 1,
                        north_east_lat: map.getBounds().getNorthEast().lat(),
                        north_east_lng: map.getBounds().getNorthEast().lng(),
                        south_west_lat: map.getBounds().getSouthWest().lat(),
                        south_west_lng: map.getBounds().getSouthWest().lng()
                    };
                    if( markerCluster != undefined ){
                        markerCluster.clearMarkers();
                    }
                    loadData(ajaxurl+"?action=getlocHomemap");
                }
            });
        }
        else {
            google.maps.event.addListenerOnce(map, 'idle', function(){
                loadData(ajaxurl+"?action=getlocHomemap");
            });
        }

        if( showMarkerLabels == true ){
            $(".hero-section .map").addClass("show-marker-labels");
        }


        var zoomControlDiv = document.createElement('div');
        var zoomControl = new ZoomControl(zoomControlDiv, map);

        function ZoomControl(controlDiv, map) {
            zoomControlDiv.index = 1;
            map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(zoomControlDiv);
            controlDiv.style.padding = '5px';
            controlDiv.className = "zoomControlWrapper";
            var controlWrapper = document.createElement('div');
            controlDiv.appendChild(controlWrapper);
            var zoomInButton = document.createElement('div');
            zoomInButton.className = "custom-zoom-in";
            controlWrapper.appendChild(zoomInButton);
            var zoomOutButton = document.createElement('div');
            zoomOutButton.className = "custom-zoom-out";
            controlWrapper.appendChild(zoomOutButton);
            google.maps.event.addDomListener(zoomInButton, 'click', function() {
                map.setZoom(map.getZoom() + 1);
            });
            google.maps.event.addDomListener(zoomOutButton, 'click', function() {
                map.setZoom(map.getZoom() - 1);
            });
        }
        var scrollEnabling = $('#scrollEnabling');
        $(scrollEnabling).click(function(e) {
            e.preventDefault();
            $(this).toggleClass("enabled");
            if ($(this).is(".enabled")) {
                map.setOptions({
                    'scrollwheel': true
                });
            } else {
                map.setOptions({
                    'scrollwheel': false
                });
            }
        })


        // Create and place markers function ---------------------------------------------------------------------------

        var i;
        var a;
        var newMarkers = [];
        var resultsArray = [];
        var visibleMarkersId = [];
        var visibleMarkersOnMap = [];
        var markerCluster;

        function placeMarkers(markers){

            newMarkers = [];

            for (i = 0; i < markers.length; i++) {

                var marker;
                var markerContent = document.createElement('div');
                var thumbnailImage;

                if (markers[i]["marker_image"] != undefined) {
                    thumbnailImage = markers[i]["marker_image"];
                }
                else {
                    thumbnailImage = path+"assets/img/default.png";
                }

                if (markers[i]["featured"] == 1) {
                    markerContent.innerHTML =
                        '<div class="marker" data-id="' + markers[i]["id"] + '">' +
                        '<div class="title">' + markers[i]["title"] + '</div>' +
                        '<div class="marker-wrapper">' +
                        '<div class="pin">' +
                        '<div class="image" style="background-image: url(' + thumbnailImage + ');"></div>' +
                        '</div>' +
                        '</div>';
                }
                else {
                    markerContent.innerHTML =
                        '<div class="marker" data-id="' + markers[i]["id"] + '">' +
                        '<div class="title">' + markers[i]["title"] + '</div>' +
                        '<div class="marker-wrapper">' +
                        '<div class="pin">' +
                        '<div class="image iconPosition"><i class="' +markers[i]["cat_icon"]+'"></i></div>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                }

                // Latitude, Longitude and Address

                if ( markers[i]["latitude"] && markers[i]["longitude"] && markers[i]["address"] ){
                    renderRichMarker(i,"latitudeLongitude");
                }

                // Only Address

                else if ( markers[i]["address"] && !markers[i]["latitude"] && !markers[i]["longitude"] ){
                    renderRichMarker(i,"address");
                }

                // Only Latitude and Longitude

                else if ( markers[i]["latitude"] && markers[i]["longitude"] && !markers[i]["address"] ) {
                    renderRichMarker(i,"latitudeLongitude");
                }

                // No coordinates

                else {
                    console.log( "No location coordinates");
                }
            }

            // Create marker using RichMarker plugin -------------------------------------------------------------------

            function renderRichMarker(i,method){
                if( method == "latitudeLongitude" ){
                    marker = new RichMarker({
                        position: new google.maps.LatLng( markers[i]["latitude"], markers[i]["longitude"] ),
                        map: map,
                        draggable: false,
                        content: markerContent,
                        flat: true
                    });
                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() {
                            if( markerTarget == "sidebar"){
                                openSidebarDetail( $(this.content.firstChild).attr("data-id") );
                            }
                            else if( markerTarget == "gmapAdBox" ){
                                opengmapAdBox( $(this.content.firstChild).attr("data-id"), this, i );
                            }
                            else if( markerTarget == "modal" ){
                                openModal($(this.content.firstChild).attr("data-id"), "modal_item.php");
                            }
                        }
                    })(marker, i));
                    newMarkers.push(marker);
                }
                else if ( method == "address" ){
                    a = i;
                    var geocoder = new google.maps.Geocoder();
                    var geoOptions = {
                        address: markers[i]["address"]
                    };
                    geocoder.geocode(geoOptions, geocodeCallback(markerContent));

                }

                if ( mapAutoZoom == 1 ){
                    var bounds  = new google.maps.LatLngBounds();
                    for (var i = 0; i < newMarkers.length; i++ ) {
                        bounds.extend(newMarkers[i].getPosition());
                    }
                    map.fitBounds(bounds);
                }

            }

            // Ajax loading of gmapAdBox -------------------------------------------------------------------------------------

            var lastgmapAdBox;

            function opengmapAdBox(id, _this, i){
                $.ajax({
                    url: ajaxurl+"?action=openlocatoionPopup",
                    dataType: "html",
                    data: { id: id },
                    method: "POST",
                    success: function(results){
                        gmapAdBoxOptions = {
                            content: results,
                            disableAutoPan: false,
                            pixelOffset: new google.maps.Size(-135, -50),
                            zIndex: null,
                            alignBottom: true,
                            boxClass: "gmapAdBox-wrapper",
                            enableEventPropagation: true,
                            closeBoxMargin: "0px 0px -8px 0px",
                            closeBoxURL: path + "/assets/img/close-btn.png",
                            gmapAdBoxClearance: new google.maps.Size(1, 1)
                        };

                        if( lastgmapAdBox != undefined ){
                            lastgmapAdBox.close();
                        }
                        //console.log(gmapAdBoxOptions);
                        newMarkers[i].gmapAdBox = new gmapAdBox(gmapAdBoxOptions);
                        newMarkers[i].gmapAdBox.open(map, _this);
                        lastgmapAdBox = newMarkers[i].gmapAdBox;

                        setTimeout(function(){
                            //$("div#"+ id +".item.gmapAdBox").parent().addClass("show");
                            $(".item.gmapAdBox[data-id="+ id +"]").parent().addClass("show");
                        }, 10);

                        google.maps.event.addListener(newMarkers[i].gmapAdBox,'closeclick',function(){
                            $(lastClickedMarker).removeClass("active");
                        });
                    },
                    error : function () {
                        console.log("error");
                    }
                });
            }

            // Geocoder callback ---------------------------------------------------------------------------------------

            function geocodeCallback(markerContent) {
                return function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        marker = new RichMarker({
                            position: results[0].geometry.location,
                            map: map,
                            draggable: false,
                            content: markerContent,
                            flat: true
                        });
                        newMarkers.push(marker);
                        renderResults();
                        if ( mapAutoZoom == 1 ){
                            var bounds  = new google.maps.LatLngBounds();
                            for (var i = 0; i < newMarkers.length; i++ ) {
                                bounds.extend(newMarkers[i].getPosition());
                            }
                            map.fitBounds(bounds);
                        }
                        google.maps.event.addListener(marker, 'click', (function(marker, i) {
                            return function() {
                                if( markerTarget == "sidebar"){
                                    openSidebarDetail( $(this.content.firstChild).attr("data-id") );
                                }
                                else if( markerTarget == "gmapAdBox" ){
                                    opengmapAdBox( $(this.content.firstChild).attr("data-id"), this, 0 );
                                }
                                else if( markerTarget == "modal" ){
                                    openModal($(this.content.firstChild).attr("data-id"), "modal_item.php");
                                }

                            }
                        })(marker, i));
                    } else {
                        console.log("Geocode failed " + status);
                    }
                }
            }

            function openSidebarDetail(id){
                $.ajax({
                    url: ajaxurl+"?action=sidebar_detail",
                    data: { id: id },
                    method: "POST",
                    success: function(results){
                        $(".sidebar-wrapper").html(results);
                        $(".results-wrapper").removeClass("loading");
                        initializeOwl();
                        ratingPassive(".sidebar-wrapper .sidebar-content");
                        initializeFitVids();
                        socialShare();
                        initializeReadMore();
                        $(".sidebar-wrapper .back").on("click", function(){
                            $(".results-wrapper").removeClass("show-detail");
                            $(lastClickedMarker).removeClass("active");
                        });
                        $(document).keyup(function(e) {
                            switch(e.which) {
                                case 27: // ESC
                                    $(".sidebar-wrapper .back").trigger('click');
                                    break;
                            }
                        });
                        $(".results-wrapper").addClass("show-detail");
                    },
                    error : function (e) {
                        console.log("error " + e);
                    }
                });
            }

            // Highlight result in sidebar on marker hover -------------------------------------------------------------

            $(".marker").live("mouseenter", function(){
                var id = $(this).attr("data-id");
                $(".results-wrapper .results-content .result-item[data-id="+ id +"] a" ).addClass("hover-state");
            }).live("mouseleave", function(){
                var id = $(this).attr("data-id");
                $(".results-wrapper .results-content .result-item[data-id="+ id +"] a" ).removeClass("hover-state");
            });

            $(".marker").live("click", function(){
                var id = $(this).attr("data-id");
                $(lastClickedMarker).removeClass("active");
                $(this).addClass("active");
                lastClickedMarker = $(this);
            });

            // Marker clusters -----------------------------------------------------------------------------------------

            var clusterStyles = [
                {
                    url: path+'assets/img/cluster.png',
                    height: 36,
                    width: 36
                }
            ];

            markerCluster = new MarkerClusterer(map, newMarkers, { styles: clusterStyles, maxZoom: 16, ignoreHidden: true });

            // Show results in sidebar after map is moved --------------------------------------------------------------

            google.maps.event.addListener(map, 'idle', function() {
                renderResults();
            });

            renderResults();

            // Results in the sidebar ----------------------------------------------------------------------------------

            function renderResults(){
                resultsArray = [];
                visibleMarkersId = [];
                visibleMarkersOnMap = [];

                for (var i = 0; i < newMarkers.length; i++) {
                    if ( map.getBounds().contains(newMarkers[i].getPosition()) ){
                        visibleMarkersOnMap.push(newMarkers[i]);
                        visibleMarkersId.push( $(newMarkers[i].content.firstChild).attr("data-id") );
                        newMarkers[i].setVisible(true);
                    }
                    else {
                        newMarkers[i].setVisible(false);
                    }
                }
                markerCluster.repaint();

                // Ajax load data for sidebar results after markers are placed

                /*if( $(".hero-section").hasClass("sidebar-grid") ){
                 var sidebarUrl = ajaxurl+"?action=sidebar_results_grid";
                 }
                 else {
                 sidebarUrl = ajaxurl+"?action=sidebar_results";
                 }

                 $.ajax({
                 url: sidebarUrl,
                 method: "POST",
                 data: { markers: visibleMarkersId },
                 success: function(results){
                 resultsArray.push(results); // push the results from php into array
                 $(".results-wrapper .results-content").html(results); // render the new php data into html element
                 $(".results-wrapper .section-title h2 .results-number").html(visibleMarkersId.length); // show the number of results
                 ratingPassive(".results-wrapper .results"); // render rating stars

                 // Hover on the result in sidebar will highlight the marker

                 $(".result-item").on("mouseenter", function(){
                 $(".map .marker[data-id="+ $(this).attr("data-id") +"]").addClass("hover-state");
                 }).on("mouseleave", function(){
                 $(".map .marker[data-id="+ $(this).attr("data-id") +"]").removeClass("hover-state");
                 });

                 trackpadScroll("recalculate");

                 // Show detailed information in sidebar

                 $(".result-item, .results-content .item").children("a").on("click", function(e){
                 if( sidebarResultTarget == "sidebar" ){
                 e.preventDefault();
                 openSidebarDetail( $(this).parent().attr("data-id") );

                 }
                 else if( sidebarResultTarget == "modal" ){
                 e.preventDefault();
                 openModal( $(this).parent().attr("data-id"), "modal_item.php" );
                 }

                 $(lastClickedMarker).removeClass("active");

                 $(".map .marker[data-id="+ $(this).parent().attr("data-id") +"]").addClass("active");
                 lastClickedMarker = $(".map .marker[data-id="+ $(this).parent().attr("data-id") +"]");
                 });

                 },
                 error : function (e) {
                 console.log(e);
                 }
                 });*/

            }
        }

        /*
         $("[data-ajax-live='location']").on("changed.bs.select", function (e) {
         ajaxAction( $(this), "location" );
         });

         $("[data-ajax-live='string']").on("changed.bs.select", function (e) {
         ajaxAction( $(this), "string" );
         });
         */

        $("[data-ajax-response='map']").on("click", function(e){
            e.preventDefault();
            var dataFile = ajaxurl+"?action=getlocHomemap";
            searchClicked = 1;
            if( $(this).attr("data-ajax-auto-zoom") == 1 ){
                mapAutoZoom = 1;
            }
            var form = $(this).closest("form");
            var ajaxData = form.serialize();
            markerCluster.clearMarkers();
            loadData(dataFile, ajaxData);
        });

        function loadData(url, ajaxData){
            $.ajax({
                url: url,
                dataType: "json",
                method: "GET",
                data: ajaxData,
                cache: false,
                success: function(results){
                    if(results!=0){
                        for( var i=0; i <newMarkers.length; i++ ){
                            newMarkers[i].setMap(null);
                        }
                        allMarkers = results;
                        placeMarkers(results);
                    }
                },
                error : function (e) {
                    console.log(e);
                }
            });
        }

        // Geo Location ------------------------------------------------------------------------------------------------

        function success(position) {
            var center = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            map.panTo(center);
            $('#map').removeClass('fade-map');
        }

        // Geo Location on button click --------------------------------------------------------------------------------

        $(".geo-location").on("click", function() {
            if (navigator.geolocation) {
                $('#map').addClass('fade-map');
                navigator.geolocation.getCurrentPosition(success);
            } else {
                console.log('Geo Location is not supported');
            }
        });

        // Automatic Geo Location

        if( automaticGeoLocation == true ){
            navigator.geolocation.getCurrentPosition(success);
        }

        // Autocomplete

        autoComplete(map);

    }
    else {
        //console.log("No map element");
    }

}

function reloadMap(){
    google.maps.event.trigger(map, 'resize');
}

//CURRENT LOCATION
function currentLocation(){
    infoWindow = new google.maps.InfoWindow;
    // Try HTML5 geolocation.
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            _latitude = position.coords.latitude;
            _longitude = position.coords.longitude;
            mapCenter = new google.maps.LatLng(_latitude, _longitude);
            drawMap(mapCenter);
            $('#latitude').val(_latitude);
            $('#longitude').val(_latitude);

        });
    } else {
        // Browser doesn't support Geolocation
        console.log("Browser doesn't support Geolocation");
    }
}
// Simple map ----------------------------------------------------------------------------------------------------------

function simpleMap(_latitude, _longitude, element, markerDrag, place) {

    if (!markerDrag) {
        markerDrag = false;
    }
    var mapCenter, geocoder, geoOptions;

    if (place) {
        geocoder = new google.maps.Geocoder();
        geoOptions = {
            address: place
        };
        geocoder.geocode(geoOptions, getCenterFromAddress());

        function getCenterFromAddress() {
            return function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    mapCenter = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());
                    drawMap(mapCenter);
                } else {
                    console.log("Geocode failed");
                    console.log(status);
                }
            };
        }
    }
    else {
        mapCenter = new google.maps.LatLng(_latitude, _longitude);
        drawMap(mapCenter);
    }

    function drawMap(mapCenter) {
        var mapOptions = {
            zoom: 14,
            center: mapCenter,
            disableDefaultUI: true,
            scrollwheel: true,
            styles: [
                {
                    "featureType": "all",
                    "elementType": "labels.icon",
                    "stylers": [{"visibility": "off"}]
                }, {
                    "featureType": "landscape",
                    "stylers": [{"saturation": -100}, {"lightness": 60}]
                }, {
                    "featureType": "road.local",
                    "stylers": [{"saturation": -100}, {"lightness": 40}, {"visibility": "on"}]
                }, {
                    "featureType": "transit",
                    "stylers": [{"saturation": -100}, {"visibility": "simplified"}]
                }, {"featureType": "administrative.province", "stylers": [{"visibility": "off"}]}, {
                    "featureType": "water",
                    "stylers": [{"visibility": "on"}, {"lightness": 30}]
                }, {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [{"color": color}, {"lightness": 40}]
                }, {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [{"visibility": "off"}]
                }, {
                    "featureType": "poi.park",
                    "elementType": "geometry.fill",
                    "stylers": [{"color": color}, {"lightness": 60}, {"saturation": -40}]
                }, {}]
        };
        var mapElement = document.getElementById(element);
        var map = new google.maps.Map(mapElement, mapOptions);
        var marker = new RichMarker({
            position: mapCenter,
            map: map,
            draggable: markerDrag,
            content: "<img src=" + path + "/assets/img/marker.png>",
            flat: true
        });
        google.maps.event.addListener(marker, "dragend", function () {
            var latitude = this.position.lat();
            var longitude = this.position.lng();
            $('#latitude').val(latitude);
            $('#longitude').val(longitude);
            getcityStateOnDrag(latitude,longitude);
        });
        autoComplete(map, marker);
    }

    function getcityStateOnDrag(latitude,longitude){
        $.getJSON("https://maps.googleapis.com/maps/api/geocode/json?latlng="+latitude+","+longitude, function(data) {

            jsondt = data.results;
            //store the most specific address for easy access
            var a = jsondt[0].address_components;
            var city = null,
                adminal2 = null,
                state = null,
                country = null,
                address = null;
            for(i = 0; i < a.length; ++i)
            {
                var t = a[i].types;

                if(compIsType(t, 'locality')){
                    city = a[i].long_name; //store the city
                    $('#locality').val(city);
                }

                if(compIsType(t, 'administrative_area_level_2')){
                    adminal2 = a[i].long_name; //store the state
                    $('#administrative_area_level_2').val(adminal2);
                }
                if(compIsType(t, 'administrative_area_level_1')){
                    state = a[i].long_name; //store the state
                    $('#administrative_area_level_1').val(state);
                }

                if(compIsType(t, 'country')){
                    country = a[i].long_name; //store the state
                    $('#country-input').val(country);
                }

                if(adminal2 != null && state != null && country != null){
                    address = adminal2+", "+state+", "+country; //store the state
                    $('#address-autocomplete').val(address);
                }
            }

            function compIsType(t, s) {
                for(z = 0; z < t.length; ++z)
                    if(t[z] == s)
                        return true;

                return false;
            }
        });
    }
}

//Autocomplete ---------------------------------------------------------------------------------------------------------

function autoComplete(map, marker) {
    if ($("#address-autocomplete").length) {
        if (!map) {
            map = new google.maps.Map(document.getElementById("address-autocomplete"));
        }
        var input = document.getElementById('address-autocomplete');
        if(getCity && getCountry!='all') {
            var options = {
                types: ['(cities)'],
                componentRestrictions: {country: getCountry}
            };
        }else if(getCountry!='all'){
            var options = {
                componentRestrictions: {country: getCountry}
            };
        }
        else{
            var options = {};
        }
        var autocomplete = new google.maps.places.Autocomplete(input,options);
        autocomplete.bindTo('bounds', map);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            $('#latitude').val(place.geometry.location.lat());
            $('#longitude').val(place.geometry.location.lng());
            if (!place.geometry) {
                return;
            }
            map.setCenter(place.geometry.location);
            map.setZoom(14);

            if (marker) {
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
                $('#latitude').val(marker.getPosition().lat());
                $('#longitude').val(marker.getPosition().lng());
                fillInAddress();
            }
            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }
        });



        function success(position) {
            map.setCenter(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));

            $('#latitude').val(position.coords.latitude);
            $('#longitude').val(position.coords.longitude);
            getcityStateOnDrag(position.coords.latitude,position.coords.longitude);
        }

        $(".geo-location").on("click", function () {
            if (navigator.geolocation) {
                $('#' + element).addClass('fade-map');
                navigator.geolocation.getCurrentPosition(success);
            } else {
                console.log('Geo Location is not supported');
            }
        });


        var componentForm = {
            locality: 'long_name',
            administrative_area_level_2: 'long_name',
            administrative_area_level_1: 'long_name',
            country: 'long_name'
        };

        function fillInAddress() {
            // Get the place details from the autocomplete object.
            var place = autocomplete.getPlace();

            for (var component in componentForm) {
                document.getElementById(component).value = '';
                document.getElementById(component).disabled = false;
            }

            // Get each component of the address from the place details
            // and fill the corresponding field on the form.
            for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];
                if (componentForm[addressType]) {
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
                }
            }
        }
    }
}