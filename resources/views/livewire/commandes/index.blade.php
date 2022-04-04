<div wire:ignore.self>

    {{-- @if($currentPage == PAGECHOICEDRIVER)
      @include("livewire.commandes.choicedriver")
    @endif --}}

    @if($currentPage == PAGECHOICEDRIVER)
      @include("livewire.commandes.form_commande")
    @endif
  
    {{-- @if($currentPage == PAGELIST)
      @include("livewire.commandes.liste")
    @endif   --}}
  
    {{-- @if($currentPage == PAGECREATEFORM)
      @include("livewire.commandes.form_commande")
    @endif --}}
     
  </div>
  @include("livewire.commandes.alert")
  
  
  
  
   