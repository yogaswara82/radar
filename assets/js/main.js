    
// ----------------------------- CUR POS MAP -----------------------------------

var ID;
//var temp="";
var wet=false;    
    //var osmUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
    //var osmAttrib = 'Map data © <a href="http://osm.org/copyright">OpenStreetMap</a> contributors';
    //var osm = new L.TileLayer(osmUrl, {
    //    attribution: osmAttrib,
    //    detectRetina: true
    //});
    // please replace this with your own mapbox token!
    var token = 'pk.eyJ1IjoieW9nYXN3YXJhODIiLCJhIjoiY2s5aXF6Z2U5MDVjaTNndnkwOGhlajh0YiJ9.8B8Ljfp2nMoY0cpD-2DoEg';
    var mapboxUrl = 'https://api.mapbox.com/styles/v1/mapbox/streets-v10/tiles/{z}/{x}/{y}@2x?access_token=' + token;

    var mapboxAttrib = 'Map data © <a href="http://osm.org/copyright">OpenStreetMap</a> contributors. Tiles from <a href="https://www.mapbox.com">Mapbox</a>. ';
    var mapbox = new L.TileLayer(mapboxUrl, {
      attribution: mapboxAttrib,
      tileSize: 512,
      zoomOffset: -1,
      maxNativeZoom:14,
      minNativeZoom:14
      
    });
  
    var baseMaps = {
        "Mapbox": mapbox,

    };

    var map = new L.Map('map', {
        layers: [mapbox],
        zoom: 5,
        center: {lat: -5.087470, lng: 117.670192},
        zoomControl: true,
        minZoom: 13,
        maxZoom: 17
    });

//     var allowZooms = [13,14,15,17];

//     map.setView = function(center, zoom, options) {
//     // tests if the requested zoom is allowed
//     if ((zoom) && (allowZooms.indexOf(zoom) === -1)) {
//         // this._zoom is an internal value used to reference the current zoom level
//         var ixCurZoom = allowZooms.indexOf(this._zoom);

//         // are we zooming in or out?
//         var dir = (zoom > this._zoom) ? 1 : -1;

//         // pick the previous/next zoom
//         if (allowZooms[ixCurZoom + dir]) {
//             zoom = allowZooms[ixCurZoom + dir];
//         } else {
//             // or abort the zoom if we're out of bounds
//             return this;
//         }
//     }

//     // call the parent method
//     return L.Map.prototype.setView.call(this, center, zoom, options);
// }

L.control.layers(baseMaps).addTo(map);
L.control.scale().addTo(map);

var curlat='';
var curlon='';
var marker = null;
var oe = function onLocationFound(e) {
    var options = {
        radius: 8,
        weight: 1,
            //opacity: 1,
            fillOpacity: 0.8,
            color: 'blue'
        };
        if (marker !== null) {
            map.removeLayer(marker);
        }
        marker = L.circleMarker(e.latlng, options).addTo(map);
        //L.circle(e.latlng, radius).addTo(map);
        console.log('location found');
        var pointXY = map.latLngToLayerPoint(e.latlng);
        console.log("Point in x,y space: " + pointXY);
        // convert to lat/lng space
        var pointlatlng = map.layerPointToLatLng(pointXY);
        // why doesn't this match e.latlng?
        console.log("Point in lat,lng space: " + pointlatlng);
        // check if location inside the feature

        curlat = e.latlng.lat;
        curlon = e.latlng.lng;
        if (!wet){
            map.setView([curlat, curlon], 13);
            updatePos();
            weather();
            wet=true;
        }


    }
    var successFunction = function (data) {
        /* do so  mething here */
        var locations = data;
        var latlon1 = new L.latLng(locations[0].lat, locations[0].lon);
        ID = locations[0].id;
        //console.log(latlon1);

        oe({latlng: latlon1});
    }
    //map.on('locationfound', onLocationFound);

//----------------------------------------- FUN TIMER -----------------------------------------------
function Timer(funct, delayMs, times)
{
  if(times==undefined)
  {
    times=-1;
}
if(delayMs==undefined)
{
    delayMs=10;
}
this.funct=funct;
var times=times;
var timesCount=0;
var ticks = (delayMs/10)|0;
var count=0;
Timer.instances.push(this);

this.tick = function()
{
    if(count>=ticks)
    {
      this.funct();
      count=0;
      if(times>-1)
      {
        timesCount++;
        if(timesCount>=times)
        {
          this.stop();
      }
  }
}
count++; 
};

this.stop=function()
{
    var index = Timer.instances.indexOf(this);
    Timer.instances.splice(index, 1);
};
}

Timer.instances=[];

Timer.ontick=function()
{
  for(var i in Timer.instances)
  {
    Timer.instances[i].tick();
}
};

window.setInterval(Timer.ontick, 10);

// var id = 2;
$(document).ready(function ()
{   


        var timer = new Timer(ajaxcall,2000,-1); // -1 untuk timer berkelanjutan, bisa diganti dg jumlah dilakukan
        //var timer = new Timer(cuaca,10000,-1);
        var timer = new Timer(updatePos, 16000,-1);
        var timer = new Timer(weather, 5000,-1);
        

        
    });



function ajaxcall()
{
    $.ajax
    ({
        url: 'database.php',
        success: function (data)
                    { //////////////////////////////////////

                        var locations = JSON.parse(data);
                        successFunction(locations);
                    },
                    error: function (req, err) {
                        console.log('my message' + err)
                    }
                });
}



function updatePos() {
    var finalObj = {
        "id" : ID,
        "lat" : curlat,
        "lon" : curlon
    }

    $.ajax({
        type: 'POST',
        url: 'http://localhost/GroundCtrl/updatePos.php',
        data: {json: JSON.stringify(finalObj)},
        dataType: 'json'
    });
    console.log('pos')
}


//----------------------------------------------------------------------------------------

//-------------------------------- TARGET LOCATION ---------------------------------------
var markers = [];
var targetlat = null;
var targetlon = null;

map.locate({watch: true, maxZoom: 16, enableHighAccuracy: true});
map.on("contextmenu", function (event) {
    console.log("user right-clicked on map coordinates: " + event.latlng.toString());
    if (markers.length > 0) {
        map.removeLayer(markers.pop());
    }
    var marker;
    marker = L.marker(event.latlng).addTo(map);
    markers.push(marker);

    var x = event.layerPoint.x;
    var y = event.layerPoint.y;
        //var pt = turf.point([-77, 44]);
        var pt = turf.point([x, y]);

        targetlat=event.latlng.lat;
        targetlon=event.latlng.lng;

        updateTarget(targetlat, targetlon);
        weather();

       // getBMKG(event.latlng.lat,event.latlng.lng,function (response) {
       //  console.log(response);
       //   });

       marker.on({
          click: function (e) {
            $("#ex").modal("show");
        }
    });

   });

function updateTarget(lat,lon) {
    var finalObj = {
        "id" : ID,
        "lat" : lat,
        "lon" : lon
    }

    $.ajax({
        type: 'POST',
        url: 'http://localhost/radar/target.php',
        data: {json: JSON.stringify(finalObj)},
        dataType: 'json'
    });

    
}

//----------------------------------------------------------------------------


//-------------------------- GET CUACA ---------------------------------------
function getWWO (callback){
    var url = 'http://localhost/radar/getData.php';

    $.getJSON(url, function (result) {
        //console.log(result);
        return callback(result);        
    });


};

function weather() {
    getWWO(function (response) {
        cuaca(response);
        console.log('Weather Updated');

    });
}
function cuaca(temp) {
    if (temp!=""){
     temp.data.cuaca.forEach(function (obj) {
        if (obj.id == ID) {
         var response = obj; 
         document.getElementById('temp').innerHTML=response.temp + ' °C';
         document.getElementById('windspeed').innerHTML=response.windspeed+' Km/h';
         document.getElementById('winddir').innerHTML=response.winddir;
         document.getElementById('humidity').innerHTML=response.humidity + '%';
         document.getElementById('wave').innerHTML=response.wave+' meter';
         document.getElementById('waves').innerHTML=response.sigWave+' meter';
         document.getElementById('waveperiod').innerHTML=response.waveperiod+' detik';
         document.getElementById('watertemp').innerHTML=response.watertemp+' °C';
         document.getElementById('desc').innerHTML=response.description;

     }

 });
     temp.data.target_cuaca.forEach(function (obj) {
        if (obj.id == ID) {
         var response = obj; 
         document.getElementById('temp1').innerHTML=response.temp + ' °C';
         document.getElementById('windspeed1').innerHTML=response.windspeed+' Km/h';
         document.getElementById('winddir1').innerHTML=response.winddir;
         document.getElementById('humidity1').innerHTML=response.humidity + '%';
         document.getElementById('wave1').innerHTML=response.wave+' meter';
         document.getElementById('waves1').innerHTML=response.sigWave+' meter';
         document.getElementById('waveperiod1').innerHTML=response.waveperiod+' detik';
         document.getElementById('watertemp1').innerHTML=response.watertemp+' °C';
         document.getElementById('desc1').innerHTML=response.description;

     }
 });
 }

}
//---------------------------------------------------------------------------



//-------------------------- TOMBOL OPTION ----------------------------------

L.easyButton( 'glyphicon glyphicon-map-marker', function(){
  map.setView([curlat, curlon], 15);
}).addTo(map);

L.easyButton( 'glyphicon glyphicon-cloud', function(){
  $('#mymodal').modal('show');
}).addTo(map);

L.easyButton('glyphicon glyphicon-road',function() {
    var x = distance(curlat,curlon,targetlat,targetlon);
    // console.log('Distance : ' + x);
    document.getElementById('jarak').value=x+' Km';
    $('#calcu').modal('show');
}).addTo(map);



//----------------------------- FUN JARAK & BBM ----------------------------
function calcu() {

    var x = distance(curlat,curlon,targetlat,targetlon);
    var speed = document.getElementById('kecepatan').value;
    var e = document.getElementById("single_select");
    var model = e.options[e.selectedIndex].value;
    var waktu = Number(Time(x,speed).toFixed(3));
    var bbm = Number(BBM(model, x, speed).toFixed(3));
    console.log(speed*1.852);
    console.log(x);
    document.getElementById('waktu').value = waktu + ' Menit / '+ 2*waktu + ' Menit untuk PP';
    document.getElementById('bbm').value = bbm +' Liter / '+ 2*bbm + ' Liter untuk PP';

};


function distance(lat1,lon1,lat2,lon2) {
    var R = 6371; // km (change this constant to get miles)
    var dLat = (lat2-lat1) * Math.PI / 180;
    var dLon = (lon2-lon1) * Math.PI / 180;
    var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.cos(lat1 * Math.PI / 180 ) * Math.cos(lat2 * Math.PI / 180 ) *
    Math.sin(dLon/2) * Math.sin(dLon/2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
    var d = R * c;
    return d;
}

function Time(dis,speed) {
    var waktu = (dis/(speed*1.852)) * 60;
    return waktu;
}
function BBM(model,dis,speed) {
    var bbm = model * dis / speed;
    console.log(bbm,"Liter");
    bbm = (bbm*0.3) + bbm;
    return bbm;
}

