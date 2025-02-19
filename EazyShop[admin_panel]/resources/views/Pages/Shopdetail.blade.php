<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JuttBrand Product-Detail</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"> -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <link rel="stylesheet" href="{{ asset('css/ShopDetail.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Header.css') }}">

  </head>
  <body>

  <div>
    @include('component.header')
  </div>

  <div class="container">
      <div class="product-card">
        <div class="container-fliud">
          <div class="wrapper d-flex flex-sm-row flex-col row">
          <div class="preview col-md-6">
            <div class="preview-pic tab-content">
              <div class="tab-pane active" id="pic-1"><img src="{{ Storage::url($products->image) }}" alt="{{$products->productname}}" /></div>
              <div class="tab-pane" id="pic-2"><img src="{{ Storage::url($products->image) }}" alt="{{$products->productname}}" /></div>
              <div class="tab-pane" id="pic-3"><img src="{{ Storage::url($products->image) }}" alt="{{$products->productname}}" /></div>
            </div>
            <ul class="preview-thumbnail nav nav-tabs">
              <li class="active"><a href="#pic-1" data-toggle="tab"><img src="{{ Storage::url($products->image) }}" alt="{{$products->productname}}" /></a></li>
              <li><a href="#pic-2" data-toggle="tab"><img src="{{ Storage::url($products->image) }}" alt="{{$products->productname}}" /></a></li>
              <li><a href="#pic-3" data-toggle="tab"><img src="{{ Storage::url($products->image) }}" alt="{{$products->productname}}" /></a></li>
            </ul>
          </div>

            <div class="details col-md-6">
              <h3 class="product-title">{{$products->productname}}</h3>
              <div class="rating">
                <div class="stars">
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span>
                </div>
                <span class="review-no">41 reviews</span>
              </div>
              <p class="product-description">{{$products->productdescription}}</p>
              <h4 class="price">Price: <span>${{$products->totalprice}}</span></h4>
              <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>

              <h5 class="sizes">Sizes:
                <button class="size btn-sm btn-outline-light size-btn rounded-1 shadow-none" data-toggle="tooltip" title="small" onclick="selectSize('small(S)')">S</button>
                <button class="size btn-sm btn-outline-light size-btn rounded-1 shadow-none" data-toggle="tooltip" title="medium" onclick="selectSize('medium(M)')">M</button>
                <button class="size btn-sm btn-outline-light size-btn rounded-1 shadow-none" data-toggle="tooltip" title="large" onclick="selectSize('large(L)')">L</button>
                <button class="size btn-sm btn-outline-light size-btn rounded-1 shadow-none" data-toggle="tooltip" title="xtra large" onclick="selectSize('Extra-large(xl)')">XL</button>
              </h5>

              <input type="hidden" id="selectedSize" name="size">

              <h5 class="quantity d-flex flex-row">
                <div class="quantity-input rounded-1">
                  <button class="quantity-btn border-0" id="decrementBtn" onclick="qntyDecreaser()">-</button>
                    <input type="number" id="quantity" name="quantity" readonly value="1" min="1" step="1">
                  <button class="quantity-btn border-0" id="incrementBtn" onclick="qntyIncreaser()">+</button>
                </div>
              </h5>

              <div class="action">
                <button class="add-cart-btn btn btn-block my-2 text-white btn rounded-0" type="button" style="background-color:#fa561b; border:none; text-transform:uppercase">Buy now</button>
                <button class="add-cart-btn btn btn-block my-2 text-white btn rounded-0" type="button" style="background-color:#343434; border:none; text-transform:uppercase">Add to cart</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="my-5 text-center">
        <div class="position-relative d-inline-block">
          <hr class="w-75 mx-auto" style="border: 0; height: 3px; background: linear-gradient(to right, transparent, #343434, transparent);">
          <h4 class="fw-bold text-uppercase position-relative" style="color: #343434; background: #fff; display: inline-block; padding: 0 1rem; transform: translateY(-50%);">
            More to Explore
          </h4>
        </div>
      </div>


      <div class="row other-product-cards row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
          @foreach ($otherProducts as $otherProduct)
              @if ($otherProduct->category == 'Featured' || 'Top')
                  <div class="col-lg-3 col-md-4 col-6  my-2">
                      <div class="related-product-card related-card shadow-lg rounded-2 overflow-hidden">
                          <a href="{{ route('product.detail', $otherProduct->id) }}"><img src="{{ Storage::url($otherProduct->image) }}" alt="{{ $otherProduct->productname }}" class="card-img-top"></a>
                          <div class="card-body text-center">
                              <a class="card-title" href="{{ route('product.detail', $otherProduct->id) }}"><p class="card-title">{{ $otherProduct->productname }}</p></a>
                              <p class="card-text fw-bold text-warning">${{ $otherProduct->totalprice }}</p>
                              <button class="btn btn-warning-cart d-flex justify-content-between align-items-center">
                                  <small>Shop Now</small>
                                  <span class="material-icons">shopping_cart</span>
                              </button>
                          </div>
                      </div>
                  </div>
              @endif
          @endforeach
      </div>
    </div>


  </body>
  
  <script>
    function selectSize(size) {
      // Store the selected size in the hidden input field
      document.getElementById("selectedSize").value = size;

      // Optionally, you can also visually highlight the selected size
      // Remove any active class from other buttons
      var buttons = document.querySelectorAll('.size');
      buttons.forEach(function(button) {
          button.classList.remove('active');
      });

      // Add the active class to the clicked button to show the selection visually
      var selectedButton = document.querySelector(`button[onclick="selectSize('${size}')"]`);
      selectedButton.classList.add('active');
    }

    function qntyIncreaser(){
      let qnty_value = parseInt(document.getElementById('quantity').value);
      if(qnty_value == 5)
      {
        qnty_value = 5;
      }
      else{
        qnty_value = qnty_value + 1;
      }
      document.getElementById('quantity').value = qnty_value;
    }

    function qntyDecreaser(){
      let qnty_value = parseInt(document.getElementById('quantity').value);
      if(qnty_value == 1)
      {
        qnty_value = 1;
      }
      else{
        qnty_value = qnty_value - 1;
      }
      document.getElementById('quantity').value = qnty_value;
    }

  </script>

</html>
