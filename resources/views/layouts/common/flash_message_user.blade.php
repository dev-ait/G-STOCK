
    @if (session()->has('succes_user'))

    <div class="alert alert-card alert-success" role="alert">
        <strong class="text-capitalize">Success!</strong>
        l'utilisateur <strong> {{ session()->get('succes_user')  }} </strong> a été bien enregistré
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>

    @endif


    