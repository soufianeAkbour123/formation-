@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"> 
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Modifier un code promo</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Modifier un code promo</h5>
            <form action="{{ route('admin.update.promo') }}" method="POST" class="row g-3">
                @csrf
                <input type="hidden" name="id" value="{{ $promo->id }}">

                <div class="form-group col-md-6">
                    <label for="input1" class="form-label">Le code promo</label>
                    <input type="text" name="code" class="form-control" value="{{ $promo->code }}" disabled>
                </div>

                <div class="form-group col-md-6">
    <label for="input1" class="form-label">Réduction de code promo</label>
    <input class="form-control" name="discount" type="text" value="{{ old('discount', $promo->discount) }}">
</div>


<div class="form-group col-md-6">
    <label for="input3" class="form-label">La date d'expiration</label>
    <input type="date" 
           name="expiration_date" 
           class="form-control" 
           value="{{ $promo->expiration_date }}" 
           min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
</div>


                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary px-4">Enregistrer les modifications</button>
                </div>
            </form>
            
        </div>
        
    </div>
</div>

@endsection