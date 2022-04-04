<div wire:ignore.self>

  @if($currentPage == PAGELIST)
    @include("livewire.editpassword.choiceoperation")
  @endif

  @if($currentPage == PAGEEDITFORM)
    @include("livewire.editpassword.resetpassword") 
  @endif 
  
  @if($currentPage == PAGECREATEFORM)
    @include("livewire.editpassword.changepassword") 
  @endif 
  
</div>
@include("livewire.editpassword.alert")




 


 