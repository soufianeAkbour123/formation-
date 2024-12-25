@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Appliquer le code promo aux formations</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Appliquer le code "{{ $coupon->coupon_name }}" aux formations</h5>
            <form action="{{ route('admin.store.coupon.courses') }}" method="post">
                @csrf
                <input type="hidden" name="coupon_id" value="{{ $coupon->id }}">

                @foreach($categories as $category)
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">{{ $category->category_name }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($category->courses as $course)
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" 
                                                   name="course_ids[]" 
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
                @endforeach

                <div class="mt-4">
                    <button type="button" class="btn btn-secondary me-2" id="selectAll">Tout sélectionner</button>
                    <button type="button" class="btn btn-secondary me-2" id="deselectAll">Tout désélectionner</button>
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#selectAll').click(function() {
        $('input[name="course_ids[]"]').prop('checked', true);
    });

    $('#deselectAll').click(function() {
        $('input[name="course_ids[]"]').prop('checked', false);
    });
});
</script>
@endsection