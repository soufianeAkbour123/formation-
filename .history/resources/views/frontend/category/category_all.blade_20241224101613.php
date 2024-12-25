@extends('frontend.master')
@section('home')

<style>
.card {
    height: 510px;
    display: flex;
    flex-direction: column;
    transition: all 0.3s ease;
}

.card-body {
    flex-grow: 1;
}

.category-active {
    background-color: #f8f9fa;
    font-weight: bold;
    color: #007bff !important;
}

.la-star {
    color: #ffc107;
}

.la-star-o {
    color: #ddd;
}

@media (max-width: 767px) {
    .card {
        flex-direction: column;
        height: auto;
    }
    .card-body {
        padding: 16px;
    }
    .card-title {
        font-size: 18px;
    }
}

@media (min-width: 768px) and (max-width: 1199px) {
    .card {
        height: 500px;
    }
    .card-body {
        padding: 20px;
    }
    .card-title {
        font-size: 20px;
    }
}

.icon-element.active {
    background-color: green;
    color: white;
}

.filter-active {
    background-color: #e9ecef;
    border-radius: 4px;
}

.wishlist-active {
    background-color: #dc3545 !important;
    color: white !important;
}

.level-active {
    background-color: #e9ecef;
}
</style>

<section class="breadcrumb-area section-padding img-bg-2">
    <div class="overlay"></div>
    <div class="container">
        <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
            <div class="section-heading">
                <h2 class="section__title text-white">{{ $category->category_name }}</h2>
            </div>
            <ul class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>{{ $category->category_name }}</li>
            </ul>
        </div>
    </div>
</section>

<section class="course-area section--padding">
    <div class="container">
        <div class="filter-bar mb-4">
            <div class="filter-bar-inner d-flex flex-wrap align-items-center justify-content-between">
                <p class="fs-14">Nous avons trouvé <span class="text-black course-count">{{ count($courses) }}</span> cours disponibles pour vous</p>
                <div class="d-flex flex-wrap align-items-center">
                    <div class="select-container select--container">
                        <select class="select-container-select" id="sortCourses">
                            <option value="all">Tous les cours</option>
                            <option value="newest">Plus récents</option>
                            <option value="oldest">Plus anciens</option>
                            <option value="price-high-low">Prix: décroissant</option>
                            <option value="price-low-high">Prix: croissant</option>
                            <option value="rating-high-low">Notes: décroissant</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="sidebar mb-5">
                    <!-- Search Card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Rechercher</h3>
                            <div class="divider"><span></span></div>
                            <div class="form-group mb-0">
                                <input class="form-control form--control" type="text" id="searchCourse" placeholder="Rechercher des cours">
                                <span class="la la-search search-icon"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Categories Card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Catégories</h3>
                            <div class="divider"><span></span></div>
                            <ul class="generic-list-item" id="categoryList">
                                @foreach ($categories as $cat)
                                <li>
                                    <a href="{{ url('category/'.$cat->id.'/'.$cat->category_slug) }}" 
                                       class="category-link {{ $category->id == $cat->id ? 'category-active' : '' }}">
                                        {{ $cat->category_name }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Ratings Card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Avis</h3>
                            <div class="divider"><span></span></div>
                            @for ($i = 5; $i >= 1; $i--)
                            <div class="custom-control custom-radio mb-1 fs-15">
                                <input type="radio" class="custom-control-input rating-filter" 
                                       id="{{ $i }}StarRating" name="rating-filter" value="{{ $i }}">
                                <label class="custom-control-label custom--control-label" for="{{ $i }}StarRating">
                                    <span class="rating-wrap d-flex align-items-center">
                                        <span class="review-stars">
                                            @for ($j = 1; $j <= 5; $j++)
                                                <span class="la {{ $j <= $i ? 'la-star' : 'la-star-o' }}"></span>
                                            @endfor
                                        </span>
                                        <span class="rating-total pl-1">
                                            <span class="mr-1 text-black">{{ $i }}.0 & up</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            @endfor
                        </div>
                    </div>

                    <!-- Levels Card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-18 pb-2">Niveau</h3>
                            <div class="divider"><span></span></div>
                            @foreach(['Tous les niveaux', 'Débutant', 'Intermédiaire', 'Expert'] as $level)
                            <div class="custom-control custom-checkbox mb-1 fs-15">
                                <input type="checkbox" class="custom-control-input level-filter" 
                                       id="level{{ $loop->index }}" value="{{ $level }}">
                                <label class="custom-control-label custom--control-label text-black" 
                                       for="level{{ $loop->index }}">
                                    {{ $level }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course Cards -->
            <div class="col-lg-8">
                <div class="row" id="courseContainer">
                    @foreach ($courses as $course)
                    <div class="col-lg-6 responsive-column-half course-card" 
                         data-price="{{ $course->discount_price ?? $course->selling_price }}"
                         data-rating="{{ $course->average_rating }}"
                         data-date="{{ $course->created_at }}"
                         data-level="{{ $course->level }}">
                        <div class="card card-item">
                            <div class="card-image">
                                <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}">
                                    <img class="card-img-top" src="{{ asset($course->course_image) }}" alt="{{ $course->course_name }}">
                                </a>
                                <div class="course-badge-labels">
                                    @if ($course->bestseller)
                                        <div class="course-badge">Bestseller</div>
                                    @endif
                                    @if ($course->discount_price)
                                        <div class="course-badge blue">
                                            -{{ round((($course->selling_price - $course->discount_price) / $course->selling_price) * 100) }}%
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">{{ $course->level }}</h6>
                                <h5 class="card-title">
                                    <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}">
                                        {{ $course->course_name }}
                                    </a>
                                </h5>
                                <p class="card-text">
                                    <a href="{{ route('instructor.details', $course->instructor_id) }}">
                                        {{ $course->user->name }}
                                    </a>
                                </p>
                                <div class="rating-wrap d-flex align-items-center py-2">
                                    <div class="review-stars">
                                        <span class="rating-number">{{ $course->average_rating }}</span>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span class="la {{ $i <= $course->average_rating ? 'la-star' : 'la-star-o' }}"></span>
                                        @endfor
                                    </div>
                                    <span class="rating-total pl-1">({{ $course->reviews_count }})</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="card-price text-black font-weight-bold">
                                        @if ($course->discount_price)
                                            {{ $course->discount_price }} DH 
                                            <span class="before-price font-weight-medium">{{ $course->selling_price }} DH</span>
                                        @else
                                            {{ $course->selling_price }} DH
                                        @endif
                                    </p>
                                    <div class="icon-element icon-element-sm shadow-sm wishlist-icon" 
                                         data-course-id="{{ $course->id }}"
                                         onclick="toggleWishlist(this)">
                                        <i class="la la-heart-o"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="text-center pt-3">
                    {{ $courses->links('vendor.pagination.custom') }}
                    <p class="fs-14 pt-2">
                        Showing {{ $courses->firstItem() }}-{{ $courses->lastItem() }} 
                        of {{ $courses->total() }} results
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchCourse');
    const courseCards = document.querySelectorAll('.course-card');
    const courseContainer = document.getElementById('courseContainer');
    const courseCountSpan = document.querySelector('.course-count');

    function updateCourseCount() {
        const visibleCourses = document.querySelectorAll('.course-card:not([style*="display: none"])');
        courseCountSpan.textContent = visibleCourses.length;
    }

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        courseCards.forEach(card => {
            const title = card.querySelector('.card-title').textContent.toLowerCase();
            const instructor = card.querySelector('.card-text').textContent.toLowerCase();
            
            if (title.includes(searchTerm) || instructor.includes(searchTerm)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
        
        updateCourseCount();
    });

    // Rating filter
    const ratingInputs = document.querySelectorAll('.rating-filter');
    ratingInputs.forEach(input => {
        input.addEventListener('change', function() {
            const selectedRating = parseFloat(this.value);
            
            courseCards.forEach(card => {
                const rating = parseFloat(card.dataset.rating);
                card.style.display = rating >= selectedRating ? '' : 'none';
            });
            
            updateCourseCount();
        });
    });

    // Level filter
    const levelInputs = document.querySelectorAll('.level-filter');
    levelInputs.forEach(input => {
        input.addEventListener('change', function() {
            const checkedLevels = Array.from(levelInputs)
                .filter(input => input.checked)
                .map(input => input.value.toLowerCase());

            if (checkedLevels.length === 0 || checkedLevels.includes('tous les niveaux')) {
                courseCards.forEach(card => card.style.display = '');
            } else {
                courseCards.forEach(card => {
                    const level = card.dataset.level.toLowerCase();
                    card.style.display = checkedLevels.includes(level) ? '' : 'none';
                });
            }
            
            updateCourseCount();
        });
    });

    // Sorting functionality
    const sortSelect = document.getElementById('sortCourses');
    sortSelect.addEventListener('change', function() {
        const cards = Array.from(courseCards);
        const sortBy = this.value;

        cards.sort((a, b) => {
            switch(sortBy) {
                case 'newest':
                    return new Date(b.dataset.date) - new Date(a.dataset.date);
                case 'oldest':
                    return new Date(a.dataset.date) - new Date(b.dataset.date);
                case 'price-high-low':
                    return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
                case 'price-low-high':
                    return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
                case 'rating-high-low':
                    return parseFloat(b.dataset.rating) - parseFloat(a.dataset.rating);
                default:
                    return 0;
            }
        });

        cards.forEach(card => courseContainer.appendChild(card));
    });

    // Wishlist functionality
    function toggleWishlist(element) {
        const courseId = element.dataset.courseId;
        element.classList.toggle('wishlist-active');
        
        // You can add AJAX call here to update wishlist in backend
        if (element.classList.contains('wishlist-active')) {
            element.querySelector('i').classList.remove('la-heart-o');
            element