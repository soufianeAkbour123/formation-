{{-- resources/views/admin/backend/coupon/coupon_add.blade.php --}}
@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
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

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Ajouter un code promo</h5>
            <form id="myForm" action="{{ route('admin.store.coupon') }}" method="post" class="row g-3">
                @csrf

                <div class="form-group col-md-6">
                    <label for="coupon_discount" class="form-label">Réduction de code promo (%)</label>
                    <input class="form-control" name="coupon_discount" type="number" min="0" max="100" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="coupon_validity" class="form-label">Date de validité du code promo</label>
                    <input class="form-control" name="coupon_validity" type="date" 
                           min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" required>
                </div>

                <div class="form-group col-md-12">
                    <label class="form-label">Formations applicables</label>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-wrap gap-3">
                                @foreach($courses as $course)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="courses[]" 
                                           value="{{ $course->id }}" id="course{{ $course->id }}">
                                    <label class="form-check-label" for="course{{ $course->id }}">
                                        {{ $course->title }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            <div class="mt-3">
                                <button type="button" class="btn btn-sm btn-secondary" id="selectAll">Tout sélectionner</button>
                                <button type="button" class="btn btn-sm btn-secondary" id="deselectAll">Tout désélectionner</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <button type="submit" class="btn btn-primary px-4">Générer le code promo</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#selectAll').click(function() {
            $('input[name="courses[]"]').prop('checked', true);
        });

        $('#deselectAll').click(function() {
            $('input[name="courses[]"]').prop('checked', false);
        });
    });
</script>
@endsection