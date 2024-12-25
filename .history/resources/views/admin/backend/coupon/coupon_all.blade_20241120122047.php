
@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-0">Tous les codes promo</h5>
                </div>
                <div class="font-22 ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('admin.add.coupon') }}" class="btn btn-primary">Ajouter un code promo</a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nom</th>
                            <th>Réduction (%)</th>
                            <th>Validité</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($coupon as $item)
                        <tr>
                            <td>{{ $item->coupon_name }}</td>
                            <td>{{ $item->coupon_discount }}%</td>
                            <td>{{ $item->coupon_validity }}</td>
                            <td>
                                <div class="d-flex order-actions">
                                    <a href="{{ route('admin.edit.coupon', $item->id) }}" class="btn btn-sm btn-warning me-2">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                    <a href="{{ route('admin.manage.courses.coupon', $item->id) }}" class="btn btn-sm btn-info me-2">
                                        <i class="bx bx-list-check"></i> Gérer les formations
                                    </a>
                                    <a href="{{ route('admin.delete.coupon', $item->id) }}" class="btn btn-sm btn-danger" id="delete">
                                        <i class="bx bx-trash"></i>
                                    </a>
                                </div>
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