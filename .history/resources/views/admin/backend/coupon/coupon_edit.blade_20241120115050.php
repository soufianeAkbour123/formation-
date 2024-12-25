
@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
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

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Modifier un code promo</h5>
            <form id="myForm" action="{{ route('admin.update.coupon') }}" method="post" class="row g-3">
                @csrf
                <input type="hidden" name="id" value="{{ $coupon->id }}">

                <div class="form-group col-md-6">
                    <label class="form-label">Code Promo</label>
                    <input type="text" class="form-control" value="{{ $coupon->coupon_name }}" readonly disabled>
                </div>

                <div class="form-group col-md-6">
                    <label for="input2" class="form-label">Réduction de code promo (%)</label>
                    <input class="form-control" name="coupon_discount" type="number" 
                           min="0" max="100" value="{{ $coupon->coupon_discount }}" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="input2" class="form-label">Date de validité du code promo</label>
                    <input class="form-control" name="coupon_validity" type="date" 
                           min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" 
                           value="{{ $coupon->coupon_validity }}" required>
                </div>

                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <button type="submit" class="btn btn-primary px-4">Enregistrer les modifications</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection