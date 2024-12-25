@extends('frontend.master')
@section('home')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.course-area .row {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 1.5rem;
  margin: 0;
}

.course-card {
  height: 100%;
  border: none;
  border-radius: 12px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.08);
  transition: transform 0.3s ease;
}

.course-card:hover {
  transform: translateY(-5px);
}

.course-image {
  position: relative;
  padding-top: 60%;
  border-radius: 12px 12px 0 0;
  overflow: hidden;
}

.course-image img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.badge-container {
  position: absolute;
  top: 10px;
  left: 10px;
  display: flex;
  flex-direction: column;
  gap: 5px;
}

.course-badge {
  padding: 4px 8px;
  border-radius: 4px;
  font-size: 12px;
  background: rgba(255,255,255,0.9);
}

.course-content {
  padding: 1.25rem;
}

.course-level {
  font-size: 14px;
  color: #4A90E2;
  margin-bottom: 0.5rem;
}

.course-title {
  font-size: 1.1rem;
  margin-bottom: 0.5rem;
  line-height: 1.4;
}

.instructor-name {
  color: #666;
  font-size: 0.9rem;
}

.rating-wrap {
  margin: 0.5rem 0;
}

.action-buttons {
  display: flex;
  gap: 0.5rem;
  margin-top: 1rem;
}

.icon-button {
  width: 35px;
  height: 35px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #f5f5f5;
  cursor: pointer;
  transition: all 0.2s ease;
}

.icon-button:hover {
  background: #4A90E2;
  color: white;
}

.price-section {
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.current-price {
  font-weight: 600;
  color: #2C3E50;
}

.original-price {
  text-decoration: line-through;
  color: #999;
  font-size: 0.9rem;
}

@media (max-width: 992px) {
  .course-area .row {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 576px) {
  .course-area .row {
    grid-template-columns: 1fr;
  }
}

.sidebar {
  background: white;
  border-radius: 12px;
  padding: 1.5rem;
  box-shadow: 0 2px 10px rgba(0,0,0,0.08);
}

.filter-section {
  margin-bottom: 2rem;
}

.filter-title {
  font-size: 1.1rem;
  margin-bottom: 1rem;
  color: #2C3E50;
}
</style>

<section class="course-area section--padding">
  <div class="container">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-lg-3">
        <div class="sidebar">
          <!-- Search -->
          <div class="filter-section">
            <h3 class="filter-title">Rechercher</h3>
            <input type="text" class="form-control" placeholder="Rechercher des cours...">
          </div>

          <!-- Categories -->
          <div class="filter-section">
            <h3 class="filter-title">Catégories</h3>
            <div class="category-list">
              @foreach ($categories as $cat)
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="cat{{ $cat->id }}">
                  <label class="form-check-label" for="cat{{ $cat->id }}">
                    {{ $cat->category_name }}
                  </label>
                </div>
              @endforeach
            </div>
          </div>

          <!-- Level -->
          <div class="filter-section">
            <h3 class="filter-title">Niveau</h3>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="levelAll">
              <label class="form-check-label" for="levelAll">Tous les niveaux</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="levelBeginner">
              <label class="form-check-label" for="levelBeginner">Débutant</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="levelIntermediate">
              <label class="form-check-label" for="levelIntermediate">Intermédiaire</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="levelAdvanced">
              <label class="form-check-label" for="levelAdvanced">Expert</label>
            </div>
          </div>
        </div>
      </div>

      <!-- Course Grid -->
      <div class="col-lg-9">
        <div class="course-grid">
          <div class="row">
            @foreach ($courses as $course)
              <div class="course-card">
                <div class="course-image">
                  <img src="{{ asset($course->course_image) }}" alt="{{ $course->course_name }}">
                  <div class="badge-container">
                    @if($course->bestseller)
                      <span class="course-badge">Meilleure Vente</span>
                    @endif
                    @if($course->discount_price)
                      <span class="course-badge">-{{ round((($course->selling_price - $course->discount_price) / $course->selling_price) * 100) }}%</span>
                    @endif
                  </div>
                </div>

                <div class="course-content">
                  <div class="course-level">{{ $course->label == 'Begginer' ? 'Débutant' : ($course->label == 'Middle' ? 'Intermédiaire' : 'Expert') }}</div>
                  <h3 class="course-title">
                    <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}">{{ $course->course_name }}</a>
                  </h3>
                  <div class="instructor-name">{{ $course['user']['name'] }}</div>

                  <div class="rating-wrap">
                   
                    <div class="stars">
                      @for($i = 1; $i <= 5; $i++)
                        <i class="la {{ $i <= $rating ? 'la-star' : 'la-star-o' }}"></i>
                      @endfor
                      <span>({{ $course->reviews->count() }})</span>
                    </div>
                  </div>

                  <div class="d-flex justify-content-between align-items-center">
                    <div class="price-section">
                      @if($course->discount_price)
                        <span class="current-price">{{ $course->discount_price }} DH</span>
                        <span class="original-price">{{ $course->selling_price }} DH</span>
                      @else
                        <span class="current-price">{{ $course->selling_price }} DH</span>
                      @endif
                    </div>

                    <div class="action-buttons">
                      <button class="icon-button" onclick="addToCart({{$course->id}}, '{{$course->course_name}}', '{{$course->instructor_id}}', '{{$course->course_name_slug}}')">
                        <i class="la la-shopping-cart"></i>
                      </button>
                      <button class="icon-button" onclick="addToWishList({{$course->id}})">
                        <i class="la la-heart-o"></i>
                      </button>
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