@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"> 
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Toute les codes Promo</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
            <a href="{{ route('admin.add.coupon') }}" class="btn btn-primary px-5">Ajouter un code promo </a> 
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nom de code promo  </th>
                            <th>Réduction de code promo</th> 
                            <th>Validiter de code promo</th> 
                            <th> Statut </th> 
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

@foreach ($coupon as $key=> $item) 
<tr>
    <td>{{ $key+1 }}</td>
    <td> {{ $item->coupon_name }} </td>
    <td>{{ $item->coupon_discount }}%</td> 
    <td> {{ Carbon\Carbon::parse($item->coupon_validity)->format('D, d F Y')  }} </td>
    <td>  
 @if ($item->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
 <span class="badge bg-success">Valide</span>   
 @else 
 <span class="badge bg-danger">Non valide</span>
 @endif
    </td>

    <td>
    <a href="{{ route('admin.edit.coupon',$item->id) }}" class="btn btn-info px-5">Modifier </a>   
    <a href="{{ route('admin.delete.coupon',$item->id) }}" class="btn btn-danger px-5" id="delete">Supprimer </a>                     
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