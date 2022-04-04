<div wire:ignore.self>

	@if($currentPage == PAGELIST)
	  @include("livewire.contact.info")
	@endif
  
	@if($currentPage == PAGECREATEFORM)
	  @include("livewire.contact.form")
	@endif  
	 
  </div>
  @include("livewire.contact.alert")
  
  
  
  
   