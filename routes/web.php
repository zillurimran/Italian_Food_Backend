<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogTagController;
use App\Http\Controllers\BulkSmsController;
use App\Http\Controllers\ColorSettingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GeneralSettingController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminProfileSettingController;
use App\Http\Controllers\AllergyController;
use App\Http\Controllers\API\TutorialStep;
use App\Http\Controllers\NexmoSettingController;
use App\Http\Controllers\PhoneDirectoryController;
use App\Http\Controllers\PackagePricingController;
use App\Http\Controllers\SocialurlController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\ThemeSettingController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HideShowController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductOrderController;
use App\Http\Controllers\StripeSettingController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PlanningController;
use App\Http\Controllers\PickupAddressController;
use App\Http\Controllers\TutorialStepController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\FoodOfferController;
use App\Models\FoodOffer;
use App\Http\Controllers\FoodTypeController;
use App\Http\Controllers\MyOrderController;
use App\Http\Controllers\PrivacyController;

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

Route::group(['middleware' => 'visitor_log'], function(){
    Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
    Route::get('forgot-password', [FrontendController::class, 'forgotPassword'])->name('forgot.password');
    Route::get('verify-code', [FrontendController::class, 'verifyCode'])->name('verify.code');
    Route::post('send-code', [FrontendController::class, 'sendCode'])->name('send.code');
    Route::post('validate-code', [FrontendController::class, 'validateCode'])->name('validate.code');
    Route::get('change-password', [FrontendController::class, 'changePassword'])->name('change.password');
    Route::post('update-password', [FrontendController::class, 'updatePassword'])->name('update.password');

    // Route::get('/pricing', [FrontendController::class, 'pricing'])->name('frontend.pricing');
    // Route::get('/blogs', [FrontendController::class, 'blog'])->name('frontend.blog');
    // Route::get('/blog-details', [FrontendController::class, 'blogDetails'])->name('frontend.blog-details');
    // Route::get('/contact', [FrontendController::class, 'contact'])->name('frontend.contact');
});

Route::post('/comment/store',[CommentController::class,'storeComment'])->name('comment.store');

//UserController
Route::post('/user/register',[UserController::class,'storeUser'])->name('user.store');
Route::post('user-login',[UserController::class,'checkUser'])->name('registered-user.login');

// ProductOrderController
// Route::post('/order/store',[ProductOrderController::class,'orderStore'])->name('order.store');
// Route::post('pamment/success', [ProductOrderController::class, 'paymentSuccess'])->name('pamment.success');
// Route::post('user/email/check', [FrontendController::class, 'userEmailCheck'])->name('user.email.check');


// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('admin.index');
// })->name('dashboard');

// Admin Group Route
Route::group(['prefix' => 'admin','middleware' => ['auth', 'verified', 'adminCheck']], function(){

    // PlanningController 
    Route::get('/planning', [PlanningController::class, 'index'])->name('planning.index');
    Route::post('planning/create', [PlanningController::class, 'create'])->name('planning.create');
    Route::post('planning/update', [PlanningController::class, 'update'])->name('planning.update');
    Route::post('planning/delete', [PlanningController::class, 'delete'])->name('planning.delete');
    Route::get('planning/item/{id}', [PlanningController::class, 'planningItem'])->name('planning.item');
    Route::post('custom/notification', [PlanningController::class, 'customNotification'])->name('custom.notification');

    Route::post('trello-add-new', [PlanningController::class, 'trelloAddNew'])->name('trello.add.new');
    Route::post('trello-remove', [PlanningController::class, 'trelloRemove'])->name('trello.remove');
    Route::post('trello-title-update', [PlanningController::class, 'trelloTitleUpdate'])->name('trello.title.update');
    Route::post('trello-add-item', [PlanningController::class, 'trelloAddItem'])->name('trello.add.item');
    Route::post('item-modal-show', [PlanningController::class, 'itemModalShow'])->name('item.modal.show');
    Route::post('item-title-update', [PlanningController::class, 'itemTitleUpdate'])->name('item.title.update');
    Route::post('item-description-update', [PlanningController::class, 'itemDescriptionUpdate'])->name('item.description.update');
    Route::post('trello-member-update', [PlanningController::class, 'trelloMemberUpdate'])->name('trello.member.update');
    Route::post('trello-label-create', [PlanningController::class, 'trelloLabelCreate'])->name('trello.label.create');
    Route::post('trello-label-remove', [PlanningController::class, 'trelloLabelRemove'])->name('trello.label.remove');
    Route::post('trello-label-update', [PlanningController::class, 'trelloLabelUpdate'])->name('trello.label.update');
    Route::post('item-cover-update', [PlanningController::class, 'itemCoverUpdate'])->name('item.cover.update');
    Route::post('item-checklist-store', [PlanningController::class, 'itemChecklistStore'])->name('item.checklist.store');
    Route::post('item-checklist-remove', [PlanningController::class, 'itemChecklistRemove'])->name('item.checklist.remove');
    Route::post('checklist-title-update', [PlanningController::class, 'checklistTitleUpdate'])->name('checklist.title.update');
    Route::post('checklist-item-store', [PlanningController::class, 'checklistItemStore'])->name('checklist.item.store');
    Route::post('checklist-item-title-update', [PlanningController::class, 'checklistItemTitleUpdate'])->name('checklist.item.title.update');
    Route::post('checklist-item-remove', [PlanningController::class, 'checklistItemRemove'])->name('checklist.item.remove');
    Route::post('checklist-item-check', [PlanningController::class, 'checklistItemCheck'])->name('checklist.item.check');
    Route::post('checklist-item-member-update', [PlanningController::class, 'checklistItemMemberUpdate'])->name('checklist.item.member.update');
    Route::post('checklist-item-date-update', [PlanningController::class, 'checklistItemDateUpdate'])->name('checklist.item.date.update');
    Route::post('item-date-update', [PlanningController::class, 'itemDateUpdate'])->name('item.date.update');
    Route::post('item-status-update', [PlanningController::class, 'itemStatusUpdate'])->name('item.status.update');
    Route::post('item-activity-store', [PlanningController::class, 'itemActivityStore'])->name('item.activity.store');
    Route::post('item-attechment-update', [PlanningController::class, 'itemAttechmentUpdate'])->name('item.attechment.update');
    Route::post('item-attachment-remove', [PlanningController::class, 'itemAttachmentRemove'])->name('item.attachment.remove');
    Route::post('item-activity-delete', [PlanningController::class, 'itemActivityDelete'])->name('item.activity.delete');
    Route::post('trello-element-drag', [PlanningController::class, 'trelloElementDrag'])->name('trello.element.drag');
    Route::post('trello-item-drag', [PlanningController::class, 'trelloItemDrag'])->name('trello.item.drag');
    Route::post('trello-item-delete', [PlanningController::class, 'trelloItemDelete'])->name('trello.item.delete');
    Route::post('/order-event', [PlanningController::class, 'orderEvent'])->name('order.event');
    

    Route::group(['middleware' => ['adminCheck']], function(){
        // BannerController
        Route::get('/banners', [BannerController::class, 'index'])->name('banners.index');
        Route::post('/banner-store', [BannerController::class, 'store'])->name('banners.store');
        Route::post('/banners/{id}/update', [BannerController::class, 'update'])->name('banners.update');
        Route::get('/banners/{id}/delete', [BannerController::class, 'delete'])->name('banners.delete');

        // FeatureController
        Route::get('/features',[FeatureController::class,'index'])->name('features.index');
        Route::post('/feature/store',[FeatureController::class,'store'])->name('feature.store');
        Route::post('/single-feature/store',[FeatureController::class,'storeSingleFeature'])->name('singleFeature.store');
        Route::post('/feature/{id}/update',[FeatureController::class,'update'])->name('feature.update');
        Route::get('/feature/{id}/delete',[FeatureController::class,'delete'])->name('feature.delete');
        Route::post('/specs-store',[FeatureController::class,'storeSpecs'])->name('specs.store');
        Route::post('/specs/{id}/update',[FeatureController::class,'updateSpecs'])->name('specs.update');
        Route::get('/specs/{id}/delete',[FeatureController::class,'deleteSpecs'])->name('specs.delete');

        // HideShowController
        Route::post('/banner-status', [HideShowController::class, 'bannerStatus'])->name('banner.status');
        Route::post('/banner-bottom-status', [HideShowController::class, 'bannerBottomStatus'])->name('banner.bottom.status');
        Route::post('/pricing-status', [HideShowController::class, 'pricingStatus'])->name('pricing.status');
        Route::post('/testimonial-status', [HideShowController::class, 'testimonialStatus'])->name('testimonial.status');
        Route::post('/contact-status', [HideShowController::class, 'contactStatus'])->name('contact.status');
        Route::post('/map-status', [HideShowController::class, 'mapStatus'])->name('map.status');

        // LocationController
        Route::get('/location',[LocationController::class,'index'])->name('location.index');
        Route::post('/location/{id}/update',[LocationController::class,'update'])->name('location.update');
        // // AddressController
        // Route::get('/address/details',[AddressController::class,'index'])->name('detailAddress.index');
        // Route::post('/address/{id}/update',[AddressController::class,'update'])->name('address.update');
        // Route::post('/phone-store',[AddressController::class,'storePhone'])->name('phone.store');
        // Route::post('/phone/{id}/update',[AddressController::class,'updatePhone'])->name('phone.update');
        // Route::get('/phone/{id}/delete',[AddressController::class,'deletePhone'])->name('phone.delete');
        // Route::post('/email/store',[AddressController::class,'emailStore'])->name('email.store');
        // Route::post('/email/{id}/update',[AddressController::class,'emailUpdate'])->name('email.update');
        // Route::get('/email/{id}/delete',[AddressController::class,'emailDelete'])->name('email.delete');

        // CommentController
        Route::get('/all-comments',[CommentController::class,'index'])->name('comments.index');
        Route::get('/comment/{id}/delete',[CommentController::class,'deleteComment'])->name('comment.delete');
        //PackagePricingController
        // Route::get('/packages',[PackagePricingController::class,'index'])->name('packages.index');
        // Route::get('/items',[PackagePricingController::class,'packageItem'])->name('packages.item');
        // Route::post('/package/store',[PackagePricingController::class,'packageStore'])->name('package.store');
        // Route::post('/package/{id}/update',[PackagePricingController::class,'packageUpdate'])->name('package.update');
        // Route::get('/package/{id}/delete',[PackagePricingController::class,'packageDelete'])->name('package.delete');
        // Route::post('/item/store',[PackagePricingController::class,'itemStore'])->name('item.store');
        // Route::post('/item/{id}/update',[PackagePricingController::class,'itemUpdate'])->name('item.update');
        // Route::get('/item/{id}/delete',[PackagePricingController::class,'itemDelete'])->name('item.delete');

        // BlogController
        Route::get('/blog/list', [BlogController::class, 'index'])->name('blog.list.index');
        Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
        Route::post('blog/store',[BlogController::class,'store'])->name('blog.store');
        Route::post('/blog/delete', [BlogController::class, 'delete'])->name('blog.delete');

        // BlogCategoryController
        Route::get('/blog/categories', [BlogCategoryController::class, 'index'])->name('blog_categories.index');
        Route::post('/blog/categories-store', [BlogCategoryController::class, 'store'])->name('blog_categories.store');
        Route::post('/blog/categories/{id}/update', [BlogCategoryController::class, 'update'])->name('blog_categories.update');
        Route::post('/blog/categories/{id}/delete', [BlogCategoryController::class, 'delete'])->name('blog_categories.delete');

        // BlogTagController
        Route::get('/blog/tags', [BlogTagController::class, 'index'])->name('blog_tags.index');
        Route::post('/blog/create', [BlogTagController::class, 'create'])->name('blog_tags.create');
        Route::post('/blog/tags/{id}/update', [BlogTagController::class, 'update'])->name('blog_tags.update');
        Route::post('/blog/tag/{id}/delete', [BlogTagController::class, 'delete'])->name('blog_tags.delete');

        // AdminController
        Route::get('users/list', [AdminController::class, 'userList'])->name('users.index');
        Route::get('users/create', [AdminController::class, 'userCreate'])->name('users.create');
        Route::get('users/{id}/destroy', [AdminController::class, 'userDestroy'])->name('users.destroy');
        //  GeneralSettingController
        Route::resource('generalSettings', GeneralSettingController::class);

        //  ColorSettingController
        Route::resource('colorSettings', ColorSettingController::class);

        //  SocialurlController
        Route::resource('socialurls', SocialurlController::class);

        //StripeSettingController
        Route::get('/stripe/settings',[StripeSettingController::class,'index'])->name('stripe.index');
        Route::post('/key/{id}/update',[StripeSettingController::class,'updateKey'])->name('key.update');

        //PickupAddressController
        Route::get('/pickup-address',[PickupAddressController::class,'index'])->name('pickup_address.index');
        Route::get('/pickup-address/create',[PickupAddressController::class,'create'])->name('pickup_address.create');
        Route::post('/pickup-address/store',[PickupAddressController::class,'store'])->name('pickup_address.store');
        Route::post('/pickup-address/{id}/update',[PickupAddressController::class,'update'])->name('pickup_address.update');
        Route::get('/pickup-address/delete/{id}',[PickupAddressController::class,'delete'])->name('pickup_address.delete');
        Route::post('/delete-all-boutiques',[PickupAddressController::class,'deleteBoutiques'])->name('boutiques.delete');
     
        //TutorialStepController
        Route::get('/tutorial-steps',[TutorialStepController::class,'index'])->name('tutorialSteps.index');
        Route::get('/tutorial-step/create',[TutorialStepController::class,'create'])->name('tutorialSteps.create');
        Route::post('/tutorial-steps/store',[TutorialStepController::class,'store'])->name('tutorialSteps.store');
        Route::post('/tutorial-steps/{id}/update',[TutorialStepController::class,'update'])->name('tutorialSteps.update');
        Route::get('/tutorial-steps/{id}/delete',[TutorialStepController::class,'delete'])->name('tutorialSteps.delete');
     
        //RatingControllers
        Route::get('rating-list',[RatingController::class,'index'])->name('googleRatings.index');
        Route::get('/rating/{id}/delete',[RatingController::class,'delete'])->name('rating.delete');

        //FoodOfferController
        Route::get('/food/offers',[FoodOfferController::class,'index'])->name('foodOffers.index');
        Route::get('/food/offers/create',[FoodOfferController::class,'create'])->name('foodOffers.create');
        Route::post('/food/offers/store',[FoodOfferController::class,'store'])->name('foodOffers.store');
        Route::post('/food/offers/update/{id}',[FoodOfferController::class,'update'])->name('foodOffers.update');
        Route::get('/food/offers/delete/{id}',[FoodOfferController::class,'delete'])->name('foodOffers.delete');
        Route::get('/food-offer/hideShow/{id}',[FoodOfferController::class,'hideShow'])->name('foodOffers.hideShow');
        Route::get('/delete-marked',[FoodOfferController::class,'deleteAll'])->name('checkedFood.delete');
        Route::get('/flat-foods',[FoodOfferController::class,'flatFood'])->name('flatfoods.all');
        Route::get('/mystery-foods',[FoodOfferController::class,'mysteryFood'])->name('mystery.all');

        //FoodTypeController
        // Route::get('/food-types',[FoodTypeController::class,'index'])->name('foodType.index');

        //AllergyController
        Route::get('/allergies',[AllergyController::class,'index'])->name('allergies.index');
        Route::post('/allergies',[AllergyController::class,'store'])->name('add.allergy');
        Route::post('/allergies/{id}',[AllergyController::class,'update'])->name('update.allergy');
        Route::get('/allergies/delete-checked',[AllergyController::class,'deleteChecked'])->name('checkedAllergies.delete');

        //AdminProfileSettingController
        Route::get('/admin-profile-setting',[AdminProfileSettingController::class,'index'])->name('adminProfileSettings.index');

        //MyOrderController
        Route::get('/myorders',[MyOrderController::class,'index'])->name('myOrders.index');
        Route::get('/order-unpaid/{id}',[MyOrderController::class,'markAsUnpaid'])->name('order.mark.unpaid');
        Route::get('/order-paid/{id}',[MyOrderController::class,'markAsPaid'])->name('order.mark.paid');
        Route::get('/order-book/{id}',[MyOrderController::class,'markAsBook'])->name('order.mark.book');
        Route::get('/order-coupon/{id}',[MyOrderController::class,'markAsCoupon'])->name('order.mark.coupon');
        Route::get('/order-species/{id}',[MyOrderController::class,'markAsSpecies'])->name('order.mark.species');
        Route::get('/order-delete/{id}',[MyOrderController::class,'delete'])->name('myOrder.delete');
        Route::post('/orders-delete',[MyOrderController::class,'bulkDelete'])->name('bulkOrder.delete');
        // // NexmoSettings
        // Route::get('nexmo-settings', [NexmoSettingController::class, 'index'])->name('nexmo.index');
        // Route::put('nexmo-settings/{id}/update', [NexmoSettingController::class, 'update'])->name('nexmo.update');

        //privacyController
        Route::get('/privacy-policy', [PrivacyController::class,'index'])->name('privacy.index');
        Route::post('/update/privacy-policy', [PrivacyController::class,'update'])->name('privacy.update');
    });


    Route::get('histories/{id}/destroy', [AdminController::class, 'historyDestroy'])->name('histories.destroy');
    Route::get('histories-all-destroy', [AdminController::class, 'historyAllDestroy'])->name('histories_all.destroy');
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');


    // Route::get('create-sms', [BulkSmsController::class, 'create'])->name('create-sms');

    // Route::post('send-sms', [BulkSmsController::class, 'index']);
    // Route::post('user/balance/topup', [BulkSmsController::class, 'balanceTopup'])->name('user.balance.topup');
    // Route::post('topup/success', [BulkSmsController::class, 'topupSuccess'])->name('topup.success');


    // GroupController
    // Route::get('groups', [GroupController::class, 'index'])->name('groups.index');
    // Route::get('groups/create', [GroupController::class, 'create'])->name('groups.create');
    // Route::post('groups/store', [GroupController::class, 'store'])->name('groups.store');
    // Route::get('groups/{id}/edit', [GroupController::class, 'edit'])->name('groups.edit');
    // Route::put('groups/{id}/update', [GroupController::class, 'update'])->name('groups.update');
    // Route::delete('groups/{id}/destroy', [GroupController::class, 'destroy'])->name('groups.destroy');



    // Route::get('/phone-directories', [PhoneDirectoryController::class, 'index'])->name('phone-directories.index');
    // Route::get('/phone-directories/create', [PhoneDirectoryController::class, 'create'])->name('phone-directories.create');
    // Route::post('/phone-directories/store', [PhoneDirectoryController::class, 'store'])->name('phone-directories.store');
    // Route::get('/phone-directories/{id}/edit', [PhoneDirectoryController::class, 'edit'])->name('phone-directories.edit');
    // Route::put('/phone-directories/{id}/update', [PhoneDirectoryController::class, 'update'])->name('phone-directories.update');
    // Route::delete('/phone-directories/{id}/destroy', [PhoneDirectoryController::class, 'destroy'])->name('phone-directories.destroy');



});

    // My Profile
    Route::get('my-profile', [AdminController::class, 'myProfile'])->name('my-profile');

    // ThemeSettingController
    Route::get('theme-color', [ThemeSettingController::class, 'color'])->name('theme.color');
    Route::get('theme-toggle', [ThemeSettingController::class, 'toggle'])->name('theme.toggle');



    //  ContactController
    Route::resource('contacts', ContactController::class);

    //  SubscriberController
    Route::resource('subscribers', SubscriberController::class);
    // Route::get('/subscibers',[SubscriberController::class,'index'])->name('subscriber.index');
    // Route::post('/subscibers/store',[SubscriberController::class,'store'])->name('subscriber.store');
