{{-- @extends('admin.layout.master')

@section('content')
<section class="checkout spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                </h6>
            </div>
        </div>
        <div class="checkout__form">
            <h4>Billing Details</h4>
            <form method="POST" action="{{ route('cart.place.order') }}">
                @csrf
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="checkout__input">
                                    <p>Full Name<span>*</span></p>
                                    <input type="text" value="{{ Auth::user()->name }}">
                                </div>
                            </div>
                        </div>

                        <div class="checkout__input">
                            <p>Order notes<span>*</span></p>
                            <input name="notes" type="text"
                                placeholder="Notes about your order, e.g. special notes for delivery.">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Your Order</h4>
                            <div class="checkout__order__products">Products <span>Total</span></div>
                            <ul>

                                @php $total = 0 @endphp
                                @foreach ($cart as $item)
                                    @php 

                                        $cartItem = $item['price'];
                                        
                                        $total += $cartItem;
                                    @endphp
                                    
                                    <li>{{ $item['name'] }} <span>$ {{ $cartItem }}</span></li>    
                                @endforeach
                            </ul>
                            <div class="checkout__order__subtotal">Subtotal <span>${{$total}}</span></div>
                            <div class="checkout__order__total">Total <span>${{$total }}</span></div>
                            
                            <div class="checkout__input__checkbox">
                                <label for="payment">
                                    COD
                                    <input value="cod" name="payment_method" type="radio" id="payment">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="paypal">
                                    Thanh toán nội địa
                                    <input value="vnpay" name="payment_method" type="radio" id="paypal">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <input type="radio" id="bankCode" name="bankCode" value="VNBANK">
                       <label for="bankCode">Thanh toán qua thẻ ATM/Tài khoản nội địa</label><br>
                       
                       <input type="radio" id="bankCode" name="bankCode" value="INTCARD">
                       <label for="bankCode">Thanh toán qua thẻ quốc tế</label><br>
                            <button type="submit" class="site-btn">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection --}}