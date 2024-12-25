@extends('admin.admin_dashboard')
@section('admin')

<!-- Ajouter Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"> 
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Toute les codes Promo</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.add.promo') }}" class="btn btn-primary px-5">Ajouter un code promo</a> 
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Le code promo</th>
                            <th>Réduction de code promo</th> 
                            <th>La date d'expiration</th>
                            <th>Statut</th> 
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($promo as $key=> $item) 
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->code }}</td>
                            <td>{{ $item->discount }}%</td> 
                            <td>{{ $item->expiration_date }}</td> 
                            <td>{{ $item->status }}</td>

                        <td class="d-flex">
                                <a href="{{ route('admin.edit.promo', $item->id) }}" class="btn btn-info px-2 py-1 me-2">
                                    <i class="fas fa-pencil-alt fa-xs"></i>
                                </a>

                                <a href="{{ route('admin.delete.promo', $item->id) }}" class="btn btn-danger px-2 py-1 me-2" id="delete">
                                    <i class="fas fa-trash fa-xs"></i>
                                </a>


                            <form action="{{ route('admin.send.promo') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="promo_id" value="{{ $item->id }}">
                                <button type="submit" class="btn btn-success px-2 py-1">
                                 <i class="fas fa-paper-plane fa-xs"></i>
                                 </button>

                            </form>
                        </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ route('admin.all.categories') }}" class="btn btn-info px-5 me-2">Afficher tous les courses</a>
            </div>
            
        </div>
             
    </div>
</div>

@endsection