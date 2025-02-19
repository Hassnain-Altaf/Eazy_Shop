<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Product List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=menu" />
    <link rel="stylesheet" href="{{asset('css/Index.css')}}">
    
</head>
<body>

<div>
    @include('component.header')
</div>

<!-- Main Content Section -->
<div class="container py-5">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        <!-- Product Card 1 -->
         @foreach ($products as $product)
            @if ($product->category == 'Featured')
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="product-card card shadow-lg rounded-lg overflow-hidden">
                        <a href="{{ route('product.detail', $product->id) }}"><img src="{{ Storage::url($product->image) }}" alt="{{ $product->productname }}" class="card-img-top"></a>
                        <div class="card-body text-center">
                            <a class="card-title" href="{{ route('product.detail', $product->id) }}"><p class="card-title">{{ $product->productname }}</p></a>
                            <p class="card-text text-warning">${{ $product->totalprice }}</p>

                            <form class="add-to-cart-form" id="addToCartForm-{{ $product->id }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <input type="hidden" name="name" value="{{ $product->productname }}">
                                <input type="hidden" name="price" value="{{ $product->totalprice }}">
                                <input type="hidden" name="image" value="{{ Storage::url($product->image) }}">
                                <button type="button" class="btn btn-warning w-100 d-flex justify-content-between align-items-center add-to-cart-button" data-id="{{ $product->id }}">
                                    <span>Add to cart</span>
                                    <span class="material-icons">shopping_cart</span>
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            @endif
         @endforeach
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-QFsoWXe4+tzVuoZuhqIAtkmFQ4n8AuJddTQoSzjA9z9P1m5j4EzruIjpUB6dI1G5" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-x9PW3hiIp9udecvfUe40RF4iLkCZHK1fbUqkO5UgRbMx7CU6m9K9z8HB7D26hfNx" crossorigin="anonymous"></script>

</body>

<script>
    $(document).ready(function () {
        $('.add-to-cart-button').click(function () {
            var productId = $(this).data('id');
            var formData = $('#addToCartForm-' + productId).serialize(); 

            $.ajax({
                url: "{{ route('cart.add') }}", 
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.status == 'success') {
                        // alert(response.message); 
                        updateCart(response.cart); 
                    } else {
                        alert(error.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);  // Log any errors
                    alert('An error occurred while adding to cart. Please try again.');
                }
            });
        });
    });

    // Function to update cart count
    function updateCart(cartData) {
        $('#cart-count').text(cartData.count);
    }
</script>

</html>
