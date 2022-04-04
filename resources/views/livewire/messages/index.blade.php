<div wire:ignore.self>

    @if($currentPage == PAGECREATEFORM)
      @include("livewire.messages.sms")
    @endif
  
    @if($currentPage == PAGELIST)
      @include("livewire.messages.liste")
    @endif
     
  </div>
  
  
  
  
   