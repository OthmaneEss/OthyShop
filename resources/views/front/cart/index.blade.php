@extends('front.layouts.master')

@section('title')
    Shopping Cart
    @endsection
@section('content')

    <h2 class="mt-5"><i class="fa fa-shopping-cart"></i> Votre panier</h2>
    <hr>



    @if ( Cart::instance('default')->count() > 0 )

        <h4 class="mt-5">{{ Cart::instance('default')->count() }} article(s) dans votre panier</h4>

        <div class="cart-items">

            <div class="row">

                <div class="col-md-12">

                    @if ( session()->has('msg') )

                        <div class="alert alert-success">{{ session()->get('msg') }}</div>

                    @endif

                    @if ( session()->has('errors') )

                        <div class="alert alert-warning">{{ session()->get('errors') }}</div>

                    @endif

                    <table class="table table-hover">

                        <tbody>

                        @foreach (Cart::instance('default')->content() as $item )

                            <tr>
                                <td>
                                    <div class="inner1"><img src="{{ url('/uploads') . '/'. $item->model->image }}" style="width: 5em"></div>
                                    </td>
                                <td>
                                    <strong>{{ $item->model->name }}</strong><br> {{ $item->model->description }}
                                </td>

                                <td>

                                    <form action="{{ route('cart.destroy', $item->rowId) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-link btn-link-dark">Supprimer</button>
                                    </form>

                                    <form action="{{ route('cart.saveLater', $item->rowId) }}" method="post">

                                        @csrf

                                        <button type="submit" class="btn btn-link btn-link-dark">Enregistrer pour plus tard</button>

                                    </form>

                                </td>

                                <td>
                                    <select class="form-control quantity" style="width: 4.7em" data-id="{{ $item->rowId }}">
                                        @for ($i = 1; $i < 5 + 1; $i++)
                                            <option {{ $item->qty == $i ? 'selected' : '' }}>{{$i}}</option>
                                        @endfor

                                    </select>
                                </td>

                                <td>${{ $item->total() }}</td>
                            </tr>
                        @endforeach


                        </tbody>

                    </table>

                </div>
                <!-- Price Details -->
                <div class="col-md-6">
                    <div class="sub-total">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th colspan="2">Price Details</th>
                            </tr>
                            </thead>
                            <tr>
                                <td>Sous total</td>
                                <td>${{ Cart::subtotal() }}</td>
                            </tr>
                            <tr>
                                <td>Tax</td>
                                <td>${{ Cart::tax() }}</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <th>${{ Cart::total() }}</th>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- Save for later  -->
                <div class="col-md-12">
                    <a href="/home" class="btn btn-outline-dark">Continuer vos achats </a>
                    <a href="/checkout" class="btn btn-outline-info">Passer au paiement</a>
                    <hr>
                </div>
                @else
                    <h3>There is not item in your Cart</h3>
                    <a href="/home" class="btn btn-outline-dark">Continuer vos achats</a>
                    <hr>
                @endif


                @if ( Cart::instance('saveForLater')->count() > 0 )

                    <div class="col-md-12">

                        <h4>{{ Cart::instance('saveForLater')->count() }} articles enregistré(s) pour plus tard</h4>
                        <table class="table">

                            <tbody>

                            @foreach (Cart::instance('saveForLater')->content() as $item )

                                <tr>
                                    <td>
                                        <div class="inner1"><img src="{{ url('/uploads') . '/'. $item->model->image }}" style="width: 5em"></div>

                                    </td>
                                    <td>
                                        <strong>{{ $item->model->name }}</strong><br> {{ $item->model->description }}
                                    </td>

                                    <td>

                                        <form action="{{ route('saveLater.destroy', $item->rowId) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-link btn-link-dark">Retirer</button>
                                        </form>

                                        <form action="{{ route('moveToCart', $item->rowId) }}" method="post">

                                            @csrf

                                            <button type="submit" class="btn btn-link btn-link-dark">Déplacer vers panier
                                            </button>

                                        </form>

                                    </td>

                                    <td>
                                        <select name="" id="" class="form-control" style="width: 4.7em">
                                            <option value="">1</option>
                                            <option value="">2</option>
                                        </select>
                                    </td>

                                    <td>${{ $item->total() }}</td>
                                </tr>

                            @endforeach

                            </tbody>

                        </table>

                    </div>

                @endif
            </div>

        </div>

@endsection

@section('script')

    <script src="{{ asset('js/app.js') }}"></script>
    <script>

        const className = document.querySelectorAll('.quantity');

        Array.from(className).forEach(function (el) {
            el.addEventListener('change', function () {

                const id = el.getAttribute('data-id');
                axios.patch(`/cart/update/${id}`, {
                    quantity: this.value
                })
                    .then(function (response) {
//                        console.log(response);
                        location.reload();
                    })

                    .catch(function (error) {
                        console.log(error);
                        location.reload();
                    });
            });
        });


    </script>
@endsection