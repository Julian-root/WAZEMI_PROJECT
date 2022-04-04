<div class="container-contact100">
	<div class="wrap-contact100">
		<form class="contact100-form" role="form" wire:submit.prevent="addMessage()">
			<span class="contact100-form-title">
				Contactez-nous!
			</span>

			<div class="wrap-input100 " >
				<span class="label-input100">Your Name</span>
				<input  class="input100 @error('newMessage.nom') is-invalid @enderror" wire:model="newMessage.nom" placeholder="Enter your name">
				<span class="focus-input100"></span>
			</div>
			@error("newMessage.nom")
					<span class="text-danger">{{ $message }}</span>
			@enderror

			<div class="wrap-input100 ">
				<span class="label-input100">Email</span>
				<input class="input100 @error('newMessage.email') is-invalid @enderror " wire:model="newMessage.email" type="text" placeholder="Enter your email addess">
				<span class="focus-input100"></span>
			</div>
			@error("newMessage.email")
			<span class="text-danger">{{ $message }}</span>
		    @enderror

			<div class="wrap-input100">
				<span class="label-input100">Message</span>
				<textarea class="input100 @error('newMessage.message') is-invalid @enderror " wire:model="newMessage.message" placeholder="Your message here..."></textarea>
				<span class="focus-input100"></span>
			</div>
			@error("newMessage.message")
					<span class="text-danger">{{ $message }}</span>
			@enderror

			<div class="container-contact100-form-btn">
				<div class="wrap-contact100-form-btn">
					<div class="contact100-form-bgbtn"></div>
					<button type="submit" class="contact100-form-btn btn-primary">
						<span>
							Submit
							<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
						</span>
					</button>
				</div>

			</div>
		</form>
	</div>
</div>