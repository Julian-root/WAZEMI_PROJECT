  <div wire:ignore.self>

    {{-- @if($currentPage == PAGECHOICEDRIVER)
      @include("livewire.commandes.choicedriver")
    @endif --}}

    {{-- @if($currentPage == PAGECHOICEDRIVER)
      @include("livewire.commandes.form_commande")
    @endif --}}
  
    @if($currentPage == PAGELIST)
      @include("livewire.listcommandes.liste")
    @endif  
  
    @if($currentPage == PAGECREATEFORM)
      @include("livewire.listcommandes.ratings")
    @endif
     
  </div>
  @include("livewire.listcommandes.alert")

