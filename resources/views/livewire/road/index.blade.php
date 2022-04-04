<div class="row p-4 pt-5">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title"><i class="fas fa-user-plus "></i> Chemin de la course
          </h3>
        </div>
       
       
          <div class="card-body mapform">
            <div style="padding-left:32px" >
              <div id="map" style="height:400px; width: 400px; border-radius: 20px" class="my-3"></div>

              <div class="form-group">
                <label for="exampleInputEmail1"> {{$latTo}} </label>
                <label for="exampleInputEmail1"> {{$latFrom}} </label>
                <label for="exampleInputEmail1"> {{$IngTo}} </label>
                <label for="exampleInputEmail1"> {{$IngFrom}} </label>
                
              </div>
            
            
            
            </div>
            
            <script>
              let map;
                  function initMap() {
  
                      const map = new google.maps.Map(document.getElementById("map"), {
                          zoom: 8,
                          // center: { lat: 7.1606400831706125, lng: 2.020855702573403 },
                          center: { lat: parseFloat(@json($latTo)), lng: parseFloat(@json($IngTo)) },
                      });
  
                      // const uluru = { lat: 7.1606400831706125, lng: 2.020855702573403 };
                      const uluru = { lat: parseFloat(@json($latTo)), lng: parseFloat(@json($IngTo)) };
                      let marker = new google.maps.Marker({
                          position: uluru,
                          map: map,
                          draggable: false
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
  
                      // const benin = { lat: 7.184386998519062, lng: 2.008024739438623 };
                      const benin = { lat:  parseFloat(@json($latFrom)), lng:  parseFloat(@json($IngFrom)) };
                      let position = new google.maps.Marker({
                          position: benin,
                          map: map,
                          draggable: false
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
  
      </div>
      <div class="col-md-3"></div>
      <!-- /.card -->
  
    </div>
  </div>