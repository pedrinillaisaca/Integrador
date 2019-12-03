
	let lon=document.getElementById("lon").value;
	let lat=document.getElementById("lat").value;
	console.log("entrando en recarga")
	//var lon=document.getElementById("lon").value;
	//var lat=document.getElementById("lat").value;

	var map = L.map('map');

	L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
	}).addTo(map);

	var control = L.Routing.control(L.extend(window.lrmConfig, {
		waypoints: [

			
			L.latLng(-2.893197, -79.010811),//ubicacion inicio 
			L.latLng(lon, lat)//ubicacion destino
		],
		geocoder: L.Control.Geocoder.nominatim(),
		routeWhileDragging: true,
		reverseWaypoints: true,
		showAlternatives: true,
		altLineOptions: {
			styles: [
				{ color: 'black', opacity: 0.15, weight: 9 },
				{ color: 'white', opacity: 0.8, weight: 6 },
				{ color: 'blue', opacity: 0.5, weight: 2 }
			]
		}
	})).addTo(map);

	L.Routing.errorControl(control).addTo(map);








/**
 *

var map = L.map('map');
L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
	attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

var control = L.Routing.control(L.extend(window.lrmConfig, {
	waypoints: [


		L.latLng(-2.806323,-78.986095),//ubicacion inicio
		L.latLng(-2.886691,-78.988985)//ubicacion destino
	],
	geocoder: L.Control.Geocoder.nominatim(),
	routeWhileDragging: true,
	reverseWaypoints: true,
	showAlternatives: true,
	altLineOptions: {
		styles: [
			{color: 'black', opacity: 0.15, weight: 9},
			{color: 'white', opacity: 0.8, weight: 6},
			{color: 'blue', opacity: 0.5, weight: 2}
		]
	}
})).addTo(map);

L.Routing.errorControl(control).addTo(map);*/