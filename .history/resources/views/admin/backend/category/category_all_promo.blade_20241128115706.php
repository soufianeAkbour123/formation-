@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tous les cours</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.apply.promo.to.courses') }}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="promo_id" style="font-size: 1.1rem; font-weight: bold; color: #4A4A4A; display: block; margin-bottom: 8px; color: #000000;">Sélectionner un code promo</label>
                        <!-- Sélectionner tout à droite -->
                        <div>
                            <input type="checkbox" class="form-check-input" id="selectAll" onclick="toggleSelectAll()">
                            <label class="form-check-label" for="selectAll" style="font-size: 1rem; font-weight: bold; color: #000000;">Sélectionner tout</label>

                        </div>
                    </div>
                    <select name="promo_id" id="promo_id" class="form-control border-radius-10 py-2 px-3" style="width: 250px; " required>
                        <option value="" selected disabled style="color: #ff5733;" >Sélectionner un code promo</option>
                        @foreach ($promos as $promo)
                            @if($promo->status == 'active')
                                <option value="{{ $promo->id }}">{{ $promo->code }} - {{ $promo->discount }}%</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="table-responsive mt-3">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nom du cours</th>
                                <th>Choisir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $key => $course)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $course->course_name }}</td>
                                <td>
                                    <input type="checkbox" name="selected_courses[]" value="{{ $course->id }}" class="course-checkbox">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Appliquer le code promo</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Fonction pour sélectionner/désélectionner toutes les cases à cocher
    function toggleSelectAll() {
        var selectAllCheckbox = document.getElementById('selectAll');
        var courseCheckboxes = document.querySelectorAll('.course-checkbox');
        courseCheckboxes.forEach(function(checkbox) {
            checkbox.checked = selectAllCheckbox.checked;
        });
    }
</script>

@endsection