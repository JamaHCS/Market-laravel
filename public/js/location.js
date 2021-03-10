const lat = document.getElementById("latitud");
const lon = document.getElementById("longitud");

if (lat.value == "") {
  var latCentral = 20.5887932;
  var longCentral = -100.38988810000001;

  var coordenadas = {
    lat: 20.5887932,
    lng: -100.38988810000001,
  };
} else {
  var latCentral = parseFloat(lat.value);
  var longCentral = parseFloat(lon.value);

  var coordenadas = {
    lat: parseFloat(lat.value),
    lng: parseFloat(lon.value),
  };
}

var map = null;
var marker = null;
var infowindow = null;

function buscarPosicion() {
  var calle = document.getElementById("calle").value;
  var noExterior = document.getElementById("noExterior").value;
  var noInterior = document.getElementById("noInterior").value;
  var colonia = document.getElementById("colonia").value;
  var localidad = document.getElementById("localidad").value;
  var referencia = document.getElementById("referencia").value;
  var codigoPostal = document.getElementById("codigoPostal").value;
  var estado = document.getElementById("idEstado");
  var estadoSeleccionado = estado.options[estado.selectedIndex].text;
  var municipio = document.getElementById("municipio").value;

  if (
    calle != "" ||
    colonia != "" ||
    localidad != "" ||
    referencia != "" ||
    codigoPostal != "" ||
    (estadoSeleccionado != "" && municipio != "")
  ) {
    var direccion =
      calle +
      "," +
      noExterior +
      "," +
      noInterior +
      ", " +
      localidad +
      "," +
      referencia +
      "," +
      codigoPostal +
      ", " +
      estadoSeleccionado +
      ", " +
      municipio;
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode(
      {
        address: direccion,
      },
      procesaResultado
    );
  }
}

function procesaResultado(results, status) {
  if (status == "OK") {
    map.setCenter(results[0].geometry.location);
    map.fitBounds(results[0].geometry.viewport);
    map.setZoom(17);
    if (marker) {
      marker.setMap(null);
      marker = null;
    }
    marker = createMarker(
      results[0].geometry.location,
      "<b>Coordenadas</b><br>" + results[0].geometry.location
    );
    var lat = results[0].geometry.location.lat();
    var lng = results[0].geometry.location.lng();
    $("#latitud").val(lat);
    $("#longitud").val(lng);
  } else {
    alert("No se pudo obtener la localizaci&oacute;n debido a: " + status);
  }
}

function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    zoom: 17,
    center: coordenadas,
    mapTypeId: "terrain",
  });

  // Pone el marcador inicial
  point = new google.maps.LatLng(latCentral, longCentral);
  marker = createMarker(
    point,
    "<b>Coordenadas</b><br>" + latCentral + "," + longCentral
  );

  google.maps.event.addListener(map, "click", function (event) {
    if (marker) {
      marker.setMap(null);
      marker = null;
    }
    var myLatLng = event.latLng;
    var lat = myLatLng.lat();
    var lng = myLatLng.lng();
    marker = createMarker(event.latLng, "<b>Coordenadas</b><br>" + myLatLng);
    //actualiza los datos en la forma
    $("#latitud").val(lat);
    $("#longitud").val(lng);
  });
}

function createMarker(latlng, html) {
  var contentString = html;
  var marker = new google.maps.Marker({
    position: latlng,
    map: map,
  });

  google.maps.event.addListener(marker, "click", function () {
    infowindow = new google.maps.InfoWindow({
      size: new google.maps.Size(150, 50),
    });
    infowindow.setContent(contentString);
    infowindow.open(map, marker);
  });

  google.maps.event.trigger(marker, "click");

  return marker;
}

//? Enviar data

const updatedLocation = document.getElementById("updated-location");
const relationInput = document.getElementById("relation_id");

const sendingDataLocation = async () => {
  let data = new FormData();
  data.append("relation_id", relationInput.value);
  data.append("latitude", lat.value);
  data.append("longitude", lon.value);
  data.append("_token", csrf.content);

  console.log(data, "okay data");

  let response = await sendingRequestLocation(data);
  console.log(response);

  if (response) {
    updateAnimationLocation();
  }
};

const sendingRequestLocation = async (data) => {
  try {
    let req = await fetch(`${URL_SITE}/api/v1/markets/location-config`, {
      method: "POST",
      body: data,
    }).then((response) => {
      console.log(response);
      updatedLocation.classList.add("show");
      return response;
    });

    console.log(req);
    let json = await req.json();

    return json;
  } catch (err) {
    console.log(err);
    throw Error(err);
  }
};

const updateAnimationLocation = () => {
  setTimeout(() => {
    updatedLocation.classList.remove("show");
  }, 4000);
};
