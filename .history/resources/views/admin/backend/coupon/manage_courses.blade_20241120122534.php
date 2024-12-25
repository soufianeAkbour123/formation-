{{-- resources/views/admin/backend/coupon/manage_courses.blade.php --}}
@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-0">Gérer les formations pour le code promo: {{ $coupon->coupon_name }}</h5>
                </div>
            </div>
            <hr>
            
            <form action="{{ route('admin.update.courses.coupon', $coupon->id) }}" method="post">
                @csrf
                
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary me-2" id="selectAll">Tout sélectionner</button>
                            <button type="button" class="btn btn-secondary" id="deselectAll">Tout désélectionner</button>
                        </div>
                    </div>

                    @foreach($categories as $category)
                        <div class="col-md-12 mb-4">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0">{{ $category->name }}</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @foreach($category->courses as $course)
                                            <div class="col-md-4 mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" 
                                                           name="courses[]" 
                                                           value="{{ $course->id }}" 
                                                           id="course{{ $course->id }}"
                                                           {{ in_array($course->id, $selectedCourses) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="course{{ $course->id }}">
                                                        {{ $course->title }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
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