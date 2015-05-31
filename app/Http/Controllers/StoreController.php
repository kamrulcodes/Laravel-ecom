<?php namespace App\Http\Controllers;

use View;
use App\Product;
use App\Category;

use Auth;
use Cart;
use Validator;
use Input;
use Redirect;


use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class StoreController extends Controller {

	public function __construct() {
		parent::__construct();
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->middleware('cart_auth', array('only'=>array('postAddtocart', 'getCart', 'getRemoveitem')));
	}

	public function getIndex() {
		return View::make('store.index')
			->with('products', Product::take(4)->orderBy('created_at', 'DESC')->get());
	}

	public function getView($id) {
		return View::make('store.view')->with('product', Product::find($id));
	}

	public function getCategory($cat_id) {
		return View::make('store.category')
			->with('products', Product::where('category_id', '=', $cat_id)->paginate(3))
			->with('category', Category::find($cat_id));
	}

	public function getSearch() {
		$keyword = Input::get('keyword');

		return View::make('store.search')
			->with('products', Product::where('title', 'LIKE', '%'.$keyword.'%')->get())
			->with('keyword', $keyword);
	}

	public function postAddtocart() {
		$product = Product::find(Input::get('id'));
		$quantity = Input::get('quantity');

		Cart::add(array(
			'id'=>$product->id,
			'name'=>$product->title,
			'price'=>$product->price,
			'qty'=>$quantity,
			'options' => ['image' => $product->image, ],
		));

		return Redirect::to('store/cart');
	}

	public function getCart() {
		return View::make('store.cart')->with('products', Cart::content());
	}

	public function getRemoveitem($rowid) {
		//$item = Cart::get($identifier);
		//$item->remove();
		Cart::remove($rowid);
		return Redirect::to('store/cart');
	}

	public function getContact() {
		return View::make('store.contact');
	}
}
