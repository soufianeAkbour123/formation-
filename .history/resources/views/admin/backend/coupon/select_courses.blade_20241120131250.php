@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Sélectionner les formations pour le coupon: {{ $coupon->coupon_name }}</h5>
            
            <form action="{{ route('admin.coupon.update.courses', $coupon->id) }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="selectAll">
                        <label class="form-check-label" for="selectAll">
                            Sélectionner toutes les formations
                        </label>
                    </div>
                </div>

                @foreach($categories as $category)
                    <div class="card mb-3">
                        <div class="card-header">
                            <h6>{{ $category->name }}</h6>
                        </div>
                        <div class="card-body">
                            @foreach($category->courses as $course)
                                <div class="form-check">
                                    <input class="form-check-input course-checkbox" 
                                           type="checkbox"
                                           name="courses[]"
                                           value="{{ $course->id }}"
                                           id="course{{ $course->id }}"
                                           @if(in_array($course->id, $selectedCourses)) checked @endif>
                                    <label class="form-check-label" for="course{{ $course->id }}">
                                        {{ $course->course_name }} ({{ $course->price }} €)
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('selectAll').addEventListener('change', function() {
    const checkboxes = document.getElementsByClassName('course-checkbox');
    for (let checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
});
</script>
@endsection