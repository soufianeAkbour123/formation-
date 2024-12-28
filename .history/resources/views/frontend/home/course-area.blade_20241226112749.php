@php
    $courses = App\Models\Course::where('status',1)->orderBy('id','ASC')->limit(6)->get();
    $categories = App\Models\Category::orderBy('category_name','ASC')->limit(4)->get();
@endphp
<STYle>
    .card {
  height: 510px; /* Ajuster cette valeur selon vos besoins */
  display: flex;
  flex-direction: column;
}

.card-body {
  flex-grow: 1;
}
/* Mobile */
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

/* Tablette */
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
</STYle>
<section class="course-area pb-120px">
    <div class="container">
        <div class="section-heading text-center">
            <h5 class="ribbon ribbon-lg mb-2">Choisissez vos formations désirées</h5>
            <h2 class="section__title">La plus grande sélection de cours au monde</h2>
            <span class="section-divider"></span>
        </div><!-- end section-heading -->

        <ul class="nav nav-tabs generic-tab justify-content-center pb-4" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="business-tab" data-toggle="tab" href="#business" role="tab" aria-controls="business" aria-selected="true">Tout</a>
            </li>
            @foreach ($categories as $category) 

            <li class="nav-item">
                <a class="nav-link" id="business-tab" data-toggle="tab" href="#business{{ $category->id }}" role="tab" aria-controls="business" aria-selected="false">{{ $category->category_name }}</a>
            </li>
            @endforeach

        </ul>
    </div><!-- end container -->


    <div class="card-content-wrapper bg-gray pt-50px pb-120px">
        <div class="container">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="business" role="tabpanel" aria-labelledby="business-tab">
                    <div class="row">

      @foreach ($courses as $course) 

      <div class="col-lg-3 responsive-column-half position-relative">
      <div class="card card-item card-preview" data-tooltip-content="#tooltip_content_1{{ $course->id }}">
            <div class="card-image">
            <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" class="d-block">
                    <img class="card-img-top lazy" src="{{ asset($course->course_image) }}" data-src="images/img8.jpg" alt="Card image cap">
                </a>


    @php
        $amount = $course->selling_price - $course->discount_price;
        $discount = ($amount/$course->selling_price) * 100;
    @endphp

                <div class="course-badge-labels">

                    @if ($course->bestseller == 1)
                    <div class="course-badge">Meilleure Vente</div>
                    @else
                    @endif

                    @if ($course->highestrated == 1)
                    <div class="course-badge sky-blue">Le Mieux Noté</div>
                    @else
                    @endif

                    @if ($course->discount_price == NULL)
                    <div class="course-badge blue">Nouveau</div>
                    @else
                    <div class="course-badge blue">{{ round($discount) }}%</div>
                    @endif



                </div>
            </div><!-- end card-image -->
            @php
            $reviewcount = App\Models\Review::where('course_id',$course->id)->where('status',1)->latest()->get();
            $avarage = App\Models\Review::where('course_id',$course->id)->where('status',1)->avg('rating');
     
        @endphp   

            <div class="card-body">
                <h6 class="ribbon ribbon-blue-bg fs-14 mb-3"> @if ($course->label == 'Begginer')
        Débutant
    @elseif ($course->label == 'Middle')
        Intermédiaire
    @elseif ($course->label == 'Advance')
        Avancé
    @else
        {{ $course->label }}
    @endif</h6>
                
                <h5 class="card-title"><a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}">{{ $course->course_name }}</a></h5>
                <p class="card-text"><a href="{{ route('instructor.details',$course->instructor_id) }}">{{ $course['user']['name'] }}</a></p>
                <div class="rating-wrap d-flex align-items-center py-2">
                    <div class="review-stars">
                              <span class="rating-number">{{ round($avarage,1) }}</span>
                        @if ($avarage == 0)
                            <span class="la la-star-o"></span>
                            <span class="la la-star-o"></span>
                            <span class="la la-star-o"></span>
                            <span class="la la-star-o"></span>
                            <span class="la la-star-o"></span>
                            @elseif ($avarage == 1 || $avarage < 2)
                            <span class="la la-star"></span>
                            <span class="la la-star-o"></span>
                            <span class="la la-star-o"></span>
                            <span class="la la-star-o"></span>
                            <span class="la la-star-o"></span>
                            @elseif ($avarage == 2 || $avarage < 3)
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            <span class="la la-star-o"></span>
                            <span class="la la-star-o"></span>
                            <span class="la la-star-o"></span>
                            @elseif ($avarage == 3 || $avarage < 4)
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            <span class="la la-star-o"></span>
                            <span class="la la-star-o"></span>
                            @elseif ($avarage == 4 || $avarage < 5)
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            <span class="la la-star-o"></span>
                            @elseif ($avarage == 5 || $avarage < 5)
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            @endif 
                    </div>
                    <span class="rating-total pl-1">({{ count($reviewcount) }})</span>
                </div><!-- end rating-wrap -->
                <div class="d-flex justify-content-between align-items-center">
    @if ($course->discount_price == NULL)
    <p class="card-price text-black font-weight-bold">{{ $course->selling_price }} DH</p>
    @else
    <p class="card-price text-black font-weight-bold">{{ $course->discount_price }} DH <span class="before-price font-weight-medium">{{ $course->selling_price }} DH</span></p> 
    @endif

    <div class="d-flex align-items-center">
        <!-- Icon to view course details -->
        <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" 
           class="icon-element icon-element-sm shadow-sm mr-2 cursor-pointer" 
           title="Voir les détails du cours">
            <i class="la la-eye"></i>
        </a>

        <!-- Icon to add to cart -->
        <div class="icon-element icon-element-sm shadow-sm cursor-pointer" 
             title="Ajouter au panier"
             onclick="addToCart({{$course->id}} , '{{$course->course_name}}', '{{$course->instructor_id}}', '{{$course->course_name_slug}}')">
            <i class="la la-shopping-cart"></i>
        </div>

        <!-- Existing wishlist icon -->
        <div class="icon-element icon-element-sm shadow-sm ml-2 cursor-pointer" 
             title="Ajouter aux favoris" 
             id="{{ $course->id }}" 
             onclick="addToWishList(this.id)">
            <i class="la la-heart-o"></i>
        </div>
    </div>



<style>
.cart-icon-wrapper {
    background-color: #f0f0f0;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}
.cart-icon {
    color: #333;
    font-size: 20px;
    cursor: pointer;
}
.cart-icon-wrapper:hover {
    background-color: #007bff;
    color: white;
}
.cart-icon-wrapper:hover .cart-icon {
    color: white;
}
</style>



                    
                    
                    <style>
    .la-heart {
    color: #28a745; /* couleur verte */
}

.la-heart-o {
    color: initial; /* couleur par défaut */
}
</style>
                </div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col-lg-4 -->
    @endforeach   



                    </div><!-- end row -->
                </div><!-- end tab-pane -->


                @foreach ($categories as $category) 
<div class="tab-pane fade" id="business{{ $category->id }}" role="tabpanel" aria-labelledby="business-tab">
    <div class="row">
        @php
            $catwiseCourse = App\Models\Course::where('category_id',$category->id)->where('status',1)->orderBy('id','DESC')->get();
        @endphp                      
        
        @forelse ($catwiseCourse as $course)
        @php
            $amount = $course->selling_price - $course->discount_price;
            $discount = ($amount/$course->selling_price) * 100;
            $reviewcount = App\Models\Review::where('course_id',$course->id)->where('status',1)->latest()->get();
            $avarage = App\Models\Review::where('course_id',$course->id)->where('status',1)->avg('rating');
        @endphp
        <div class="col-lg-4 responsive-column-half position-relative">
            <div class="card card-item card-preview" data-tooltip-content="#tooltip_content_1{{ $course->id }}">
                <div class="card-image">
                    <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" class="d-block">
                        <img class="card-img-top lazy" src="{{ asset($course->course_image) }}" data-src="images/img8.jpg" alt="Card image cap">
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
                            <div class="course-badge blue">{{ round($discount) }}%</div>
                        @endif
                    </div>
                </div><!-- end card-image -->
                <div class="card-body">
                    <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">
                        @if ($course->label == 'Begginer')
                            Débutant
                        @elseif ($course->label == 'Middle')
                            Intermédiaire
                        @elseif ($course->label == 'Advance')
                            Avancé
                        @else
                            {{ $course->label }}
                        @endif
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
                            @if ($avarage == 0)
                                <span class="la la-star-o"></span>
                                <span class="la la-star-o"></span>
                                <span class="la la-star-o"></span>
                                <span class="la la-star-o"></span>
                                <span class="la la-star-o"></span>
                            @elseif ($avarage == 1 || $avarage < 2)
                                <span class="la la-star"></span>
                                <span class="la la-star-o"></span>
                                <span class="la la-star-o"></span>
                                <span class="la la-star-o"></span>
                                <span class="la la-star-o"></span>
                            @elseif ($avarage == 2 || $avarage < 3)
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star-o"></span>
                                <span class="la la-star-o"></span>
                                <span class="la la-star-o"></span>
                            @elseif ($avarage == 3 || $avarage < 4)
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star-o"></span>
                                <span class="la la-star-o"></span>
                            @elseif ($avarage == 4 || $avarage < 5)
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star-o"></span>
                            @elseif ($avarage == 5 || $avarage < 5)
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                                <span class="la la-star"></span>
                            @endif 
                        </div>
                        <span class="rating-total pl-1">({{ count($reviewcount) }})</span>
                    </div><!-- end rating-wrap -->
                    <div class="d-flex justify-content-between align-items-center">
                        @if ($course->discount_price == NULL)
                            <p class="card-price text-black font-weight-bold">{{ $course->selling_price }} DH</p>
                        @else
                            <p class="card-price text-black font-weight-bold">{{ $course->discount_price }} DH
                                <span class="before-price font-weight-medium">{{ $course->selling_price }} DH</span>
                            </p> 
                        @endif

                        <div class="d-flex align-items-center">
                            <!-- Icon to view course details -->
                            <a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}" 
                               class="icon-element icon-element-sm shadow-sm mr-2 cursor-pointer" 
                               title="Voir les détails du cours">
                                <i class="la la-eye"></i>
                            </a>

                            <!-- Icon to add to cart -->
                            <div class="icon-element icon-element-sm shadow-sm cursor-pointer" 
                                 title="Ajouter au panier"
                                 onclick="addToCart({{$course->id}}, '{{$course->course_name}}', '{{$course->instructor_id}}', '{{$course->course_name_slug}}')">
                                <i class="la la-shopping-cart"></i>
                            </div>

                            <!-- Wishlist icon -->
                            <div class="icon-element icon-element-sm shadow-sm ml-2 cursor-pointer" 
                                 title="Ajouter aux favoris" 
                                 id="{{ $course->id }}" 
                                 onclick="addToWishList(this.id)">
                                <i class="la la-heart-o"></i>
                            </div>
                        </div>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!-- end col-lg-4 --> 
        
        @empty
            <h5 class="text-danger">Aucun cours trouvé</h5>
        @endforelse
    </div><!-- end row -->
</div><!-- end tab-pane -->
@endforeach 


            </div><!-- end tab-content -->
            <div class="more-btn-box mt-4 text-center">
                <a href="course-grid.html" class="btn theme-btn">Parcourir les formations <i class="la la-arrow-right icon ml-1"></i></a>
            </div><!-- end more-btn-box -->
        </div><!-- end container -->
    </div><!-- end card-content-wrapper -->
    </section>
    @php
    $courseData = App\Models\Course::get();
@endphp
<!-- tooltip_templates -->
@foreach ($courseData as $item)
     
<div class="tooltip_templates">
    <div id="tooltip_content_1{{ $item->id }}">
        <div class="card card-item">
            <div class="card-body">
                <p class="card-text pb-2">By <a href="teacher-detail.html">{{ $item['user']['name'] }}</a></p>
                <h5 class="card-title pb-1"><a href="course-details.html"> {{ $item->course_name }}</a></h5>
                <div class="d-flex align-items-center pb-1">
                    @if ($item->bestseller == 1)
                    <h6 class="ribbon fs-14 mr-2">Bestseller</h6>
                    @else
                    <h6 class="ribbon fs-14 mr-2">New</h6> 
                    @endif
                   
                    <p class="text-success fs-14 font-weight-medium">Updated<span class="font-weight-bold pl-1">{{ $item->created_at->format('M d Y') }}</span></p>
                </div>
                <ul class="generic-list-item generic-list-item-bullet generic-list-item--bullet d-flex align-items-center fs-14">
                    <li>{{ $item->duration }} total hours</li>
                    <li>{{ $item->label }}</li>
                </ul>
                <p class="card-text pt-1 fs-14 lh-22">{{ $item->prerequisites }}</p>
    @php
       $goals = App\Models\Course_goal::where('course_id',$item->id)->orderBy('id','DESC')->get(); 
    @endphp
                <ul class="generic-list-item fs-14 py-3">
                    @foreach ($goals as $goal)
                    <li><i class="la la-check mr-1 text-black"></i> {{ $goal->goal_name }}</li> 
                    @endforeach
                </ul>
                <div class="d-flex justify-content-between align-items-center">
                <button type="submit" class="btn theme-btn flex-grow-1 mr-3" onclick="addToCart({{$item->id }} , '{{$item->course_name }}',
                      '{{$item->instructor_id }}', '{{$item->course_name_slug }}' )" >
                     <i class="la la-shopping-cart mr-1 fs-18"></i> Ajouter au panier</button>
                    <div class="icon-element icon-element-sm shadow-sm cursor-pointer" title="Add to Wishlist"><i class="la la-heart-o"></i></div>
                </div>
            </div>
        </div><!-- end card -->
    </div>
</div><!-- end tooltip_templates -->
@endforeach