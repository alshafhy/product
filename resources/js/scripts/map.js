// for copy
var userText = $('#share_link');
var btnCopy = $('#btn-copy'),
  isRtl = $('html').attr('data-textdirection') === 'rtl';

// copy text on click
btnCopy.on('click', function () {
//   userText.select();
//   document.execCommand('copy');
    copyShareLink()

    toastr['success'](
        '',
        'تم نسخ الرابط بنجاح',
        {
        closeButton: true,
        tapToDismiss: false,
        rtl: isRtl
        }
    );

});
/* end copy****** */

var map;
var x = 24.4669 ;
var y = 39.6110  ;

if(!x){
    x=24.7136;
}
if(!y){
    y=46.6753;
}

var markers = [];
var postionLatLong;
function initMap() {
    var zoom = 15 ;
    var str_xaxis = $("#x_axis").val();
    var str_yaxis = $("#y_axis").val();
    $("#utm_easting").on("input",function () {
        console.dir("utm_easting");
        var utm_northing = $('#utm_northing').val();
        var utm_easting = $('#utm_easting').val();
        if (utm_easting !== "" && utm_northing !==""){
            $.getJSON("/api/coord/utm/"+utm_easting+"/"+utm_northing,function(result){//https://api.getthedata.com/bng2latlong/550716/2704567

                deleteMarkers();
                var lat = result.latitude;
                var lng = result.longitude;
                $('#x_axis').val(lat);
                $('#y_axis').val(lng);
                addMarker({ lat: lat, lng: lng });

                $('#share_link').val("http://maps.google.com/maps?q="+lat+","+lng+"&z=14&ll="+lat+","+lng);

            });
        }
    });
    $("#utm_northing").on("input",function () {
        console.dir("utm_northing");
        var utm_northing = $('#utm_northing').val();
        var utm_easting = $('#utm_easting').val();
        if (utm_easting !== "" && utm_northing !==""){
            $.getJSON("/api/coord/utm/"+utm_easting+"/"+utm_northing,function(result){
                deleteMarkers();
                var lat = result.latitude;
                var lng = result.longitude;
                $('#x_axis').val(lat);
                $('#y_axis').val(lng);
                addMarker({ lat: lat, lng: lng });

                $('#share_link').val("http://maps.google.com/maps?q="+lat+","+lng+"&z=14&ll="+lat+","+lng);
            });
        }
    });
    if(str_xaxis && str_yaxis ){
       x = Number(str_xaxis);
       y = Number(str_yaxis);  
       zoom = 16 ;
       $('#share_link').val("http://maps.google.com/maps?q="+x+","+y+"&z=14&ll="+x+","+y);
    }
    // $('#share_link').val("http://maps.google.com/maps?q="+x+","+y+"+(My+Point)&z=14&ll="+x+","+y);
    
    var postionLatLong = {lat: x, lng: y};
    map = new google.maps.Map(document.getElementById('map'), {
    zoom: zoom,
            center: {lat: x, lng: y},
            mapTypeId: 'terrain'
    });
    map.addListener('click', function (event) {
        deleteMarkers();
        addMarker(event.latLng);
        postionLatLong = event.latLng;
        var lat = postionLatLong.lat();
        var lng = postionLatLong.lng();
        postionLatLong = event.latLng;
        $('#x_axis').val(lat);
        $('#y_axis').val(lng);
        $('#share_link').val("http://maps.google.com/maps?q="+lat+","+lng+"&z=14&ll="+lat+","+lng);
    });
    if(str_xaxis && str_yaxis){
      addMarker(postionLatLong);  
    }
    
}

function addMarker(location) {
    var marker = new google.maps.Marker({
        position: location,
        map: map
    });
    markers.push(marker);
}
function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
}
function copyShareLink() {
    /* Get the text field */
    var copyText = document.getElementById("share_link");

    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */
    try {
        navigator.clipboard.writeText(copyText.value).then(function () {
        }, function () {
            document.execCommand('copy');
        });
    }catch (e) {
        document.execCommand('copy');
    }
    /* Copy the text inside the text field */
    //navigator.clipboard.writeText(copyText.value);

    /* Alert the copied text */
    $('#share_link_div').attr('title','copied');
    //alert("Copied the text: " + copyText.value);
}
// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
    setMapOnAll(null);
}

// Shows any markers currently in the array.
function showMarkers() {
    setMapOnAll(map);
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
    clearMarkers();
    markers = [];
}
