@php
    $courses = App\Models\Course::where('status',1)->orderBy('id','ASC')->limit(6)->get();
    $categories = App\Models\Category::orderBy('category_name','ASC')->limit(4)->get();
@endphp
<STYle>
 .row {
    display: flex;
    flex-wrap: wrap; /* Permet le retour à la ligne */
    gap: 20px; /* Espacement entre les cartes */
}

.col-lg-4 {
    flex: 0 0 calc(33.333% - 20px); /* Chaque carte occupe un tiers de la largeur avec un espace */
    display: flex;
    flex-direction: column;
}

.card {
    flex: 1; /* Toutes les cartes ont la même hauteur */
    display: flex;
    flex-direction: column;
}

.card-body {
    flex-grow: 1; /* Remplit l'espace restant de la carte */
}


    .icon-element.active {
    background-color: green;
    color: white;
    
}
@media (max-width: 992px) {
    .col-lg-4 {
        flex: 0 0 calc(50% - 20px); /* Deux colonnes sur tablettes */
    }
}

@media (max-width: 576px) {
    .col-lg-4 {
        flex: 0 0 100%; /* Une colonne sur mobiles */
    }
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

    <div class="col-lg-4 responsive-column-half">
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
            <div class="card-body">
                <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">{{ $course->label }}</h6>
                <h5 class="card-title"><a href="{{ url('course/details/'.$course->id.'/'.$course->course_name_slug) }}">{{ $course->course_name }}</a></h5>
                <p class="card-text"><a href="{{ route('instructor.details',$course->instructor_id) }}">{{ $course['user']['name'] }}</a></p>
                <div class="rating-wrap d-flex align-items-center py-2">
                    <div class="review-stars">
                        <span class="rating-number">4.4</span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star"></span>
                        <span class="la la-star-o"></span>
                    </div>
                    <span class="rating-total pl-1">(350)</span>
                </div><!-- end rating-wrap -->
                <div class="d-flex justify-content-between align-items-center">

                    @if ($course->discount_price == NULL)
                    <p class="card-price text-black font-weight-bold">{{ $course->selling_price }}  DH</p>
                    @else
                    <p class="card-price text-black font-weight-bold">{{ $course->discount_price }} DH <span class="before-price font-weight-medium">{{ $course->selling_price }} DH </span></p> 
                    @endif



                    <div class="icon-element icon-element-sm shadow-sm 
                    cursor-pointer" title="Add to Wishlist" id="{{ $course->id }}" onclick="addToWishList
                    (this.id)"><i class="la la-heart-o"></i></div>
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
        <div class="col-lg-4 responsive-column-half">
            <div class="card card-item card-preview" data-tooltip-content="#tooltip_content_2">
                <div class="card-image">
                    <img class="card-img-top lazy" src="{{ asset($course->course_image) }}" data-src="images/img8.jpg" alt="Card image cap">
                </div><!-- end card-image -->
                <div class="card-body">
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
         <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">{{ $course->label }}</h6>
           <h5 class="card-title"><a href="course-details.html">{{ $course->course_name }}</a></h5>
          <p class="card-text"><a href=" ">{{ $course['user']['name'] }}</a></p>
                    <div class="rating-wrap d-flex align-items-center py-2">
                        <div class="review-stars">
                            <span class="rating-number">4.4</span>
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            <span class="la la-star"></span>
                            <span class="la la-star-o"></span>
                        </div>
                        <span class="rating-total pl-1">(350)</span>
                    </div><!-- end rating-wrap -->
                    <div class="d-flex justify-content-between align-items-center">
                       
                    @if ($course->discount_price == NULL)
                    <p class="card-price text-black font-weight-bold">{{ $course->selling_price }} DH </p>
                    @else
                    <p class="card-price text-black font-weight-bold">{{ $course->discount_price }} DH<span class="before-price font-weight-medium">{{ $course->selling_price }}DH</span></p> 
                    @endif
                        <div class="icon-element icon-element-sm shadow-sm cursor-pointer" title="Add to Wishlist"><i class="la la-heart-o"></i></div>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!-- end col-lg-4 --> 
              
        @empty
        <h5 class="text-danger">Aucun cours trouvé </h5>
              
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