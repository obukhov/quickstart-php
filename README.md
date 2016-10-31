# Zuora Quickstart PHP
# Introduction  
Welcome to the reference documentation for the Zuora REST API!   [REST](http://en.wikipedia.org/wiki/REST_API \"http://en.wikipedia.org/wiki/REST_API\") is a web-service protocol that lends itself to rapid development by using everyday HTTP and JSON technology. REST offers the following:  *   Easy to use and learn for developers *   Works with virtually any language and platform *   Use case-oriented calls *   Well-suited for solutions that fall outside the traditional desktop application model  The Zuora REST API provides a set of use case-oriented calls that:  *   Enable Web Storefront integration between your websites. *   Support self-service subscriber sign-ups and account management. *   Process revenue schedules through custom revenue rule models.  ## Set up an API User Account  Few setup steps are required to use the Zuora REST API. No special software libraries or development tools are needed. Take a moment to set up an API user account. See [Creating an API](https://knowledgecenter.zuora.com/DC_Developers/SOAP_API/AB_Getting_started_with_the__SOAP_API/F_Create_an_API_User) user.  Note that a user role does not have write access to Zuora REST services unless it has the API Write Access permission as described in those instructions.  Use the API user account only for API calls, and avoid using it to log into the Zuora UI. Logging into the UI enables a security feature that periodically expires the account's password, which may eventually cause authentication failures with the API.  ## Authentication  There are three ways to authenticate:  * Use an authorization cookie. The cookie authorizes the user to make calls to the REST API for the duration specified in  **Administration > Security Policies > Session timeout**. The cookie expiration time is reset with this duration after every call to the REST API. To obtain a cookie, call the REST  `connections` resource with the following API user information:     *   ID     *   password     *   entity Id or entity name (Only for [Zuora Multi-entity](https://knowledgecenter.zuora.com/BB_Introducing_Z_Business/Multi-entity \"Multi-entity\"). See \"Entity Id and Entity Name\" below for more information.)  *   Include the following parameters in the request header, which re-authenticates the user with each request:     *   `apiAccessKeyId`     *   `apiSecretAccessKey`     *   `entityId` or `entityName` (Only for [Zuora Multi-entity](https://knowledgecenter.zuora.com/BB_Introducing_Z_Business/Multi-entity \"Multi-entity\"). See \"Entity Id and Entity Name\" below for more information.) *   For CORS-enabled APIs only: Include a 'single-use' token in the request header, which re-authenticates the user with each request. See below for more details.   ## Errors  Responses and error codes are detailed in [Responses and errors](https://knowledgecenter.zuora.com/DC_Developers/REST_API/A_REST_basics/3_Responses_and_errors \"Responses and errors\").   ## Entity Id and Entity Name  The `entityId` and `entityName`  parameters are only used for  [Zuora Multi-entity](https://knowledgecenter.zuora.com/BB_Introducing_Z_Business/Multi-entity).  The  `entityId` parameter specifies the Id of the entity that you want to access. The `entityName` parameter specifies the [name of the entity](https://knowledgecenter.zuora.com/BB_Introducing_Z_Business/Multi-entity/B_Introduction_to_Entity_and_Entity_Hierarchy#Name_and_Display_Name \"Introduction to Entity and Entity Hierarchy\") that you want to access. Note that you must have permission to access the entity. You can get the entity Id and entity name through the REST GET Entities call.  You can specify either the  `entityId` or `entityName` parameter in the authentication to access and view an entity.  *   If both `entityId` and `entityName` are specified in the authentication, an error occurs.  *   If neither  `entityId` nor  `entityName` is specified in the authentication, you will log in to the entity in which your user account is created.   See [API User Authentication](https://knowledgecenter.zuora.com/BB_Introducing_Z_Business/Multi-entity/A_Overview_of_Multi-entity#API_User_Authentication \"Zuora Multi-entity\") for more information.  ## Token Authentication for CORS-Enabled APIs  The CORS mechanism enables REST API calls to Zuora to be made directly from your customer's browser, with all credit card and security information transmitted directly to Zuora. This minimizes your PCI compliance burden, allows you to implement advanced validation on your payment forms, and makes your payment forms look just like any other part of your website.  For security reasons, instead of using cookies, an API request via CORS uses **tokens** for authentication.  The token method of authentication is only designed for use with requests that must originate from your customer's browser; **it should not be considered a replacement to the existing cookie authentication** mechanism.  See [Zuora CORS REST ](https://knowledgecenter.zuora.com/DC_Developers/REST_API/A_REST_basics/G_CORS_REST \"Zuora CORS REST\")for details on how CORS works and how you can begin to implement customer calls to the Zuora REST APIs. See  [HMAC Signatures](/BC_Developers/REST_API/B_REST_API_reference/HMAC_Signatures \"HMAC Signatures\") for details on the HMAC method that returns the authentication token.   ## Zuora REST API Versions  The Zuora REST API is in version control. Versioning ensures that Zuora REST API changes are backward compatible. Zuora uses a major and minor version nomenclature to manage changes. By specifying a version in a REST request, you can get expected responses regardless of future changes to the API.   ### Major Version  The major version number of the REST API appears in the REST URL. Currently, Zuora only supports the **v1** major version. For example,  `POST https://rest.zuora.com/v1/subscriptions` .   ### Minor Version  Zuora uses minor versions for the REST API to control small changes. For example, a field in a REST method is deprecated and a new field is used to replace it.   Some fields in the REST methods are supported as of minor versions. If a field is not noted with a minor version, this field is available for all minor versions. If a field is noted with a minor version, this field is in version control. You must specify the supported minor version in the request header to process without an error.   If a field is in version control, it is either with a minimum minor version or a maximum minor version, or both of them. You can only use this field with the minor version between the minimum and the maximum minor versions. For example, the  `invoiceCollect` field in the POST Subscription method is in version control and its maximum minor version is 189.0. You can only use this field with the minor version 189.0 or earlier.  The supported minor versions are not serial, see [Zuora REST API Minor Version History](https://knowledgecenter.zuora.com/DC_Developers/REST_API/A_REST_basics/Zuora_REST_API_Minor_Version_History \"Zuora REST API Minor Version History\") for the fields and their supported minor versions. In our REST API documentation, if a field or feature requires a minor version number, we note that in the field description.  You only need to specify the version number when you use the fields require a minor version. To specify the minor version, set the `zuora-version` parameter to the minor version number in the request header for the request call. For example, the `collect` field is in 196.0 minor version. If you want to use this field for the POST Subscription method, set the  `zuora-version` parameter to `196.0` in the request header. The `zuora-version` parameter is case sensitive.   For all the REST API fields, by default, if the minor version is not specified in the request header, Zuora will use the minimum minor version of the REST API to avoid breaking your integration.    ## URLs and Endpoints  The following REST services are provided in Zuora.  | Service                 | Base URL for REST Endpoints                                                                                                                                         | |-------------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------| | Production REST service | https://rest.zuora.com/v1                                                                                                                                           | | Sandbox REST service    | https://rest.apisandbox.zuora.com/v1                                                                                                                                | | Services REST service   | https://services123.zuora.com/apps/v1/  (where \"123\" is replaced by the number of your actual services environment)  The production service provides access to your live user data. The sandbox environment is a good place to test your code without affecting real-world data.  To use it, you must be provisioned with a sandbox tenant - your Zuora representative can help with this if needed.   ## Requests and Responses   ### HTTP Request Body  Most of the parameters and data accompanying your requests will be contained in the body of the HTTP request.  The Zuora REST API accepts JSON in the HTTP request body.  No other data format (e.g., XML) is supported.   #### Testing a Request  Use a third party client, such as Postman or Advanced REST Client, to test the Zuora REST API.  You can test the Zuora REST API from the Zuora sandbox or  production service. If connecting to the production service, bear in mind that you are working with your live production data, not sample data or test data.  #### Testing with Credit Cards  Sooner or later it will probably be necessary to test some transactions that involve credit cards. For suggestions on how to handle this, see [Going Live With Your Payment Gateway](https://knowledgecenter.zuora.com/CB_Billing/M_Payment_Gateways/C_Managing_Payment_Gateways/B_Going_Live_Payment_Gateways#Testing_with_Credit_Cards \"C_Zuora_User_Guides/A_Billing_and_Payments/M_Payment_Gateways/C_Managing_Payment_Gateways/B_Going_Live_Payment_Gateways#Testing_with_Credit_Cards\").   ## Request IDs  As a general rule, when asked to supply a \"key\" for an account or subscription (accountKey, account-key, subscriptionKey, subscription-key), you can provide either the actual ID or the number of the entity.  ## Pagination  When retrieving information (using GET methods), the optional `pageSize` query parameter sets the maximum number of rows to return in a response. The maximum is `40`; larger values are treated as `40`. If this value is empty or invalid, `pageSize` typically defaults to `10`.  The default value for the maximum number of rows retrieved can be overridden at the method level.  If more rows are available, the response will include a `nextPage` element, which contains a URL for requesting the next page.  If this value is not provided, no more rows are available. No \"previous page\" element is explicitly provided; to support backward paging, use the previous call.  ### Array Size  For data items that are not paginated, the REST API supports arrays of up to 300 rows.  Thus, for instance, repeated pagination can retrieve thousands of customer accounts, but within any account an array of no more than 300 rate plans is returned.

This PHP package is automatically generated by the [Swagger Codegen](https://github.com/swagger-api/swagger-codegen) project:

- API version: 0.0.1
- Build date: 2016-10-27T20:57:24.953Z
- Build package: class io.swagger.codegen.languages.PhpClientCodegen

## Requirements

PHP 5.4.0 and later

## Installation & Usage

### Manual Installation

Download the files and deploy to an apache server. 

### Zuora Test Drive

To complete this tutorial, you'll need a Zuora Test Drive tenant.

The Test Drive tenant comes with seed data, such as a sample product catalog, which will be used in the Exercises.
Go to [Zuora Test Drive](https://www.zuora.com/resource/zuora-test-drive/) and sign up for a tenant.

## Getting Started

To run, deploy on an APACHE server and navigate to index.html page. Choose a scenario and click Submit. 

### Included Scenarios 
* Connect to Zuora 
* Retrieve product catalog 
* Retrieve specific product 
* Create account and subscription 
* Upgrade subscription by adding a new plan 
* Cancel subscription 

## Documentation for API Endpoints

All URIs are relative to *https://rest.zuora.com/v1*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*AccountingCodesApi* | [**dELETEAccountingCode**](docs/Api/AccountingCodesApi.md#deleteaccountingcode) | **DELETE** /accounting-codes/{ac-id} | Delete accounting code
*AccountingCodesApi* | [**gETAccountingCodeItem**](docs/Api/AccountingCodesApi.md#getaccountingcodeitem) | **GET** /accounting-codes/{ac-id} | Query an accounting code
*AccountingCodesApi* | [**gETAccountingCodes**](docs/Api/AccountingCodesApi.md#getaccountingcodes) | **GET** /accounting-codes | Get all accounting codes
*AccountingCodesApi* | [**pOSTAccountingCode**](docs/Api/AccountingCodesApi.md#postaccountingcode) | **POST** /accounting-codes | Create accounting code
*AccountingCodesApi* | [**pUTAccountingCode**](docs/Api/AccountingCodesApi.md#putaccountingcode) | **PUT** /accounting-codes/{ac-id} | Update an accounting code
*AccountingCodesApi* | [**pUTActivateAccountingCode**](docs/Api/AccountingCodesApi.md#putactivateaccountingcode) | **PUT** /accounting-codes/{ac-id}/activate | Activate accounting code
*AccountingCodesApi* | [**pUTDeactivateAccountingCode**](docs/Api/AccountingCodesApi.md#putdeactivateaccountingcode) | **PUT** /accounting-codes/{ac-id}/deactivate | Deactivate accounting code
*AccountingCodesApi* | [**proxyDELETEAccountingCode**](docs/Api/AccountingCodesApi.md#proxydeleteaccountingcode) | **DELETE** /object/accounting-code/{id} | CRUD: Delete AccountingCode
*AccountingCodesApi* | [**proxyGETAccountingCode**](docs/Api/AccountingCodesApi.md#proxygetaccountingcode) | **GET** /object/accounting-code/{id} | CRUD: Retrieve AccountingCode
*AccountingCodesApi* | [**proxyPOSTAccountingCode**](docs/Api/AccountingCodesApi.md#proxypostaccountingcode) | **POST** /object/accounting-code | CRUD: Create AccountingCode
*AccountingCodesApi* | [**proxyPUTAccountingCode**](docs/Api/AccountingCodesApi.md#proxyputaccountingcode) | **PUT** /object/accounting-code/{id} | CRUD: Update AccountingCode
*AccountingPeriodsApi* | [**dELETEAccountingPeriod**](docs/Api/AccountingPeriodsApi.md#deleteaccountingperiod) | **DELETE** /accounting-periods/{ap-id} | Delete accounting period
*AccountingPeriodsApi* | [**gETAccountingPeriod**](docs/Api/AccountingPeriodsApi.md#getaccountingperiod) | **GET** /accounting-periods/{ap-id} | Get accounting period
*AccountingPeriodsApi* | [**gETAccountingPeriods**](docs/Api/AccountingPeriodsApi.md#getaccountingperiods) | **GET** /accounting-periods | Get all accounting periods
*AccountingPeriodsApi* | [**pOSTAccountingPeriod**](docs/Api/AccountingPeriodsApi.md#postaccountingperiod) | **POST** /accounting-periods | Create accounting period
*AccountingPeriodsApi* | [**pUTCloseAccountingPeriod**](docs/Api/AccountingPeriodsApi.md#putcloseaccountingperiod) | **PUT** /accounting-periods/{ap-id}/close | Close accounting period
*AccountingPeriodsApi* | [**pUTPendingCloseAccountingPeriod**](docs/Api/AccountingPeriodsApi.md#putpendingcloseaccountingperiod) | **PUT** /accounting-periods/{ap-id}/pending-close | Set accounting period to pending close
*AccountingPeriodsApi* | [**pUTReopenAccountingPeriod**](docs/Api/AccountingPeriodsApi.md#putreopenaccountingperiod) | **PUT** /accounting-periods/{ap-id}/reopen | Re-open accounting period
*AccountingPeriodsApi* | [**pUTRunTrialBalance**](docs/Api/AccountingPeriodsApi.md#putruntrialbalance) | **PUT** /accounting-periods/{ap-id}/run-trial-balance | Run trial balance
*AccountingPeriodsApi* | [**pUTUpdateAccountingPeriod**](docs/Api/AccountingPeriodsApi.md#putupdateaccountingperiod) | **PUT** /accounting-periods/{ap-id} | Update accounting period
*AccountingPeriodsApi* | [**proxyDELETEAccountingPeriod**](docs/Api/AccountingPeriodsApi.md#proxydeleteaccountingperiod) | **DELETE** /object/accounting-period/{id} | CRUD: Delete AccountingPeriod
*AccountingPeriodsApi* | [**proxyGETAccountingPeriod**](docs/Api/AccountingPeriodsApi.md#proxygetaccountingperiod) | **GET** /object/accounting-period/{id} | CRUD: Retrieve AccountingPeriod
*AccountsApi* | [**gETAccount**](docs/Api/AccountsApi.md#getaccount) | **GET** /accounts/{account-key} | Get account
*AccountsApi* | [**gETAccountSummary**](docs/Api/AccountsApi.md#getaccountsummary) | **GET** /accounts/{account-key}/Summary | Get account summary
*AccountsApi* | [**pOSTAccount**](docs/Api/AccountsApi.md#postaccount) | **POST** /accounts | Create account
*AccountsApi* | [**pUTAccount**](docs/Api/AccountsApi.md#putaccount) | **PUT** /accounts/{account-key} | Update account
*AccountsApi* | [**proxyDELETEAccount**](docs/Api/AccountsApi.md#proxydeleteaccount) | **DELETE** /object/account/{id} | CRUD: Delete Account
*AccountsApi* | [**proxyGETAccount**](docs/Api/AccountsApi.md#proxygetaccount) | **GET** /object/account/{id} | CRUD: Retrieve Account
*AccountsApi* | [**proxyPOSTAccount**](docs/Api/AccountsApi.md#proxypostaccount) | **POST** /object/account | CRUD: Create Account
*AccountsApi* | [**proxyPUTAccount**](docs/Api/AccountsApi.md#proxyputaccount) | **PUT** /object/account/{id} | CRUD: Update Account
*ActionsApi* | [**proxyActionPOSTamend**](docs/Api/ActionsApi.md#proxyactionpostamend) | **POST** /action/amend | Amend
*ActionsApi* | [**proxyActionPOSTcreate**](docs/Api/ActionsApi.md#proxyactionpostcreate) | **POST** /action/create | Create
*ActionsApi* | [**proxyActionPOSTdelete**](docs/Api/ActionsApi.md#proxyactionpostdelete) | **POST** /action/delete | Delete
*ActionsApi* | [**proxyActionPOSTexecute**](docs/Api/ActionsApi.md#proxyactionpostexecute) | **POST** /action/execute | Execute
*ActionsApi* | [**proxyActionPOSTgenerate**](docs/Api/ActionsApi.md#proxyactionpostgenerate) | **POST** /action/generate | Generate
*ActionsApi* | [**proxyActionPOSTgetUserInfo**](docs/Api/ActionsApi.md#proxyactionpostgetuserinfo) | **POST** /action/getUserInfo | GetUserInfo
*ActionsApi* | [**proxyActionPOSTlogin**](docs/Api/ActionsApi.md#proxyactionpostlogin) | **POST** /action/login | Login
*ActionsApi* | [**proxyActionPOSTquery**](docs/Api/ActionsApi.md#proxyactionpostquery) | **POST** /action/query | Query
*ActionsApi* | [**proxyActionPOSTqueryMore**](docs/Api/ActionsApi.md#proxyactionpostquerymore) | **POST** /action/queryMore | QueryMore
*ActionsApi* | [**proxyActionPOSTsubscribe**](docs/Api/ActionsApi.md#proxyactionpostsubscribe) | **POST** /action/subscribe | Subscribe
*ActionsApi* | [**proxyActionPOSTupdate**](docs/Api/ActionsApi.md#proxyactionpostupdate) | **POST** /action/update | Update
*AmendmentsApi* | [**gETAmendment**](docs/Api/AmendmentsApi.md#getamendment) | **GET** /amendments/{amendment-key} | Get amendments by key
*AmendmentsApi* | [**gETAmendmentsBySubscriptionID**](docs/Api/AmendmentsApi.md#getamendmentsbysubscriptionid) | **GET** /amendments/subscriptions/{subscription-id} | Get amendments by subscription ID
*AmendmentsApi* | [**proxyDELETEAmendment**](docs/Api/AmendmentsApi.md#proxydeleteamendment) | **DELETE** /object/amendment/{id} | CRUD: Delete Amendment
*AmendmentsApi* | [**proxyGETAmendment**](docs/Api/AmendmentsApi.md#proxygetamendment) | **GET** /object/amendment/{id} | CRUD: Retrieve Amendment
*AmendmentsApi* | [**proxyPOSTAmendment**](docs/Api/AmendmentsApi.md#proxypostamendment) | **POST** /object/amendment | CRUD: Create Amendment
*AmendmentsApi* | [**proxyPUTAmendment**](docs/Api/AmendmentsApi.md#proxyputamendment) | **PUT** /object/amendment/{id} | CRUD: Update Amendment
*AttachmentsApi* | [**dELETEAttachments**](docs/Api/AttachmentsApi.md#deleteattachments) | **DELETE** /attachments/{attachment-id} | Delete attachments
*AttachmentsApi* | [**gETAttachments**](docs/Api/AttachmentsApi.md#getattachments) | **GET** /attachments/{attachment-id} | View attachments
*AttachmentsApi* | [**gETAttachmentsResponse**](docs/Api/AttachmentsApi.md#getattachmentsresponse) | **GET** /attachments/{object-type}/{object-key} | View attachments list
*AttachmentsApi* | [**pOSTAttachments**](docs/Api/AttachmentsApi.md#postattachments) | **POST** /attachments | Add attachments
*AttachmentsApi* | [**pUTAttachments**](docs/Api/AttachmentsApi.md#putattachments) | **PUT** /attachments/{attachment-id} | Edit attachments
*CatalogApi* | [**gETCatalog**](docs/Api/CatalogApi.md#getcatalog) | **GET** /catalog/products | Get product catalog
*ChargeRevenueSummariesApi* | [**gETCRSByCRSNumber**](docs/Api/ChargeRevenueSummariesApi.md#getcrsbycrsnumber) | **GET** /charge-revenue-summaries/{crs-number} | Get charge summary details by CRS number
*ChargeRevenueSummariesApi* | [**gETCRSByChargeID**](docs/Api/ChargeRevenueSummariesApi.md#getcrsbychargeid) | **GET** /charge-revenue-summaries/subscription-charges/{charge-key} | Get charge summary details by charge ID
*CommunicationProfilesApi* | [**proxyDELETECommunicationProfile**](docs/Api/CommunicationProfilesApi.md#proxydeletecommunicationprofile) | **DELETE** /object/communication-profile/{id} | CRUD: Delete CommunicationProfile
*CommunicationProfilesApi* | [**proxyGETCommunicationProfile**](docs/Api/CommunicationProfilesApi.md#proxygetcommunicationprofile) | **GET** /object/communication-profile/{id} | CRUD: Retrieve CommunicationProfile
*ConnectionsApi* | [**pOSTConnections**](docs/Api/ConnectionsApi.md#postconnections) | **POST** /connections | Establish connection to Zuora REST API service
*ContactsApi* | [**proxyDELETEContact**](docs/Api/ContactsApi.md#proxydeletecontact) | **DELETE** /object/contact/{id} | CRUD: Delete Contact
*ContactsApi* | [**proxyGETContact**](docs/Api/ContactsApi.md#proxygetcontact) | **GET** /object/contact/{id} | CRUD: Retrieve Contact
*ContactsApi* | [**proxyPOSTContact**](docs/Api/ContactsApi.md#proxypostcontact) | **POST** /object/contact | CRUD: Create Contact
*ContactsApi* | [**proxyPUTContact**](docs/Api/ContactsApi.md#proxyputcontact) | **PUT** /object/contact/{id} | CRUD: Update Contact
*CreditBalanceAdjustmentsApi* | [**proxyDELETECreditBalanceAdjustment**](docs/Api/CreditBalanceAdjustmentsApi.md#proxydeletecreditbalanceadjustment) | **DELETE** /object/credit-balance-adjustment/{id} | CRUD: Delete CreditBalanceAdjustment
*CreditBalanceAdjustmentsApi* | [**proxyGETCreditBalanceAdjustment**](docs/Api/CreditBalanceAdjustmentsApi.md#proxygetcreditbalanceadjustment) | **GET** /object/credit-balance-adjustment/{id} | CRUD: Retrieve CreditBalanceAdjustment
*CustomExchangeRatesApi* | [**gETCustomExchangeRates**](docs/Api/CustomExchangeRatesApi.md#getcustomexchangerates) | **GET** /custom-exchange-rates/{currency} | Get custom foreign currency exchange rates
*ExportsApi* | [**proxyDELETEExport**](docs/Api/ExportsApi.md#proxydeleteexport) | **DELETE** /object/export/{id} | CRUD: Delete Export
*ExportsApi* | [**proxyGETExport**](docs/Api/ExportsApi.md#proxygetexport) | **GET** /object/export/{id} | CRUD: Retrieve Export
*ExportsApi* | [**proxyPOSTExport**](docs/Api/ExportsApi.md#proxypostexport) | **POST** /object/export | CRUD: Create Export
*FeaturesApi* | [**proxyDELETEFeature**](docs/Api/FeaturesApi.md#proxydeletefeature) | **DELETE** /object/feature/{id} | CRUD: Delete Feature
*FeaturesApi* | [**proxyGETFeature**](docs/Api/FeaturesApi.md#proxygetfeature) | **GET** /object/feature/{id} | CRUD: Retrieve Feature
*GetFilesApi* | [**gETFiles**](docs/Api/GetFilesApi.md#getfiles) | **GET** /files/{file-id} | Get files
*HMACSignaturesApi* | [**pOSTHMACSignature**](docs/Api/HMACSignaturesApi.md#posthmacsignature) | **POST** /hmac-signatures | Return HMAC signatures
*HostedPagesApi* | [**getHostedPages**](docs/Api/HostedPagesApi.md#gethostedpages) | **GET** /hostedpages | Return hosted pages
*ImportsApi* | [**proxyDELETEImport**](docs/Api/ImportsApi.md#proxydeleteimport) | **DELETE** /object/import/{id} | CRUD: Delete Import
*ImportsApi* | [**proxyGETImport**](docs/Api/ImportsApi.md#proxygetimport) | **GET** /object/import/{id} | CRUD: Retrieve Import
*ImportsApi* | [**proxyPOSTImport**](docs/Api/ImportsApi.md#proxypostimport) | **POST** /object/import | CRUD: Create Import
*InvoiceAdjustmentsApi* | [**proxyDELETEInvoiceAdjustment**](docs/Api/InvoiceAdjustmentsApi.md#proxydeleteinvoiceadjustment) | **DELETE** /object/invoice-adjustment/{id} | CRUD: Delete InvoiceAdjustment
*InvoiceAdjustmentsApi* | [**proxyGETInvoiceAdjustment**](docs/Api/InvoiceAdjustmentsApi.md#proxygetinvoiceadjustment) | **GET** /object/invoice-adjustment/{id} | CRUD: Retrieve InvoiceAdjustment
*InvoiceAdjustmentsApi* | [**proxyPOSTInvoiceAdjustment**](docs/Api/InvoiceAdjustmentsApi.md#proxypostinvoiceadjustment) | **POST** /object/invoice-adjustment | CRUD: Create InvoiceAdjustment
*InvoiceAdjustmentsApi* | [**proxyPUTInvoiceAdjustment**](docs/Api/InvoiceAdjustmentsApi.md#proxyputinvoiceadjustment) | **PUT** /object/invoice-adjustment/{id} | CRUD: Update InvoiceAdjustment
*InvoiceItemAdjustmentsApi* | [**proxyDELETEInvoiceItemAdjustment**](docs/Api/InvoiceItemAdjustmentsApi.md#proxydeleteinvoiceitemadjustment) | **DELETE** /object/invoice-item-adjustment/{id} | CRUD: Delete InvoiceItemAdjustment
*InvoiceItemAdjustmentsApi* | [**proxyGETInvoiceItemAdjustment**](docs/Api/InvoiceItemAdjustmentsApi.md#proxygetinvoiceitemadjustment) | **GET** /object/invoice-item-adjustment/{id} | CRUD: Retrieve InvoiceItemAdjustment
*InvoiceItemsApi* | [**proxyDELETEInvoiceItem**](docs/Api/InvoiceItemsApi.md#proxydeleteinvoiceitem) | **DELETE** /object/invoice-item/{id} | CRUD: Delete InvoiceItem
*InvoiceItemsApi* | [**proxyGETInvoiceItem**](docs/Api/InvoiceItemsApi.md#proxygetinvoiceitem) | **GET** /object/invoice-item/{id} | CRUD: Retrieve InvoiceItem
*InvoicePaymentsApi* | [**proxyDELETEInvoicePayment**](docs/Api/InvoicePaymentsApi.md#proxydeleteinvoicepayment) | **DELETE** /object/invoice-payment/{id} | CRUD: Delete InvoicePayment
*InvoicePaymentsApi* | [**proxyGETInvoicePayment**](docs/Api/InvoicePaymentsApi.md#proxygetinvoicepayment) | **GET** /object/invoice-payment/{id} | CRUD: Retrieve InvoicePayment
*InvoicePaymentsApi* | [**proxyPOSTInvoicePayment**](docs/Api/InvoicePaymentsApi.md#proxypostinvoicepayment) | **POST** /object/invoice-payment | CRUD: Create InvoicePayment
*InvoicePaymentsApi* | [**proxyPUTInvoicePayment**](docs/Api/InvoicePaymentsApi.md#proxyputinvoicepayment) | **PUT** /object/invoice-payment/{id} | CRUD: Update InvoicePayment
*InvoiceSplitItemsApi* | [**proxyDELETEInvoiceSplitItem**](docs/Api/InvoiceSplitItemsApi.md#proxydeleteinvoicesplititem) | **DELETE** /object/invoice-split-item/{id} | CRUD: Delete InvoiceSplitItem
*InvoiceSplitItemsApi* | [**proxyGETInvoiceSplitItem**](docs/Api/InvoiceSplitItemsApi.md#proxygetinvoicesplititem) | **GET** /object/invoice-split-item/{id} | CRUD: Retrieve InvoiceSplitItem
*InvoiceSplitsApi* | [**proxyDELETEInvoiceSplit**](docs/Api/InvoiceSplitsApi.md#proxydeleteinvoicesplit) | **DELETE** /object/invoice-split/{id} | CRUD: Delete InvoiceSplit
*InvoiceSplitsApi* | [**proxyGETInvoiceSplit**](docs/Api/InvoiceSplitsApi.md#proxygetinvoicesplit) | **GET** /object/invoice-split/{id} | CRUD: Retrieve InvoiceSplit
*InvoicesApi* | [**proxyDELETEInvoice**](docs/Api/InvoicesApi.md#proxydeleteinvoice) | **DELETE** /object/invoice/{id} | CRUD: Delete Invoice
*InvoicesApi* | [**proxyGETInvoice**](docs/Api/InvoicesApi.md#proxygetinvoice) | **GET** /object/invoice/{id} | CRUD: Retrieve Invoice
*InvoicesApi* | [**proxyPOSTInvoice**](docs/Api/InvoicesApi.md#proxypostinvoice) | **POST** /object/invoice | CRUD: Create Invoice
*InvoicesApi* | [**proxyPUTInvoice**](docs/Api/InvoicesApi.md#proxyputinvoice) | **PUT** /object/invoice/{id} | CRUD: Update Invoice
*JournalRunsApi* | [**dELETEJournalRun**](docs/Api/JournalRunsApi.md#deletejournalrun) | **DELETE** /journal-runs/{jr-number} | Delete journal run
*JournalRunsApi* | [**gETJournalRun**](docs/Api/JournalRunsApi.md#getjournalrun) | **GET** /journal-runs/{jr-number} | Get journal run
*JournalRunsApi* | [**pOSTJournalRun**](docs/Api/JournalRunsApi.md#postjournalrun) | **POST** /journal-runs | Create journal run
*JournalRunsApi* | [**pUTJournalRun**](docs/Api/JournalRunsApi.md#putjournalrun) | **PUT** /journal-runs/{jr-number}/cancel | Cancel journal run
*MassUpdaterApi* | [**gETMassUpdate**](docs/Api/MassUpdaterApi.md#getmassupdate) | **GET** /bulk/{bulk-key} | Get mass action result
*MassUpdaterApi* | [**pOSTMassUpdate**](docs/Api/MassUpdaterApi.md#postmassupdate) | **POST** /bulk | Perform mass action
*MassUpdaterApi* | [**pUTMassUpdater**](docs/Api/MassUpdaterApi.md#putmassupdater) | **PUT** /bulk/{bulk-key}/stop | Stop mass action
*NotificationHistoryApi* | [**gETCalloutHistoryVOs**](docs/Api/NotificationHistoryApi.md#getcallouthistoryvos) | **GET** /notification-history/callout | Get callout notification histories
*NotificationHistoryApi* | [**gETEmailHistoryVOs**](docs/Api/NotificationHistoryApi.md#getemailhistoryvos) | **GET** /notification-history/email | Get email notification histories
*OperationsApi* | [**pOSTTransactionInvoicePayment**](docs/Api/OperationsApi.md#posttransactioninvoicepayment) | **POST** /operations/invoice-collect | Invoice and collect
*PaymentMethodSnapshotsApi* | [**proxyDELETEPaymentMethodSnapshot**](docs/Api/PaymentMethodSnapshotsApi.md#proxydeletepaymentmethodsnapshot) | **DELETE** /object/payment-method-snapshot/{id} | CRUD: Delete PaymentMethodSnapshot
*PaymentMethodSnapshotsApi* | [**proxyGETPaymentMethodSnapshot**](docs/Api/PaymentMethodSnapshotsApi.md#proxygetpaymentmethodsnapshot) | **GET** /object/payment-method-snapshot/{id} | CRUD: Retrieve PaymentMethodSnapshot
*PaymentMethodTransactionLogsApi* | [**proxyDELETEPaymentMethodTransactionLog**](docs/Api/PaymentMethodTransactionLogsApi.md#proxydeletepaymentmethodtransactionlog) | **DELETE** /object/payment-method-transaction-log/{id} | CRUD: Delete PaymentMethodTransactionLog
*PaymentMethodTransactionLogsApi* | [**proxyGETPaymentMethodTransactionLog**](docs/Api/PaymentMethodTransactionLogsApi.md#proxygetpaymentmethodtransactionlog) | **GET** /object/payment-method-transaction-log/{id} | CRUD: Retrieve PaymentMethodTransactionLog
*PaymentMethodsApi* | [**dELETEPaymentMethods**](docs/Api/PaymentMethodsApi.md#deletepaymentmethods) | **DELETE** /payment-methods/{payment-method-id} | Delete payment method
*PaymentMethodsApi* | [**gETPaymentMethods**](docs/Api/PaymentMethodsApi.md#getpaymentmethods) | **GET** /payment-methods/credit-cards/accounts/{account-key} | Get payment methods
*PaymentMethodsApi* | [**pOSTPaymentMethod**](docs/Api/PaymentMethodsApi.md#postpaymentmethod) | **POST** /payment-methods/credit-cards | Create payment method
*PaymentMethodsApi* | [**pUTPaymentMethods**](docs/Api/PaymentMethodsApi.md#putpaymentmethods) | **PUT** /payment-methods/credit-cards/{payment-method-id} | Update payment method
*PaymentMethodsApi* | [**proxyDELETEPaymentMethod**](docs/Api/PaymentMethodsApi.md#proxydeletepaymentmethod) | **DELETE** /object/payment-method/{id} | CRUD: Delete PaymentMethod
*PaymentMethodsApi* | [**proxyGETPaymentMethod**](docs/Api/PaymentMethodsApi.md#proxygetpaymentmethod) | **GET** /object/payment-method/{id} | CRUD: Retrieve PaymentMethod
*PaymentMethodsApi* | [**proxyPOSTPaymentMethod**](docs/Api/PaymentMethodsApi.md#proxypostpaymentmethod) | **POST** /object/payment-method | CRUD: Create PaymentMethod
*PaymentMethodsApi* | [**proxyPUTPaymentMethod**](docs/Api/PaymentMethodsApi.md#proxyputpaymentmethod) | **PUT** /object/payment-method/{id} | CRUD: Update PaymentMethod
*PaymentTransactionLogsApi* | [**proxyDELETEPaymentTransactionLog**](docs/Api/PaymentTransactionLogsApi.md#proxydeletepaymenttransactionlog) | **DELETE** /object/payment-transaction-log/{id} | CRUD: Delete PaymentTransactionLog
*PaymentTransactionLogsApi* | [**proxyGETPaymentTransactionLog**](docs/Api/PaymentTransactionLogsApi.md#proxygetpaymenttransactionlog) | **GET** /object/payment-transaction-log/{id} | CRUD: Retrieve PaymentTransactionLog
*PaymentsApi* | [**proxyDELETEPayment**](docs/Api/PaymentsApi.md#proxydeletepayment) | **DELETE** /object/payment/{id} | CRUD: Delete Payment
*PaymentsApi* | [**proxyGETPayment**](docs/Api/PaymentsApi.md#proxygetpayment) | **GET** /object/payment/{id} | CRUD: Retrieve Payment
*PaymentsApi* | [**proxyPOSTPayment**](docs/Api/PaymentsApi.md#proxypostpayment) | **POST** /object/payment | CRUD: Create Payment
*PaymentsApi* | [**proxyPUTPayment**](docs/Api/PaymentsApi.md#proxyputpayment) | **PUT** /object/payment/{id} | CRUD: Update Payment
*ProductFeaturesApi* | [**proxyDELETEProductFeature**](docs/Api/ProductFeaturesApi.md#proxydeleteproductfeature) | **DELETE** /object/product-feature/{id} | CRUD: Delete ProductFeature
*ProductFeaturesApi* | [**proxyGETProductFeature**](docs/Api/ProductFeaturesApi.md#proxygetproductfeature) | **GET** /object/product-feature/{id} | CRUD: Retrieve ProductFeature
*ProductRatePlanChargeTiersApi* | [**proxyDELETEProductRatePlanChargeTier**](docs/Api/ProductRatePlanChargeTiersApi.md#proxydeleteproductrateplanchargetier) | **DELETE** /object/product-rate-plan-charge-tier/{id} | CRUD: Delete ProductRatePlanChargeTier
*ProductRatePlanChargeTiersApi* | [**proxyGETProductRatePlanChargeTier**](docs/Api/ProductRatePlanChargeTiersApi.md#proxygetproductrateplanchargetier) | **GET** /object/product-rate-plan-charge-tier/{id} | CRUD: Retrieve ProductRatePlanChargeTier
*ProductRatePlanChargesApi* | [**proxyDELETEProductRatePlanCharge**](docs/Api/ProductRatePlanChargesApi.md#proxydeleteproductrateplancharge) | **DELETE** /object/product-rate-plan-charge/{id} | CRUD: Delete ProductRatePlanCharge
*ProductRatePlanChargesApi* | [**proxyGETProductRatePlanCharge**](docs/Api/ProductRatePlanChargesApi.md#proxygetproductrateplancharge) | **GET** /object/product-rate-plan-charge/{id} | CRUD: Retrieve ProductRatePlanCharge
*ProductRatePlansApi* | [**proxyDELETEProductRatePlan**](docs/Api/ProductRatePlansApi.md#proxydeleteproductrateplan) | **DELETE** /object/product-rate-plan/{id} | CRUD: Delete ProductRatePlan
*ProductRatePlansApi* | [**proxyGETProductRatePlan**](docs/Api/ProductRatePlansApi.md#proxygetproductrateplan) | **GET** /object/product-rate-plan/{id} | CRUD: Retrieve ProductRatePlan
*ProductRatePlansApi* | [**proxyPOSTProductRatePlan**](docs/Api/ProductRatePlansApi.md#proxypostproductrateplan) | **POST** /object/product-rate-plan | CRUD: Create ProductRatePlan
*ProductRatePlansApi* | [**proxyPUTProductRatePlan**](docs/Api/ProductRatePlansApi.md#proxyputproductrateplan) | **PUT** /object/product-rate-plan/{id} | CRUD: Update ProductRatePlan
*ProductsApi* | [**proxyDELETEProduct**](docs/Api/ProductsApi.md#proxydeleteproduct) | **DELETE** /object/product/{id} | CRUD: Delete Product
*ProductsApi* | [**proxyGETProduct**](docs/Api/ProductsApi.md#proxygetproduct) | **GET** /object/product/{id} | CRUD: Retrieve Product
*ProductsApi* | [**proxyPOSTProduct**](docs/Api/ProductsApi.md#proxypostproduct) | **POST** /object/product | CRUD: Create Product
*ProductsApi* | [**proxyPUTProduct**](docs/Api/ProductsApi.md#proxyputproduct) | **PUT** /object/product/{id} | CRUD: Update Product
*QuotesDocumentApi* | [**pOSTQuoteDoc**](docs/Api/QuotesDocumentApi.md#postquotedoc) | **POST** /quotes/document | Generate quotes document
*RSASignaturesApi* | [**pOSTDecryptResponse**](docs/Api/RSASignaturesApi.md#postdecryptresponse) | **POST** /rsa-signatures/decrypt | Decrypt RSA signature
*RSASignaturesApi* | [**pOSTRSASignature**](docs/Api/RSASignaturesApi.md#postrsasignature) | **POST** /rsa-signatures | Generate RSA signature
*RatePlanChargeTiersApi* | [**proxyDELETERatePlanChargeTier**](docs/Api/RatePlanChargeTiersApi.md#proxydeleterateplanchargetier) | **DELETE** /object/rate-plan-charge-tier/{id} | CRUD: Delete RatePlanChargeTier
*RatePlanChargeTiersApi* | [**proxyGETRatePlanChargeTier**](docs/Api/RatePlanChargeTiersApi.md#proxygetrateplanchargetier) | **GET** /object/rate-plan-charge-tier/{id} | CRUD: Retrieve RatePlanChargeTier
*RatePlanChargesApi* | [**proxyDELETERatePlanCharge**](docs/Api/RatePlanChargesApi.md#proxydeleterateplancharge) | **DELETE** /object/rate-plan-charge/{id} | CRUD: Delete RatePlanCharge
*RatePlanChargesApi* | [**proxyGETRatePlanCharge**](docs/Api/RatePlanChargesApi.md#proxygetrateplancharge) | **GET** /object/rate-plan-charge/{id} | CRUD: Retrieve RatePlanCharge
*RatePlansApi* | [**proxyDELETERatePlan**](docs/Api/RatePlansApi.md#proxydeleterateplan) | **DELETE** /object/rate-plan/{id} | CRUD: Delete RatePlan
*RatePlansApi* | [**proxyGETRatePlan**](docs/Api/RatePlansApi.md#proxygetrateplan) | **GET** /object/rate-plan/{id} | CRUD: Retrieve RatePlan
*RefundInvoicePaymentsApi* | [**proxyDELETERefundInvoicePayment**](docs/Api/RefundInvoicePaymentsApi.md#proxydeleterefundinvoicepayment) | **DELETE** /object/refund-invoice-payment/{id} | CRUD: Delete RefundInvoicePayment
*RefundInvoicePaymentsApi* | [**proxyGETRefundInvoicePayment**](docs/Api/RefundInvoicePaymentsApi.md#proxygetrefundinvoicepayment) | **GET** /object/refund-invoice-payment/{id} | CRUD: Retrieve RefundInvoicePayment
*RefundTransactionLogsApi* | [**proxyDELETERefundTransactionLog**](docs/Api/RefundTransactionLogsApi.md#proxydeleterefundtransactionlog) | **DELETE** /object/refund-transaction-log/{id} | CRUD: Delete RefundTransactionLog
*RefundTransactionLogsApi* | [**proxyGETRefundTransactionLog**](docs/Api/RefundTransactionLogsApi.md#proxygetrefundtransactionlog) | **GET** /object/refund-transaction-log/{id} | CRUD: Retrieve RefundTransactionLog
*RefundsApi* | [**proxyDELETERefund**](docs/Api/RefundsApi.md#proxydeleterefund) | **DELETE** /object/refund/{id} | CRUD: Delete Refund
*RefundsApi* | [**proxyGETRefund**](docs/Api/RefundsApi.md#proxygetrefund) | **GET** /object/refund/{id} | CRUD: Retrieve Refund
*RefundsApi* | [**proxyPOSTRefund**](docs/Api/RefundsApi.md#proxypostrefund) | **POST** /object/refund | CRUD: Create Refund
*RefundsApi* | [**proxyPUTRefund**](docs/Api/RefundsApi.md#proxyputrefund) | **PUT** /object/refund/{id} | CRUD: Update Refund
*RevenueEventsApi* | [**gETRevenueEventDetails**](docs/Api/RevenueEventsApi.md#getrevenueeventdetails) | **GET** /revenue-events/revenue-schedules/{rs-number} | Get revenue events for a revenue schedule
*RevenueEventsApi* | [**gETRevenueEventDetails_0**](docs/Api/RevenueEventsApi.md#getrevenueeventdetails_0) | **GET** /revenue-events/{event-number} | Get revenue event details
*RevenueItemsApi* | [**gETRevenueItemsByChargeRevenueEventNumber**](docs/Api/RevenueItemsApi.md#getrevenueitemsbychargerevenueeventnumber) | **GET** /revenue-items/revenue-events/{event-number} | Get revenue items by revenue event number
*RevenueItemsApi* | [**gETRevenueItemsByChargeRevenueSummaryNumber**](docs/Api/RevenueItemsApi.md#getrevenueitemsbychargerevenuesummarynumber) | **GET** /revenue-items/charge-revenue-summaries/{crs-number} | Get revenue items by charge revenue summary number
*RevenueItemsApi* | [**gETRevenueItemsByRevenueSchedule**](docs/Api/RevenueItemsApi.md#getrevenueitemsbyrevenueschedule) | **GET** /revenue-items/revenue-schedules/{rs-number} | Get revenue items by revenue schedule
*RevenueItemsApi* | [**pUTCustomFieldsonRevenueItemsByRevenueEvent**](docs/Api/RevenueItemsApi.md#putcustomfieldsonrevenueitemsbyrevenueevent) | **PUT** /revenue-items/revenue-events/{event-number} | Update custom fields on revenue items by revenue event number
*RevenueItemsApi* | [**pUTCustomFieldsonRevenueItemsByRevenueSchedule**](docs/Api/RevenueItemsApi.md#putcustomfieldsonrevenueitemsbyrevenueschedule) | **PUT** /revenue-items/revenue-schedules/{rs-number} | Update custom fields on revenue items by revenue schedule number
*RevenueRulesApi* | [**gETRevenueRecognitionRuleAssociation**](docs/Api/RevenueRulesApi.md#getrevenuerecognitionruleassociation) | **GET** /revenue-recognition-rules/subscription-charges/{charge-key} | Get the rule associated with a charge
*RevenueSchedulesApi* | [**dELETERS**](docs/Api/RevenueSchedulesApi.md#deleters) | **DELETE** /revenue-schedules/{rs-number} | Delete revenue schedule
*RevenueSchedulesApi* | [**gETRSDetail**](docs/Api/RevenueSchedulesApi.md#getrsdetail) | **GET** /revenue-schedules/{rs-number} | Get revenue schedule details
*RevenueSchedulesApi* | [**gETRSDetailsByCharge**](docs/Api/RevenueSchedulesApi.md#getrsdetailsbycharge) | **GET** /revenue-schedules/subscription-charges/{charge-key} | Get revenue schedule by subscription charge
*RevenueSchedulesApi* | [**gETRSbyInvoiceItem**](docs/Api/RevenueSchedulesApi.md#getrsbyinvoiceitem) | **GET** /revenue-schedules/invoice-items/{invoice-item-id} | Get a revenue schedule by invoice item ID
*RevenueSchedulesApi* | [**gETRSbyInvoiceItemAdjustment**](docs/Api/RevenueSchedulesApi.md#getrsbyinvoiceitemadjustment) | **GET** /revenue-schedules/invoice-item-adjustments/{invoice-item-adj-id}/ | Get a revenue schedule by invoice item adjustment
*RevenueSchedulesApi* | [**pOSTRSforInvoiceItemAdjustmentDistributeByDateRange**](docs/Api/RevenueSchedulesApi.md#postrsforinvoiceitemadjustmentdistributebydaterange) | **POST** /revenue-schedules/invoice-item-adjustments/{invoice-item-adj-key}/distribute-revenue-with-date-range | Create a revenue schedule for an Invoice Item Adjustment (distribute by date range)
*RevenueSchedulesApi* | [**pOSTRSforInvoiceItemAdjustmentManualDistribution**](docs/Api/RevenueSchedulesApi.md#postrsforinvoiceitemadjustmentmanualdistribution) | **POST** /revenue-schedules/invoice-item-adjustments/{invoice-item-adj-key} | Create a revenue schedule for an Invoice Item Adjustment (manual distribution)
*RevenueSchedulesApi* | [**pOSTRSforInvoiceItemDistributeByDateRange**](docs/Api/RevenueSchedulesApi.md#postrsforinvoiceitemdistributebydaterange) | **POST** /revenue-schedules/invoice-items/{invoice-item-id}/distribute-revenue-with-date-range | Create a revenue schedule for an Invoice Item (distribute by date range)
*RevenueSchedulesApi* | [**pOSTRSforInvoiceItemManualDistribution**](docs/Api/RevenueSchedulesApi.md#postrsforinvoiceitemmanualdistribution) | **POST** /revenue-schedules/invoice-items/{invoice-item-id} | Create a revenue schedule for an Invoice Item (manual distribution)
*RevenueSchedulesApi* | [**pOSTRevenueScheduleByChargeResponse**](docs/Api/RevenueSchedulesApi.md#postrevenueschedulebychargeresponse) | **POST** /revenue-schedules/subscription-charges/{charge-key} | Create a revenue schedule on a subscription charge
*RevenueSchedulesApi* | [**pUTRSBasicInfo**](docs/Api/RevenueSchedulesApi.md#putrsbasicinfo) | **PUT** /revenue-schedules/{rs-number}/basic-information | Update revenue schedule basic information
*RevenueSchedulesApi* | [**pUTRevenueAcrossAP**](docs/Api/RevenueSchedulesApi.md#putrevenueacrossap) | **PUT** /revenue-schedules/{rs-number}/distribute-revenue-across-accounting-periods | Distribute revenue across accounting periods
*RevenueSchedulesApi* | [**pUTRevenueByRecognitionStartandEndDates**](docs/Api/RevenueSchedulesApi.md#putrevenuebyrecognitionstartandenddates) | **PUT** /revenue-schedules/{rs-number}/distribute-revenue-with-date-range | Distribute revenue by recognition start and end dates
*RevenueSchedulesApi* | [**pUTRevenueSpecificDate**](docs/Api/RevenueSchedulesApi.md#putrevenuespecificdate) | **PUT** /revenue-schedules/{rs-number}/distribute-revenue-on-specific-date | Distribute revenue on a specific date
*SettingsApi* | [**gETRevenueStartDateSetting**](docs/Api/SettingsApi.md#getrevenuestartdatesetting) | **GET** /settings/finance/revenue-automation-start-date | Get the revenue automation start date
*SubscriptionProductFeaturesApi* | [**proxyDELETESubscriptionProductFeature**](docs/Api/SubscriptionProductFeaturesApi.md#proxydeletesubscriptionproductfeature) | **DELETE** /object/subscription-product-feature/{id} | CRUD: Delete SubscriptionProductFeature
*SubscriptionProductFeaturesApi* | [**proxyGETSubscriptionProductFeature**](docs/Api/SubscriptionProductFeaturesApi.md#proxygetsubscriptionproductfeature) | **GET** /object/subscription-product-feature/{id} | CRUD: Retrieve SubscriptionProductFeature
*SubscriptionsApi* | [**gETOneSubscription**](docs/Api/SubscriptionsApi.md#getonesubscription) | **GET** /subscriptions/{subscription-key} | Get subscriptions by key
*SubscriptionsApi* | [**gETSubscription**](docs/Api/SubscriptionsApi.md#getsubscription) | **GET** /subscriptions/accounts/{account-key} | Get subscriptions by account
*SubscriptionsApi* | [**pOSTSubscription**](docs/Api/SubscriptionsApi.md#postsubscription) | **POST** /subscriptions | Create subscription
*SubscriptionsApi* | [**pOSTSubscriptionCancellation**](docs/Api/SubscriptionsApi.md#postsubscriptioncancellation) | **PUT** /subscriptions/{subscription-key}/cancel | Cancel subscription
*SubscriptionsApi* | [**pOSTSubscriptionPreview**](docs/Api/SubscriptionsApi.md#postsubscriptionpreview) | **POST** /subscriptions/preview | Preview subscription
*SubscriptionsApi* | [**pUTRenewSubscription**](docs/Api/SubscriptionsApi.md#putrenewsubscription) | **PUT** /subscriptions/{subscription-key}/renew | Renew subscription
*SubscriptionsApi* | [**pUTSubscription**](docs/Api/SubscriptionsApi.md#putsubscription) | **PUT** /subscriptions/{subscription-key} | Update subscription
*SubscriptionsApi* | [**pUTSubscriptionResume**](docs/Api/SubscriptionsApi.md#putsubscriptionresume) | **PUT** /subscriptions/{subscription-key}/resume | Resume subscription
*SubscriptionsApi* | [**pUTSubscriptionSuspend**](docs/Api/SubscriptionsApi.md#putsubscriptionsuspend) | **PUT** /subscriptions/{subscription-key}/suspend | Suspend subscription
*SubscriptionsApi* | [**proxyDELETESubscription**](docs/Api/SubscriptionsApi.md#proxydeletesubscription) | **DELETE** /object/subscription/{id} | CRUD: Delete Subscription
*SubscriptionsApi* | [**proxyGETSubscription**](docs/Api/SubscriptionsApi.md#proxygetsubscription) | **GET** /object/subscription/{id} | CRUD: Retrieve Subscription
*SubscriptionsApi* | [**proxyPOSTSubscription**](docs/Api/SubscriptionsApi.md#proxypostsubscription) | **POST** /object/subscription | CRUD: Create Subscription
*SubscriptionsApi* | [**proxyPUTSubscription**](docs/Api/SubscriptionsApi.md#proxyputsubscription) | **PUT** /object/subscription/{id} | CRUD: Update Subscription
*SummaryJournalEntriesApi* | [**dELETESummaryJournalEntry**](docs/Api/SummaryJournalEntriesApi.md#deletesummaryjournalentry) | **DELETE** /journal-entries/{je-number} | Delete summary journal entry
*SummaryJournalEntriesApi* | [**gETJournalEntriesInJournalRun**](docs/Api/SummaryJournalEntriesApi.md#getjournalentriesinjournalrun) | **GET** /journal-entries/journal-runs/{jr-number} | Get all summary journal entries in a journal run
*SummaryJournalEntriesApi* | [**gETJournalEntryDetail**](docs/Api/SummaryJournalEntriesApi.md#getjournalentrydetail) | **GET** /journal-entries/{je-number} | Get summary journal entry
*SummaryJournalEntriesApi* | [**pOSTJournalEntry**](docs/Api/SummaryJournalEntriesApi.md#postjournalentry) | **POST** /journal-entries | Create summary journal entry
*SummaryJournalEntriesApi* | [**pUTBasicSummaryJournalEntry**](docs/Api/SummaryJournalEntriesApi.md#putbasicsummaryjournalentry) | **PUT** /journal-entries/{je-number}/basic-information | Update basic information of a summary journal entry
*SummaryJournalEntriesApi* | [**pUTSummaryJournalEntry**](docs/Api/SummaryJournalEntriesApi.md#putsummaryjournalentry) | **PUT** /journal-entries/{je-number}/cancel | Cancel summary journal entry
*TaxationItemsApi* | [**proxyDELETETaxationItem**](docs/Api/TaxationItemsApi.md#proxydeletetaxationitem) | **DELETE** /object/taxation-item/{id} | CRUD: Delete TaxationItem
*TaxationItemsApi* | [**proxyGETTaxationItem**](docs/Api/TaxationItemsApi.md#proxygettaxationitem) | **GET** /object/taxation-item/{id} | CRUD: Retrieve TaxationItem
*TaxationItemsApi* | [**proxyPOSTTaxationItem**](docs/Api/TaxationItemsApi.md#proxyposttaxationitem) | **POST** /object/taxation-item | CRUD: Create TaxationItem
*TaxationItemsApi* | [**proxyPUTTaxationItem**](docs/Api/TaxationItemsApi.md#proxyputtaxationitem) | **PUT** /object/taxation-item/{id} | CRUD: Update TaxationItem
*TransactionsApi* | [**gETInvoice**](docs/Api/TransactionsApi.md#getinvoice) | **GET** /transactions/invoices/accounts/{account-key} | Get invoices
*TransactionsApi* | [**gETPayments**](docs/Api/TransactionsApi.md#getpayments) | **GET** /transactions/payments/accounts/{account-key} | Get payments
*UnitOfMeasureApi* | [**proxyDELETEUnitOfMeasure**](docs/Api/UnitOfMeasureApi.md#proxydeleteunitofmeasure) | **DELETE** /object/unit-of-measure/{id} | CRUD: Delete UnitOfMeasure
*UnitOfMeasureApi* | [**proxyGETUnitOfMeasure**](docs/Api/UnitOfMeasureApi.md#proxygetunitofmeasure) | **GET** /object/unit-of-measure/{id} | CRUD: Retrieve UnitOfMeasure
*UnitOfMeasureApi* | [**proxyPOSTUnitOfMeasure**](docs/Api/UnitOfMeasureApi.md#proxypostunitofmeasure) | **POST** /object/unit-of-measure | CRUD: Create UnitOfMeasure
*UnitOfMeasureApi* | [**proxyPUTUnitOfMeasure**](docs/Api/UnitOfMeasureApi.md#proxyputunitofmeasure) | **PUT** /object/unit-of-measure/{id} | CRUD: Update UnitOfMeasure
*UsageApi* | [**gETUsage**](docs/Api/UsageApi.md#getusage) | **GET** /usage/accounts/{account-key} | Get usage
*UsageApi* | [**pOSTUsage**](docs/Api/UsageApi.md#postusage) | **POST** /usage | Post usage
*UsageApi* | [**proxyDELETEUsage**](docs/Api/UsageApi.md#proxydeleteusage) | **DELETE** /object/usage/{id} | CRUD: Delete Usage
*UsageApi* | [**proxyGETUsage**](docs/Api/UsageApi.md#proxygetusage) | **GET** /object/usage/{id} | CRUD: Retrieve Usage
*UsageApi* | [**proxyPOSTUsage**](docs/Api/UsageApi.md#proxypostusage) | **POST** /object/usage | CRUD: Create Usage
*UsageApi* | [**proxyPUTUsage**](docs/Api/UsageApi.md#proxyputusage) | **PUT** /object/usage/{id} | CRUD: Update Usage
*UsersApi* | [**proxyDELETEUser**](docs/Api/UsersApi.md#proxydeleteuser) | **DELETE** /object/user/{id} | CRUD: Delete User
*UsersApi* | [**proxyGETUser**](docs/Api/UsersApi.md#proxygetuser) | **GET** /object/user/{id} | CRUD: Retrieve User
*UsersApi* | [**proxyPUTUser**](docs/Api/UsersApi.md#proxyputuser) | **PUT** /object/user/{id} | CRUD: Update User


## Documentation For Models

 - [Account](docs/Model/Account.md)
 - [AmendOptions](docs/Model/AmendOptions.md)
 - [AmendRequest](docs/Model/AmendRequest.md)
 - [AmendResult](docs/Model/AmendResult.md)
 - [Amendment](docs/Model/Amendment.md)
 - [ChargeMetricsData](docs/Model/ChargeMetricsData.md)
 - [CommonResponseType](docs/Model/CommonResponseType.md)
 - [Contact](docs/Model/Contact.md)
 - [DeleteResult](docs/Model/DeleteResult.md)
 - [ElectronicPaymentOptions](docs/Model/ElectronicPaymentOptions.md)
 - [Error](docs/Model/Error.md)
 - [EventRevenueItemType](docs/Model/EventRevenueItemType.md)
 - [ExecuteResult](docs/Model/ExecuteResult.md)
 - [ExternalPaymentOptions](docs/Model/ExternalPaymentOptions.md)
 - [GETAccountSummaryInvoiceType](docs/Model/GETAccountSummaryInvoiceType.md)
 - [GETAccountSummaryPaymentInvoiceType](docs/Model/GETAccountSummaryPaymentInvoiceType.md)
 - [GETAccountSummaryPaymentType](docs/Model/GETAccountSummaryPaymentType.md)
 - [GETAccountSummarySubscriptionRatePlanType](docs/Model/GETAccountSummarySubscriptionRatePlanType.md)
 - [GETAccountSummarySubscriptionType](docs/Model/GETAccountSummarySubscriptionType.md)
 - [GETAccountSummaryType](docs/Model/GETAccountSummaryType.md)
 - [GETAccountSummaryTypeBasicInfo](docs/Model/GETAccountSummaryTypeBasicInfo.md)
 - [GETAccountSummaryTypeBasicInfoDefaultPaymentMethod](docs/Model/GETAccountSummaryTypeBasicInfoDefaultPaymentMethod.md)
 - [GETAccountSummaryTypeBillToContact](docs/Model/GETAccountSummaryTypeBillToContact.md)
 - [GETAccountSummaryTypeSoldToContact](docs/Model/GETAccountSummaryTypeSoldToContact.md)
 - [GETAccountSummaryTypeTaxInfo](docs/Model/GETAccountSummaryTypeTaxInfo.md)
 - [GETAccountSummaryUsageType](docs/Model/GETAccountSummaryUsageType.md)
 - [GETAccountType](docs/Model/GETAccountType.md)
 - [GETAccountTypeBasicInfo](docs/Model/GETAccountTypeBasicInfo.md)
 - [GETAccountTypeBillToContact](docs/Model/GETAccountTypeBillToContact.md)
 - [GETAccountTypeBillingAndPayment](docs/Model/GETAccountTypeBillingAndPayment.md)
 - [GETAccountTypeMetrics](docs/Model/GETAccountTypeMetrics.md)
 - [GETAccountTypeSoldToContact](docs/Model/GETAccountTypeSoldToContact.md)
 - [GETAccountingCodeItemType](docs/Model/GETAccountingCodeItemType.md)
 - [GETAccountingCodeItemWithoutSuccessType](docs/Model/GETAccountingCodeItemWithoutSuccessType.md)
 - [GETAccountingCodesType](docs/Model/GETAccountingCodesType.md)
 - [GETAccountingPeriodFileIdsType](docs/Model/GETAccountingPeriodFileIdsType.md)
 - [GETAccountingPeriodType](docs/Model/GETAccountingPeriodType.md)
 - [GETAccountingPeriodWithoutSuccessType](docs/Model/GETAccountingPeriodWithoutSuccessType.md)
 - [GETAccountingPeriodsType](docs/Model/GETAccountingPeriodsType.md)
 - [GETAmendmentType](docs/Model/GETAmendmentType.md)
 - [GETAttachmentResponseType](docs/Model/GETAttachmentResponseType.md)
 - [GETAttachmentResponseWithoutSuccessType](docs/Model/GETAttachmentResponseWithoutSuccessType.md)
 - [GETAttachmentsResponseType](docs/Model/GETAttachmentsResponseType.md)
 - [GETCalloutHistoryVOType](docs/Model/GETCalloutHistoryVOType.md)
 - [GETCalloutHistoryVOsType](docs/Model/GETCalloutHistoryVOsType.md)
 - [GETCatalogType](docs/Model/GETCatalogType.md)
 - [GETChargeRSDetailType](docs/Model/GETChargeRSDetailType.md)
 - [GETCustomExchangeRatesDataType](docs/Model/GETCustomExchangeRatesDataType.md)
 - [GETCustomExchangeRatesDataTypeDATE](docs/Model/GETCustomExchangeRatesDataTypeDATE.md)
 - [GETCustomExchangeRatesType](docs/Model/GETCustomExchangeRatesType.md)
 - [GETEmailHistoryVOType](docs/Model/GETEmailHistoryVOType.md)
 - [GETEmailHistoryVOsType](docs/Model/GETEmailHistoryVOsType.md)
 - [GETInvoiceFileType](docs/Model/GETInvoiceFileType.md)
 - [GETInvoiceFileWrapper](docs/Model/GETInvoiceFileWrapper.md)
 - [GETInvoiceType](docs/Model/GETInvoiceType.md)
 - [GETInvoicesInvoiceItemType](docs/Model/GETInvoicesInvoiceItemType.md)
 - [GETJournalEntriesInJournalRunType](docs/Model/GETJournalEntriesInJournalRunType.md)
 - [GETJournalEntryDetailType](docs/Model/GETJournalEntryDetailType.md)
 - [GETJournalEntryDetailTypeWithoutSuccess](docs/Model/GETJournalEntryDetailTypeWithoutSuccess.md)
 - [GETJournalEntryItemType](docs/Model/GETJournalEntryItemType.md)
 - [GETJournalEntrySegmentType](docs/Model/GETJournalEntrySegmentType.md)
 - [GETJournalRunTransactionType](docs/Model/GETJournalRunTransactionType.md)
 - [GETJournalRunType](docs/Model/GETJournalRunType.md)
 - [GETMassUpdateType](docs/Model/GETMassUpdateType.md)
 - [GETPaidInvoicesType](docs/Model/GETPaidInvoicesType.md)
 - [GETPaymentMethodType](docs/Model/GETPaymentMethodType.md)
 - [GETPaymentMethodTypeCardHolderInfo](docs/Model/GETPaymentMethodTypeCardHolderInfo.md)
 - [GETPaymentMethodsType](docs/Model/GETPaymentMethodsType.md)
 - [GETPaymentType](docs/Model/GETPaymentType.md)
 - [GETPaymentsType](docs/Model/GETPaymentsType.md)
 - [GETProductRatePlanChargePricingTierType](docs/Model/GETProductRatePlanChargePricingTierType.md)
 - [GETProductRatePlanChargePricingType](docs/Model/GETProductRatePlanChargePricingType.md)
 - [GETProductRatePlanChargeType](docs/Model/GETProductRatePlanChargeType.md)
 - [GETProductRatePlanChargeTypeFinanceInformation](docs/Model/GETProductRatePlanChargeTypeFinanceInformation.md)
 - [GETProductRatePlanType](docs/Model/GETProductRatePlanType.md)
 - [GETProductType](docs/Model/GETProductType.md)
 - [GETRSDetailType](docs/Model/GETRSDetailType.md)
 - [GETRSDetailWithoutSuccessType](docs/Model/GETRSDetailWithoutSuccessType.md)
 - [GETRSDetailsByChargeType](docs/Model/GETRSDetailsByChargeType.md)
 - [GETRevenueEventDetailType](docs/Model/GETRevenueEventDetailType.md)
 - [GETRevenueEventDetailWithoutSuccessType](docs/Model/GETRevenueEventDetailWithoutSuccessType.md)
 - [GETRevenueEventDetailsType](docs/Model/GETRevenueEventDetailsType.md)
 - [GETRevenueItemType](docs/Model/GETRevenueItemType.md)
 - [GETRevenueItemsType](docs/Model/GETRevenueItemsType.md)
 - [GETRevenueRecognitionRuleAssociationType](docs/Model/GETRevenueRecognitionRuleAssociationType.md)
 - [GETRevenueStartDateSettingType](docs/Model/GETRevenueStartDateSettingType.md)
 - [GETRsRevenueItemType](docs/Model/GETRsRevenueItemType.md)
 - [GETRsRevenueItemsType](docs/Model/GETRsRevenueItemsType.md)
 - [GETSubscriptionProductFeatureType](docs/Model/GETSubscriptionProductFeatureType.md)
 - [GETSubscriptionRatePlanChargesType](docs/Model/GETSubscriptionRatePlanChargesType.md)
 - [GETSubscriptionRatePlanType](docs/Model/GETSubscriptionRatePlanType.md)
 - [GETSubscriptionType](docs/Model/GETSubscriptionType.md)
 - [GETSubscriptionTypeWithSuccess](docs/Model/GETSubscriptionTypeWithSuccess.md)
 - [GETSubscriptionWrapper](docs/Model/GETSubscriptionWrapper.md)
 - [GETTierType](docs/Model/GETTierType.md)
 - [GETUsageType](docs/Model/GETUsageType.md)
 - [GETUsageWrapper](docs/Model/GETUsageWrapper.md)
 - [GatewayOption](docs/Model/GatewayOption.md)
 - [GatewayOptionData](docs/Model/GatewayOptionData.md)
 - [GetHostedPageType](docs/Model/GetHostedPageType.md)
 - [GetHostedPagesType](docs/Model/GetHostedPagesType.md)
 - [GetProductFeatureType](docs/Model/GetProductFeatureType.md)
 - [Invoice](docs/Model/Invoice.md)
 - [InvoiceData](docs/Model/InvoiceData.md)
 - [InvoiceItem](docs/Model/InvoiceItem.md)
 - [InvoiceProcessingOptions](docs/Model/InvoiceProcessingOptions.md)
 - [InvoiceResult](docs/Model/InvoiceResult.md)
 - [LoginResult](docs/Model/LoginResult.md)
 - [NewChargeMetrics](docs/Model/NewChargeMetrics.md)
 - [POSTAccountResponseType](docs/Model/POSTAccountResponseType.md)
 - [POSTAccountType](docs/Model/POSTAccountType.md)
 - [POSTAccountTypeBillToContact](docs/Model/POSTAccountTypeBillToContact.md)
 - [POSTAccountTypeCreditCard](docs/Model/POSTAccountTypeCreditCard.md)
 - [POSTAccountTypeCreditCardCardHolderInfo](docs/Model/POSTAccountTypeCreditCardCardHolderInfo.md)
 - [POSTAccountTypeSoldToContact](docs/Model/POSTAccountTypeSoldToContact.md)
 - [POSTAccountTypeSubscription](docs/Model/POSTAccountTypeSubscription.md)
 - [POSTAccountTypeTaxInfo](docs/Model/POSTAccountTypeTaxInfo.md)
 - [POSTAccountingCodeResponseType](docs/Model/POSTAccountingCodeResponseType.md)
 - [POSTAccountingCodeType](docs/Model/POSTAccountingCodeType.md)
 - [POSTAccountingPeriodResponseType](docs/Model/POSTAccountingPeriodResponseType.md)
 - [POSTAccountingPeriodType](docs/Model/POSTAccountingPeriodType.md)
 - [POSTAttachmentResponseType](docs/Model/POSTAttachmentResponseType.md)
 - [POSTAttachmentType](docs/Model/POSTAttachmentType.md)
 - [POSTDecryptResponseType](docs/Model/POSTDecryptResponseType.md)
 - [POSTDecryptionType](docs/Model/POSTDecryptionType.md)
 - [POSTDistributionItemType](docs/Model/POSTDistributionItemType.md)
 - [POSTHMACSignatureResponseType](docs/Model/POSTHMACSignatureResponseType.md)
 - [POSTHMACSignatureType](docs/Model/POSTHMACSignatureType.md)
 - [POSTInvoiceCollectInvoicesType](docs/Model/POSTInvoiceCollectInvoicesType.md)
 - [POSTInvoiceCollectResponseType](docs/Model/POSTInvoiceCollectResponseType.md)
 - [POSTInvoiceCollectType](docs/Model/POSTInvoiceCollectType.md)
 - [POSTJournalEntryItemType](docs/Model/POSTJournalEntryItemType.md)
 - [POSTJournalEntryResponseType](docs/Model/POSTJournalEntryResponseType.md)
 - [POSTJournalEntrySegmentType](docs/Model/POSTJournalEntrySegmentType.md)
 - [POSTJournalEntryType](docs/Model/POSTJournalEntryType.md)
 - [POSTJournalRunResponseType](docs/Model/POSTJournalRunResponseType.md)
 - [POSTJournalRunTransactionType](docs/Model/POSTJournalRunTransactionType.md)
 - [POSTJournalRunType](docs/Model/POSTJournalRunType.md)
 - [POSTMassUpdateResponseType](docs/Model/POSTMassUpdateResponseType.md)
 - [POSTMassUpdateType](docs/Model/POSTMassUpdateType.md)
 - [POSTMassUpdateTypeParams](docs/Model/POSTMassUpdateTypeParams.md)
 - [POSTPaymentMethodResponseType](docs/Model/POSTPaymentMethodResponseType.md)
 - [POSTPaymentMethodType](docs/Model/POSTPaymentMethodType.md)
 - [POSTPaymentMethodTypeCardHolderInfo](docs/Model/POSTPaymentMethodTypeCardHolderInfo.md)
 - [POSTQuoteDocResponseType](docs/Model/POSTQuoteDocResponseType.md)
 - [POSTQuoteDocType](docs/Model/POSTQuoteDocType.md)
 - [POSTRSASignatureResponseType](docs/Model/POSTRSASignatureResponseType.md)
 - [POSTRSASignatureType](docs/Model/POSTRSASignatureType.md)
 - [POSTRevenueScheduleByChargeResponseType](docs/Model/POSTRevenueScheduleByChargeResponseType.md)
 - [POSTRevenueScheduleByChargeType](docs/Model/POSTRevenueScheduleByChargeType.md)
 - [POSTRevenueScheduleByChargeTypeRevenueEvent](docs/Model/POSTRevenueScheduleByChargeTypeRevenueEvent.md)
 - [POSTRevenueScheduleByDateRangeType](docs/Model/POSTRevenueScheduleByDateRangeType.md)
 - [POSTRevenueScheduleByDateRangeTypeRevenueEvent](docs/Model/POSTRevenueScheduleByDateRangeTypeRevenueEvent.md)
 - [POSTRevenueScheduleByTransactionResponseType](docs/Model/POSTRevenueScheduleByTransactionResponseType.md)
 - [POSTRevenueScheduleByTransactionType](docs/Model/POSTRevenueScheduleByTransactionType.md)
 - [POSTRevenueScheduleByTransactionTypeRevenueEvent](docs/Model/POSTRevenueScheduleByTransactionTypeRevenueEvent.md)
 - [POSTScCreateType](docs/Model/POSTScCreateType.md)
 - [POSTSrpCreateType](docs/Model/POSTSrpCreateType.md)
 - [POSTSubscriptionCancellationResponseType](docs/Model/POSTSubscriptionCancellationResponseType.md)
 - [POSTSubscriptionCancellationType](docs/Model/POSTSubscriptionCancellationType.md)
 - [POSTSubscriptionPreviewInvoiceItemsType](docs/Model/POSTSubscriptionPreviewInvoiceItemsType.md)
 - [POSTSubscriptionPreviewResponseType](docs/Model/POSTSubscriptionPreviewResponseType.md)
 - [POSTSubscriptionPreviewResponseTypeChargeMetrics](docs/Model/POSTSubscriptionPreviewResponseTypeChargeMetrics.md)
 - [POSTSubscriptionPreviewType](docs/Model/POSTSubscriptionPreviewType.md)
 - [POSTSubscriptionPreviewTypePreviewAccountInfo](docs/Model/POSTSubscriptionPreviewTypePreviewAccountInfo.md)
 - [POSTSubscriptionPreviewTypePreviewAccountInfoBillToContact](docs/Model/POSTSubscriptionPreviewTypePreviewAccountInfoBillToContact.md)
 - [POSTSubscriptionResponseType](docs/Model/POSTSubscriptionResponseType.md)
 - [POSTSubscriptionType](docs/Model/POSTSubscriptionType.md)
 - [POSTTierType](docs/Model/POSTTierType.md)
 - [POSTUsageResponseType](docs/Model/POSTUsageResponseType.md)
 - [PUTAccountType](docs/Model/PUTAccountType.md)
 - [PUTAccountTypeBillToContact](docs/Model/PUTAccountTypeBillToContact.md)
 - [PUTAccountTypeSoldToContact](docs/Model/PUTAccountTypeSoldToContact.md)
 - [PUTAccountingCodeType](docs/Model/PUTAccountingCodeType.md)
 - [PUTAccountingPeriodType](docs/Model/PUTAccountingPeriodType.md)
 - [PUTAllocateManuallyType](docs/Model/PUTAllocateManuallyType.md)
 - [PUTAttachmentType](docs/Model/PUTAttachmentType.md)
 - [PUTBasicSummaryJournalEntryType](docs/Model/PUTBasicSummaryJournalEntryType.md)
 - [PUTEventRIDetailType](docs/Model/PUTEventRIDetailType.md)
 - [PUTJournalEntryItemType](docs/Model/PUTJournalEntryItemType.md)
 - [PUTPaymentMethodResponseType](docs/Model/PUTPaymentMethodResponseType.md)
 - [PUTPaymentMethodType](docs/Model/PUTPaymentMethodType.md)
 - [PUTRSBasicInfoType](docs/Model/PUTRSBasicInfoType.md)
 - [PUTRSTermType](docs/Model/PUTRSTermType.md)
 - [PUTRenewSubscriptionResponseType](docs/Model/PUTRenewSubscriptionResponseType.md)
 - [PUTRenewSubscriptionType](docs/Model/PUTRenewSubscriptionType.md)
 - [PUTRevenueScheduleResponseType](docs/Model/PUTRevenueScheduleResponseType.md)
 - [PUTScAddType](docs/Model/PUTScAddType.md)
 - [PUTScUpdateType](docs/Model/PUTScUpdateType.md)
 - [PUTScheduleRIDetailType](docs/Model/PUTScheduleRIDetailType.md)
 - [PUTSpecificDateAllocationType](docs/Model/PUTSpecificDateAllocationType.md)
 - [PUTSrpAddType](docs/Model/PUTSrpAddType.md)
 - [PUTSrpRemoveType](docs/Model/PUTSrpRemoveType.md)
 - [PUTSrpUpdateType](docs/Model/PUTSrpUpdateType.md)
 - [PUTSubscriptionPreviewInvoiceItemsType](docs/Model/PUTSubscriptionPreviewInvoiceItemsType.md)
 - [PUTSubscriptionResponseType](docs/Model/PUTSubscriptionResponseType.md)
 - [PUTSubscriptionResponseTypeChargeMetrics](docs/Model/PUTSubscriptionResponseTypeChargeMetrics.md)
 - [PUTSubscriptionResumeResponseType](docs/Model/PUTSubscriptionResumeResponseType.md)
 - [PUTSubscriptionResumeType](docs/Model/PUTSubscriptionResumeType.md)
 - [PUTSubscriptionSuspendResponseType](docs/Model/PUTSubscriptionSuspendResponseType.md)
 - [PUTSubscriptionSuspendType](docs/Model/PUTSubscriptionSuspendType.md)
 - [PUTSubscriptionType](docs/Model/PUTSubscriptionType.md)
 - [PaymentMethod](docs/Model/PaymentMethod.md)
 - [PreviewOptions](docs/Model/PreviewOptions.md)
 - [ProxyActionamendRequest](docs/Model/ProxyActionamendRequest.md)
 - [ProxyActionamendResponse](docs/Model/ProxyActionamendResponse.md)
 - [ProxyActioncreateRequest](docs/Model/ProxyActioncreateRequest.md)
 - [ProxyActioncreateResponse](docs/Model/ProxyActioncreateResponse.md)
 - [ProxyActiondeleteRequest](docs/Model/ProxyActiondeleteRequest.md)
 - [ProxyActiondeleteResponse](docs/Model/ProxyActiondeleteResponse.md)
 - [ProxyActionexecuteRequest](docs/Model/ProxyActionexecuteRequest.md)
 - [ProxyActionexecuteResponse](docs/Model/ProxyActionexecuteResponse.md)
 - [ProxyActiongenerateRequest](docs/Model/ProxyActiongenerateRequest.md)
 - [ProxyActiongenerateResponse](docs/Model/ProxyActiongenerateResponse.md)
 - [ProxyActiongetUserInfoResponse](docs/Model/ProxyActiongetUserInfoResponse.md)
 - [ProxyActionloginRequest](docs/Model/ProxyActionloginRequest.md)
 - [ProxyActionloginResponse](docs/Model/ProxyActionloginResponse.md)
 - [ProxyActionqueryMoreRequest](docs/Model/ProxyActionqueryMoreRequest.md)
 - [ProxyActionqueryMoreResponse](docs/Model/ProxyActionqueryMoreResponse.md)
 - [ProxyActionqueryRequest](docs/Model/ProxyActionqueryRequest.md)
 - [ProxyActionqueryResponse](docs/Model/ProxyActionqueryResponse.md)
 - [ProxyActionsubscribeRequest](docs/Model/ProxyActionsubscribeRequest.md)
 - [ProxyActionsubscribeResponse](docs/Model/ProxyActionsubscribeResponse.md)
 - [ProxyActionupdateRequest](docs/Model/ProxyActionupdateRequest.md)
 - [ProxyActionupdateResponse](docs/Model/ProxyActionupdateResponse.md)
 - [ProxyBadRequestResponse](docs/Model/ProxyBadRequestResponse.md)
 - [ProxyBadRequestResponseErrors](docs/Model/ProxyBadRequestResponseErrors.md)
 - [ProxyCreateAccount](docs/Model/ProxyCreateAccount.md)
 - [ProxyCreateAccountingCode](docs/Model/ProxyCreateAccountingCode.md)
 - [ProxyCreateAmendment](docs/Model/ProxyCreateAmendment.md)
 - [ProxyCreateContact](docs/Model/ProxyCreateContact.md)
 - [ProxyCreateExport](docs/Model/ProxyCreateExport.md)
 - [ProxyCreateImport](docs/Model/ProxyCreateImport.md)
 - [ProxyCreateInvoice](docs/Model/ProxyCreateInvoice.md)
 - [ProxyCreateInvoiceAdjustment](docs/Model/ProxyCreateInvoiceAdjustment.md)
 - [ProxyCreateInvoicePayment](docs/Model/ProxyCreateInvoicePayment.md)
 - [ProxyCreateOrModifyResponse](docs/Model/ProxyCreateOrModifyResponse.md)
 - [ProxyCreatePayment](docs/Model/ProxyCreatePayment.md)
 - [ProxyCreatePaymentMethod](docs/Model/ProxyCreatePaymentMethod.md)
 - [ProxyCreateProduct](docs/Model/ProxyCreateProduct.md)
 - [ProxyCreateProductRatePlan](docs/Model/ProxyCreateProductRatePlan.md)
 - [ProxyCreateRefund](docs/Model/ProxyCreateRefund.md)
 - [ProxyCreateSubscription](docs/Model/ProxyCreateSubscription.md)
 - [ProxyCreateTaxationItem](docs/Model/ProxyCreateTaxationItem.md)
 - [ProxyCreateUnitOfMeasure](docs/Model/ProxyCreateUnitOfMeasure.md)
 - [ProxyCreateUsage](docs/Model/ProxyCreateUsage.md)
 - [ProxyDeleteResponse](docs/Model/ProxyDeleteResponse.md)
 - [ProxyGetAccount](docs/Model/ProxyGetAccount.md)
 - [ProxyGetAccountingCode](docs/Model/ProxyGetAccountingCode.md)
 - [ProxyGetAccountingPeriod](docs/Model/ProxyGetAccountingPeriod.md)
 - [ProxyGetAmendment](docs/Model/ProxyGetAmendment.md)
 - [ProxyGetCommunicationProfile](docs/Model/ProxyGetCommunicationProfile.md)
 - [ProxyGetContact](docs/Model/ProxyGetContact.md)
 - [ProxyGetCreditBalanceAdjustment](docs/Model/ProxyGetCreditBalanceAdjustment.md)
 - [ProxyGetExport](docs/Model/ProxyGetExport.md)
 - [ProxyGetFeature](docs/Model/ProxyGetFeature.md)
 - [ProxyGetImport](docs/Model/ProxyGetImport.md)
 - [ProxyGetInvoice](docs/Model/ProxyGetInvoice.md)
 - [ProxyGetInvoiceAdjustment](docs/Model/ProxyGetInvoiceAdjustment.md)
 - [ProxyGetInvoiceItem](docs/Model/ProxyGetInvoiceItem.md)
 - [ProxyGetInvoiceItemAdjustment](docs/Model/ProxyGetInvoiceItemAdjustment.md)
 - [ProxyGetInvoicePayment](docs/Model/ProxyGetInvoicePayment.md)
 - [ProxyGetInvoiceSplit](docs/Model/ProxyGetInvoiceSplit.md)
 - [ProxyGetInvoiceSplitItem](docs/Model/ProxyGetInvoiceSplitItem.md)
 - [ProxyGetPayment](docs/Model/ProxyGetPayment.md)
 - [ProxyGetPaymentMethod](docs/Model/ProxyGetPaymentMethod.md)
 - [ProxyGetPaymentMethodSnapshot](docs/Model/ProxyGetPaymentMethodSnapshot.md)
 - [ProxyGetPaymentMethodTransactionLog](docs/Model/ProxyGetPaymentMethodTransactionLog.md)
 - [ProxyGetPaymentTransactionLog](docs/Model/ProxyGetPaymentTransactionLog.md)
 - [ProxyGetProduct](docs/Model/ProxyGetProduct.md)
 - [ProxyGetProductFeature](docs/Model/ProxyGetProductFeature.md)
 - [ProxyGetProductRatePlan](docs/Model/ProxyGetProductRatePlan.md)
 - [ProxyGetProductRatePlanCharge](docs/Model/ProxyGetProductRatePlanCharge.md)
 - [ProxyGetProductRatePlanChargeTier](docs/Model/ProxyGetProductRatePlanChargeTier.md)
 - [ProxyGetRatePlan](docs/Model/ProxyGetRatePlan.md)
 - [ProxyGetRatePlanCharge](docs/Model/ProxyGetRatePlanCharge.md)
 - [ProxyGetRatePlanChargeTier](docs/Model/ProxyGetRatePlanChargeTier.md)
 - [ProxyGetRefund](docs/Model/ProxyGetRefund.md)
 - [ProxyGetRefundInvoicePayment](docs/Model/ProxyGetRefundInvoicePayment.md)
 - [ProxyGetRefundTransactionLog](docs/Model/ProxyGetRefundTransactionLog.md)
 - [ProxyGetSubscription](docs/Model/ProxyGetSubscription.md)
 - [ProxyGetSubscriptionProductFeature](docs/Model/ProxyGetSubscriptionProductFeature.md)
 - [ProxyGetTaxationItem](docs/Model/ProxyGetTaxationItem.md)
 - [ProxyGetUnitOfMeasure](docs/Model/ProxyGetUnitOfMeasure.md)
 - [ProxyGetUsage](docs/Model/ProxyGetUsage.md)
 - [ProxyGetUser](docs/Model/ProxyGetUser.md)
 - [ProxyModifyAccount](docs/Model/ProxyModifyAccount.md)
 - [ProxyModifyAccountingCode](docs/Model/ProxyModifyAccountingCode.md)
 - [ProxyModifyAmendment](docs/Model/ProxyModifyAmendment.md)
 - [ProxyModifyContact](docs/Model/ProxyModifyContact.md)
 - [ProxyModifyInvoice](docs/Model/ProxyModifyInvoice.md)
 - [ProxyModifyInvoiceAdjustment](docs/Model/ProxyModifyInvoiceAdjustment.md)
 - [ProxyModifyInvoicePayment](docs/Model/ProxyModifyInvoicePayment.md)
 - [ProxyModifyPayment](docs/Model/ProxyModifyPayment.md)
 - [ProxyModifyPaymentMethod](docs/Model/ProxyModifyPaymentMethod.md)
 - [ProxyModifyProduct](docs/Model/ProxyModifyProduct.md)
 - [ProxyModifyProductRatePlan](docs/Model/ProxyModifyProductRatePlan.md)
 - [ProxyModifyRefund](docs/Model/ProxyModifyRefund.md)
 - [ProxyModifySubscription](docs/Model/ProxyModifySubscription.md)
 - [ProxyModifyTaxationItem](docs/Model/ProxyModifyTaxationItem.md)
 - [ProxyModifyUnitOfMeasure](docs/Model/ProxyModifyUnitOfMeasure.md)
 - [ProxyModifyUsage](docs/Model/ProxyModifyUsage.md)
 - [ProxyModifyUser](docs/Model/ProxyModifyUser.md)
 - [ProxyNoDataResponse](docs/Model/ProxyNoDataResponse.md)
 - [QueryResult](docs/Model/QueryResult.md)
 - [RatePlan](docs/Model/RatePlan.md)
 - [RatePlanCharge](docs/Model/RatePlanCharge.md)
 - [RatePlanChargeData](docs/Model/RatePlanChargeData.md)
 - [RatePlanChargeTier](docs/Model/RatePlanChargeTier.md)
 - [RatePlanData](docs/Model/RatePlanData.md)
 - [RevenueScheduleItemType](docs/Model/RevenueScheduleItemType.md)
 - [SaveResult](docs/Model/SaveResult.md)
 - [SubscribeInvoiceProcessingOptions](docs/Model/SubscribeInvoiceProcessingOptions.md)
 - [SubscribeOptions](docs/Model/SubscribeOptions.md)
 - [SubscribeRequest](docs/Model/SubscribeRequest.md)
 - [SubscribeResult](docs/Model/SubscribeResult.md)
 - [Subscription](docs/Model/Subscription.md)
 - [SubscriptionData](docs/Model/SubscriptionData.md)
 - [SubscriptionProductFeature](docs/Model/SubscriptionProductFeature.md)
 - [SubscriptionProductFeatureList](docs/Model/SubscriptionProductFeatureList.md)
 - [ZObject](docs/Model/ZObject.md)


## Documentation For Authorization

 All endpoints do not require authorization.


## Author

docs@zuora.com


