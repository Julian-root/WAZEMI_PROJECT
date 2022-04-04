<div class="row p-4 pt-5">
  <div class="col-12">
    <div class="card">
      <div class="card-header bg-gradient-primary d-flex align-items-center">
        <h3 class="card-title flex-grow-1"><i class="fas fa-users fa-2x"></i>Listes des messages</h3>

        {{-- <div class="card-tools d-flex align-items-center">
          <a class="btn btn-link text-white mr-4 d-block" wire:click.prevent="goToAddUser()"><i
              class="fas fa-user-plus"></i>Nouvel utilisateur</a>

          <div class="input-group input-group-md" style="width: 250px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div> --}}
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0 table-striped" style="height: 300px;">
        <table class="table table-head-fixed text-nowrap">
          <thead>
            <tr>
              <th style="width: 15%;">Avatar</th>
              <th style="width: 25%;">Nom</th>
              <th style="width: 20%;">Email</th>
              <th style="width: 20%;" class="text-center">Messages</th>
              <th style="width: 30%;" class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($messages as $message)
            <tr>
              <td>
                @if ( Auth::user()->imageUrl != "" || Auth::user()->imageUrl != null )
                <img  src="{{ asset('storage/'.Auth::user()->imageUrl) }}" width="24px"
                  alt="User profile picture">
                @else
                @if(Auth::user()->sexe === "F")
                <img src="{{ asset('img/woman.png') }}" width="24px" alt="">
                @endif
                @if(Auth::user()->sexe === "H")
                <div class="image">
                  <img src="{{ asset('img/man.png') }}" width="24px" alt="">
                </div>
                @endif
                @endif
              </td>
              <td>{{$message->nom }}</td>
              <td>
                {{ $message->email }}
              </td>
              <td>
                {{ $message->message }}
              </td>
              <td class="text-center">
                <button class="btn btn-link" wire:click.prevent=""><i
                    class="far fa-edit"></i></button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <div class="float-right">{{ $messages->links() }}</div>
      </div>
    </div>
    <!-- /.card -->
  </div>
</div>