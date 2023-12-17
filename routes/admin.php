<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Admin

Route::name('admin.')->group(function() {

    Route::middleware(['admin.guest'])->group(function () {
        //Your routes here
        Route::get('/login', [Auth\LoginController ::class, 'showLoginForm'])->name('login');
        Route::post('/login', [Auth\LoginController ::class, 'login'])->name('signin');
    });
    Route::middleware(['admin'])->group(function () {
        //Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::get('user/auto-login/{id}', [AdminController::class, 'autoLogin'])->name('auto.login');

          //Profile
          Route::get('/profile', [AdminController::class, 'Profile'])->name('profile');
          Route::post('/profile',[AdminController::class,'profileUpdate'])->name('profile.update');

          //password
          Route::get('/change/password',[AdminController::class,'passwordChange'])->name('password');
          Route::post('password',[AdminController::class,'passwordUpdate'])->name('password.update');

        // Banks
        Route::get('banks/index', [BankController::class, 'index'])->name('banks.index');
        Route::get('banks/create', [BankController::class, 'create'])->name('banks.create');
        Route::post('banks/create', [BankController::class, 'store'])->name('banks.store');
        Route::get('banks/edit/{id}', [BankController::class, 'edit'])->name('banks.edit');
        Route::post('banks/update/{id}', [BankController::class, 'update'])->name('banks.update');
        Route::post('banks/activate', [BankController::class, 'activate'])->name('banks.activate');
        Route::post('banks/deactivate', [BankController::class, 'deactivate'])->name('banks.deactivate');

        // Transfer to other-banks
        Route::get('transfer/pending', [TransferController::class, 'pending'] )->name('transfer.pending');
        Route::get('transfer/approved', [TransferController::class, 'approved'] )->name('transfer.approved');
        Route::get('transfer/rejected', [TransferController::class, 'rejected'] )->name('transfer.rejected');
        Route::get('transfer/log', [TransferController::class, 'log'] )->name('transfer.log');
        Route::get('transfer/{scope}/search', [TransferController::class, 'search'] )->name('transfer.search');
        Route::post('transfer/approve', [TransferController::class, 'approve'] )->name('transfer.approve');
        Route::post('transfer/reject', [TransferController::class, 'reject'] )->name('transfer.reject');

        // Transfer to own-banks
        Route::get('own-bank/transfer/pending', [TransferController::class, 'ownbankPending'] )->name('ownbank.transfer.pending');
        Route::get('own-bank/transfer/approved', [TransferController::class, 'ownbankApproved'] )->name('ownbank.transfer.approved');
        Route::get('own-bank/transfer/rejected', [TransferController::class, 'ownbankRejected'] )->name('ownbank.transfer.rejected');
        Route::get('own-bank/transfer/log', [TransferController::class, 'ownbankLog'] )->name('ownbank.transfer.log');
        Route::get('own-bank/transfer/{scope}/search', [TransferController::class, 'ownbankSearch'] )->name('ownbank.transfer.search');
        Route::post('own-bank/transfer/approve', [TransferController::class, 'ownbankApprove'] )->name('ownbank.transfer.approve');
        Route::post('own-bank/transfer/reject', [TransferController::class, 'ownbankReject'] )->name('ownbank.transfer.reject');

        //Request to own-banks
        Route::get('own-bank/request/pending', [TransferController::class, 'pendingRequest'] )->name('ownbank.request.pending');
        Route::get('own-bank/request/approved', [TransferController::class, 'approvedRequest'] )->name('ownbank.request.approved');
        Route::get('own-bank/request/rejected', [TransferController::class, 'rejectedRequest'] )->name('ownbank.request.rejected');

          //Manage User
          Route::get('/allusers', [UserController::class, 'Index'])->name('allusers');
          Route::get('/activeusers', [UserController::class, 'activeUsers'])->name('activeusers');
          Route::get('/pendingusers', [UserController::class, 'pendingUsers'])->name('pendingusers');
          Route::get('/blockedusers', [UserController::class, 'blockedUsers'])->name('blockedusers');
          Route::get('/emailunverified', [UserController::class, 'emailUnverifiedUsers'])->name('emailunverified');
          Route::get('/smsunverified', [UserController::class, 'smsUnverifiedUsers'])->name('smsunverified');
          Route::get('/kycunverified', [UserController::class, 'kycUnverifiedUsers'])->name('kycunverified');
          Route::get('/kycverified', [UserController::class, 'kycVerifiedUsers'])->name('kycverified');



          Route::get('users/{id}', [UserController::class, 'userEdit'])->name('user.edit');
          Route::post('users/{id}', [UserController::class, 'userUpdate'])->name('user.update');
          Route::post('addbalance/{id}', [UserController::class, 'addBalance'])->name('user.addbalance');
          Route::post('subbalance/{id}', [UserController::class, 'subBalance'])->name('user.subbalance');

        //Basic Settings

          //Basic
          Route::get('settings/basic', [BasicSettingController::class, 'basic'])->name('settings');
          Route::post('settings/basic', [BasicSettingController::class, 'basicUpdate'])->name('settings.basic');

          //logo
          Route::get('settings/logo-favicon', [BasicSettingController::class, 'logo_favicon'])->name('logo');
          Route::post('settings/logo-favicon', [BasicSettingController::class, 'logo_favicon_update'])->name('settings.logo');


        Route::get('settings/home-version', [BasicSettingController::class, 'homeversion'])->name('settings.home.version');
        Route::post('settings/home-version/post', [BasicSettingController::class, 'updatehomeversion'])->name('settings.home.version.update');

          //Contact
          Route::get('settings/contact', [BasicSettingController::class, 'contact'])->name('contact');
          Route::post('settings/contact', [BasicSettingController::class, 'contactUpdate'])->name('settings.contact');

          //Breadcrumb
          Route::get('settings/breadcrumb', [BasicSettingController::class, 'breadcrumb'])->name('breadcrumb');
          Route::post('settings/breadcrumb', [BasicSettingController::class, 'breadcrumbUpdate'])->name('settings.breadcrumb');

        //   //Social
          Route::get('settings/social/create', [SocialController::class, 'index'])->name('social.create');
          Route::post('settings/social/create', [SocialController::class, 'store'])->name('settings.social.store');
          Route::get('settings/social/edit/{id}', [SocialController::class, 'edit'])->name('settings.social.edit');
          Route::post('settings/social/edit/{id}', [SocialController::class, 'update'])->name('settings.social.update');
          Route::delete('/social/destroy/{id}', [SocialController::class, 'destroy'])->name('settings.social.destroy');

          //Footer
          Route::get('settings/footer', [BasicSettingController::class, 'footer'])->name('footer');
          Route::post('settings/footer', [BasicSettingController::class, 'footerUpdate'])->name('settings.footer');

          //End Basic Settings

        //Subscribers
        Route::get('/subscriber', [SubscriberController::class, 'index'])->name('subscriber');
        Route::get('/subscriber/mail', [SubscriberController::class, 'mail'])->name('subscriber.mail');
        Route::post('/subscriber/mail', [SubscriberController::class, 'sendMail'])->name('subscriber.mail.send');
          //Home Page

          //Banner
          Route::get('home/banner', [BannerController::class, 'Banner'])->name('banner');
          Route::post('home/banner', [BannerController::class, 'bannerUpdate'])->name('banner.update');
          //Slider
          Route::get('home/slider', [SliderController::class, 'Slider'])->name('slider');
          Route::get('home/slider/create', [SliderController::class, 'sliderCreate'])->name('slider.create');
          Route::post('home/slider/create', [SliderController::class, 'sliderStore'])->name('slider.store');
          Route::get('home/slider/edit/{id}', [SliderController::class, 'sliderEdit'])->name('slider.edit');
          Route::post('home/slider/edit/{id}', [SliderController::class, 'sliderUpdate'])->name('slider.update');
          Route::delete('/slider/destroy/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');


          //Services
          Route::get('home/services', [ServiceController::class, 'Service'])->name('services');
          Route::post('home/services', [ServiceController::class, 'serviceSectionUpdate'])->name('serviceupdate');

          Route::get('home/services/create', [ServiceController::class, 'servicesCreate'])->name('services.create');
          Route::post('home/services/create', [ServiceController::class, 'servicesStore'])->name('services.store');
          Route::get('home/services/edit/{id}', [ServiceController::class, 'servicesEdit'])->name('services.edit');
          Route::post('home/services/edit/{id}', [ServiceController::class, 'servicesUpdate'])->name('services.update');
          Route::delete('/services/destroy/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');


          //About
          Route::get('home/about', [SettingExtraController::class, 'about'])->name('about');
          Route::post('home/about', [SettingExtraController::class, 'aboutUpdate'])->name('about.update');

          //Counter
          Route::get('home/counter', [CounterController::class, 'Counter'])->name('counter');
          Route::post('home/counter', [CounterController::class, 'counterSectionUpdate'])->name('countersection.update');

          Route::get('home/counter/create', [CounterController::class, 'counterCreate'])->name('counter.create');
          Route::post('home/counter/create', [CounterController::class, 'counterStore'])->name('counter.store');
          Route::get('home/counter/edit/{id}', [CounterController::class, 'counterEdit'])->name('counter.edit');
          Route::post('home/counter/edit/{id}', [CounterController::class, 'counterUpdate'])->name('counter.update');
          Route::delete('/counter/destroy/{id}', [CounterController::class, 'destroy'])->name('counter.destroy');


          //Work
          Route::get('home/work', [WorkController::class, 'Work'])->name('work');
          Route::post('home/work', [WorkController::class, 'workSectionUpdate'])->name('worksection.update');

          Route::get('home/work/create', [WorkController::class, 'workCreate'])->name('work.create');
          Route::post('home/work/create', [WorkController::class, 'workStore'])->name('work.store');
          Route::get('home/work/edit/{id}', [WorkController::class, 'workEdit'])->name('work.edit');
          Route::post('home/work/edit/{id}', [WorkController::class, 'workUpdate'])->name('work.update');
          Route::delete('/work/destroy/{id}', [WorkController::class, 'destroy'])->name('work.destroy');


          //Faq
          Route::get('home/faq', [FaqController::class, 'Faq'])->name('faq');
          Route::post('home/faq', [FaqController::class, 'faqSectionUpdate'])->name('faqsection.update');

          Route::get('home/faq/create', [FaqController::class, 'faqCreate'])->name('faq.create');
          Route::post('home/faq/create', [FaqController::class, 'faqStore'])->name('faq.store');
          Route::get('home/faq/edit/{id}', [FaqController::class, 'faqEdit'])->name('faq.edit');
          Route::post('home/faq/edit/{id}', [FaqController::class, 'faqUpdate'])->name('faq.update');
          Route::delete('/faq/destroy/{id}', [FaqController::class, 'destroy'])->name('faq.destroy');

          //Why Choose us
          Route::get('home/choose', [ChooseUsController::class, 'Choose'])->name('choose');
          Route::post('home/choose', [ChooseUsController::class, 'chooseSectionUpdate'])->name('choosesection.update');

          Route::get('home/choose/create', [ChooseUsController::class, 'chooseCreate'])->name('choose.create');
          Route::post('home/choose/create', [ChooseUsController::class, 'chooseStore'])->name('choose.store');
          Route::get('home/choose/edit/{id}', [ChooseUsController::class, 'chooseEdit'])->name('choose.edit');
          Route::post('home/choose/edit/{id}', [ChooseUsController::class, 'chooseUpdate'])->name('choose.update');
          Route::delete('/choose/destroy/{id}', [ChooseUsController::class, 'destroy'])->name('choose.destroy');


          //Testimonial
          Route::get('home/testimonial', [TestimonialController::class, 'Testimonial'])->name('testimonial');
          Route::post('home/testimonial', [TestimonialController::class, 'testimonialSectionUpdate'])->name('testimonialsection.update');

          Route::get('home/testimonial/create', [TestimonialController::class, 'testimonialCreate'])->name('testimonial.create');
          Route::post('home/testimonial/create', [TestimonialController::class, 'testimonialStore'])->name('testimonial.store');
          Route::get('home/testimonial/edit/{id}', [TestimonialController::class, 'testimonialEdit'])->name('testimonial.edit');
          Route::post('home/testimonial/edit/{id}', [TestimonialController::class, 'testimonialUpdate'])->name('testimonial.update');
          Route::delete('/testimonial/destroy/{id}', [TestimonialController::class, 'destroy'])->name('testimonial.destroy');


          //Blog
          Route::get('home/blog', [BlogController::class, 'Blog'])->name('blog');
          Route::post('home/blog', [BlogController::class, 'blogSectionUpdate'])->name('blogsection.update');

          Route::get('home/blog/create', [BlogController::class, 'blogCreate'])->name('blog.create');
          Route::post('home/blog/create', [BlogController::class, 'blogStore'])->name('blog.store');
          Route::get('home/blog/edit/{id}', [BlogController::class, 'blogEdit'])->name('blog.edit');
          Route::post('home/blog/edit/{id}', [BlogController::class, 'blogUpdate'])->name('blog.update');
          Route::delete('/blog/destroy/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');

          //Title and Subtitle
          Route::get('home/title-subtitle', [TitleSubtitleController::class, 'titleSubtitle'])->name('titleSubtitle');
          Route::post('home/title-subtitle', [TitleSubtitleController::class, 'titleSubtitleUpdate'])->name('titleSubtitle.update');

          //privacy
          Route::get('home/privacy', [SettingExtraController::class, 'Privacy'])->name('privacy');
          Route::post('home/privacy', [SettingExtraController::class, 'privacyUpdate'])->name('privacy.update');

          //Terms
          Route::get('home/terms', [SettingExtraController::class, 'Terms'])->name('terms');
          Route::post('home/terms', [SettingExtraController::class, 'termsUpdate'])->name('terms.update');

          //End Home

        // Email Setting
        Route::get('email-template/global', [EmailTemplateController::class, 'emailTemplate'])->name('global-template');
        Route::post('email-template/global', [EmailTemplateController::class, 'emailTemplateUpdate'])->name('email-template.global');
        Route::get('email-template/setting', [EmailTemplateController::class, 'emailSetting'])->name('email-template-setting');
        Route::post('email-template/setting', [EmailTemplateController::class, 'emailSettingUpdate'])->name('email-template.setting');
        Route::get('email-template/index', [EmailTemplateController::class, 'index'])->name('email-template');
        Route::get('email-template/{id}/edit', [EmailTemplateController::class, 'edit'])->name('email-template.edit');
        Route::post('email-template/{id}/update', [EmailTemplateController::class, 'update'])->name('email-template.update');
        Route::post('email-template/send-test-mail', [EmailTemplateController::class, 'sendTestMail'])->name('email-template.sendTestMail');

        // SMS Setting
        Route::get('sms-template/global', [SmsTemplateController::class, 'smsSetting'])->name('sms-template');
        Route::post('sms-template/global', [SmsTemplateController::class, 'smsSettingUpdate'])->name('sms-template.global');
        Route::get('sms-template/index', [SmsTemplateController::class, 'index'])->name('sms-template.index');
        Route::get('sms-template/edit/{id}', [SmsTemplateController::class, 'edit'])->name('sms-template.edit');
        Route::post('sms-template/update/{id}', [SmsTemplateController::class, 'update'])->name('sms-template.update');
        Route::post('email-template/send-test-sms', [SmsTemplateController::class, 'sendTestSMS'])->name('email-template.sendTestSMS');


          Route::get('/language', [LanguageController::class, 'langManage'])->name('language-manage');
          Route::post('/language', [LanguageController::class, 'langStore'])->name('language-manage-store');
          Route::delete('/language/delete/{id}', [LanguageController::class, 'langDel'])->name('language-manage-del');
          Route::post('/language/update/{id}', [LanguageController::class, 'langUpdatepp'])->name('language-manage-update');
          Route::get('/language/view/{id}', [LanguageController::class, 'langEdit'])->name('language-key');
          Route::put('/language/keyword-update/{id}', [LanguageController::class, 'langUpdate'])->name('language.key-update');
          Route::post('/language/import', [LanguageController::class, 'langImport'])->name('language.import_lang');

        //logout
        Route::get('/logout', [Auth\LoginController ::class, 'logout'])->name('logout');
    });

});


