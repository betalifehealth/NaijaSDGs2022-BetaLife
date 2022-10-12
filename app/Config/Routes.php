<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Test Routes
$routes->add('/', 'DashboardController::index');
$routes->post('/api/mobile/user/clear/', 'AuthController::deleteUser');
$routes->post('/coupon/new', 'Coupon::new');
$routes->add('/coupon/fetch', 'Coupon::index');

// Authentication
$routes->post('/api/mobile/auth/logout', 'AuthController::mobileLogout');
$routes->post('/api/mobile/auth/login', 'AuthController::mobileLogin');
$routes->post('/api/mobile/auth/login/verify', 'AuthController::completeLogin');
$routes->post('/api/mobile/auth/register', 'AuthController::register');
$routes->post('/api/mobile/auth/register/verify', 'AuthController::completeRegistration');
$routes->post('/api/mobile/auth/register/resendotp', 'AuthController::resendOTP');

// Protected Routes
$routes->group('api/mobile/user', ['filter' => 'auth'], function($routes) {
	
	// Routes for user's profile
	$routes->get('profile', 'UsersController::show');
	$routes->post('profile/update', 'UsersController::update');
	$routes->post('profile/logo/update', 'UsersController::updateLogo');
	$routes->post('profile/location/update', 'UsersController::updateLocation');

	// General Routes
	$routes->get('fetch-countries', 'UsersController::getCountries');
	$routes->get('fetch-states/(:num)', 'UsersController::getStates/$1');

	// Routes For Blood Donation (Patient)
	$routes->get('blood-donation/fetch-urgency', 'BloodRequestController::getUrgency');
	$routes->post('blood-donation/request/post', 'BloodRequestController::postRequest');
	$routes->get('blood-donation/request/available-donors/(:num)', 'BloodRequestController::availableDonors/$1');
	$routes->post('blood-donation/request/confirm-donor', 'BloodRequestController::confirmDonor');
	$routes->post('blood-donation/request/use-coupon', 'BloodRequestController::useCoupon');
	$routes->post('blood-donation/request/initialise-payment', 'BloodRequestController::initialisePayment');
	$routes->post('blood-donation/request/verify-payment', 'BloodRequestController::verifyPayment');
	$routes->get('blood-donation/request/fetch-data/(:num)', 'BloodRequestController::requestData/$1');
	$routes->get('blood-donation/request/get-qr/(:num)', 'BloodRequestController::showQRCode/$1');
	
	
	// Routes For Blood Donation (Donor)
	$routes->get('blood-donation/donor/apply', 'BloodRequestController::applyDonor');
	$routes->get('blood-donation/donor/active-requests', 'BloodRequestController::activeRequests');
	$routes->get('blood-donation/donor/request-detail/(:num)', 'BloodRequestController::viewSingleRequest/$1');
	$routes->get('blood-donation/donor/accept/(:num)', 'BloodRequestController::acceptRequest/$1');
	$routes->get('blood-donation/donor/status/(:num)', 'BloodRequestController::donorStatus/$1');
	$routes->get('blood-donation/donor/get-reward/(:any)', 'BloodRequestController::rewardDonor/$1');
});

$routes->get('/admin-login', 'AdministratorsController::loginPage');
$routes->post('/admin-login', 'AdministratorsController::processAdminLoginProcessing');

$routes->group('admin', function($routes) {
	$routes->get('dashboard', 'AdministratorsController::index');
	$routes->get('pending-withdrawals', 'AdministratorsController::getAllPendingWithdrawals');
	$routes->get('approved-withdrawals', 'AdministratorsController::getAllApprovedWithdrawals');
	$routes->get('rejected-withdrawals', 'AdministratorsController::getAllRejectedWithdrawals');
	
	$routes->get('view-hospitals', 'AdministratorsController::getAllHospitalsList');
	$routes->get('view-blood-banks', 'AdministratorsController::getAllBloodBanksList');
	$routes->get('view-phamarcies', 'AdministratorsController::getAllPharmaciesList');
	$routes->get('view-users', 'AdministratorsController::getAllUsersList');
	$routes->get('profile', 'AdministratorsController::myProfile');
	$routes->post('submit-profile', 'AdministratorsController::processProfileFormSubmit');

	$routes->get('manage-posts', 'AdministratorsController::getAllPosts');
	$routes->get('add-post', 'AdministratorsController::addPostForm');
	$routes->post('add-post', 'AdministratorsController::addPost');

	$routes->get('edit-post/(:num)', 'AdministratorsController::editPostForm');
	$routes->post('edit-post/(:num)', 'AdministratorsController::editPost');

	$routes->get('delete-post/(:num)', 'AdministratorsController::deletePost');

	$routes->get('approve-withdrawal-request/(:num)', 'AdministratorsController::approveWithdrawalForInstitution');
	$routes->post('reject-withdrawal-request/(:num)', 'AdministratorsController::rejectWithdrawalForInstitution');
	$routes->get('logout', 'AdministratorsController::logout');
});

// On-Boarding routes
$routes->get('/login', 'AuthController::webLoginPage');
$routes->get('/register', 'AuthController::webRegisterPage');
$routes->get('/register/(:any)', 'AuthController::webRegisterPage');
$routes->get('/verify-otp/(:any)', 'AuthController::verifyWebUserOTP');
$routes->post('/register/account', 'AuthController::processUserRegistration');
$routes->post('/sign-in', 'AuthController::processUserLogin');
$routes->post('/confirm-user-otp', 'AuthController::processUserOtpVerification');
$routes->post('/resend-user-otp/(:any)', 'AuthController::resendUserOTPVerificationCode');
$routes->get('/registration-complete', 'AuthController::webAppRegistrationComplete');

// Dashboard 
$routes->get('/dashboard', 'DashboardController::index');
// $routes->get('/test-email', 'SendOutgoingEmailController::sendOutNewBloodRequestEmail');
// $routes->get('/test-receipt', 'SendOutgoingEmailController::sendOutPaymentReceiptForPaymentMade');

// Profile Pages
$routes->get('/profile', 'ProfilePageController::profileInformationPage');
$routes->post('/profile', 'ProfilePageController::processProfileCompletion');


$routes->get('/request-blood', 'DashboardController::requestForBloodDonation');
$routes->post('/submit-blood-request', 'DashboardController::processRequestForBloodDonation');

$routes->get('/browse-blood-requests', 'DashboardController::fetchAllNearByRequestsForWeb');
$routes->get('/accept-donors', 'DashboardController::viewAllRequestForOffers');
$routes->get('/delete-request/(:num)', 'DashboardController::deleteRequestForHospital');
$routes->post('/accept-request-breakdown/(:num)', 'DashboardController::getBreakdownToAcceptRequest');
$routes->post('/record-accepted-request', 'DashboardController::recordAcceptedOfferForRequest');

$routes->post('/get-new-offers-for-request/(:num)', 'DashboardController::checkNewOfferFromTime');
$routes->post('/get-time', 'DashboardController::getTime');

$routes->get('/browse-activities', 'DashboardController::getAllActivitiesSaved');
$routes->get('/review-activity/(:any)/(:num)', 'DashboardController::reviewTheActivity');
$routes->get('/withdraw-offer/(:num)', 'DashboardController::withdrawRequestOffer');
$routes->get('/my-activities', 'DashboardController::hospitalBloodRequestActivites');
$routes->get('/view-delivery-information/(:num)', 'DashboardController::viewHospitalDeliveryInformation');
$routes->post('/verify-delivery-otp/(:num)', 'DashboardController::verifyDeliveryOTPInformation');

$routes->get('/wallet', 'DashboardController::walletPage');
$routes->post('/process-withdrawal-disbursement', 'DashboardController::processWithdrawalDisbursement');

$routes->get('/payment-summary/(:num)', 'PaymentController::seePaymentBreakdownSummary');
$routes->post('/create-new-request/(:num)', 'PaymentController::createNewRequestFromWhatsLeft');
$routes->post('/begin-payment-process/(:num)', 'PaymentController::fetchPaymentInformationDetails');
$routes->post('/record-payment-information/(:num)', 'PaymentController::recordTransactionPaymentInformation');

$routes->get('/browse-blood-offers/(:num)', 'DashboardController::getAllBloodOffersFromDonors');
$routes->post('/send-request-offer/(:num)', 'DashboardController::sendRequestOfferForWeb');

// Health Insurance
$routes->get('/health-insurance', 'HealthInsuranceController::index');

// Inventory
$routes->get('/inventory', 'BloodGroupStockController::index');
$routes->get('/inventory-history/(:any)', 'BloodGroupStockController::stockHistory');
$routes->post('/add-to-inventory', 'BloodGroupStockController::addToStock');

// Settings
$routes->get('/settings', 'SettingsPageController::settings');

// Blood Bank set rates
$routes->get('/settings/set-rates', 'SettingsPageController::bloodBankSetRates');
$routes->post('/settings/set-rates', 'SettingsPageController::bloodBankStoreSetRates');
$routes->get('/settings/bank-information', 'SettingsPageController::BankInformationPage');
$routes->post('/settings/bank-information', 'SettingsPageController::storeBankInformation');

$routes->get('/hospital/(:any)', 'HospitalController::index');
$routes->post('/hospital/(:any)', 'HospitalController::recordVistForHospital');

// Hospitals visitors links
$routes->get('/visitors', 'DashboardController::allHospitalVisitors');
$routes->post('/visitor/details', 'HospitalController::fetchVisitorsDetails');
$routes->post('/view-visitor-details', 'HospitalController::fetchVisitorsDetailsPreview');
$routes->post('/get-visitor-medical-details', 'HospitalController::fetchVisitorsMedicalDetails');
$routes->post('/save-visitor-record', 'HospitalController::saveVisitorMedicalRecord');
$routes->post('/save-visitor-additional-record', 'HospitalController::saveVisitorAdditionalMedicalRecord');

// Notifications
$routes->get('/set-notifications', 'NotificationsController::index');
$routes->get('/get-notifications', 'NotificationsController::getNotifications');

// Logout for WebApp
$routes->get('/logout', 'AuthController::webAppLogout');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
