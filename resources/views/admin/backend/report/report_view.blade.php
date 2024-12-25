@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title mb-0 d-flex align-items-center">
                            <i class="bx bx-search-alt-2 me-3"></i>Rapports et Recherches
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            {{-- Date Search --}}
                            <div class="col-md-4">
                                <div class="search-box bg-light p-3 rounded-3">
                                    <form action="{{ route('search.by.date') }}" method="post" class="needs-validation" novalidate>
                                        @csrf
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="bx bx-calendar text-primary me-2 fs-4"></i>
                                            <label class="form-label mb-0 me-2">Recherche par Date</label>
                                        </div>
                                        <div class="input-group">
                                            <input type="date" name="date" class="form-control" required>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bx bx-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            {{-- Month and Year Search --}}
                            <div class="col-md-4">
                                <div class="search-box bg-light p-3 rounded-3">
                                    <form action="{{ route('search.by.month') }}" method="post" class="needs-validation" novalidate>
                                        @csrf
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="bx bx-calendar-check text-primary me-2 fs-4"></i>
                                            <label class="form-label mb-0 me-2">Recherche par Mois et Année</label>
                                        </div>
                                        <div class="mb-2">
                                            <div class="input-group mb-2">
                                                <span class="input-group-text"><i class="bx bx-time"></i></span>
                                                <select name="month" class="form-select" required>
                                                    <option value="">Sélectionner un mois</option>
                                                    @php
                                                    $months = [
                                                        'Janvier', 'Février', 'Mars', 'Avril', 
                                                        'Mai', 'Juin', 'Juillet', 'Août', 
                                                        'Septembre', 'Octobre', 'Novembre', 'Décembre'
                                                    ];
                                                    @endphp
                                                    @foreach($months as $month)
                                                        <option value="{{ $month }}">{{ $month }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                                <select name="year_name" class="form-select" required>
                                                    <option value="">Sélectionner une année</option>
                                                    @for($year = 2022; $year <= 2025; $year++)
                                                        <option value="{{ $year }}">{{ $year }}</option>
                                                    @endfor
                                                </select>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bx bx-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            {{-- Year Search --}}
                            <div class="col-md-4">
                                <div class="search-box bg-light p-3 rounded-3">
                                    <form action="{{ route('search.by.year') }}" method="post" class="needs-validation" novalidate>
                                        @csrf
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="bx bx-year text-primary me-2 fs-4"></i>
                                            <label class="form-label mb-0 me-2">Recherche par Année</label>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                            <select name="year" class="form-select" required>
                                                <option value="">Sélectionner une année</option>
                                                @for($year = 2022; $year <= 2025; $year++)
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                @endfor
                                            </select>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bx bx-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Example custom validation
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
@endpush
@endsection