
<h4 class="mt-4 mb-2"></h4>
<div class="row">
    

    <div class="col-md-1"></div>
    <div class="col-md-5">

        <div class="card direct-chat direct-chat-success">
            <div class="card-header bg-success">
                <h3 class="card-title text-center">Make a reservation now</h3>
            </div>

            <div class="card-body">
                <img style="width: 400px; height:345px" class="contacts-list-img" src="{{ asset('img/hero.png') }}" alt="User Avatar">
            </div>

            <div class="card-footer">
                <button type="button" wire:click.prevent="goToAddCommandPresent()" class="btn btn-outline-success btn-block">
                    <i class="fa fa-bell"></i>
                    <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                        GET STARTED
                    </font>
                    </font>
                </button>
            </div>

        </div>

    </div>

    

    <div class="col-md-5">

        <div class="card card-warning   direct-chat direct-chat-success">
            <div class="card-header">
                <h3 class="card-title text-center">Make a reservation for later</h3>
            </div>

            <div class="card-body">
                <img style="width: 400px; height:345px" class="contacts-list-img" src="{{ asset('img/hero.png') }}" alt="User Avatar">
            </div>

            <div class="card-footer">
                <button type="button" class="btn btn-outline-warning btn-block">
                    <i class="fa fa-bell"></i>
                    <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                    GET STARTED
                    </font>
                    </font>
                </button>
            </div>

        </div>
        <div class="col-md-3"></div>

    </div>
    <div class="col-md-1"></div>

    

</div>
