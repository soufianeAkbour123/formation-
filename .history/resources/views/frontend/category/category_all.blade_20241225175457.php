@extends('frontend.master')
@section('home')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.course-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 1.5rem;
}

.card-item {
  border: none;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  transition: transform 0.3s ease;
  background: #fff;
  height: 100%;
}

.card-item:hover {
  transform: translateY(-5px);
  box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.card-image {
  position: relative;
  padding-top: 60%;
  overflow: hidden;
  border-radius: 12px 12px 0 0;
}

.card-image img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.course-badge-labels {
  position: absolute;
  top: 12px;
  left: 12px;
  display: flex;
  flex-direction: column;
  gap: 6px;
}

.course-badge {
  padding: 6px 12px;
  border-radius: 4px;
  font-size: 12px;
  font-weight: 500;
  background: rgba(255,255,255,0.95);
}

.card-body {
  padding: 1.25rem;
}

.icon-element {
  width: 35px;
  height: 35px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #f5f5f5;
  margin: 0 4px;
  cursor: pointer;
  transition: all 0.2s ease;
}

.icon-element:hover {
  background: #4A90E2;
  color: white;
}

.before-price {
  text-decoration: line-through;
  color: #999;
  font-size: 0.9rem;
  margin-left: 8px;
}

.review-stars {
  display: flex;
  align-items: center;
  gap: 2px;
}

.la-star {
  color: #ffc107;
}

.la-heart {
  color: #28a745;
}

@media (max-width: 992px) {
  .course-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 576px) {
  .course-grid {
    grid-template-columns: 1fr;
  }
  
  .card-body {
    padding: 1rem;
  }
}
</style>

@foreach ($courses as $course)
<div class="card card-item">
  <div class="card-image">
    <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}">
      <img class="lazy" src="{{ asset($course->course_image) }}" alt="{{ $course->course_name }}">
    </a>
    
    <div class="course-badge-labels">
      @if ($course->bestseller == 1)
        <div class="course-badge">Meilleure Vente</div>
      @endif
      @if ($course->highestrated == 1)
        <div class="course-badge sky-blue">Le Mieux Noté</div>
      @endif
      @if ($course->discount_price == NULL)
        <div class="course-badge blue">Nouveau</div>
      @else
        <div class="course-badge blue">{{ round(($course->selling_price - $course->discount_price) / $course->selling_price * 100) }}%</div>
      @endif
    </div>
  </div>

  <div class="card-body">
    <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">
      {{ $course->label == 'Begginer' ? 'Débutant' : ($course->label == 'Middle' ? 'Intermédiaire' : 'Avancé') }}
    </h6>
    
    <h5 class="card-title">
      <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}">{{ $course->course_name }}</a>
    </h5>
    
    <p class="card-text">
      <a href="{{ route('instructor.details',$course->instructor_id) }}">{{ $course['user']['name'] }}</a>
    </p>

    <div class="rating-wrap d-flex align-items-center py-2">
      <div class="review-stars">
        <span class="rating-number">{{ round($avarage,1) }}</span>
        @for ($i = 1; $i <= 5; $i++)
          <i class="la {{ $i <= $avarage ? 'la-star' : 'la-star-o' }}"></i>
        @endfor
      </div>
      <span class="rating-total pl-1">({{ count($reviewcount) }})</span>
    </div>

    <div class="d-flex justify-content-between align-items-center">
      <div class="price">
        @if ($course->discount_price == NULL)
          <span class="card-price text-black font-weight-bold">{{ $course->selling_price }} DH</span>
        @else
          <span class="card-price text-black font-weight-bold">
            {{ $course->discount_price }} DH
            <span class="before-price">{{ $course->selling_price }} DH</span>
          </span>
        @endif
      </div>

      <div class="d-flex align-items-center">
        <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" 
           class="icon-element" title="Voir les détails">
          <i class="la la-eye"></i>
        </a>
        
        <div class="icon-element" onclick="addToCart({{$course->id}}, '{{$course->course_name}}', '{{$course->instructor_id}}', '{{$course->course_name_slug}}')">
          <i class="la la-shopping-cart"></i>
        </div>
        
        <div class="icon-element" id="{{ $course->id }}" onclick="addToWishList(this.id)">
          <i class="la la-heart-o"></i>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach
          </div>

          <div class="pagination-container mt-4">
            {{ $courses->links('vendor.pagination.custom') }}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
function addToCart(courseId, courseName, instructorId, courseSlug) {
  // Add your cart functionality here
}

function addToWishList(courseId) {
  // Add your wishlist functionality here
}
</script>

@endsection