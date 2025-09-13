<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\ProductSubCategoryController;
use App\Http\Controllers\admin\TempImagesController;
use App\Http\Controllers\admin\ProductImageController;
use App\Http\Controllers\admin\ShippingController;
use App\Http\Controllers\admin\DiscountController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/test', function () {
  orderEmail(10);
});*/
Route::get('/',[FrontController::class,'index'])->name('front.home');
Route::get('/shop/{categorySlug?}/{subCategorySlug?}',[ShopController::class,'index'])->name('front.shop');
Route::get('/product/{productSlug}',[ShopController::class,'product'])->name('front.product'); 
Route::get('/cart',[CartController::class,'cart'])->name('front.cart');
Route::post('/add-to-cart',[CartController::class,'addToCart'])->name('front.addToCart');
Route::post('/update-cart',[CartController::class,'updateCart'])->name('front.updateCart');
Route::post('/delete-item',[CartController::class,'deleteItem'])->name('front.deleteItem.cart');

Route::get('/checkout',[CartController::class,'checkout'])->name('front.checkout');

Route::post('/process-checkout',[CartController::class,'processCheckout'])->name('front.processCheckout');
Route::get('/thank/{orderId}',[CartController::class,'thankyou'])->name('front.thank');
Route::post('/get-order-summery',[CartController::class,'getOrderSummery'])->name('front.getOrderSummery');
Route::post('/apply-discount',[CartController::class,'applyDiscount'])->name('front.applyDiscount');
Route::post('/remove-discount',[CartController::class,'removeCoupon'])->name('front.removeCoupon');
Route::post('/add-to-wishlist',[FrontController::class,'addToWishlist'])->name('front.addToWishlist');
Route::get('/contact',[ContactController::class,'index'])->name('contact');
Route::post('/send-email',[ContactController::class,'sendContactEmail'])->name('contact.sendEmail');
Route::get('/forgot-password',[AuthController::class,'forgotPassword'])->name('front.forgotPassword');
Route::post('/process-forgot-password',[AuthController::class,'processForgotPassword'])->name('front.processForgotPassword');
Route::get('/reset-password/{token}',[AuthController::class,'resetPassword'])->name('front.resetPassword');
Route::post('/process-reset-password',[AuthController::class,'processResetPassword'])->name('front.processResetPassword');
Route::post('/save-rating/{productId}',[shopController::class,'saveRating'])->name('front.saveRating');

Route::group(['prefix'=> 'account'],function(){ 
  Route::group(['middleware'=>'guest'],function(){
    Route::get('/register',[AuthController::class,'register'])->name('account.register');
    Route::post('/process-register',[AuthController::class,'processRegister'])->name('account.processRegister');
    Route::get('/login',[AuthController::class,'login'])->name('account.login');
    Route::post('/login',[AuthController::class,'authenticate'])->name('account.authenticate');
    
    
  });

  Route::group(['middleware'=>'auth'],function(){
    Route::get('/profile',[AuthController::class,'profile'])->name('account.profile');
    Route::post('/updateProfile',[AuthController::class,'updateProfile'])->name('account.updateProfile');
    Route::get('/orders',[AuthController::class,'orders'])->name('account.orders');
    Route::get('/wishlist',[AuthController::class,'wishlist'])->name('account.wishlist');
    Route::post('/remove-product-from-wishlist',[AuthController::class,'removeProductFromWishlist'])->name('account.removeProductFromWishlist');
    Route::get('/order-detail/{orderId}',[AuthController::class,'orderDetail'])->name('account.orderDetail');
    Route::get('/change-password',[AuthController::class,'showChangePasswordForm'])->name('account.changePassword');
    Route::post('/process-change-password',[AuthController::class,'changePassword'])->name('account.processChangePassword');

    Route::get('/logout',[AuthController::class,'logout'])->name('account.logout');
  });
}); 

Route::group(['prefix'=> 'admin'],function(){
    Route::group(['middleware'=>'admin.guest'],function(){
        Route::get('/login',[AdminLoginController::class,'index'])->name('admin.login');
        Route::post('/authenticate',[AdminLoginController::class,'authenticate'])->name('admin.authenticate');
    });

    Route::group(['middleware'=>'admin.auth'],function(){
        Route::get('/dashboard',[HomeController::class,'index'])->name('admin.dashboard');
        Route::get('/logout',[HomeController::class,'logout'])->name('admin.logout');
        //category
        Route::get('/categories',[CategoryController::class,'index'])->name('category.list');
        Route::get('/category/create',[CategoryController::class,'create'])->name('category.create');
        Route::post('/categories',[CategoryController::class,'store'])->name('category.store');

        Route::get('/categories/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
        Route::put('/categories/update/{id}', [CategoryController::class,'update'])->name('category.update');
        Route::delete('/categories/delete/{id}', [CategoryController::class,'delete'])->name('category.delete');
        Route::post('/upload-temp-image',[TempImagesController::class,'create'])->name('temp-images.create');
        
        Route::get('/subcategories',[SubCategoryController::class,'index'])->name('subcategory.list');
        Route::get('/subcategory/create',[SubCategoryController::class,'create'])->name('subcategory.create');
        Route::post('/subcategories',[SubCategoryController::class,'store'])->name('subcategory.store');
        Route::get('/subcategory/edit/{id}',[SubCategoryController::class,'edit'])->name('subcategory.edit');
        Route::put('/subcategory/update/{id}',[SubCategoryController::class,'update'])->name('subcategory.update');
        Route::delete('/subcategory/delete/{id}', [SubCategoryController::class,'delete'])->name('subcategory.delete');
    
       //product 
       Route::get('/product/create',[ProductController::class,'create'])->name('product.create');
       Route::get('/product-subcategories',[ProductSubCategoryController::class,'index'])->name('product-subcategories.index');
       Route::post('/products',[ProductController::class,'store'])->name('product.store');       
       Route::get('/products',[ProductController::class,'index'])->name('product.list');
       Route::get('/product/edit/{id}',[ProductController::class,'edit'])->name('product.edit');
       Route::put('/product/update/{id}',[ProductController::class,'update'])->name('product.update');
       Route::delete('/product/delete/{id}', [ProductController::class,'delete'])->name('product.delete');
       Route::get('get-products',[ProductController::class,'getProducts'])->name('product.getProducts');

       Route::post('/product-images/update',[ProductImageController::class,'update'])->name('product-images.update'); 
       Route::delete('/product-images/delete', [ProductImageController::class,'destroy'])->name('product-image.delete');

       Route::get('/rating',[ProductController::class,'rating'])->name('product.rating');
       Route::get('/change-rating-status',[ProductController::class,'changeRatingStatus'])->name('product.changeRatingStatus');
       //shipping
       Route::get('/shipping/create',[ShippingController::class,'create'])->name('shipping.create');
       Route::post('/shipping',[ShippingController::class,'store'])->name('shipping.store');


       Route::get('/discount',[DiscountController::class,'index'])->name('discount.list');
        Route::get('/discount/create',[DiscountController::class,'create'])->name('discount.create');
        Route::post('/discount',[DiscountController::class,'store'])->name('discount.store');

        Route::get('/orders',[OrderController::class,'index'])->name('order.list');
        Route::get('/orders/{id}',[OrderController::class,'detail'])->name('order.detail');

        Route::post('/order/change-status/{id}',[OrderController::class,'changeOrderStatus'])->name('order.changeOrderStatus');

        Route::post('/order/send-invoice/{id}',[OrderController::class,'sendInvoiceEmail'])->name('order.sendInvoiceEmail');

      
        Route::get('/getSlug', function(Request $request){
                $slug = "";
              if(!empty($request->title)){
                $slug = Str::slug($request->title);
              }
              return response()->json([
                'status' => true,
                'slug' => $slug
              ]);
        })->name('getSlug');
    });
});