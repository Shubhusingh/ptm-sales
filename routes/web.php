<?php

Route::group(['middleware' => ['IsInstalled', 'lang_check_user', 'front_enable']], function () {
    // define all routes here
    Route::get('/', 'FrontEnd\HomeController@index')->name('frontend.home');
    Route::get('edit_profile', 'FrontEnd\HomeController@edit_profile')->middleware('auth_user')->name('frontend.edit_profile');
    Route::post('edit_profile', 'FrontEnd\HomeController@edit_profile_post')->middleware('auth_user');
    Route::get('contact', 'FrontEnd\HomeController@contact')->name('frontend.contact');
    Route::get('about', 'FrontEnd\HomeController@about')->name('frontend.about');
    Route::post('user-login', 'FrontEnd\HomeController@user_login');
    Route::get('booking-history/{id}', 'FrontEnd\HomeController@booking_history')->middleware('auth_user')->name('frontend.booking_history');
    Route::post('user-logout', 'FrontEnd\HomeController@user_logout');

    Route::get('forgot-password', 'FrontEnd\HomeController@forgot');
    Route::post('forgot-password', 'FrontEnd\HomeController@send_reset_link');
    Route::get('reset-password/{token}', 'FrontEnd\HomeController@reset');
    Route::post('reset-password', 'FrontEnd\HomeController@reset_password');

    Route::post('user-register', 'FrontEnd\HomeController@customer_register');
    Route::post('send-enquiry', 'FrontEnd\HomeController@send_enquiry')->name('user.enquiry');
    Route::post('book', 'FrontEnd\HomeController@book')->middleware('auth_user');
});

// Route::get('/', 'FrontendController@index')->middleware('IsInstalled');
// if (env('front_enable') == 'no') {
//     Route::get('/', function () {
//         return redirect('admin');
//     })->middleware('IsInstalled');
// } else {
//     Route::get('/', 'FrontendController@index')->middleware('IsInstalled');
// }

Route::get('dtable-posts-lists', 'DatatablesController@index');
Route::get('dtable-custom-posts', 'DatatablesController@get_custom_posts');

Route::post('redirect-payment', 'FrontEnd\HomeController@redirect_payment')->name('redirect-payment');
Route::get('redirect-payment/{method}/{booking_id}', 'FrontEnd\HomeController@redirect');


// stripe payment integration
Route::get('stripe/{booking_id}', 'PaymentController@stripe');
Route::get('stripe-success', 'PaymentController@stripe_success');
Route::get('stripe-cancel', 'PaymentController@stripe_cancel');

// paystack payment integration
// Route::get('paystack','PaymentController@paystack');
Route::get('paystack/{booking_id}', 'PaymentController@paystack');
Route::get('paystack-success','PaymentController@paystack_callback');

Route::get('transaction','PaymentController@transaction');

// razorpay payment integration
Route::get('razorpay/{booking_id}', 'PaymentController@razorpay');
Route::post('razorpay-success', 'PaymentController@razorpay_success');
Route::get('razorpay-failed', 'PaymentController@razorpay_failed');

// cash payment
Route::get('cash/{booking_id}', 'PaymentController@cash');

Route::get('sample-payment', function () {
    return view('payments.test_pay');
});

// Route::post('redirect-payment', 'PaymentController@redirect_payment');

// Route::get('all-data', function () {
//     $bookings = BookingPaymentsModel::latest()->get();
//     foreach ($bookings as $booking) {
//         if ($booking->payment_details != null) {
//             echo "<pre>";
//             print_r(json_decode($booking->payment_details));
//             echo "---------------------------------------------<br>";
//         }
//     }
// });
