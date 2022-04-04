<div class="row p-4 pt-5">
  <div class="col-md-3"></div>
  <div class="col-md-6">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user-plus "></i> Formulaire de reservation d'une course
        </h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->

      <form role="form" wire:submit.prevent="addCommand()">
          @csrf
          <div class="card-body mapform">
            <div style="padding-left:32px">
              <div wire:ignore id="map" style="height:400px; width: 200px; border-radius: 20px; margin-right: 150px;"></div>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Coordonnées du lieu de départ</label>
              <div class="d-flex">
                <div class="form-group flex-grow-1 mr-2">
                  <input wire:ignore type="text" wire:model="newCommand.lat" placeholder="lat" name="lat" id="lat"
                    class="form-control">
                </div>
                <div class="form-group flex-grow-1">
                  <input type="text" wire:model="newCommand.lng" placeholder="lng" name="lng" id="lng"
                    class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Coordonnées du lieu d'arrivée</label>
              <div class="d-flex">
                <div class="form-group flex-grow-1 mr-2">
                  <input type="text" wire:model="newCommand.lat2" placeholder="lat2" name="lat2" id="lat2"
                    class="form-control">
                </div>
                <div class="form-group flex-grow-1">
                  <input type="text" wire:model="newCommand.lng2" placeholder="lng2" name="lng2" id="lng2"
                    class="form-control">
                </div>

              </div>
            </div>


            <div class="form-group">
              <label>Type transport</label>
              <select class="form-control" name="way" id="way" wire:model="newCommand.way">
                  <option value="">---------</option>
                  <option value="Moto">Moto</option>
                  <option value="Voiture">Voiture</option>
                </select>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Date et Heure de départ</label>
              <div class="d-flex">
                <div class="form-group flex-grow-1 mr-2">
                  <input id="date" class="form-control" type="datetime-local" name="date" wire:model="newCommand.date"
                    placeholder="Date et Heure" min=" {{$currentTime->format('Y-m-d H:i:s')}} ">
                </div>
              </div>
            </div>
            <script>
              let map;
          function initMap() {

              const map = new google.maps.Map(document.getElementById("map"), {
                  zoom: 8,
                  center: { lat: 7.1606400831706125, lng: 2.020855702573403 },
              });

              const uluru = { lat: 7.1606400831706125, lng: 2.020855702573403 };
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

              const benin = { lat: 7.184386998519062, lng: 2.008024739438623 };
              let position = new google.maps.Marker({
                  position: benin,
                  type: "parking",
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

          {{-- <input type="submit" class="btn btn-primary"> --}}
          <div class="card-footer">
            <input type="submit" class="btn btn-primary">
            <button type="button" wire:click.prevent="goToListCommand()" class="btn btn-secondary">Retouner à la liste
              des commandes</button>
          </div>
        </form>
      
      
      
      
        <!-- <form action="{{ route('client.commande.store') }}" method="post">
        @csrf
        <div class="card-body mapform">
          <div>
            <div id="map" style="height:400px; width: 200px; border-radius: 20px; margin-right: 150px;"></div>
        </div>
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
          <div class="form-group">
            <label for="exampleInputEmail1">Coordonnées du lieu d'arrivée</label>
            <div class="d-flex">
              <div class="form-group flex-grow-1 mr-2">
                <input type="text" class="form-control" placeholder="lat2" name="lat2" id="lat2">
              </div>
              <div class="form-group flex-grow-1">
                <input type="text" class="form-control" placeholder="lng2" name="lng2" id="lng2">
              </div>
              
            </div>
          </div>

          <div class="form-group">
            <label >Type transport</label>
            <select class="form-control" name="way" id="way">
                <option value="">---------</option>
                <option value="Moto">Moto</option>
                <option value="Voiture">Voiture</option>
            </select>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Date et  Heure de départ</label>
            <div class="d-flex">
              <div class="form-group flex-grow-1 mr-2">
                <input id="date" class="form-control" type="datetime-local" name="date" min=" {{$currentTime->format('Y-m-d H:i:s')}} ">
              </div>
              {{-- <div class="form-group flex-grow-1">
            <input class="form-control" type="time" id="appt" name="time" min="05:00" max="21:00">
              </div> --}}
            </div>
          </div>
          <script>
            let map;
          function initMap() {

              const map = new google.maps.Map(document.getElementById("map"), {
                  zoom: 8,
                  center: { lat: 7.1606400831706125, lng: 2.020855702573403 },
              });

              const uluru = { lat: 7.1606400831706125, lng: 2.020855702573403 };
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

              const benin = { lat: 7.184386998519062, lng: 2.008024739438623 };
              let position = new google.maps.Marker({
                  position: benin,
                  type: "parking",
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

        {{-- <input type="submit" class="btn btn-primary"> --}}
        <div class="card-footer">
          <input type="submit" class="btn btn-primary">
        </div>
      </form> -->




    </div>
    <div class="col-md-3"></div>  
    <!-- /.card -->

  </div>
</div>

