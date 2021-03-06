<?php
/**
 * ProxyGetRefund
 *
 * PHP version 5
 *
 * @category Class
 * @package  Swagger\Client
 * @author   http://github.com/swagger-api/swagger-codegen
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * Zuora REST API Reference
 *
 * # Introduction  Welcome to the reference documentation for the Zuora REST API!   [REST](http://en.wikipedia.org/wiki/REST_API \"http://en.wikipedia.org/wiki/REST_API\") is a web-service protocol that lends itself to rapid development by using everyday HTTP and JSON technology. REST offers the following:  *   Easy to use and learn for developers *   Works with virtually any language and platform *   Use case-oriented calls *   Well-suited for solutions that fall outside the traditional desktop application model  The Zuora REST API provides a set of use case-oriented calls that:  *   Enable Web Storefront integration between your websites. *   Support self-service subscriber sign-ups and account management. *   Process revenue schedules through custom revenue rule models.  ## Set up an API User Account  Few setup steps are required to use the Zuora REST API. No special software libraries or development tools are needed. Take a moment to set up an API user account. See [Creating an API](https://knowledgecenter.zuora.com/DC_Developers/SOAP_API/AB_Getting_started_with_the__SOAP_API/F_Create_an_API_User) user.  Note that a user role does not have write access to Zuora REST services unless it has the API Write Access permission as described in those instructions.  Use the API user account only for API calls, and avoid using it to log into the Zuora UI. Logging into the UI enables a security feature that periodically expires the account's password, which may eventually cause authentication failures with the API.  ## Authentication  There are three ways to authenticate:  * Use an authorization cookie. The cookie authorizes the user to make calls to the REST API for the duration specified in  **Administration > Security Policies > Session timeout**. The cookie expiration time is reset with this duration after every call to the REST API. To obtain a cookie, call the REST  `connections` resource with the following API user information:     *   ID     *   password     *   entity Id or entity name (Only for [Zuora Multi-entity](https://knowledgecenter.zuora.com/BB_Introducing_Z_Business/Multi-entity \"Multi-entity\"). See \"Entity Id and Entity Name\" below for more information.)  *   Include the following parameters in the request header, which re-authenticates the user with each request:     *   `apiAccessKeyId`     *   `apiSecretAccessKey`     *   `entityId` or `entityName` (Only for [Zuora Multi-entity](https://knowledgecenter.zuora.com/BB_Introducing_Z_Business/Multi-entity \"Multi-entity\"). See \"Entity Id and Entity Name\" below for more information.) *   For CORS-enabled APIs only: Include a 'single-use' token in the request header, which re-authenticates the user with each request. See below for more details.   ## Errors  Responses and error codes are detailed in [Responses and errors](https://knowledgecenter.zuora.com/DC_Developers/REST_API/A_REST_basics/3_Responses_and_errors \"Responses and errors\").   ## Entity Id and Entity Name  The `entityId` and `entityName`  parameters are only used for  [Zuora Multi-entity](https://knowledgecenter.zuora.com/BB_Introducing_Z_Business/Multi-entity).  The  `entityId` parameter specifies the Id of the entity that you want to access. The `entityName` parameter specifies the [name of the entity](https://knowledgecenter.zuora.com/BB_Introducing_Z_Business/Multi-entity/B_Introduction_to_Entity_and_Entity_Hierarchy#Name_and_Display_Name \"Introduction to Entity and Entity Hierarchy\") that you want to access. Note that you must have permission to access the entity. You can get the entity Id and entity name through the REST GET Entities call.  You can specify either the  `entityId` or `entityName` parameter in the authentication to access and view an entity.  *   If both `entityId` and `entityName` are specified in the authentication, an error occurs.  *   If neither  `entityId` nor  `entityName` is specified in the authentication, you will log in to the entity in which your user account is created.   See [API User Authentication](https://knowledgecenter.zuora.com/BB_Introducing_Z_Business/Multi-entity/A_Overview_of_Multi-entity#API_User_Authentication \"Zuora Multi-entity\") for more information.  ## Token Authentication for CORS-Enabled APIs  The CORS mechanism enables REST API calls to Zuora to be made directly from your customer's browser, with all credit card and security information transmitted directly to Zuora. This minimizes your PCI compliance burden, allows you to implement advanced validation on your payment forms, and makes your payment forms look just like any other part of your website.  For security reasons, instead of using cookies, an API request via CORS uses **tokens** for authentication.  The token method of authentication is only designed for use with requests that must originate from your customer's browser; **it should not be considered a replacement to the existing cookie authentication** mechanism.  See [Zuora CORS REST ](https://knowledgecenter.zuora.com/DC_Developers/REST_API/A_REST_basics/G_CORS_REST \"Zuora CORS REST\")for details on how CORS works and how you can begin to implement customer calls to the Zuora REST APIs. See  [HMAC Signatures](/BC_Developers/REST_API/B_REST_API_reference/HMAC_Signatures \"HMAC Signatures\") for details on the HMAC method that returns the authentication token.   ## Zuora REST API Versions  The Zuora REST API is in version control. Versioning ensures that Zuora REST API changes are backward compatible. Zuora uses a major and minor version nomenclature to manage changes. By specifying a version in a REST request, you can get expected responses regardless of future changes to the API.   ### Major Version  The major version number of the REST API appears in the REST URL. Currently, Zuora only supports the **v1** major version. For example,  `POST https://rest.zuora.com/v1/subscriptions` .   ### Minor Version  Zuora uses minor versions for the REST API to control small changes. For example, a field in a REST method is deprecated and a new field is used to replace it.   Some fields in the REST methods are supported as of minor versions. If a field is not noted with a minor version, this field is available for all minor versions. If a field is noted with a minor version, this field is in version control. You must specify the supported minor version in the request header to process without an error.   If a field is in version control, it is either with a minimum minor version or a maximum minor version, or both of them. You can only use this field with the minor version between the minimum and the maximum minor versions. For example, the  `invoiceCollect` field in the POST Subscription method is in version control and its maximum minor version is 189.0. You can only use this field with the minor version 189.0 or earlier.  The supported minor versions are not serial, see [Zuora REST API Minor Version History](https://knowledgecenter.zuora.com/DC_Developers/REST_API/A_REST_basics/Zuora_REST_API_Minor_Version_History \"Zuora REST API Minor Version History\") for the fields and their supported minor versions. In our REST API documentation, if a field or feature requires a minor version number, we note that in the field description.  You only need to specify the version number when you use the fields require a minor version. To specify the minor version, set the `zuora-version` parameter to the minor version number in the request header for the request call. For example, the `collect` field is in 196.0 minor version. If you want to use this field for the POST Subscription method, set the  `zuora-version` parameter to `196.0` in the request header. The `zuora-version` parameter is case sensitive.   For all the REST API fields, by default, if the minor version is not specified in the request header, Zuora will use the minimum minor version of the REST API to avoid breaking your integration.    ## URLs and Endpoints  The following REST services are provided in Zuora.  | Service                 | Base URL for REST Endpoints                                                                                                                                         | |-------------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------| | Production REST service | https://rest.zuora.com/v1                                                                                                                                           | | Sandbox REST service    | https://rest.apisandbox.zuora.com/v1                                                                                                                                | | Services REST service   | https://services123.zuora.com/apps/v1/  (where \"123\" is replaced by the number of your actual services environment)  The production service provides access to your live user data. The sandbox environment is a good place to test your code without affecting real-world data.  To use it, you must be provisioned with a sandbox tenant - your Zuora representative can help with this if needed.   ## Requests and Responses   ### HTTP Request Body  Most of the parameters and data accompanying your requests will be contained in the body of the HTTP request.  The Zuora REST API accepts JSON in the HTTP request body.  No other data format (e.g., XML) is supported.   #### Testing a Request  Use a third party client, such as Postman or Advanced REST Client, to test the Zuora REST API.  You can test the Zuora REST API from the Zuora sandbox or  production service. If connecting to the production service, bear in mind that you are working with your live production data, not sample data or test data.  #### Testing with Credit Cards  Sooner or later it will probably be necessary to test some transactions that involve credit cards. For suggestions on how to handle this, see [Going Live With Your Payment Gateway](https://knowledgecenter.zuora.com/CB_Billing/M_Payment_Gateways/C_Managing_Payment_Gateways/B_Going_Live_Payment_Gateways#Testing_with_Credit_Cards \"C_Zuora_User_Guides/A_Billing_and_Payments/M_Payment_Gateways/C_Managing_Payment_Gateways/B_Going_Live_Payment_Gateways#Testing_with_Credit_Cards\").   ## Request IDs  As a general rule, when asked to supply a \"key\" for an account or subscription (accountKey, account-key, subscriptionKey, subscription-key), you can provide either the actual ID or the number of the entity.  ## Pagination  When retrieving information (using GET methods), the optional `pageSize` query parameter sets the maximum number of rows to return in a response. The maximum is `40`; larger values are treated as `40`. If this value is empty or invalid, `pageSize` typically defaults to `10`.  The default value for the maximum number of rows retrieved can be overridden at the method level.  If more rows are available, the response will include a `nextPage` element, which contains a URL for requesting the next page.  If this value is not provided, no more rows are available. No \"previous page\" element is explicitly provided; to support backward paging, use the previous call.  ### Array Size  For data items that are not paginated, the REST API supports arrays of up to 300 rows.  Thus, for instance, repeated pagination can retrieve thousands of customer accounts, but within any account an array of no more than 300 rate plans is returned.
 *
 * OpenAPI spec version: 0.0.1
 * Contact: docs@zuora.com
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace Swagger\Client\Model;

use \ArrayAccess;

/**
 * ProxyGetRefund Class Doc Comment
 *
 * @category    Class */
/** 
 * @package     Swagger\Client
 * @author      http://github.com/swagger-api/swagger-codegen
 * @license     http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class ProxyGetRefund implements ArrayAccess
{
    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'ProxyGetRefund';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = array(
        'account_id' => 'string',
        'accounting_code' => 'string',
        'amount' => 'double',
        'cancelled_on' => '\DateTime',
        'comment' => 'string',
        'created_by_id' => 'string',
        'created_date' => '\DateTime',
        'gateway' => 'string',
        'gateway_response' => 'string',
        'gateway_response_code' => 'string',
        'gateway_state' => 'string',
        'id' => 'string',
        'marked_for_submission_on' => '\DateTime',
        'method_type' => 'string',
        'payment_method_id' => 'string',
        'payment_method_snapshot_id' => 'string',
        'reason_code' => 'string',
        'reference_id' => 'string',
        'refund_date' => '\DateTime',
        'refund_number' => 'string',
        'refund_transaction_time' => '\DateTime',
        'second_refund_reference_id' => 'string',
        'settled_on' => '\DateTime',
        'soft_descriptor' => 'string',
        'soft_descriptor_phone' => 'string',
        'source_type' => 'string',
        'status' => 'string',
        'submitted_on' => '\DateTime',
        'transferred_to_accounting' => 'string',
        'type' => 'string',
        'updated_by_id' => 'string',
        'updated_date' => '\DateTime'
    );

    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of attributes where the key is the local name, and the value is the original name
     * @var string[]
     */
    protected static $attributeMap = array(
        'account_id' => 'AccountId',
        'accounting_code' => 'AccountingCode',
        'amount' => 'Amount',
        'cancelled_on' => 'CancelledOn',
        'comment' => 'Comment',
        'created_by_id' => 'CreatedById',
        'created_date' => 'CreatedDate',
        'gateway' => 'Gateway',
        'gateway_response' => 'GatewayResponse',
        'gateway_response_code' => 'GatewayResponseCode',
        'gateway_state' => 'GatewayState',
        'id' => 'Id',
        'marked_for_submission_on' => 'MarkedForSubmissionOn',
        'method_type' => 'MethodType',
        'payment_method_id' => 'PaymentMethodId',
        'payment_method_snapshot_id' => 'PaymentMethodSnapshotId',
        'reason_code' => 'ReasonCode',
        'reference_id' => 'ReferenceID',
        'refund_date' => 'RefundDate',
        'refund_number' => 'RefundNumber',
        'refund_transaction_time' => 'RefundTransactionTime',
        'second_refund_reference_id' => 'SecondRefundReferenceId',
        'settled_on' => 'SettledOn',
        'soft_descriptor' => 'SoftDescriptor',
        'soft_descriptor_phone' => 'SoftDescriptorPhone',
        'source_type' => 'SourceType',
        'status' => 'Status',
        'submitted_on' => 'SubmittedOn',
        'transferred_to_accounting' => 'TransferredToAccounting',
        'type' => 'Type',
        'updated_by_id' => 'UpdatedById',
        'updated_date' => 'UpdatedDate'
    );

    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = array(
        'account_id' => 'setAccountId',
        'accounting_code' => 'setAccountingCode',
        'amount' => 'setAmount',
        'cancelled_on' => 'setCancelledOn',
        'comment' => 'setComment',
        'created_by_id' => 'setCreatedById',
        'created_date' => 'setCreatedDate',
        'gateway' => 'setGateway',
        'gateway_response' => 'setGatewayResponse',
        'gateway_response_code' => 'setGatewayResponseCode',
        'gateway_state' => 'setGatewayState',
        'id' => 'setId',
        'marked_for_submission_on' => 'setMarkedForSubmissionOn',
        'method_type' => 'setMethodType',
        'payment_method_id' => 'setPaymentMethodId',
        'payment_method_snapshot_id' => 'setPaymentMethodSnapshotId',
        'reason_code' => 'setReasonCode',
        'reference_id' => 'setReferenceId',
        'refund_date' => 'setRefundDate',
        'refund_number' => 'setRefundNumber',
        'refund_transaction_time' => 'setRefundTransactionTime',
        'second_refund_reference_id' => 'setSecondRefundReferenceId',
        'settled_on' => 'setSettledOn',
        'soft_descriptor' => 'setSoftDescriptor',
        'soft_descriptor_phone' => 'setSoftDescriptorPhone',
        'source_type' => 'setSourceType',
        'status' => 'setStatus',
        'submitted_on' => 'setSubmittedOn',
        'transferred_to_accounting' => 'setTransferredToAccounting',
        'type' => 'setType',
        'updated_by_id' => 'setUpdatedById',
        'updated_date' => 'setUpdatedDate'
    );

    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = array(
        'account_id' => 'getAccountId',
        'accounting_code' => 'getAccountingCode',
        'amount' => 'getAmount',
        'cancelled_on' => 'getCancelledOn',
        'comment' => 'getComment',
        'created_by_id' => 'getCreatedById',
        'created_date' => 'getCreatedDate',
        'gateway' => 'getGateway',
        'gateway_response' => 'getGatewayResponse',
        'gateway_response_code' => 'getGatewayResponseCode',
        'gateway_state' => 'getGatewayState',
        'id' => 'getId',
        'marked_for_submission_on' => 'getMarkedForSubmissionOn',
        'method_type' => 'getMethodType',
        'payment_method_id' => 'getPaymentMethodId',
        'payment_method_snapshot_id' => 'getPaymentMethodSnapshotId',
        'reason_code' => 'getReasonCode',
        'reference_id' => 'getReferenceId',
        'refund_date' => 'getRefundDate',
        'refund_number' => 'getRefundNumber',
        'refund_transaction_time' => 'getRefundTransactionTime',
        'second_refund_reference_id' => 'getSecondRefundReferenceId',
        'settled_on' => 'getSettledOn',
        'soft_descriptor' => 'getSoftDescriptor',
        'soft_descriptor_phone' => 'getSoftDescriptorPhone',
        'source_type' => 'getSourceType',
        'status' => 'getStatus',
        'submitted_on' => 'getSubmittedOn',
        'transferred_to_accounting' => 'getTransferredToAccounting',
        'type' => 'getType',
        'updated_by_id' => 'getUpdatedById',
        'updated_date' => 'getUpdatedDate'
    );

    public static function getters()
    {
        return self::$getters;
    }

    

    

    /**
     * Associative array for storing property values
     * @var mixed[]
     */
    protected $container = array();

    /**
     * Constructor
     * @param mixed[] $data Associated array of property value initalizing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['account_id'] = isset($data['account_id']) ? $data['account_id'] : null;
        $this->container['accounting_code'] = isset($data['accounting_code']) ? $data['accounting_code'] : null;
        $this->container['amount'] = isset($data['amount']) ? $data['amount'] : null;
        $this->container['cancelled_on'] = isset($data['cancelled_on']) ? $data['cancelled_on'] : null;
        $this->container['comment'] = isset($data['comment']) ? $data['comment'] : null;
        $this->container['created_by_id'] = isset($data['created_by_id']) ? $data['created_by_id'] : null;
        $this->container['created_date'] = isset($data['created_date']) ? $data['created_date'] : null;
        $this->container['gateway'] = isset($data['gateway']) ? $data['gateway'] : null;
        $this->container['gateway_response'] = isset($data['gateway_response']) ? $data['gateway_response'] : null;
        $this->container['gateway_response_code'] = isset($data['gateway_response_code']) ? $data['gateway_response_code'] : null;
        $this->container['gateway_state'] = isset($data['gateway_state']) ? $data['gateway_state'] : null;
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['marked_for_submission_on'] = isset($data['marked_for_submission_on']) ? $data['marked_for_submission_on'] : null;
        $this->container['method_type'] = isset($data['method_type']) ? $data['method_type'] : null;
        $this->container['payment_method_id'] = isset($data['payment_method_id']) ? $data['payment_method_id'] : null;
        $this->container['payment_method_snapshot_id'] = isset($data['payment_method_snapshot_id']) ? $data['payment_method_snapshot_id'] : null;
        $this->container['reason_code'] = isset($data['reason_code']) ? $data['reason_code'] : null;
        $this->container['reference_id'] = isset($data['reference_id']) ? $data['reference_id'] : null;
        $this->container['refund_date'] = isset($data['refund_date']) ? $data['refund_date'] : null;
        $this->container['refund_number'] = isset($data['refund_number']) ? $data['refund_number'] : null;
        $this->container['refund_transaction_time'] = isset($data['refund_transaction_time']) ? $data['refund_transaction_time'] : null;
        $this->container['second_refund_reference_id'] = isset($data['second_refund_reference_id']) ? $data['second_refund_reference_id'] : null;
        $this->container['settled_on'] = isset($data['settled_on']) ? $data['settled_on'] : null;
        $this->container['soft_descriptor'] = isset($data['soft_descriptor']) ? $data['soft_descriptor'] : null;
        $this->container['soft_descriptor_phone'] = isset($data['soft_descriptor_phone']) ? $data['soft_descriptor_phone'] : null;
        $this->container['source_type'] = isset($data['source_type']) ? $data['source_type'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['submitted_on'] = isset($data['submitted_on']) ? $data['submitted_on'] : null;
        $this->container['transferred_to_accounting'] = isset($data['transferred_to_accounting']) ? $data['transferred_to_accounting'] : null;
        $this->container['type'] = isset($data['type']) ? $data['type'] : null;
        $this->container['updated_by_id'] = isset($data['updated_by_id']) ? $data['updated_by_id'] : null;
        $this->container['updated_date'] = isset($data['updated_date']) ? $data['updated_date'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = array();
        return $invalid_properties;
    }

    /**
     * validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properteis are valid
     */
    public function valid()
    {
        return true;
    }


    /**
     * Gets account_id
     * @return string
     */
    public function getAccountId()
    {
        return $this->container['account_id'];
    }

    /**
     * Sets account_id
     * @param string $account_id The ID of the [account](/BC_Developers/SOAP_API/E_SOAP_API_Objects/Account) associated with this refund. Specify a value for this field only if you're creating an electronic non-referenced refund. Don't specify a value for any other type of refund; Zuora associates the refund automatically with the account from the associated payment. **Character limit**: 32 **Values**: a valid account ID
     * @return $this
     */
    public function setAccountId($account_id)
    {
        $this->container['account_id'] = $account_id;

        return $this;
    }

    /**
     * Gets accounting_code
     * @return string
     */
    public function getAccountingCode()
    {
        return $this->container['accounting_code'];
    }

    /**
     * Sets accounting_code
     * @param string $accounting_code The accounting code for the payment or invoice line item that the refund applies to. If there is no accounting code, then this value is null. Accounting codes group transactions that contain similar accounting attributes. **Character limit**: 50 **Values**: automatically generated
     * @return $this
     */
    public function setAccountingCode($accounting_code)
    {
        $this->container['accounting_code'] = $accounting_code;

        return $this;
    }

    /**
     * Gets amount
     * @return double
     */
    public function getAmount()
    {
        return $this->container['amount'];
    }

    /**
     * Sets amount
     * @param double $amount The amount of the refund. The amount can't exceed the amount of the associated payment. If the original payment was applied to a single invoice, then you can create a partial refund. However, if the payment was applies to multiple invoices, then you can only make a partial refund through the web-based UI, not through the API. **Character limit**: 16 **Values**: a valid currency amount
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->container['amount'] = $amount;

        return $this;
    }

    /**
     * Gets cancelled_on
     * @return \DateTime
     */
    public function getCancelledOn()
    {
        return $this->container['cancelled_on'];
    }

    /**
     * Sets cancelled_on
     * @param \DateTime $cancelled_on The date the refund was cancelled. **Values**: automatically generated
     * @return $this
     */
    public function setCancelledOn($cancelled_on)
    {
        $this->container['cancelled_on'] = $cancelled_on;

        return $this;
    }

    /**
     * Gets comment
     * @return string
     */
    public function getComment()
    {
        return $this->container['comment'];
    }

    /**
     * Sets comment
     * @param string $comment Use this field to record comments about the refund. **Character limit**: 255 **Values**: a string of 255 characters or fewer
     * @return $this
     */
    public function setComment($comment)
    {
        $this->container['comment'] = $comment;

        return $this;
    }

    /**
     * Gets created_by_id
     * @return string
     */
    public function getCreatedById()
    {
        return $this->container['created_by_id'];
    }

    /**
     * Sets created_by_id
     * @param string $created_by_id The ID of the Zuora user who created the `Refund` object. **Character limit**: 32 **Values**: automatically generated
     * @return $this
     */
    public function setCreatedById($created_by_id)
    {
        $this->container['created_by_id'] = $created_by_id;

        return $this;
    }

    /**
     * Gets created_date
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->container['created_date'];
    }

    /**
     * Sets created_date
     * @param \DateTime $created_date The date when the `Refund` object was created. **Character limit**: 29 **Values**: automatically generated
     * @return $this
     */
    public function setCreatedDate($created_date)
    {
        $this->container['created_date'] = $created_date;

        return $this;
    }

    /**
     * Gets gateway
     * @return string
     */
    public function getGateway()
    {
        return $this->container['gateway'];
    }

    /**
     * Sets gateway
     * @param string $gateway The gateway that processed the original payment. Zuora uses this same gateway for the corresponding refund. If this payment gateway is no longer active, then the electronic refund fails. A gateway is an online service provider that connects an online shopping cart to a payment processor. **Values**: automatically inherited from the `Payment` object
     * @return $this
     */
    public function setGateway($gateway)
    {
        $this->container['gateway'] = $gateway;

        return $this;
    }

    /**
     * Gets gateway_response
     * @return string
     */
    public function getGatewayResponse()
    {
        return $this->container['gateway_response'];
    }

    /**
     * Sets gateway_response
     * @param string $gateway_response The message returned from the payment gateway for the refund. This message is gateway-dependent. **Character limit**: 500 **Values**: automatically generated
     * @return $this
     */
    public function setGatewayResponse($gateway_response)
    {
        $this->container['gateway_response'] = $gateway_response;

        return $this;
    }

    /**
     * Gets gateway_response_code
     * @return string
     */
    public function getGatewayResponseCode()
    {
        return $this->container['gateway_response_code'];
    }

    /**
     * Sets gateway_response_code
     * @param string $gateway_response_code The code returned from the payment gateway for the payment. This code is gateway-dependent. **Character limit**: 20 **System****Values**: automatically generated
     * @return $this
     */
    public function setGatewayResponseCode($gateway_response_code)
    {
        $this->container['gateway_response_code'] = $gateway_response_code;

        return $this;
    }

    /**
     * Gets gateway_state
     * @return string
     */
    public function getGatewayState()
    {
        return $this->container['gateway_state'];
    }

    /**
     * Sets gateway_state
     * @param string $gateway_state The status of the payment in the gateway. **Character limit**: 19 **Values**: automatically generated
     * @return $this
     */
    public function setGatewayState($gateway_state)
    {
        $this->container['gateway_state'] = $gateway_state;

        return $this;
    }

    /**
     * Gets id
     * @return string
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     * @param string $id Object identifier.
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets marked_for_submission_on
     * @return \DateTime
     */
    public function getMarkedForSubmissionOn()
    {
        return $this->container['marked_for_submission_on'];
    }

    /**
     * Sets marked_for_submission_on
     * @param \DateTime $marked_for_submission_on The date when a payment was marked and waiting for batch submission to the payment process. **Character limit**: 29 **Values**: automatically generated
     * @return $this
     */
    public function setMarkedForSubmissionOn($marked_for_submission_on)
    {
        $this->container['marked_for_submission_on'] = $marked_for_submission_on;

        return $this;
    }

    /**
     * Gets method_type
     * @return string
     */
    public function getMethodType()
    {
        return $this->container['method_type'];
    }

    /**
     * Sets method_type
     * @param string $method_type Indicates how an external refund was issued to a customer. This field is required for an external refund. You can issue an external refund on an electronic payment. **Character limit**: 30 **Values**:  - `ACH` - `Cash` - `Check` - `CreditCard` - `Other` - `PayPal` - `WireTransfer` - `DebitCard` - `CreditCardReferenceTransaction`
     * @return $this
     */
    public function setMethodType($method_type)
    {
        $this->container['method_type'] = $method_type;

        return $this;
    }

    /**
     * Gets payment_method_id
     * @return string
     */
    public function getPaymentMethodId()
    {
        return $this->container['payment_method_id'];
    }

    /**
     * Sets payment_method_id
     * @param string $payment_method_id The unique ID of the payment method that the customer used to make the payment. Specify a value for this field only if you're creating an electronic non-referenced refund. **Character limit**: 32 **V****alues**: a valid payment method ID
     * @return $this
     */
    public function setPaymentMethodId($payment_method_id)
    {
        $this->container['payment_method_id'] = $payment_method_id;

        return $this;
    }

    /**
     * Gets payment_method_snapshot_id
     * @return string
     */
    public function getPaymentMethodSnapshotId()
    {
        return $this->container['payment_method_snapshot_id'];
    }

    /**
     * Sets payment_method_snapshot_id
     * @param string $payment_method_snapshot_id The unique ID of the payment method snapshot which is a copy of the particular Payment Method used in a transaction. **Character limit**: 32 **V****alues**: a valid payment method snapshot ID
     * @return $this
     */
    public function setPaymentMethodSnapshotId($payment_method_snapshot_id)
    {
        $this->container['payment_method_snapshot_id'] = $payment_method_snapshot_id;

        return $this;
    }

    /**
     * Gets reason_code
     * @return string
     */
    public function getReasonCode()
    {
        return $this->container['reason_code'];
    }

    /**
     * Sets reason_code
     * @param string $reason_code A code identifying the reason for the transaction. Must be an existing reason code or empty. If you do not specify a value, Zuora uses the default reason code. **Character limit**: 32 **V****alues**: a valid reason code
     * @return $this
     */
    public function setReasonCode($reason_code)
    {
        $this->container['reason_code'] = $reason_code;

        return $this;
    }

    /**
     * Gets reference_id
     * @return string
     */
    public function getReferenceId()
    {
        return $this->container['reference_id'];
    }

    /**
     * Sets reference_id
     * @param string $reference_id The transaction ID returned by the payment gateway for an electronic refund. Use this field to reconcile refunds between your gateway and Z-Payments. **Character limit**: 60 **Values**: a string of 60 characters or fewer
     * @return $this
     */
    public function setReferenceId($reference_id)
    {
        $this->container['reference_id'] = $reference_id;

        return $this;
    }

    /**
     * Gets refund_date
     * @return \DateTime
     */
    public function getRefundDate()
    {
        return $this->container['refund_date'];
    }

    /**
     * Sets refund_date
     * @param \DateTime $refund_date The date of the refund. The date of the refund cannot be before the payment date. Specify this field only for external refunds. Zuora automatically generates this field for electronic refunds. **Character limit**: 29 **Values**: a valid date and time value
     * @return $this
     */
    public function setRefundDate($refund_date)
    {
        $this->container['refund_date'] = $refund_date;

        return $this;
    }

    /**
     * Gets refund_number
     * @return string
     */
    public function getRefundNumber()
    {
        return $this->container['refund_number'];
    }

    /**
     * Sets refund_number
     * @param string $refund_number The unique identifier of the refund. **Character limit**: 50 **Values**: automatically generated
     * @return $this
     */
    public function setRefundNumber($refund_number)
    {
        $this->container['refund_number'] = $refund_number;

        return $this;
    }

    /**
     * Gets refund_transaction_time
     * @return \DateTime
     */
    public function getRefundTransactionTime()
    {
        return $this->container['refund_transaction_time'];
    }

    /**
     * Sets refund_transaction_time
     * @param \DateTime $refund_transaction_time The date and time when the refund was issued. **Character limit**: 29 **Values**: automatically generated
     * @return $this
     */
    public function setRefundTransactionTime($refund_transaction_time)
    {
        $this->container['refund_transaction_time'] = $refund_transaction_time;

        return $this;
    }

    /**
     * Gets second_refund_reference_id
     * @return string
     */
    public function getSecondRefundReferenceId()
    {
        return $this->container['second_refund_reference_id'];
    }

    /**
     * Sets second_refund_reference_id
     * @param string $second_refund_reference_id The transaction ID returned by the payment gateway if there is an additional transaction for the payment. Use this field to reconcile payments between your gateway and Z-Payments. **Character limit**: 60 **Values**: a string of 60 characters or fewer
     * @return $this
     */
    public function setSecondRefundReferenceId($second_refund_reference_id)
    {
        $this->container['second_refund_reference_id'] = $second_refund_reference_id;

        return $this;
    }

    /**
     * Gets settled_on
     * @return \DateTime
     */
    public function getSettledOn()
    {
        return $this->container['settled_on'];
    }

    /**
     * Sets settled_on
     * @param \DateTime $settled_on The date when the payment was settled in the payment processor. This field is used by the Spectrum gateway only and not applicable to other gateways. **Character limit**: 29 **Values**: automatically generated
     * @return $this
     */
    public function setSettledOn($settled_on)
    {
        $this->container['settled_on'] = $settled_on;

        return $this;
    }

    /**
     * Gets soft_descriptor
     * @return string
     */
    public function getSoftDescriptor()
    {
        return $this->container['soft_descriptor'];
    }

    /**
     * Sets soft_descriptor
     * @param string $soft_descriptor A payment gateway-specific field that maps Zuora to other gateways . **Character limit**: 35 **Values**:  - 3-byte company identifier &quot;*&quot; 18-byte descriptor - 7-byte company identifier &quot;*&quot; 14-byte descriptor - 12-byte company identifier &quot;*&quot; 9-byte descriptor
     * @return $this
     */
    public function setSoftDescriptor($soft_descriptor)
    {
        $this->container['soft_descriptor'] = $soft_descriptor;

        return $this;
    }

    /**
     * Gets soft_descriptor_phone
     * @return string
     */
    public function getSoftDescriptorPhone()
    {
        return $this->container['soft_descriptor_phone'];
    }

    /**
     * Sets soft_descriptor_phone
     * @param string $soft_descriptor_phone A payment gateway-specific field that maps Zuora to other gateways . **Character limit**: 20 **Values**:  - Customer service phone number formatted as: `NNN-NNN-NNNN` or `NNN-AAAAAAA` - URL (non-e-Commerce): Transactions sent with a URL do not qualify for the best interchange rate - Email address
     * @return $this
     */
    public function setSoftDescriptorPhone($soft_descriptor_phone)
    {
        $this->container['soft_descriptor_phone'] = $soft_descriptor_phone;

        return $this;
    }

    /**
     * Gets source_type
     * @return string
     */
    public function getSourceType()
    {
        return $this->container['source_type'];
    }

    /**
     * Sets source_type
     * @param string $source_type Specifies whether the refund is a refund payment or a credit balance. This field is required when creating an non-referenced refund. If you creating an non-referenced refund, then set this value to `CreditBalance`. **Character limit**: 13 **Values**:  - `Payment` - `CreditBalance`
     * @return $this
     */
    public function setSourceType($source_type)
    {
        $this->container['source_type'] = $source_type;

        return $this;
    }

    /**
     * Gets status
     * @return string
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     * @param string $status The status of the refund. **Character limit**: 10 **Values**: automatically generated:  - `Canceled` - `Error` - `Processed` - `Processing`
     * @return $this
     */
    public function setStatus($status)
    {
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets submitted_on
     * @return \DateTime
     */
    public function getSubmittedOn()
    {
        return $this->container['submitted_on'];
    }

    /**
     * Sets submitted_on
     * @param \DateTime $submitted_on The date when the payment was submitted. **Character limit**: 29 **Values**: automatically generated
     * @return $this
     */
    public function setSubmittedOn($submitted_on)
    {
        $this->container['submitted_on'] = $submitted_on;

        return $this;
    }

    /**
     * Gets transferred_to_accounting
     * @return string
     */
    public function getTransferredToAccounting()
    {
        return $this->container['transferred_to_accounting'];
    }

    /**
     * Sets transferred_to_accounting
     * @param string $transferred_to_accounting Specifies whether or not the object has been transferred to an external accounting system. Use this field for integrations with accounting systems such as NetSuite. **Character limit**: 10 **Values**: automatically generated:  - `Processing` - `Yes` - `Error` - `Ignore`
     * @return $this
     */
    public function setTransferredToAccounting($transferred_to_accounting)
    {
        $this->container['transferred_to_accounting'] = $transferred_to_accounting;

        return $this;
    }

    /**
     * Gets type
     * @return string
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     * @param string $type Specifies if the refund is electronic or external. **Character limit**: 10 **Values**:  - `Electronic` - External
     * @return $this
     */
    public function setType($type)
    {
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets updated_by_id
     * @return string
     */
    public function getUpdatedById()
    {
        return $this->container['updated_by_id'];
    }

    /**
     * Sets updated_by_id
     * @param string $updated_by_id The ID of the last user to update the object. **Character limit**: 32 **Values**: automatically generated
     * @return $this
     */
    public function setUpdatedById($updated_by_id)
    {
        $this->container['updated_by_id'] = $updated_by_id;

        return $this;
    }

    /**
     * Gets updated_date
     * @return \DateTime
     */
    public function getUpdatedDate()
    {
        return $this->container['updated_date'];
    }

    /**
     * Sets updated_date
     * @param \DateTime $updated_date The date when the object was last updated. **Character limit**: 29 **Values**: automatically generated
     * @return $this
     */
    public function setUpdatedDate($updated_date)
    {
        $this->container['updated_date'] = $updated_date;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     * @param  integer $offset Offset
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     * @param  integer $offset Offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     * @param  integer $offset Offset
     * @param  mixed   $value  Value to be set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     * @param  integer $offset Offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(\Swagger\Client\ObjectSerializer::sanitizeForSerialization($this), JSON_PRETTY_PRINT);
        }

        return json_encode(\Swagger\Client\ObjectSerializer::sanitizeForSerialization($this));
    }
}


