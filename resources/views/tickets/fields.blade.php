<!-- Universite Id Field -->
<div class="form-group col-lg-4 col-md-6 col-sm-12">
    <form action="{{ route('tickets.storePerso') }}" method="post">
        @csrf
        <input type="hidden" name="categorie_id" value="1">
        <div class="panel panel-primary"style="margin-bottom: 0.8rem;">
            <div class="panel-body bg-primary">
                <h3 class="text-center">PERSO</h3>
                <p class="text-center" style="font-size: 1rem"><em><b>10 000 FCFA - 300 MMS</b></em></p>
            </div>
        </div>
        <button class="mt-3 btn btn-md text-uppercase btn-primary btn-block">Valider</button>
    </form>
</div>

<div class="form-group col-lg-4 col-md-6 col-sm-12">
    <form action="{{ route('tickets.storePro') }}" method="post">
        @csrf
        <input type="hidden" name="categorie_id" value="2">
        <div class="panel panel-warning" style="margin-bottom: 0.8rem;">
            <div class="panel-body bg-warning">
                <h3 class="text-center">PRO</h3>
                <p class="text-center" style="font-size: 1rem"><em><b>50 000 FCFA - 1 200 MMS</b></em></p>
            </div>
        </div>
        <button class="mt-3 btn btn-md text-uppercase btn-warning btn-block">Valider</button>
    </form>
</div>

<div class="form-group col-lg-4 col-md-6 col-sm-12">
    <form action="{{ route('tickets.storeProMax') }}" method="post">
        @csrf
        <input type="hidden" name="categorie_id" value="3">
        <div class="panel panel-success" style="margin-bottom: 0.8rem;">
            <div class="panel-body bg-success">
                <h3 class="text-center">PRO MAX</h3>
                <p class="text-center" style="font-size: 1rem"><em><b>100 000 FCFA - 3000 MMS</b></em></p>
            </div>
        </div>
        <button class="mt-3 btn btn-md text-uppercase btn-success btn-block">Valider</button>
    </form>
</div>
