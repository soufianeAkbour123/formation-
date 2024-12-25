{{-- /// Start Wishlist Add Option // --}}
<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function addToWishList(course_id) {
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "/add-to-wishlist/" + course_id,
        success: function(data) {
            // Start Message
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 6000
            });

            if ($.isEmptyObject(data.error)) {
                // Changement de la couleur du cœur en vert
                $([id='${course_id}']).find('i').removeClass('la-heart-o').addClass('la-heart');
                $([id='${course_id}']).find('i').css('color', '#28a745');
                
                Toast.fire({
                    icon: 'success',
                    title: data.success
                });
            } else {
                Toast.fire({
                    icon: 'error',
                    title: data.error
                });
            }
            // End Message
        }
    });
}
   
</script>
{{-- /// End Wishlist Add Option // --}}

{{-- /// Start Load Wishlist Data // --}}
<script type="text/javascript">

    function wishlist() {
    $.ajax({
        type: "GET",
        dataType: 'json',
        url: "/get-wishlist-course/",
        success: function(response) {
            $('#wishQty').text(response.wishQty);
            var rows = "";
            $.each(response.wishlist, function(key, value) {
                // Préparer l'affichage du prix
                let priceHTML = '';
                if (value.course.discount_price == null) {
                    priceHTML = `<p class="card-price text-black font-weight-bold">${value.course.selling_price} DHS</p>`;
                } else {
                    priceHTML = `<p class="card-price text-black font-weight-bold">${value.course.discount_price}DHS <span class="before-price font-weight-medium">${value.course.selling_price} DHS</span></p>`;
                }

                rows += `
                    <div class="col-lg-4 responsive-column-half">
                        <div class="card card-item">
                            <div class="card-image">
                                <a href="/course/details/${value.course.id}/${value.course.course_name_slug}" class="d-block">
                                    <img class="card-img-top" src="/${value.course.course_image}" alt="Card image cap">
                                </a>
                            </div>
                            
                            <div class="card-body">
                                <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">${value.course.label}</h6>
                                <h5 class="card-title">
                                    <a href="/course/details/${value.course.id}/${value.course.course_name_slug}">${value.course.course_name}</a>
                                </h5>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    ${priceHTML}
                                    <div class="icon-element icon-element-sm shadow-sm cursor-pointer" 
                                         data-toggle="tooltip" 
                                         data-placement="top" 
                                         title="Remove from Wishlist" 
                                         id="${value.id}" 
                                         onclick="wishlistRemove(this.id)">
                                        <i class="la la-heart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });
            $('#wishlist').html(rows);
            // Réinitialiser les tooltips après avoir ajouté le contenu
            $('[data-toggle="tooltip"]').tooltip();
        }
    });
}

    /// WishList Remove Start  ///
    function wishlistRemove(id) {
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "/wishlist-remove/" + id,
            success: function(data) {
                wishlist(); // Recharger la wishlist après suppression
                // Start Message
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 6000
                });

                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        icon: 'success',
                        title: data.success
                    });
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: data.error
                    });
                }
                // End Message
            }
        });
    }
    /// End WishList Remove ///
    // Document Ready Function pour s'assurer que tout est chargé
$(document).ready(function() {
    // Initialiser la wishlist
    wishlist();

    // Initialiser les tooltips Bootstrap
    $('[data-toggle="tooltip"]').tooltip();
});

// Fonction pour charger la wishlist
function wishlist() {
    $.ajax({
        type: "GET",
        dataType: 'json',
        url: "/get-wishlist-course/",
        success: function(response) {
            // Mettre à jour le compteur de wishlist
            $('#wishQty').text(response.wishQty);
            
            var rows = "";
            $.each(response.wishlist, function(key, value) {
                // Préparer l'affichage du prix
                let priceHTML = '';
                if (value.course.discount_price == null) {
                    priceHTML = `<p class="card-price text-black font-weight-bold">${value.course.selling_price} DHS</p>`;
                } else {
                    priceHTML = `<p class="card-price text-black font-weight-bold">${value.course.discount_price}DHS <span class="before-price font-weight-medium">${value.course.selling_price} DHS</span></p>`;
                }

                // Construire la carte du cours
                rows += `
                    <div class="col-lg-4 responsive-column-half">
                        <div class="card card-item">
                            <div class="card-image">
                                <a href="/course/details/${value.course.id}/${value.course.course_name_slug}" class="d-block">
                                    <img class="card-img-top" src="/${value.course.course_image}" alt="${value.course.course_name}">
                                </a>
                            </div>
                            
                            <div class="card-body">
                                <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">${value.course.label}</h6>
                                <h5 class="card-title">
                                    <a href="/course/details/${value.course.id}/${value.course.course_name_slug}">
                                        ${value.course.course_name}
                                    </a>
                                </h5>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    ${priceHTML}
                                    <div class="icon-element icon-element-sm shadow-sm cursor-pointer" 
                                         data-toggle="tooltip" 
                                         data-placement="top" 
                                         title="Retirer de la liste des favoris" 
                                         id="${value.id}" 
                                         onclick="wishlistRemove(this.id)">
                                        <i class="la la-heart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            // Mettre à jour le contenu de la wishlist
            $('#wishlist').html(rows);
            
            // Réinitialiser les tooltips
            $('[data-toggle="tooltip"]').tooltip();
        },
        error: function(xhr, status, error) {
            console.error("Erreur lors du chargement de la wishlist:", error);
            // Afficher un message d'erreur à l'utilisateur
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            
            Toast.fire({
                icon: 'error',
                title: 'Erreur lors du chargement de la liste des favoris'
            });
        }
    });
}

// Fonction pour ajouter à la wishlist
function addToWishlist(course_id) {
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "/add-to-wishlist/" + course_id,
        success: function(data) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            
            if ($.isEmptyObject(data.error)) {
                Toast.fire({
                    icon: 'success',
                    title: data.success
                });
                // Recharger la wishlist
                wishlist();
            } else {
                Toast.fire({
                    icon: 'error',
                    title: data.error
                });
            }
        },
        error: function(xhr, status, error) {
            console.error("Erreur lors de l'ajout à la wishlist:", error);
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            
            Toast.fire({
                icon: 'error',
                title: 'Erreur lors de l\'ajout aux favoris'
            });
        }
    });
}

// Fonction pour supprimer de la wishlist
function wishlistRemove(id) {
    // Confirmation avant suppression
    Swal.fire({
        title: 'Êtes-vous sûr?',
        text: "Voulez-vous retirer ce cours de vos favoris?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui, retirer!',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/wishlist-remove/" + id,
                success: function(data) {
                    // Recharger la wishlist
                    wishlist();
                    
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            icon: 'success',
                            title: data.success
                        });
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: data.error
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Erreur lors de la suppression:", error);
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    
                    Toast.fire({
                        icon: 'error',
                        title: 'Erreur lors de la suppression'
                    });
                }
            });
        }
    });
}
</script>
{{-- /// End Load Wishlist Data // --}}




{{--//////start add to cart ///--}}
<script type="text/javascript">

    function addToCart(courseId, courseName, instructorId,slug ){
        $.ajax({
            type:"POST",
            dataType:'json',
            data: {
                _token: '{{csrf_token() }}',
                course_name: courseName,
                course_name_slug : slug,
                instructor:instructorId
            },

            url:"/cart/data/store/"+courseId,
            success: function(data){
                miniCart();

                // Start Message 

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            if ($.isEmptyObject(data.error)) {
                Toast.fire({
                    icon: 'success', 
                    title: data.success
                });
            } else {
                Toast.fire({
                    icon: 'error', 
                    title: data.error
                });
            }

            // End Message  

            }
        });
    }

</script>
{{--//////end add to cart ///--}}

{{--//////start mini to cart ///--}}
<script type="text/javascript">

    function miniCart() {
        $.ajax({
            type: 'GET',
            url:'/course/mini/cart',
            dataType: 'json',
            success:function(response){

                $('span[id="cartSubTotal"]').text(response.cartTotal);
                $('#cartQty').text(response.cartQty);

                var miniCart =""
                

                $.each(response.carts,function(key,value){
                    miniCart +=`
                        <li class="media media-card">
                            <a href="shopping-cart.html" class="media-img">
                                <img src="/${value.options.image}" alt="Cart image">
                            </a>
                            <div class="media-body">
                                <h5><a href="/course/details/${value.id}/${value.
                                options.slug}">${value.name}</a></h5>
                                
                                 <span class="d-block fs-14">${value.price}DHS</span>
                                 <a type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="la la-times"></i></a>
                            </div>
                        </li>

                    `
                });
                $('#miniCart').html(miniCart);

            }
        })
        
    }
    miniCart();


    ///mini cart remove sstart///

    function miniCartRemove(rowId){
        $.ajax({
            type:'GET',
            url:'/minicart/course/remove/'+rowId,
            dataType:'json',
            success:function(data){
                miniCart();
                   // Start Message 

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            if ($.isEmptyObject(data.error)) {
                Toast.fire({
                    icon: 'success', 
                    title: data.success
                });
            } else {
                Toast.fire({
                    icon: 'error', 
                    title: data.error
                });
            }

            // End Message  
                
            }
        });
    }
    //end mini cart///

</script>

{{--//////end mini to cart ///--}}

{{--//////start  Mycart ///--}}
<script type="text/javascript">

    function cart() {
        $.ajax({
            type: 'GET',
            url: '/get-cart-course',
            dataType: 'json',
            success: function(response) {

                // Mettre à jour le sous-total du panier
                $('span[id="cartSubtotal"]').text(response.cartTotal);

                var rows = "";
                $.each(response.carts, function(key, value) {
                    rows += `
                        <tr>
                            <th scope="row">
                                <div class="media media-card">
                                    <a href="course-details.html" class="media-img mr-0">
                                        <img src="/${value.options.image}" alt="Cart image">
                                    </a>
                                </div>
                            </th>
                            <td>
                                <a href="/course/details/${value.id}/${value.options.slug}" class="text-black font-weight-semi-bold">${value.name}</a>
                            </td>
                            <td>
                                <ul class="generic-list-item font-weight-semi-bold">
                                    <li class="text-black lh-18">${value.price} DHS</li>
                                </ul>
                            </td>
                            <td>
                                <button type="button" class="icon-element icon-element-xs shadow-sm border-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove" id="${value.rowId}" 
                                    onclick="cartRemove(this.id)">
                                    <i class="la la-times"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                });

                // Injecter les lignes dans le tableau avec l'ID cartPage
                $('#cartPage').html(rows);
            },
            error: function(xhr, status, error) {
                console.error('Erreur lors de la récupération du panier:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Impossible de charger le panier pour le moment.'
                });
            }
        });
    }
    cart();

    // My Cart Remove Start
    function cartRemove(rowId) {
        $.ajax({
            type: 'GET',
            url: '/cart-remove/' + rowId,
            dataType: 'json',
            success: function(data) {
                miniCart(); // Mettre à jour le mini panier
                cart(); // Recharger le panier
                couponCalculation(); 

                // Start Message
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000 
                });

                if (data.success) { // Vérification correcte pour 'success'
                    Toast.fire({
                        icon: 'success',
                        title: data.success
                    });
                } else if (data.error) {
                    Toast.fire({
                        icon: 'error',
                        title: data.error
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Erreur lors de la suppression du produit:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Un problème est survenu lors de la suppression du produit.'
                });
            }
        });
    }
    // End My Cart Remove

</script>
{{--//////end  Mycart ///--}}


{{-- /// Apply Coupon Start  // --}}
 <script type="text/javascript">
  function applyCoupon() {
    var coupon_name = $('#coupon_name').val();
    
    if (!coupon_name) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: 'Veuillez entrer un code promo',
            showConfirmButton: false,
            timer: 3000
        });
        return;
    }

    // Désactiver le bouton pendant la requête
    $('#apply-coupon-btn').prop('disabled', true);

    $.ajax({
        type: "POST",
        dataType: 'json',
        data: {
            coupon_name: coupon_name,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        url: "/coupon-apply",
        success: function(data) {
            if (data.validity === true) {
                $('#couponField').hide();
                couponCalculation();
                
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: data.success,
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', xhr.responseText);
            let errorMessage = 'Une erreur est survenue';
            
            if (xhr.responseJSON && xhr.responseJSON.error) {
                errorMessage = xhr.responseJSON.error;
            }
            
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: errorMessage,
                showConfirmButton: false,
                timer: 3000
            });
        },
        complete: function() {
            // Réactiver le bouton après la requête
            $('#apply-coupon-btn').prop('disabled', false);
        }
    });
}

function couponCalculation() {
    $.ajax({
        type: 'GET',
        url: "/coupon-calculation",
        dataType: 'json',
        success: function(data) {
            if (data.error) {
                console.error('Calculation Error:', data.error);
                return;
            }

            let html = `
                <h3 class="fs-18 font-weight-bold pb-3">Totaux de panier</h3>
                <div class="divider"><span></span></div>
                <ul class="generic-list-item pb-4">
            `;
            
            if (data.total) {
                html += `
                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                        <span class="text-black">Sous-total:</span>
                        <span>${data.total} DHS</span>
                    </li>
                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                        <span class="text-black">Total:</span>
                        <span>${data.total} DHS</span>
                    </li>
                `;
            } else {
                html += `
                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                        <span class="text-black">Sous-total:</span>
                        <span>${data.subtotal} DHS</span>
                    </li>
                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                        <span class="text-black">Code Promo:</span>
                        <span>${data.coupon_name} 
                            <button type="button" class="icon-element icon-element-xs shadow-sm border-0" onclick="couponRemove()">
                                <i class="la la-times"></i>
                            </button>
                        </span>
                    </li>
                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                        <span class="text-black">Réduction:</span>
                        <span>${data.discount_amount} DHS</span>
                    </li>
                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                        <span class="text-black">Total général:</span>
                        <span>${data.total_amount} DHS</span>
                    </li>
                `;
            }
            
            html += `</ul>`;
            $('#couponCalField').html(html);
        },
        error: function(xhr, status, error) {
            console.error('Calculation Error:', error);
            console.error('Response:', xhr.responseText);
        }
    });
}

// Assurez-vous d'avoir le token CSRF dans votre page
function couponRemove() {
    $.ajax({
        type: "GET",
        url: '/coupon-remove',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            $('#couponField').show();
            couponCalculation();
            
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: data.success,
                showConfirmButton: false,
                timer: 3000
            });
        },
        error: function(xhr, status, error) {
            console.error('Remove Error:', error);
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'Erreur lors de la suppression du coupon',
                showConfirmButton: false,
                timer: 3000
            });
        }
    });
}

// Initialisation au chargement de la page
$(document).ready(function() {
    couponCalculation();
});
</script>
{{-- /// End Remove Coupon  // --}}



<Script>
function applyPromo() {
    var promo_name = $('#promo_name').val();

    if (!promo_name) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: 'Veuillez entrer un code promo',
            showConfirmButton: false,
            timer: 3000
        });
        return;
    }

    $.ajax({
        type: "POST",
        dataType: 'json',
        data: {
            promo_name: promo_name,
            _token: '{{ csrf_token() }}'
        },
        url: "{{ url('/promo-remove') }}",
        success: function(data) {
            if (data.validity === true) {
                calculatePromo();
            } else {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: data.error,
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        }
    });
}

function removePromo() {
    $.ajax({
        type: 'GET',
        url: "{{ url('/promo-remove') }}",
        dataType: 'json',
        success: function(data) {
            calculatePromo();
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: data.success,
                showConfirmButton: false,
                timer: 3000
            });
        }
    });
}

function calculatePromo() {
    $.ajax({
        type: 'GET',
        url: "{{ route('promo.calculate') }}",
        dataType: 'json',
        success: function(data) {
            var html = `
                <h3 class="fs-18 font-weight-bold pb-3">Totaux du panier</h3>
                <div class="divider"><span></span></div>
                <ul class="generic-list-item pb-4">
                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                        <span class="text-black">Sous-total:</span>
                        <span>${data.subtotal} DHS</span>
                    </li>`;

            if (data.promo_code) {
                html += `
                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                        <span class="text-black">Code Promo (${data.promo_code}):</span>
                        <span>-${data.discount_amount} DHS</span>
                    </li>
                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                        <span class="text-black">Réduction:</span>
                        <span>${data.promo_discount}%</span>
                    </li>`;
            }

            html += `
                    <li class="d-flex align-items-center justify-content-between font-weight-bold">
                        <span class="text-black">Total:</span>
                        <span>${data.total_amount || data.total} DHS</span>
                    </li>
                </ul>`;

            $('#promoCalField').html(html);
        }
    });
}

$(document).ready(function() {
    calculatePromo();
});


function promoCalculation() {
    $.ajax({
        type: 'GET',
        url: "/promo-calculation",
        dataType: 'json',
        success: function(data) {
            let html = `
                <h3 class="fs-18 font-weight-bold pb-3">Totaux du panier</h3>
                <div class="divider"><span></span></div>
                <ul class="generic-list-item pb-4">
                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                        <span class="text-black">Sous-total:</span>
                        <span>${data.subtotal} DHS</span>
                    </li>`;

            if (data.promo_code) {
                html += `
                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                        <span class="text-black">Code Promo (${data.promo_code}):</span>
                        <span>-${data.discount_amount} DHS</span>
                    </li>
                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                        <span class="text-black">Réduction:</span>
                        <span>${data.promo_discount}%</span>
                    </li>`;
            }

            html += `
                    <li class="d-flex align-items-center justify-content-between font-weight-bold">
                        <span class="text-black">Total:</span>
                        <span>${data.total_amount || data.total} DHS</span>
                    </li>
                </ul>`;

            $('#promoCalField').html(html);
        }
    });
}

// Fonction pour supprimer le code promo
function removePromo() {
    $.ajax({
        type: 'GET',
        url: '/promo-remove',
        dataType: 'json',
        success: function(data) {
            $('#promoField').show();
            promoCalculation();
            
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Code promo supprimé',
                showConfirmButton: false,
                timer: 3000
            });
        }
    });
}

// Initialiser le calcul au chargement de la page
$(document).ready(function() {
    promoCalculation();
});
function promoCalculation() {
    $.ajax({
        type: 'GET',
        url: "/promo-calculation",
        dataType: 'json',
        success: function(data) {
            console.log(data);  // Affiche les données dans la console pour vérifier

            if (data.promo_code) {
                // Si un code promo a été appliqué, afficher les informations avec la réduction
                $('#promoCalField').html(
                    `<h3 class="fs-18 font-weight-bold pb-3">Cart Totals</h3>
                    <div class="divider"><span></span></div>
                    <ul class="generic-list-item pb-4">
                        <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                            <span class="text-black">Subtotal:</span>
                            <span>${data.subtotal} DHS</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                            <span class="text-black">Promo Code:</span>
                            <span>${data.promo_code}</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                            <span class="text-black">Promo Discount:</span>
                            <span>${data.promo_discount}%</span>
                        </li>
                         <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                            <span class="text-black">Prix Reduit:</span>
                            <span>-${data.discount_amount}DHS</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                            <span class="text-black">Grand Total:</span>
                            <span>${data.total_amount} DHS</span>
                        </li>
                    </ul>`
                );
            } else {
                // Si aucun code promo n'a été appliqué, afficher seulement le Subtotal et Total sans réduction
                $('#promoCalField').html(
                    `<h3 class="fs-18 font-weight-bold pb-3">Cart Totals</h3>
                    <div class="divider"><span></span></div>
                    <ul class="generic-list-item pb-4">
                        <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                            <span class="text-black">Subtotal:</span>
                            <span>${data.subtotal} DHS</span>
                        </li>
                        <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                            <span class="text-black">Total:</span>
                            <span>${data.subtotal} DHS</span>
                        </li>
                    </ul>`
                );
            }
        }
    });
}

promoCalculation();




</Script>