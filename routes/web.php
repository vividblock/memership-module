<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\adminAuth;
use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\auth\membersAuth;
use App\Http\Controllers\membersController;
use App\Http\Controllers\logoutController;

use App\Http\Middleware\adminMiddleware;
use App\Http\Middleware\membersMiddleware;


// Admin part --
Route::get('/',[adminAuth::class, 'index'])->name('adminLoginView');
Route::post('/',[adminAuth::class, 'login'])->name('adminLogin');
Route::middleware([adminMiddleware::class])->prefix('/auth/admin')->group(function(){
    Route::get('/dashboard', [adminController::class, 'index'])->name('adminDashboardView');
    Route::get('/smtp-intrigations', [adminController::class, 'SmtpIntrigationView'])->name('smtpIntrigationView');
    Route::post('/smtp-server-info-save', [adminController::class, 'SmtpIntrigationSave'])->name('smtpIntrigationSave');
    Route::post('/send-test-mail',[adminController::class, 'TestMailSend'])->name('SendTestMail');

    Route::get('/waiting-members-list', [adminController::class, 'WaitingMembersView'])->name('waitingMembersView');

    Route::get('/waiting-members-view/{memberId}', [adminController::class, 'waitingMembersSingleView'])->name('waitingMembersSingleView');


    // Abandoned Members
    Route::get('/abandoned-members-list', [adminController::class, 'abandonedMembersList'])->name('abandonedMembersList');

});


// Members part --
Route::get('/become-a-member/step-one', [membersAuth::class, 'registrationOneView'])->name('membersRegistrationOneView');
Route::post('/become-a-member/step-one', [membersAuth::class, 'registrationOne'])->name('membersRegistrationOne');
Route::get('/become-a-member/step-two', [membersAuth::class, 'registrationTwoView'])->name('membersRegistrationTwoView');
Route::post('/become-a-member/step-two', [membersAuth::class, 'registrationTwo'])->name('membersRegistrationTwo');
Route::get('/become-a-member/login', [membersAuth::class, 'membersloginView'])->name('membersloginView');
Route::post('/become-a-member/login', [membersAuth::class, 'memberslogin'])->name('memberslogin');

// Email Validation on Registration
Route::post('/validate-email-api', [membersAuth::class, 'membersEmailValidateApi'])->name('membersEmailValidateApi');
Route::post('/otp-verify', [membersAuth::class, 'otpVerify'])->name('otpVerify');

// Email Check Already Exists or Not
Route::post('/email-already-exists', [membersAuth::class, 'emailAlreadyExists'])->name('emailAlreadyExists');

Route::middleware([membersMiddleware::class])->prefix('/auth/members')->group(function(){
    Route::get('/dashboard', [membersController::class, 'dashboard'])->name('membersDashboard');

    // Membership form
    Route::get('/member-form/step-one/{memberId}', [membersController::class, 'memberformOneView'])->name('memberformOneView');
    Route::post('/member-form/step-one/{memberId}', [membersController::class, 'membersformOne'])->name('membersformOne');
    Route::get('/member-form/step-two/{memberId}', [membersController::class, 'memberformTwoView'])->name('memberformTwoView');
    Route::get('/member-form/step-three/{memberId}',[membersController::class, 'memberformThreeView'])->name('memberformThreeView');
    Route::post('/member-form/step-three/{memberId}',[membersController::class, 'memberformThree'])->name('memberformThree');
    Route::get('/member-form/step-four/{memberId}', [membersController::class,'memberformFourView'])->name('memberformFourView');
    Route::post('/member-form/step-four/{memberId}', [membersController::class,'memberformFour'])->name('memberformFour');
    Route::get('/member-form/step-five/{memberId}', [membersController::class,'memberformFiveView'])->name('memberformFiveView');
    Route::post('/member-form/step-five/{memberId}', [membersController::class,'memberformFive'])->name('memberformFive');
    Route::get('/member-form/step-six/{memberId}', [membersController::class,'memberformSixView'])->name('memberformSixView');
    Route::post('/member-form/step-six/{memberId}', [membersController::class,'memberformSix'])->name('memberformSix');

    // Profile
    Route::get('/member-profile', [membersController::class,'profileView'])->name('profileView');


    // Cards
    Route::get('/cards', [membersController::class, 'cardsView'])->name('cardsView');

    // Support 
    Route::get('/support', [membersController::class, 'supportView'])->name('supportView');
    Route::post('/support-submit/{memberId}', [membersController::class, 'supportSubmit'])->name('supportSubmit');

    // Reset Password
    Route::get('/reset-password', [membersController::class, 'resetPasswordView'])->name('resetPasswordView');

    Route::post('/reset-password', [membersController::class, 'resetPassword'])->name('resetPassword');
}); 


Route::get('/auth/logout',[logoutController::class, 'logout'])->name('logout');