

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/ShopingCart.css">
</head>
<body>

<div>
    @include('component.header')
</div>

    <div class="container my-5">


    <div class="row justify-content-center">
    <div class="col-12 col-md-6 col-lg-4 mx-auto text-center my-md-4 mb-3">
        @if(session('message'))
            <small id="alertMessage" class="small-alert bg-white text-warning w-100">
                {{ session('message') }}
            </small>
        @endif

        @if(session('success'))
            <small id="alertMessage" class="small-alert bg-white text-success w-100">
                {{ session('success') }}
            </small>
        @endif

        @if(session('error'))
            <small id="alertMessage" class="small-alert bg-white text-danger w-100">
                {{ session('error') }}
            </small>
        @endif
    </div>
</div>

    <div class="row">
        <div class="col-md-8 cart">
            <div class="title">
                <div class="row">
                    <div class="col"><h4 style="color: #343434">Shopping Cart</h4></div>
                    <div class="col align-self-center fs-5 text-right text-muted">{{ $cartItems->count() }} items</div>
                </div>
            </div>    
            <div class="table-responsive"> <!-- Add this div -->
                <table class="table">
                    <tbody>
                        @foreach($cartItems as $item)
                        <tr class="border-top border-bottom" id="cart-item-{{ $item->id }}">
                            <td class="col-2">
                                <img class="img-fluid" src="{{ Storage::url($item->product->image) }}" alt="{{ $item->product->productname }}">
                            </td>
                            <td>
                                <div class="row product-name text-muted fw-bold mx-1">{{ $item->product->productname }}</div>
                            </td>
                            <td>
                                <div class="quantity-input-main rounded-1">
                                    <button class="quantity-btn qty-1 border-0" data-id="{{ $item->id }}" id="decrementBtn-{{ $item->id }}">-</button>
                                        <input class="shadow-none border-0 quantity-input" type="number" id="quantity-{{ $item->id }}" name="quantity" disabled readonly value="{{ $item->quantity }}" min="1" max="5" step="1" data-price="{{ $item->product->totalprice }}">
                                    <button class="quantity-btn qty-2 border-0" data-id="{{ $item->id }}" id="incrementBtn-{{ $item->id }}">+</button>
                                </div>
                            </td>
                            <td class="total-price" id="total-price-{{ $item->id }}">&dollar;{{ number_format($item->product->totalprice * $item->quantity, 2) }}</td>
                            <td><a href="{{ route('cart.remove', ['itemId' => $item->id]) }}" class="remove-btn text-decoration-none border"><span class="close" >&#10005;</span></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class=""><a class="back-to-shop bg-white text-dark border-black" href="/">&leftarrow;</a><span class="text-muted">Back to shop</span></div>
        </div>

        <div class="col-md-4 summary p-4">
            <h4 class="text-center my-4 fw-bold" style="color: #343434">Bill Summary</h4>
            <div class="summary-card p-3 rounded">
                <table class="table table-responsive table-borderless mb-0">
                    <tbody>
                        @php
                            $totalprice = 0;
                        @endphp
                        @foreach($cartItems as $item)
                        @php
                            $itemtotalprice = $item->product->totalprice * $item->quantity;
                            $totalprice += $itemtotalprice; 
                        @endphp
                        <tr>
                            <td>{{ $item->product->productname }}</td>
                            <td class="text-end" id="summary-price-{{ $item->id }}">&dollar;{{ number_format($itemtotalprice, 2) }}</td>
                        </tr>
                        @endforeach
                        <tr class="border-top-1">
                            <hr>
                            <td class="pt-3"><strong>Total</strong></td>
                            <td class="text-end pt-3" id="total-summary"><strong>&dollar;{{ number_format($totalprice, 2) }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a href="/checkout"><button class="btn btn-sm checkout-btn rounded-0 text-white border-0 shadow-none w-100 mt-4 py-2 btn-dark">CHECKOUT</button></a>
        </div>
    </div>
</div>

</body>

<script>
    
    document.querySelectorAll('.quantity-btn').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const quantityInput = document.getElementById(`quantity-${id}`);
        let quantity = parseInt(quantityInput.value);

        if (this.id.includes('decrement')) {
            if (quantity > 1) {
                quantity--;
            }
        } else if (this.id.includes('increment')) {
            if (quantity < 5) {
                quantity++;
            }
        }

        quantityInput.value = quantity;

        const pricePerUnit = parseFloat(quantityInput.getAttribute('data-price'));
        const totalPrice = pricePerUnit * quantity;

        document.getElementById(`total-price-${id}`).textContent = `&dollar; ${totalPrice.toFixed(2)}`;

        updateTotalSummary();

        updateCartQuantity(id, quantity);
    });
});

function updateTotalSummary() {
    let totalPrice = 0;

    document.querySelectorAll('.total-price').forEach(item => {
        const priceText = item.textContent.trim();
        const price = parseFloat(priceText.replace('$', '').replace(',', '').trim());
        if (!isNaN(price)) {
            totalPrice += price;
        }
    });

    document.getElementById('total-summary').textContent = `$ ${totalPrice.toFixed(2)}`;
}

function updateCartQuantity(itemId, quantity) {
    fetch(`/update-cart/${itemId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            quantity: quantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateCartView(data.updatedCartItems, data.totalPrice);
        } else {
            console.error('Error updating cart');
        }
    })
    .catch(error => console.error('Error:', error));
}

function updateCartView(cartItems, totalPrice) {
    cartItems.forEach(item => {
        const totalPriceElement = document.getElementById(`total-price-${item.id}`);
        const summaryPriceElement = document.getElementById(`summary-price-${item.id}`);

        const itemTotalPrice = item.product.totalprice * item.quantity;
        totalPriceElement.textContent = `$ ${itemTotalPrice.toFixed(2)}`;
        summaryPriceElement.textContent = `$ ${itemTotalPrice.toFixed(2)}`;
    });

    document.getElementById('total-summary').textContent = `$ ${totalPrice.toFixed(2)}`;
}


function updateBillSummary(cartItems) {
    let totalPrice = 0;

    // Clear existing summary rows before updating
    document.querySelector('.summary-card table tbody').innerHTML = '';

    // Update the Bill Summary with the remaining cart items
    cartItems.forEach(item => {
        const itemTotalPrice = item.price * item.quantity;
        totalPrice += itemTotalPrice;

        // Create a new row for the item in the summary
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${item.name}</td>
            <td class="text-end" id="summary-price-${item.id}">&dollar; ${itemTotalPrice.toFixed(2)}</td>
        `;
        document.querySelector('.summary-card table tbody').appendChild(row);
    });

    document.getElementById('total-summary').textContent = `$ ${totalPrice.toFixed(2)}`;
}


// JavaScript to remove the alert after 3 seconds
setTimeout(function () {
    const alertMessage = document.getElementById('alertMessage');
    if (alertMessage) {
        alertMessage.style.transition = 'opacity 0.5s'; 
        alertMessage.style.opacity = '0'; 

        setTimeout(() => {
            alertMessage.remove(); 
        }, 500); 
    }
}, 3000); 



</script>

</html>