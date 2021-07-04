<?php

use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CityController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\GiftSetController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\PromotionController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\TermsController;
use App\Http\Controllers\Frontend\User\MypageController;
use App\Http\Controllers\Frontend\QuizController;
use App\Http\Controllers\Frontend\ShoppingController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::get('/', [HomeController::class, 'index'])
    ->name('index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('frontend.index'));
    });

Route::get('terms', [HomeController::class, 'terms'])
    ->name('pages.terms');
Route::get('privacy', [HomeController::class, 'privacy'])
    ->name('pages.privacy');

Route::group(['prefix' => 'product'], function () {
    Route::get('/index/{slug}', [ProductController::class, 'show'])
        ->name('product.show');
    Route::get('/detail/{id}', [ProductController::class, 'index'])
        ->name('product.detail');
    Route::post('/rating', [ProductController::class, 'rating'])
        ->name('product.rating');
    Route::get('/category/{slug}', [ProductController::class, 'category'])
        ->name('product.category');
    Route::get('/list/{id?}', [ProductController::class, 'list'])
        ->name('product.list');

    Route::get('/sortProduct', [ProductController::class, 'sortProduct'])
        ->name('product.sortProduct');
});

Route::group(['prefix' => 'mypage', 'middleware' => 'auth'], function () {
    Route::get('/', [MypageController::class, 'index'])
        ->name('mypage');

    Route::get('/updateInfo', [MypageController::class, 'updateInfo'])
        ->name('mypage.updateInfo');

    Route::post('/updateInfoAddr', [MypageController::class, 'updateInfoAddr'])
        ->name('mypage.updateInfo');

    Route::post('/updateAddr', [MypageController::class, 'updateAddr'])
        ->name('mypage.updateAddr');

    Route::post('/cancelOrder', [MypageController::class, 'cancelOrder'])
        ->name('mypage.cancel');
});

Route::get('/getCity', [CityController::class, 'getCity']);
Route::get('/getDistrict', [CityController::class, 'getDistrict']);
Route::get('/getWard', [CityController::class, 'getWard']);

Route::get('/about-miri', function () {
    return view('frontend.about.index');
});

Route::get('/story-miri', function () {
    return view('frontend.about.story');
});

Route::get('/process-miri', function () {
    $elements = \App\Models\Element::all();
    $groupElements = $elements->groupBy('letter');
    return view('frontend.about.process', compact('groupElements', 'elements'));
});

Route::get('/contact-miri', [ContactController::class, 'index']);

Route::group(['prefix' => 'blog-miri', 'as' => 'blog-miri'], function () {
    Route::get('/detail/{id}', [BlogController::class, 'detail'])
        ->name('blog.detail');

    Route::get('/', [BlogController::class, 'index'])
        ->name('blog.index');
});

Route::get('/quiz-miri', function () {
    return view('frontend.quiz.index');
});

Route::post('/quiz-miri', [QuizController::class, 'index'])
    ->name('quiz.index');

Route::get('/gift-set', [GiftSetController::class, 'index'])
    ->name('gift-set.index');

Route::get('/promotion', [PromotionController::class, 'index'])
    ->name('promotion.index');

Route::get('/promotionSort', [PromotionController::class, 'reloadProduct'])
    ->name('promotion.Sort');

Route::get('/search', [SearchController::class, 'index'])
    ->name('search.index');

Route::group(['prefix' => 'cart'], function () {
    Route::get('/', [CartController::class, 'index'])
        ->name('cart.index');

    Route::get('/handleCart', [CartController::class, 'handleCart'])
        ->name('handleCart');

    Route::get('/addDiscount', [CartController::class, 'addDiscount'])
        ->name('addDiscount');

    Route::post('/addItem', [CartController::class, 'addItem'])
        ->name('addItem');

    Route::get('/addGiftSet', [CartController::class, 'addGiftSet'])
        ->name('addGiftSet');

    Route::get('/addCoupleProduct', [CartController::class, 'addCoupleProduct'])
        ->name('addCoupleProduct');

    Route::get('/deleteItem/{id}', [CartController::class, 'deleteItem'])
        ->name('deleteItem');

    Route::get('/getOnCart', [CartController::class, 'getOnCart'])
        ->name('onCart');

    Route::get('/getPageCart', [CartController::class, 'getPageCart'])
        ->name('pageCart');

    Route::get('/checkout', [CartController::class, 'checkout'])
        ->name('checkout');
});

Route::group(['prefix' => 'shopping', 'middleware' => 'userInfo'], function () {
    Route::get('/login', function () {
        return view('frontend.shopping.login');
    })->name('shopping.login');

    Route::get('/info', [ShoppingController::class, 'getInfo'])
        ->name('shopping.getInfo');
    Route::post('/info', [ShoppingController::class, 'postInfo'])
        ->name('shopping.postInfo');

    Route::get('/', [ShoppingController::class, 'index'])
        ->name('shopping');

    Route::post('/addOtherAddr', [ShoppingController::class, 'addOtherAddr'])->name('shopping.addOtherAddr');
    Route::get('/cancelOtherAddr', [ShoppingController::class, 'cancelOtherAddr'])->name('shopping.cancelOtherAddr');
    Route::post('/addReceipt', [ShoppingController::class, 'addReceipt'])->name('shopping.addReceipt');
    Route::get('/cancelReceipt', [ShoppingController::class, 'cancelReceipt'])->name('shopping.cancelReceipt');

    Route::post('/confirm', [ShoppingController::class, 'confirm'])->name('shopping.confirm');

    Route::get('/payment', [ShoppingController::class, 'payment'])->name('shopping.payment');
    Route::post('/payment', [ShoppingController::class, 'postPayment'])->name('shopping.post.payment');

    Route::get('/complete', [ShoppingController::class, 'complete'])->name('shopping.complete');
    Route::get('/error', [ShoppingController::class, 'error'])->name('shopping.error');
});
