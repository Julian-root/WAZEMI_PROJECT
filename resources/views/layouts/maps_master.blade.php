<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ChriDarek</title>

    <link rel="stylesheet" href="{{ asset('css/appmaps.css') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: sans-serif;
        }
    </style>
    <script src="{{ asset('js/appmap.js') }}"></script>



</head>

<body>


    <nav class="navbar navbar-expand-md navbar-light absolute py-2 mb-4">
        <div class="container">
            <div class=" navbar-collapse " id="navbarCollapse">
                <ul class="navbar-nav mx-auto">
                    <a href="" class="navbar-brand">
                        <h2 class="d-inline align-middle"><strong>Google Maps</strong></h2>
                    </a>
                </ul>

            </div>
        </div>
    </nav>
    <div class="container">
        <div class="content">
            <form action="{{ route('client.commande.store') }}" method="post">
                @csrf
                <div class="mapform">
                    <div class="row">
                        <div class="col-5">
                            <input type="text" class="form-control" placeholder="lat" name="lat" id="lat">
                        </div>
                        <div class="col-5">
                            <input type="text" class="form-control" placeholder="lng" name="lng" id="lng">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <input type="text" class="form-control" placeholder="lat2" name="lat2" id="lat2">
                        </div>
                        <div class="col-5">
                            <input type="text" class="form-control" placeholder="lng2" name="lng2" id="lng2">
                        </div>
                    </div>

                    <div class="wrapper"></div>


                    <div id="map" style="height:400px; width: 800px;" class="my-3"></div>

                    <script>
                        let map;
                    function initMap() {

                        const map = new google.maps.Map(document.getElementById("map"), {
                            zoom: 8,
                            center: { lat: 9.3220475, lng: 2.313137999999981 },
                        });

                        const uluru = { lat: 9.3220475, lng: 2.313137999999981 };
                        let marker = new google.maps.Marker({
                            position: uluru,
                            map: map,
                            draggable: true
                        });

                        google.maps.event.addListener(marker,'position_changed',
                            function (){
                                let lat = marker.position.lat()
                                let lng = marker.position.lng()
                                $('#lat').val(lat)
                                $('#lng').val(lng)
                            })

                        google.maps.event.addListener(map,'click',
                        function (event){
                            pos = event.latLng
                            marker.setPosition(pos)
                        })

                        const benin = { lat: 9.3520475, lng: 2.353137999999981 };
                        let position = new google.maps.Marker({
                            position: benin,
                            map: map,
                            draggable: true
                        });

                        google.maps.event.addListener(position,'position_changed',
                        function (){
                            let lat2 = position.position.lat()
                            let lng2 = position.position.lng()
                            $('#lat2').val(lat2)
                            $('#lng2').val(lng2)
                        })

                        google.maps.event.addListener(map,'click',
                        function (event){
                            pos = event.latLng
                            position.setPosition(pos)
                        })
                        }
                    </script>
                    <script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"
                        type="text/javascript"></script>
                    <script
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCF0C7B4g3OVgquGj0VLyGVoShNDkScf2E&callback=initMap&v=weekly"
                        async></script>
                </div>

                <input type="submit" class="btn btn-primary">
            </form>


        </div>

    </div>




    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>