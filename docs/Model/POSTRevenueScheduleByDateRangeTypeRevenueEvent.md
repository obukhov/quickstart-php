# POSTRevenueScheduleByDateRangeTypeRevenueEvent

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**custom_field__c** | **string** | Any custom fields defined for this object. | [optional] 
**event_type** | **string** | Label of the revenue event type. Revenue event type labels can be duplicated. You can configure your revenue event type labels by navigating to **Settings &gt; Z-Finance Settings &gt; Configure Revenue Event Types** in the Zuora UI. The default revenue event types are: * Invoice Posted * Invoice Item Adjustment Created * Invoice Canceled * Invoice Item Adjustment Canceled * Revenue Distributed | [optional] 
**event_type_system_id** | **string** | System ID of the revenue event type. Each eventType has a unique system ID. You can configure your revenue event type system IDs by navigating to **Settings &gt; Z-Finance Settings &gt; Configure Revenue Event Types** in the Zuora UI.  Required only if there is more than one revenue event type with the same label. | [optional] 
**notes** | **string** |  | [optional] 

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)

