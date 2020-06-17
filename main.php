<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>A simple map</title>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-theme.min.css">
    <link rel="stylesheet" href="leaflet/leaflet.css" />
    <link rel="stylesheet" href="assets/css/leaflet-gps.css" />
    <link rel="stylesheet" href="assets/css/easy-button.css" />
    <link rel="stylesheet" href="assets/css/L.Control.Locate.min.css" />
    <link href="assets/css/L.Control.Locate.mapbox.css" rel="stylesheet"/>
    <link href="assets/css/L.Control.Locate.css" rel="stylesheet"/>
    <link type="text/css" rel="stylesheet" href="style.css" />
    <link type="text/css" rel="stylesheet" href="mapbox.css" />

    <style>
        body {
            margin: 0;
            padding: 0;
        }
        #map {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 100%;
        }
        .state-remove-markers,
        .state-add-markers{
            transition-duration: .5s;
            transform: scaleY(0);
            position: absolute;
            display: block;
            top: 0;
            width: 100%;}

            .state-remove-markers{
                transform-origin: 50% 0; }
                .state-add-markers{
                    transform-origin: 50% 100%; }

                    .state-remove-markers.remove-markers-active{
                        transform: scaleY(1); }

                        .state-add-markers.add-markers-active{
                            transform: scaleY(1); }
            
                        </style>
                    </head>

                    <body>

                        <div id="map"></div>
                        <script src="assets/js/mapbox.js"></script>
                        <script src="assets/js/event.js"></script>
                        <script src="assets/js/storage.js"></script>
                        <script src="assets/js/map.js"></script>
                        <script src="assets/js/run.js"></script>
                        <script src="leaflet/leaflet.js"></script>
                        <script src="leaflet/leaflet-src.js"></script>
                        <script src="assets/js/easy-button.js"></script>
                        <script src="assets/js/L.Control.Locate.js" ></script>
                        <script src="assets/js/turf.min.js"></script>
                        <script src="assets/js/leaflet-pip.js"></script>
                        <script src="assets/js/leaflet-knn.min.js"></script>
                        <script src="assets/js/leaflet-gps.js"></script>
                        <script src="assets/js/jquery.min.js"></script>
                        <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->
                        <script src="assets/js/bootstrap.min.js"></script>
                       <!-- <script type="text/javascript" src="assets/js/GIBSLayer.js"></script>
                        <script src="assets/js/GIBSMetadata.js"></script> -->
                        <script type="text/javascript" src="assets/js/leaflet-hash.js"></script>

                        <script type="text/javascript" src="assets/js/main.js?newversion">

                        </script>
                        <div id="mymodal" class="modal fade" tabindex="-1" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Informasi Cuaca</h4>
                            </div>
                            <div class="modal-body">
                                <table>
                                    <tr>
                                        <td>
                                            <p><b>Temperatur</b></p>
                                        </td>
                                        <td>
                                            :
                                        </td>
                                        <td>
                                            <p id="temp"></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p><b>Kecepatan Angin</b></p>
                                        </td>
                                        <td>
                                            :
                                        </td>
                                        <td>
                                            <p id="windspeed"></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p><b>Arah Angin (16 Arah Kompas)</b></p>
                                        </td>
                                        <td>
                                            :
                                        </td>
                                        <td>
                                            <p id="winddir"></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p><b>Kelembaban</b></p>
                                        </td>
                                        <td>
                                            :
                                        </td>
                                        <td>
                                            <p id="humidity"></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p><b>Tinggi Gelombang</b></p>
                                        </td>
                                        <td>
                                            :
                                        </td>
                                        <td>
                                            <p id="wave"></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p><b>Tinggi Gelombang Signifikan</b></p>
                                        </td>
                                        <td>
                                            :
                                        </td>
                                        <td>
                                            <p id="waves"></p>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>
                                            <p><b>Periode Gelombang</b></p>
                                        </td>
                                        <td>
                                            :
                                        </td>
                                        <td>
                                            <p id="waveperiod"></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p><b>Temperatur Air</b></p>
                                        </td>
                                        <td>
                                            :
                                        </td>
                                        <td>
                                            <p id="watertemp"></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p><b>Cuaca</b></p>
                                        </td>
                                        <td>
                                            :
                                        </td>
                                        <td>
                                            <p id="desc"></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p><b>Potensi Persebaran Ikan</b></p>
                                        </td>
                                        <td>
                                            :
                                        </td>
                                        <td>
                                            <p id="kloro"></p>
                                        </td>
                                    </tr>       
                                </table>
                                

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>

                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <iframe id="dummy">
                </iframe>
                
                <div id="ex" class="modal fade" tabindex="-1" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Informasi Cuaca</h4>
                    </div>
                    <div class="modal-body">
                        <table>
                            <tr>
                                <td>
                                    <p><b>Temperatur</b></p>
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <p id="temp1"></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p><b>Kecepatan Angin</b></p>
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <p id="windspeed1"></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p><b>Arah Angin (16 Arah Kompas)</b></p>
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <p id="winddir1"></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p><b>Kelembaban</b></p>
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <p id="humidity1"></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p><b>Tinggi Gelombang</b></p>
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <p id="wave1"></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p><b>Tinggi Gelombang Signifikan</b></p>
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <p id="waves1"></p>
                                </td>
                            </tr> 
                            <tr>
                                <td>
                                    <p><b>Periode Gelombang</b></p>
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <p id="waveperiod1"></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p><b>Temperatur Air</b></p>
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <p id="watertemp1"></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p><b>Cuaca</b></p>
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <p id="desc1"></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p><b>Klorofil</b></p>
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    <p id="kloro"></p>
                                </td>
                            </tr>         
                        </table>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

        <div id="calcu" class="modal fade" tabindex="-1" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Perkiraan Penggunaan BBM</h4>
            </div>
            <div class="modal-body">
               <div class="form-group">
                 <div class="col-md-12">
                    Pilih Mesin :<select id="single_select" class="form-control" name="mesin" required autofocus>

                        <option value="5.10">Mercury 4 stroke (15) TK 5500 RPM</option>
                        <option value="3.8">Mercury 4 stroke (10) TK 5500 RPM</option>
                        <option value="26.1">Mercury OptiMax 2 stroke (75) TK 5500 RPM</option>
                        <option value="5.10">Envinrude 4 stroke (15) TK 5500 RPM</option>
                        <option value="3.8">Envinrude 4 stroke (10) TK 5500 RPM</option>
                        <option value="7.95">Envinrude Etec 2 stroke (25) TK 5500 RPM</option>
                        <option value="15.3">Envinrude Etec 2 stroke (50) TK 5500 RPM</option>
                        <option value="4.90" >Honda 4 stroke (15) TK 5500 RPM</option>
                        <option value="3.80">Honda 4 stroke (10) TK 5500 RPM</option>
                        <option value="12.1">Honda BF40 4 stroke (40) TK 5500 RPM</option>
                        <option value="4.90">Suzuki 4 stroke (15) TK 5300 RPM</option>
                        <option value="3.8">Suzuki 4 stroke (10) TK 5700 RPM</option>
                        <option value="8.40">Suzuki DF V-twin 4 stroke (25) TK 5500 RPM</option>
                        <option value="5.413">Yamaha 4 stroke (15) TK 5500 RPM</option>
                        <option value="3.596">Yamaha 4 stroke (10) TK 5500 RPM</option>
                        <option value="22.2">Yamaha 70 HP 2 stroke (70) TK 5500 RPM</option>
                    </select>
                </div>
                <div class="form-group">
                 <div class="col-md-12">
                    Jarak:
                    <input type="text" disabled  id="jarak" class="form-control" required autofocus>
                </div>
                <div class="form-group">
                 <div class="col-md-12">
                    Kecepatan :
                    <input type="number" min="1" max="100" placeholder="Knot" name="kecepatan" id="kecepatan" class="form-control" required autofocus>
                </div>

                <div class="form-group">
                 <div class="col-md-12">
                    Waktu :
                    <input type="text"   disabled id="waktu" class="form-control" required autofocus>
                </div>

                <div class="form-group">
                 <div class="col-md-12">
                    BBM :
                    <input type="text"   disabled id="bbm" class="form-control" required autofocus>
                </div>


            </div>
            <div class="modal-footer">
                <br><br>
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button onclick="calcu();" type="button" class="btn btn-success" >Hitung</button>    
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>



</body>

</html>