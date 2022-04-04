<script>
  window.addEventListener("showSuccessMessage", event=>{
      Swal.fire({
              position: 'top-end',
              icon: 'success',
              toast:true,
              title: event.detail.message || "Opération effectuée avec succès!",
              showConfirmButton: false,
              timer: 5000
              }
          )
  })
</script>

<script>
  window.addEventListener("showConfirmMessage", event=>{
     Swal.fire({
      title: event.detail.message.title,
      text: event.detail.message.text,
      icon: event.detail.message.type,
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Continuer',
      cancelButtonText: 'Annuler'
      }).then((result) => {
      
      if (result.isConfirmed) {
          if(event.detail.message.data){
              @this.deleteCommande(event.detail.message.data.commande_id)
          }
      }
      })
  })
</script>

<script>
  window.addEventListener("showConfirmCommand", event=>{
     Swal.fire({
      title: event.detail.message.title,
      text: event.detail.message.text,
      icon: event.detail.message.type,
      showCancelButton: false,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Continuer',
      // cancelButtonText: 'Annuler'
      }).then((result) => {
      
      if (result.isConfirmed) {
          if(event.detail.message.data){
              @this.RedirectCommand(event.detail.message.data.commande_id)
          }
      }
      })
  })
</script>

<script>
  window.addEventListener("showConfirm", event=>{
     Swal.fire({
      title: event.detail.message.title,
      text: event.detail.message.text,
      icon: event.detail.message.type,
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'OK',
      }).then((result) => {
      
      if (result.isConfirmed) {
          @this.redirectCommand(event.detail.message.data.commande_id)
      }
      })
  })
</script>

