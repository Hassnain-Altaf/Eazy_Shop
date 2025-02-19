<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/css/Checkout.css">
</head>
<body>

<div>
    @include('component.header')
</div>

<div class="container billing-form-container p-4">
    <div class="row">
        <!-- Cart Section -->
        <div class="col-md-4 order-md-2 mb-4">
            <ul class="list-group mb-3 sticky-top">

                @php
                    $totalprice = 0;
                @endphp
                
                @foreach ($cartItems as $cartItem)

                @php
                    $Itemtotalprice = $cartItem->product->totalprice * $cartItem->product->quantity;
                    $totalprice += $Itemtotalprice;
                @endphp

                <li class="list-group-item mt-md-4 p-4 d-flex justify-content-between lh-condensed">
                    <div class="d-flex flex-row">
                        <img class="img-fluid" height="50" width="50" src="{{ Storage::url($cartItem->product->image) }}" alt="{{ $cartItem->product->productname }}" style="object-fit:cover">
                        <div class="mx-2">
                            <h6 class="my-0">{{$cartItem->product->productname}}</h6>
                            <small class="text-muted">{{$cartItem->product->size}}</small>
                        </div>
                    </div>
                    <span class="text-muted">${{$cartItem->product->totalprice}}</span>
                </li>
                @endforeach

                <li class="list-group-item mt-md-4 p-4 d-flex justify-content-between lh-condensed">
                    <div class="mx-2">
                        <h6 class="my-0">Grand Total</h6>
                    </div>
                    <input type="hidden" name="total_amount" value="{{ number_format($totalprice, 2) }}">
                    <span class="text-muted" name="total_amount" value="{{ number_format($totalprice, 2) }}" >${{ number_format($totalprice, 2) }}</span>
                </li>

            </ul>
        </div>

        <!-- Billing Address Section -->
        <div class="col-md-8 order-md-1">
            <h4 class="mb-4 fw-bold">Billing Address</h4>
            <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control form-control-order rounded-2 shadow-none" name="billing_first_name" style="padding: 10px" placeholder="First name" id="firstName" required>
                        <div class="invalid-feedback">Valid first name is required.</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control form-control-order rounded-2 shadow-none" name="billing_last_name" style="padding: 10px" placeholder="Last name" id="lastName" required>
                        <div class="invalid-feedback">Valid last name is required.</div>
                    </div>
                </div>

                <div class="mb-3">
                    <input type="email" class="form-control form-control-order rounded-2 shadow-none" name="billing_email" style="padding: 10px" id="email" placeholder="Email">
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                </div>

                
                <div class="mb-3">
                    <input type="text" class="form-control form-control-order rounded-2 shadow-none" name="billing_address" style="padding: 10px" id="address" placeholder="1234 Main St" required>
                    <div class="invalid-feedback">Please enter your shipping address.</div>
                </div>
                
                <div class="mb-3">
                    <input type="text" class="form-control form-control-order rounded-2 shadow-none" name="billing_city" style="padding: 10px" id="address2" placeholder='Your complete "City Name"'>
                </div>
                
                <div class="mb-3">
                    <input type="number" class="form-control form-control-order rounded-2 shadow-none" name="billing_phone" style="padding: 10px" id="phone" placeholder="Phone">
                    <div class="invalid-feedback">Please enter a valid phone number</div>
                </div>

                <div class="row">
                    <div class="col-md-5 mb-3">
                        <select class="custom-select d-block w-100 shadow-none" name="billing_country" id="country" required>
                            <option value="">Select Country</option>
                            <option>United States</option>
                            <option>China</option>
                        </select>
                        <div class="invalid-feedback">Please select a valid country.</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <select class="custom-select d-block w-100 shadow-none" name="billing_state" id="state" >
                            <option value="">Select State (Optional)</option>
                            <option>California</option>
                            <option>Punjab</option>
                        </select>
                        <div class="invalid-feedback">Please provide a valid state.</div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="text" class="form-control form-control-order rounded-2 shadow-none" name="billing_zip" style="padding: 10px"  id="zip" placeholder="Zip Code (Optional)">
                        <div class="invalid-feedback">Zip code required.</div>
                    </div>
                </div>

                <!-- Shipping Address Section -->
                <h4 class="mb-4 fw-bold mt-5">Shipping Address</h4>
                <div class="form-check mb-3 billing-checkbox">
                    <input type="checkbox" checked class="form-check-input shadow-none billing-checkbox" id="sameAsBilling">
                    <input type="text" name="same_as_billing" hidden class="form-control" id="statusChecked" value="Unchecked">
                    <label class="form-check-label" for="sameAsBilling">Shipping address same as billing address</label>
                </div>

                <div id="shippingAddress">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control form-control-order rounded-2 shadow-none" name="shipping_first_name" style="padding: 10px" placeholder="First name" id="shippingFirstName" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control form-control-order rounded-2 shadow-none" name="shipping_last_name" style="padding: 10px" placeholder="Last name" id="shippingLastName" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control form-control-order rounded-2 shadow-none" name="shipping_email" style="padding: 10px" id="shippingEmail" placeholder="Email">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control form-control-order rounded-2 shadow-none" name="shipping_address" style="padding: 10px" id="shippingAddress1" placeholder="1234 Main St" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control form-control-order rounded-2 shadow-none" name="shipping_city" style="padding: 10px" id="shippingAddress2" placeholder='Your complete "City Name"'>
                    </div>
                    <div class="mb-3">
                        <input type="number" class="form-control form-control-order rounded-2 shadow-none" name="shipping_phone" style="padding: 10px" id="shippingPhone" placeholder="Phone">
                    </div>
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <select class="custom-select d-block w-100 shadow-none" name="shipping_country" id="shippingCountry" required>
                                <option value="">Select Country</option>
                                <option>United States</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <select class="custom-select d-block w-100 shadow-none" name="shipping_state" id="shippingState">
                                <option value="">Select State (Optional)</option>
                                <option>California</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <input type="text" class="form-control form-control-order rounded-2 shadow-none" name="shipping_zip" style="padding: 10px"  id="shippingZip" placeholder="Zip Code (Optional)">
                        </div>
                        
                    </div>
                </div>

                <hr class="mb-1" hidden>                

                <hr class="mb-4" hidden>

                <!-- Payment Method Selection -->
                <!-- <div class="d-flex mt-4">
                    <div class="payment-option" id="visa-option">
                        <i class="fab fa-cc-visa" style="font-size: 24px;"></i> Visa
                    </div>
                    <div class="payment-option" id="other-option">
                        <i class="fas fa-credit-card" style="font-size: 24px;"></i> Other Cards
                    </div>
                </div>

                <div class="payment-form-container">
                    <div class="payment-form" id="visa-form">
                        <h3 class="my-4">Payment Method</h3>
                        <div class="mb-3">
                            <label for="other-card-number" class="form-label">Card Number</label>
                            <input type="text" class="form-control form-control-order shadow-none border-muted" id="other-card-number" placeholder="Enter your card number" style="padding: 10px"  required>
                        </div>
                        <div class="mb-3">
                            <label for="billing-name" class="form-label">Cardholder Name</label>
                            <input type="text" class="form-control form-control-order rounded-2 shadow-none" id="other-cvc" id="billing-name" placeholder="Enter cardholder name" style="padding: 10px"  placeholder="Enter your card's CVC" required>
                        </div>
                        <div class="mb-3 d-flex flex-row">
                            <div class="w-100" style="margin-right:5px;">
                                <label for="other-cvc" class="form-label">CVC</label>
                                <input type="text" class="form-control form-control-order rounded-2 shadow-none payment-card-input" id="other-cvc" placeholder="Card's CVC" style="padding: 10px" required>
                            </div>
                            <div class="w-100" style="margin-left:5px;">
                                <label for="other-expiry" class="form-label ">Expiration Date</label>
                                <input type="text" class="form-control form-control-order rounded-2 shadow-none payment-card-input" id="other-expiry" placeholder="MM/YY" style="padding: 10px" required>
                            </div>
                        </div>
                    </div>

                    <div class="payment-form" id="other-form">
                        <h3 class="my-4">Other Card Payment</h3>
                        <div class="mb-3">
                            <label for="other-card-number" class="form-label">Card Number</label>
                            <input type="text" class="form-control form-control-order shadow-none border-muted" id="other-card-number" placeholder="Enter your card number" style="padding: 10px"  required>
                        </div>
                        <div class="mb-3">
                            <label for="billing-name" class="form-label">Cardholder Name</label>
                            <input type="text" class="form-control form-control-order rounded-2 shadow-none" id="other-cvc" id="billing-name" placeholder="Enter cardholder name" style="padding: 10px"  placeholder="Enter your card's CVC" required>
                        </div>
                        <div class="mb-3 d-flex flex-row">
                            <div class="w-100" style="margin-right:5px;">
                                <label for="other-cvc" class="form-label">CVC</label>
                                <input type="text" class="form-control form-control-order rounded-2 shadow-none payment-card-input" id="other-cvc" placeholder="Card's CVC" style="padding: 10px" required>
                            </div>
                            <div class="w-100" style="margin-left:5px;">
                                <label for="other-expiry" class="form-label ">Expiration Date</label>
                                <input type="text" class="form-control form-control-order rounded-2 shadow-none payment-card-input" id="other-expiry" placeholder="MM/YY" style="padding: 10px" required>
                            </div>
                        </div>
                    </div>
                </div> -->

                <button class="btn btn-block w-100 btn-order text-white" type="submit" style="padding: 10px 25px; background-color: #fa561b;">Place Order</button>
            </form>
        </div>
    </div>

</div>

<!-- Bootstrap JS & Dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>

<!-- jQuery for form switching -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Show Visa Form when "Visa" is selected
        $('#visa-option').click(function() {
            $('#visa-form').addClass('active');
            $('#other-form').removeClass('active');
        });

        // Show Other Card Form when "Other Cards" is selected
        $('#other-option').click(function() {
            $('#other-form').addClass('active');
            $('#visa-form').removeClass('active');
        });

        $('#visa-form').addClass('active');

        // Copy billing address to shipping address when checkbox is checked
        $('#sameAsBilling').change(function() {
            if (this.checked) {
                document.getElementById('shippingAddress').style.display = 'none';
                document.getElementById('statusChecked').value = 'Checked';
            } else {
                document.getElementById('shippingAddress').style.display = 'block';
                document.getElementById('statusChecked').value = 'Unchecked';
            }
        });
    });

    window.onload = function(){
        document.getElementById('shippingAddress').style.display = 'none';
    }

</script>

</body>
</html>