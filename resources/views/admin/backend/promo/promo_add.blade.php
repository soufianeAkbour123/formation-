@extends('admin.admin_dashboard')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"> 
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ajouter un code promo</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Ajouter un code promo</h5>
            <form id="myForm" action="{{ route('admin.store.promo') }}" method="post" class="row g-3" enctype="multipart/form-data">
                @csrf

                <!-- Réduction de code promo -->
                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Réduction de code promo</label>
                    <input class="form-control" name="discount" type="text">
                </div>

                <!-- Date de validité du code promo -->
                <div class="form-group col-md-6">
                    <label for="input2" class="form-label">La date d'expiration</label>
                    <input class="form-control" 
                        name="expiration_date" 
                        type="date" 
                        min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" 
                        max="{{ Carbon\Carbon::now()->addYear(1)->format('Y-m-d') }}">
                </div>


                <!-- Bouton de soumission -->
                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <button type="submit" class="btn btn-primary px-4">Enregistrer le code promo</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection