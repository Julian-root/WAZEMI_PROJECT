<div wire:ignore.self>

  @if($currentPage == PAGELIST)
    @include("livewire.editer.checkedprofile")
  @endif

  @if($currentPage == PAGEEDITFORM)
    @include("livewire.editer.updateprofile") 
  @endif  
  
</div>
@include("livewire.editer.alert")




 


 