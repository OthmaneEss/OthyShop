@extends('front.layouts.master')

@section('title')
    Checkout Page
@endsection

@section('style')

    <script src="https://js.stripe.com/v3/"></script>
@endsection
@section('content')




    <h2 class="mt-5"><i class="fa fa-credit-card"></i> Checkout</h2>
    <hr>
    @include('front.layouts.session')

    @if(Cart::instance('default')->content < 0)

        <center><h4>Panier vide ! s'il vous plaît ajouter des articles !</h4></center>

<hr>

    @else
    <div class="row">

        <div class="col-md-7">
            <h4> Details de Facturation</h4>

            <form method="post" id="payment-form" action="{{url('/checkout')}}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">Nom</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">Adresse</label>
                    <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="city">Ville</label>
                        <input type="text" class="form-control" name="city" id="city" placeholder="City">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="province">Province</label>
                        <input type="text" class="form-control" name="province" id="province" placeholder="Province">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="postal">Code postal</label>
                        <input type="text" class="form-control" name="postal" id="postal" placeholder="Postal">
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone">Telephone </label>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone">
                </div>
                <hr>
                <h5><i class="fa fa-credit-card"></i> Details du paiement</h5>

                <div class="form-group">
                    <label for="name_card">Name on card</label>
                    <input type="text" class="form-control" name="name_card" id="name_card" placeholder="Name on card">
                </div>

                <div class="form-group">
                    <label for="card-element">
                    Credit or debit card
                    </label>
                    <div id="card-element">
                        <!-- A Stripe Element will be inserted here. -->
                    </div>

                    <!-- Used to display form errors. -->
                    <div id="card-errors" role="alert"></div>
                </div>

                <button type="submit" class="btn btn-outline-info col-md-12">Completer la commande</button>
            </form>

        </div>

        <div class="col-md-5">

            <h4>Ta commande</h4>



            <table class="table your-order-table">

                <tr>
                    <th>Image</th>
                    <th>Details</th>
                    <th>Qty</th>
                </tr>
                @foreach( Cart::instance('default')->content() as $item)
                <tr>
                    <td>
                        <div class="inner2"><img src="{{url('/uploads').'/'.$item->model->image}}" alt="{{$item->model->image}}" style="width: 4em"></div>
                        </td>
                    <td>
                        <strong>{{$item->model->name}}</strong><br>
                        {{$item->model->description}} <br>
                        <span class="text-dark">{{$item->model->price}} DH</span>
                    </td>
                    <td>
                        <span class="badge badge-light">1</span>
                    </td>
                </tr>
                @endforeach
            </table>

            <hr>
            <table class="table your-order-table table-bordered table-hover">
                <tr>
                    <th colspan="2" >Details du prix</th>
                </tr>
                <tr>
                    <td>Sous total</td>
                    <td>{{Cart::subtotal()}} DH</td>
                </tr>
                <tr>
                    <td>Tax</td>
                    <td>{{Cart::tax()}} DH</td>
                </tr>
                <tr>
                    <th>Total</th>
                    <th>{{Cart::total()}} DH</th>
                </tr>

            </table>

        </div>
    </div>

   @endif

@endsection

@section('script')
    <script>
        // Create a Stripe client.
        var stripe = Stripe('pk_test_jR02gNbwLzr2EkYvDxJShuWg');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {
            style: style,
            hidePostalCode: true
        });

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            var options = {
                name: document.getElementById("name_card").value,
                address_line_1: document.getElementById("address").value,
                address_city: document.getElementById("city").value,
                address_state: document.getElementById("province").value,
                address_zip: document.getElementById("postal").value
            };

            stripe.createToken(card, options).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }

    </script>


@endsection