<div class="row p-4 pt-5">
	<div class="col-md-3"></div>
	<div class="col-md-6">
	  <!-- general form elements -->
	  <div class="card card-primary">
		<div class="card-header">
		  <h3 class="card-title"><i class="fas fa-user-plus "></i> Formulaire de notation de la course
		  </h3>
		</div>
		<!-- /.card-header -->
		<!-- form start -->
		<form action="{{ route('client.listcommande.store') }}" method="post">
		  @csrf
		  <div class="card-body">

			<div class="rate text-center"> Ponctualité et Conduite</div>
  
			<div class="form-group">
				<div>
					<fieldset class="rating">
		
						<input type="radio" id="star5" name="rating" value="5"/>
						<label for="star5" class="full" title="Awesome"></label>
			
						<input type="radio" id="star4.5" name="rating" value="4.5"/>
						<label for="star4.5" class="half"></label>
			
						<input type="radio" id="star4" name="rating" value="4"/>
						<label for="star4" class="full"></label>
			
						<input type="radio" id="star3.5" name="rating" value="3.5"/>
						<label for="star3.5" class="half"></label>
			
						<input type="radio" id="star3" name="rating" value="3"/>
						<label for="star3" class="full"></label>
			
						<input type="radio" id="star2.5" name="rating" value="2.5"/>
						<label for="star2.5" class="half"></label>
			
						<input type="radio" id="star2" name="rating" value="2"/>
						<label for="star2" class="full"></label>
			
						<input type="radio" id="star1.5" name="rating" value="1.5"/>
						<label for="star1.5" class="half"></label>
			
						<input type="radio" id="star1" name="rating" value="1"/>
						<label for="star1" class="full"></label>
			
						<input type="radio" id="star0.5" name="rating" value="0.5"/><label for="star0.5" class="half"></label>
					</fieldset>
					<h4 id="rating-value" style="width: 140px; margin-right : 5px"></h4>
				</div>
			</div>

			<script>
  
			  let star = document.querySelectorAll('input');
			  let showValue = document.querySelector('#rating-value');
  
			  for (let i = 0; i < star.length; i++) {
				star[i].addEventListener('click', function() {
				  i = this.value;
  
				  showValue.innerHTML = i + " out of 5";
				});
			  }
  
			</script>
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
  
  <style>
	@import url(https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css);
  
  
  #rating-value{	
	  width: 110px;
	  margin: 40px auto 0;
	  padding: 10px 5px;
	  text-align: center;
	  box-shadow: inset 0 0 2px 1px rgba(46,204,113,.2);
  }
  
  /*styling star rating*/
  .rating{
	  border: none;
	  float: left;
  }
  
  .rating > input{
	  display: none;
  }

  .rate{
	  content: '\f005';
	  font-family: FontAwesome;
	  font-size: 1.5rem;
	  display: inline-block;
  }
  
  .rating > label:before{
	  content: '\f005';
	  font-family: FontAwesome;
	  margin: 5px;
	  font-size: 1.5rem;
	  display: inline-block;
	  cursor: pointer;
  }
  
  .rating > .half:before{
	  content: '\f089';
	  position: absolute;
	  cursor: pointer;
  }
  
  
  .rating > label{
	  color: #ddd;
	  float: right;
	  cursor: pointer;
  }
  
  .rating > input:checked ~ label,
  .rating:not(:checked) > label:hover, 
  .rating:not(:checked) > label:hover ~ label{
	  color: #2ce679;
  }
  
  .rating > input:checked + label:hover,
  .rating > input:checked ~ label:hover,
  .rating > label:hover ~ input:checked ~ label,
  .rating > input:checked ~ label:hover ~ label{
	  color: #2ddc76;
  }
  </style>
  
  
  