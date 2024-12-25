@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"> 
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Les codes Promo appliquer</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Les codes promo</th>
                            <th>Les courses</th>
                            <th>Statut</th>  
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($promos as $promo)
                            <tr>
                                <td>{{ $promo->code }}</td>
                                <td>
                                    @foreach($promo->courses as $course)
                                        <!-- Ajouter un point avant le titre du cours avec un <strong> -->
                                        <strong>.</strong> {{ $course->course_title }}<br>
                                    @endforeach
                                </td>
                                <td>
                                    <!-- Vérifier le statut et appliquer une classe CSS -->
                                    <span class="badge" style="
                                        @if($promo->status == 'active')
                                            background-color: #28a745; color: white;
                                        @elseif($promo->status == 'inactive')
                                            background-color: #dc3545; color: white;
                                        @else
                                            background-color: #6c757d; color: white;
                                        @endif
                                    ">
                                        {{ $promo->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection

@section('css')
<style>
    /* Styles supplémentaires pour personnaliser les badges */
    .badge {
        padding: 5px 10px;
        font-weight: bold;
        border-radius: 12px;
        text-align: center;
    }

    /* Table styling */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th, table td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }
</style>
@endsection