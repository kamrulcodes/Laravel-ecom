@extends('layouts.main')

@section('content')

	<div id="shopping-cart">
    <h1>Shopping Cart & Checkout</h1>

    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
        <table border="1">
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>

            @foreach($products as $product)
            <tr>
                <td>{!! $product->id !!}</td>
                <td>
                    <?php //dd ($product->toArray()) ?>

                    {!! Html::image($product->options['image'], $product->name, array('width'=>'65', 'height'=>'37'))!!} 
                    {!! $product->name !!}
                </td>
                <td>${!! $product->price !!}</td>
                <td>
                    {!! $product->qty !!}
                </td>
                <td>
                    ${!! $product->subtotal !!} 
                    <?php // dd (Cart::content() -> toArray()) ?>
                    <a href="/store/removeitem/{!! $product->rowid !!}">
                        {!! Html::image('img/remove.gif', 'Remove product') !!}
                    </a>
                </td>
            </tr>
            @endforeach
            
            <tr class="total">
                <td colspan="5">
                    Subtotal: ${!! Cart::total() !!}<br />
                    <span>TOTAL: ${!! Cart::total() !!}</span><br />

                    <input type="hidden" name="cmd" value="_xclick">
                    <input type="hidden" name="business" value="office@shop.com"> 
                    <input type="hidden" name="item_name" value="eCommerce Store Purchase"> 
                    <input type="hidden" name="amount" value="{!! Cart::total() !!}">
                    <input type="hidden" name="first_name" value="{!! Auth::user()->firstname !!}">
                    <input type="hidden" name="last_name" value="{!! Auth::user()->lastname !!}">
                    <input type="hidden" name="email" value="{!! Auth::user()->email !!}">

                    {!! Html::link('/', 'Continue Shopping', array('class'=>'tertiary-btn')) !!}
                    <input type="submit" value="CHECKOUT WITH PAYPAL" class="secondary-cart-btn">
                </td>
            </tr>
        </table>
    </form>
</div><!-- end shopping-cart -->

@stop
