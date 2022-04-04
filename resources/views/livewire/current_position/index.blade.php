<div wire:ignore.self>


<div class="row p-4 pt-5">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title"><i class="fas fa-user-plus "></i> Actualiser votre position
          </h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('conducteur.current.position') }}" method="post">
          @csrf
          <div class="card-body mapform">
            <div style="padding-left:32px" ><div id="map" style="height:400px; width: 400px; border-radius: 20px" class="my-3"></div></div>
            <div class="form-group">
              <label for="exampleInputEmail1">Coordonnées du lieu de départ</label>
              <div class="d-flex">
                <div class="form-group flex-grow-1 mr-2">
                  <input type="text" class="form-control" placeholder="lat" name="lat" id="lat">
                </div>
                <div class="form-group flex-grow-1">
                  <input type="text" class="form-control" placeholder="lng" name="lng" id="lng">
                </div>
              </div>
            </div>
            <script>
              let map;
            function initMap() {

                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 8,
                    center: { lat: parseFloat(@json($lat_conducteur)), lng: parseFloat(@json($lng_conducteur)) },
                });
  
                const uluru = { lat: parseFloat(@json($lat_conducteur)), lng: parseFloat(@json($lng_conducteur)) };
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
  
                }
            </script>
            <script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"
              type="text/javascript"></script>
            <script
              src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCF0C7B4g3OVgquGj0VLyGVoShNDkScf2E&callback=initMap&v=weekly"
              async></script>
          </div>
  
          {{-- <input type="submit" class="btn btn-primary"> --}}
          <div class="card-footer">
            <input type="submit" class="btn btn-primary">
          </div>
        </form>
      </div>
      <div class="col-md-3"></div>
      <!-- /.card -->
  
    </div>
  </div>
  
  
</div>
@include("livewire.current_position.alert")
  
  
  
  
   