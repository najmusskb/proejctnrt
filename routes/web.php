<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdvertiseController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\AuthenticationController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CompanyprofileController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ManagementController;
use App\Http\Controllers\Admin\NewseventController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\WhyChooseUsController;
use App\Http\Controllers\Website\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::group(['middleware' => 'guest'], function() {
    Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('/login', [AuthenticationController::class, 'authCheck'])->name('login.check');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/registration', [AuthenticationController::class, 'registration'])->name('admin.registration');
    Route::post('/registration', [AuthenticationController::class, 'newUser'])->name('registration.store');
    Route::put('/password', [AuthenticationController::class, 'passwordUpdate'])->name('password.change');
    Route::get('/profile', [AuthenticationController::class, 'profile'])->name('profile');
    Route::put('/profile', [AuthenticationController::class, 'profileUpdate'])->name('profile.update');
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('admin.logout');

    Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::post('/category/delete', [CategoryController::class, 'destroy'])->name('category.delete');
    
    Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
    Route::post('/brand/store', [BrandController::class, 'store'])->name('brand.store');
    Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
    Route::post('/brand/update/{id}', [BrandController::class, 'update'])->name('brand.update');
    Route::post('/brand/delete', [BrandController::class, 'destroy'])->name('brand.delete');

    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::post('/product/delete', [ProductController::class, 'destroy'])->name('product.delete');
    Route::get('/remove-image/{id}', [ProductController::class, 'removeImage'])->name('product.remove.image');

    Route::get('/sliders', [SliderController::class, 'index'])->name('slider.index');
    Route::post('/slider/store', [SliderController::class, 'store'])->name('slider.store');
    Route::get('/slider/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
    Route::post('/slider/update/{id}', [SliderController::class, 'update'])->name('slider.update');
    Route::post('/slider/delete', [SliderController::class, 'destroy'])->name('slider.delete');

    Route::get('/abouts', [AboutController::class, 'index'])->name('abouts');
    Route::post('/about/update/{id}', [AboutController::class, 'update'])->name('about.update');

    Route::get('/managements', [ManagementController::class, 'index'])->name('management.index');
    Route::post('/management/store', [ManagementController::class, 'store'])->name('management.store');
    Route::get('/management/edit/{id}', [ManagementController::class, 'edit'])->name('management.edit');
    Route::post('/management/update/{id}', [ManagementController::class, 'update'])->name('management.update');
    Route::post('/management/delete', [ManagementController::class, 'destroy'])->name('management.delete');

    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::post('/gallery/store', [GalleryController::class, 'store'])->name('gallery.store');
    Route::get('/gallery/edit/{id}', [GalleryController::class, 'edit'])->name('gallery.edit');
    Route::post('/gallery/update/{id}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::post('/gallery/delete', [GalleryController::class, 'destroy'])->name('gallery.delete');

    Route::get('/services', [ServiceController::class, 'index'])->name('service.index');
    Route::post('/service/store', [ServiceController::class, 'store'])->name('service.store');
    Route::get('/service/edit/{id}', [ServiceController::class, 'edit'])->name('service.edit');
    Route::post('/service/update/{id}', [ServiceController::class, 'update'])->name('service.update');
    Route::post('/service/delete', [ServiceController::class, 'destroy'])->name('service.delete');

    Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonial.index');
    Route::post('/testimonial/store', [TestimonialController::class, 'store'])->name('testimonial.store');
    Route::get('/testimonial/edit/{id}', [TestimonialController::class, 'edit'])->name('testimonial.edit');
    Route::post('/testimonial/update/{id}', [TestimonialController::class, 'update'])->name('testimonial.update');
    Route::post('/testimonial/delete', [TestimonialController::class, 'destroy'])->name('testimonial.delete');

    Route::get('/faqs', [FaqController::class, 'index'])->name('faq.index');
    Route::post('/faq/store', [FaqController::class, 'store'])->name('faq.store');
    Route::get('/faq/edit/{id}', [FaqController::class, 'edit'])->name('faq.edit');
    Route::post('/faq/update/{id}', [FaqController::class, 'update'])->name('faq.update');
    Route::post('/faq/delete', [FaqController::class, 'destroy'])->name('faq.delete');

    Route::get('/why-choose-us', [WhyChooseUsController::class, 'index'])->name('why_choose_us.index');
    Route::post('/why-choose-us/store', [WhyChooseUsController::class, 'store'])->name('why_choose_us.store');
    Route::get('/why-choose-us/edit/{id}', [WhyChooseUsController::class, 'edit'])->name('why_choose_us.edit');
    Route::post('/why-choose-us/update/{id}', [WhyChooseUsController::class, 'update'])->name('why_choose_us.update');
    Route::post('/why-choose-us/delete', [WhyChooseUsController::class, 'destroy'])->name('why_choose_us.delete');

    Route::get('/admin/blogs', [BlogController::class, 'index'])->name('blog.index');
    Route::post('/admin/blog/store', [BlogController::class, 'store'])->name('blog.store');
    Route::get('/admin/blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
    Route::post('/admin/blog/update/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::post('/admin/blog/delete', [BlogController::class, 'destroy'])->name('blog.delete');

    Route::get('/company/profile', [CompanyprofileController::class, 'index'])->name('company.profile');
    Route::post('/company/profile/update/{id}', [CompanyprofileController::class, 'update'])->name('company.profile.update');
    
    Route::get('/messages', [ContactController::class, 'index'])->name('messages.index');
    Route::post('/message/delete', [ContactController::class, 'destroy'])->name('message.delete');
});
