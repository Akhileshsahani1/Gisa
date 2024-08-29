<?php

use App\Http\Controllers\Admin\Auth\ChangePasswordController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\MyAccountController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InsuranceCompanyController;
use App\Http\Controllers\Admin\PolicyController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PolicyFormController;
use App\Http\Controllers\Admin\QuotationController;
use App\Http\Controllers\Admin\ExpenseCategoryController;
use App\Http\Controllers\Admin\AgencyController;
use App\Http\Controllers\Admin\ClaimController;
use App\Http\Controllers\Admin\ReceiptController;
use App\Http\Controllers\Admin\StatementController;
use App\Http\Controllers\Admin\DispatchController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SupportController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\Dropdown\LeadStatusController;
use App\Http\Controllers\Admin\RenewalController;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    /*
    |--------------------------------------------------------------------------
    | Authentication Routes | LOGIN | REGISTER
    |--------------------------------------------------------------------------
    */

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.submit');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/update', [ResetPasswordController::class, 'reset'])->name('password.update');

    Route::post('update-fields',[QuotationController::class,'updateFields'])->name('update.fields');
    Route::post('quotation/field-update',[QuotationController::class,'metaUpdate'])->name('quotation.meta.update');
    Route::post('quotation/delete-option',[QuotationController::class,'optionDelete'])->name('quotation.option.delete');
    // Route::post('quotation/update-status',[QuotationController::class,'quotationStatus'])->name('quotation.status');
    /*
    |--------------------------------------------------------------------------
    | Dashboard Route
    |--------------------------------------------------------------------------
    */

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('uploadFile', [DashboardController::class, 'uploadFile'])->name('uploadFile');
     /*
    |--------------------------------------------------------------------------
    | Policies Route
    |--------------------------------------------------------------------------
    */
    Route::get('policies/product-type', [PolicyController::class, 'getType'])->name('policies.getType');
    Route::resource('policies', PolicyController::class);
    Route::get('policies/{id}/change-status', [PolicyController::class, 'changeStatus'])->name('policies.change-status');
    Route::post('policies/bulk-delete', [PolicyController::class, 'bulkDelete'])->name('policies.bulk-delete');
    Route::get('policies/{id}/create', [PolicyController::class, 'createType'])->name('policies.create-type');
    Route::put('policies/{id}/save-type', [PolicyController::class, 'storeType'])->name('policies.store-type');
    Route::get('policies/{id}/type', [PolicyController::class, 'editType'])->name('policies.edit-type');
    Route::put('policies/{id}/type', [PolicyController::class, 'updateType'])->name('policies.update-type');
    Route::delete('policies/{id}/type', [PolicyController::class, 'deleteType'])->name('policies.delete-type');

   /*
    |--------------------------------------------------------------------------
    | Leads Route
    |--------------------------------------------------------------------------
    */
    Route::resource('leads', LeadController::class);
    Route::post('leads/bulk-delete', [LeadController::class, 'bulkDelete'])->name('leads.bulk-delete');
    Route::put('leads/{id}/update-status', [LeadController::class, 'updateStatus'])->name('leads.update-status');
    Route::post('leads/transfer', [LeadController::class, 'transfer'])->name('leads.transfer');
    Route::get('leads/{id}/convert', [LeadController::class, 'convertLead'])->name('leads.convert');
    Route::get('leads/{id}/contact-history', [LeadController::class, 'contactHistory'])->name('leads.contact-history');
    Route::get('leads/import/view', [LeadController::class, 'importView'])->name('leads.import-view');
    Route::post('leads/import/file', [LeadController::class, 'import'])->name('leads.import');
    Route::post('leads/bulk-assign-user', [LeadController::class, 'bulkAssignUser'])->name('bulk.leads.assign.user');
    Route::post('leads/{id}/add-comment', [LeadController::class, 'addComment'])->name('leads.comment');
    Route::post('lead/type',[LeadController::class,'leadType'])->name('lead.type');
    Route::post('lead/quote-request/{id}',[LeadController::class,'quoteRequest'])->name('leads.quote-request');
    Route::post('lead/save-follow/{id}',[LeadController::class,'saveFollow'])->name('leads.save-follow');
    Route::delete('lead/delete-follow/{id}',[LeadController::class,'deleteFollow'])->name('leads.delete-follow');
    Route::get('lead/follows/{id}',[LeadController::class,'showFollow'])->name('leads.show-follow');
    /*
    |--------------------------------------------------------------------------
    | Customers Route
    |--------------------------------------------------------------------------
    */
    Route::get('customers/quotationTable',[CustomerController::class,'quotationTable'])->name('customer.quotationTable');
    Route::get('customers/leadTable',[CustomerController::class,'leadTable'])->name('customer.Table');
    Route::get('customers/PolicyTable',[CustomerController::class,'policiesTable'])->name('customer.quotationPolicyTable');
    Route::get('customers/dispatchPolicyTable',[CustomerController::class,'dispatchpoliciesTable'])->name('customer.dispatchpoliciesTable');
    Route::get('customers/renewalTable',[CustomerController::class,'renewalTable'])->name('customer.renewalTable');



    Route::resource('customers', CustomerController::class);


   Route::group(['prefix' => 'customer'], function()
   {
      Route::resource('statements', StatementController::class);
   });

    Route::post('customers/bulk-delete', [CustomerController::class, 'bulkDelete'])->name('customers.bulk-delete');
    Route::get('search/customers', [CustomerController::class, 'searchCustomer'])->name('customers.search');

       /*
    |--------------------------------------------------------------------------
    | Quotations Route
    |--------------------------------------------------------------------------
    */
    Route::get('quoted-request', [QuotationController::class, 'index'])->name('quotations.quoted-request');
    Route::resource('quotations', QuotationController::class);
    Route::post('quotations/bulk-delete', [QuotationController::class, 'bulkDelete'])->name('quotations.bulk-delete');
    Route::post('quotations/get-policy-form', [PolicyFormController::class, 'getForm'])->name('quotations.get-form');
    Route::post('quotations/get-policy-editable-form', [PolicyFormController::class, 'getEditableForm'])->name('quotations.get-editable-form');

    /*
    |--------------------------------------------------------------------------
    | Quotation Transactions
    |--------------------------------------------------------------------------
    */


   // Users Routes
   Route::resource('users', UserController::class);
   Route::get('users-online', [UserController::class, 'onlineUsers'])->name('online.users');
   Route::post('toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');

   // Roles Routes
   Route::resource('roles', RoleController::class);

   // Permissions Routes
   Route::resource('permissions', PermissionController::class);

    Route::get('quotation/transactions/{id}',[QuotationController::class,'listTransactions'])->name('quotation.transactions.list');
    Route::post('quotation/transactions/add',[QuotationController::class,'addTransaction'])->name('quotation-transactions.store');
    Route::post('quotation/transactions/edit',[QuotationController::class,'editTransaction'])->name('quotation-transactions.edit');
    Route::post('quotation/transaction/{id}',[QuotationController::class,'deleteTransaction'])->name('quotation-transaction.delete');
    /*
    |--------------------------------------------------------------------------
    | Quotation to policy
    |--------------------------------------------------------------------------
    */
    Route::get('quotation/convert-policy/{id}',[QuotationController::class,'convertPolicy'])->name('quotation.convert-policy');
    Route::post('quotation/get-convert-form',[PolicyFormController::class,'getConvertPolicyForm'])->name('quotation.get-convert-form');
    Route::post('quotation/convert',[QuotationController::class,'quotationAddConvert'])->name('quotation.convert');

    Route::get('quotation-policies',[QuotationController::class,'listPolicies'])->name('list.quotation-policies');
    Route::get('show-policy/{id}',[QuotationController::class,'quotationPolicyShow'])->name('quotation-policy.show');
    Route::get('edit-policy/{id}',[QuotationController::class,'quotationPolicyEdit'])->name('quotation-policy.edit');
    Route::post('edit-policy-form',[PolicyFormController::class,'policyEditForm'])->name('quotation-policy.edit.form');
    Route::post('update-quotation-policy',[QuotationController::class,'updateQuotationPolicy'])->name('quotation-policy.update');
    Route::post('delete-quotation-policy',[QuotationController::class,'deleteQuotationPolicy'])->name('quotation-policy.delete');

    Route::get('quotation-policies/customer',[QuotationController::class,'getQuotationPolicyByCustomer'])->name('quotation-policies.customer');

    /*
    |--------------------------------------------------------------------------
    | Insurance Company Route
    |--------------------------------------------------------------------------
    */
    Route::resource('insurance-companies', InsuranceCompanyController::class);
    Route::post('insurance-companies/bulk-delete', [InsuranceCompanyController::class, 'bulkDelete'])->name('insurance-companies.bulk-delete');


    /*
    |--------------------------------------------------------------------------
    | Insurance Company Route
    |--------------------------------------------------------------------------
    */
    Route::resource('agency', AgencyController::class);
    Route::post('agency/bulk-delete', [AgencyController::class, 'bulkDelete'])->name('agency.bulk-delete');
    /*
    |--------------------------------------------------------------------------
    | Dropdown
    |--------------------------------------------------------------------------
    */
    Route::get('dropdown',[LeadStatusController::class,'getDropdown'])->name('dropdown');
    Route::resource('lead-status', LeadStatusController::class);

    /*
    |--------------------------------------------------------------------------
    | Settings > My Account Route
    |--------------------------------------------------------------------------
    */
    Route::resource('my-account', MyAccountController::class);


    /*
    |--------------------------------------------------------------------------
    | sales > receipts
    |--------------------------------------------------------------------------
    */



   Route::group(['prefix' => 'account'], function()
   {
      Route::resource('receipts', ReceiptController::class);
   });



   /*
    |--------------------------------------------------------------------------
    | Reports
    |--------------------------------------------------------------------------
    */


   Route::resource('reports', ReportController::class);


   /*
    |--------------------------------------------------------------------------
    | Supports
    |--------------------------------------------------------------------------
    */


   Route::resource('grievance', SupportController::class);
   Route::put('send-grievance-message/{id}', [SupportController::class, 'sendMessage'])->name('grievances.send-message');


   /*
    |--------------------------------------------------------------------------
    | Expenses
    |--------------------------------------------------------------------------
    */


   Route::resource('expenses', ExpenseController::class);
   Route::resource('expense-categories', ExpenseCategoryController::class);
   Route::post('expense-categories/bulk-delete', [ExpenseCategoryController::class, 'bulkDelete'])->name('expense-categories.bulk-delete');

   Route::post('expenses/bulk-delete', [PolicyController::class, 'bulkDelete'])->name('expenses.bulk-delete');

    /*
    |--------------------------------------------------------------------------
    | Settings > Change Password Route
    |--------------------------------------------------------------------------
    */
    Route::get('change-password', [ChangePasswordController::class, 'changePasswordForm'])->name('password.form');

    Route::post('change-password', [ChangePasswordController::class, 'changePassword'])->name('change-password');

    # Company details Routes
    Route::get('settings/company-details', [CompanyController::class, 'companyDetailsForm'])->name('company-details.form');
    Route::post('settings/company-details', [CompanyController::class, 'companyDetails'])->name('company-details');
    Route::get('members',[CompanyController::class,'usersList'])->name('users.list');
    Route::get('member/edit/{id}',[CompanyController::class,'userEdit'])->name('user.edit');
    Route::post('member/update/{id}',[CompanyController::class,'userUpdate'])->name('user.update');
    Route::post('member/delete',[CompanyController::class,'deleteUser'])->name('user.delete');
    Route::get('member/add',[CompanyController::class,'createUserForm'])->name('user.create');
    Route::post('member/create',[CompanyController::class,'createUser'])->name('user.add');

     /*
    |--------------------------------------------------------------------------
    | Settings > Change Password Route
    |--------------------------------------------------------------------------
    */

    Route::get('dispach-policies',[DispatchController::class,'index'])->name('dispatch.list');
    Route::get('dispatch/fill/{id}',[DispatchController::class,'fillDispatchForm'])->name('dispatch.fill');
    Route::post('dispatch/add',[DispatchController::class,'addDispatchData'])->name('dispatch.add');
    Route::post('dispatch/update',[DispatchController::class,'dispatchUpdate'])->name('dispatch.update');
    Route::post('dispatch/delete',[DispatchController::class,'dispatchDelete'])->name('dispatch.delete');

     /*
    |--------------------------------------------------------------------------
    | Renewal Policies
    |--------------------------------------------------------------------------
    */
    Route::get('renewals',[RenewalController::class,'index'])->name('renewal.list');
    Route::get('renewal/{id}',[RenewalController::class,'showRenewal'])->name('renewal.show');
    Route::post('renewal/transfer',[RenewalController::class,'renewalTransfer'])->name('renewal.transfer');
    Route::put('renewal/{id}/update-status', [RenewalController::class, 'updateStatus'])->name('renewal.update-status');
    Route::post('renewal/{id}/convert', [RenewalController::class, 'convertRenewal'])->name('renewal.quote-request');
    Route::get('renewal/{id}/contact-history', [RenewalController::class, 'contactHistory'])->name('renewal.contact-history');
    Route::post('renewal/{id}/add-comment', [RenewalController::class, 'addComment'])->name('renewal.comment');
    Route::post('renewal/bulk-delete', [RenewalController::class, 'bulkDelete'])->name('renewal.bulk-delete');
    Route::post('renewal/delete/{id}',[RenewalController::class,'destroyRenewal'])->name('renewal.destroy');
    //Route::post('renewal/quote-request/{id}',[RenewalController::class,'quoteRequest'])->name('.quote-request');

      /*
    |--------------------------------------------------------------------------
    | Claims
    |--------------------------------------------------------------------------
    */
    Route::get('claims',[ClaimController::class,'index'])->name('claims.list');
    Route::get('claim/{id}',[ClaimController::class,'viewClaim'])->name('claims.show');
    Route::post('claim/update',[ClaimController::class,'update'])->name('claims.update');
    Route::post('claims/delete/{id}',[ClaimController::class,'deleteClaim'])->name('claims.delete');
});
