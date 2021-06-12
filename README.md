# CartThrob Sample Payment Gateways

The purpose of this repository is to demonstrate how a CartThrob Payment Gateway should, ideally, be laid out as a program.
They're pretty simple at the core, by design, though depending on your use case can be challenging in their own right. To help with this,
this repository contains multiple branches with different use cases and examples.

## A Basic Gateway
A simple Payment Gateway is just a simple PHP Class wrapped in an ExpressionEngine Add-on. 
That said, every Gateway must follow a couple rules:

1. Your payment gateway object MUST inherit from  "Cartthrob_payment_gateway"
2. There MUST be, at a minimum, a `title` property (with the name of the gateway) 
   and a `charge($creditCardNumber)` method.

That's it. Your charge method does the magic YOU create. 

### Example Object
```php 
<?php
class Cartthrob_sample_gateway extends Cartthrob_payment_gateway
{
    public $title = 'ct.payments.sample_gateway.title';

    public function charge($creditCardNumber): \CartThrob\Transactions\TransactionState
    {
        // magic goes here
    }
}
```

Once you have the above ready, you just need to wrap it up in an ExpressionEngine Extension, call some magic to register your fancy new Payment Gateway, 
and you're off to the races. 

```php 
<?php
ee()->lang->load('cartthrob_sample_gateway', $idiom = '', $return = false, $add_suffix = true, $alt_path = __DIR__ . '/');
ee('cartthrob:PluginService')->register(Cartthrob_sample_gateway::class);
```

## A Complete Gateway Object

If you need more complex logic, here's the complete Payment Gateway API:

### Properties
`title`Used in outputting what your Gateway is called; note that this is filtered through the Language file.

`overview` A description displayed on the Gateway management page within CartThrob; note that this is filtered through the Language file.

`settings` A multidimensional array to generate the Settings form within the CartThrob Control Panel.

`fields` A simple array of the fields to output on the Checkout form when using the `{gateway_fields)` tag

### Methods 

`charge($creditCardNumber)` Handles processing the credit card number for payment

`createToken($creditCardNumber)`For Payment Gateways that generate reusable Tokens, you'll wrap that up in this method.

`refund($transactionId, $amount, $creditCardNumber)` Processes the refund with the Gateway

`chargeToken($token, $customerId, $offsite)` Takes the provided Vault token and charges the amount stored in the `total()` method.

### Complete Object Prototype

Here's a simple example of everything's laid out. 

```php 
<?php
class Cartthrob_sample_gateway extends Cartthrob_payment_gateway
{
    public $title = 'ct.payments.sample_gateway.title';

    public $overview = 'ct.payments.sample_gateway.overview';

    public $settings = [];

    public $fields = [];

    public function charge($creditCardNumber): \CartThrob\Transactions\TransactionState
    {

    }

    public function refund($transactionId, $amount, $creditCardNumber): \CartThrob\Transactions\TransactionState
    {

    }

    public function createToken($creditCardNumber): \CartThrob\Transactions\TransactionState|\Cartthrob_token
    {

    }

    public function chargeToken($token, $customerId, $offsite): \CartThrob\Transactions\TransactionState
    {

    }
}
```
### The Settings Property 

If your Gateway requires custom settings and configuration, you use the `$settings` property to define the form. 

Note that the format needs to match up with ExpressionEngine's form builder. 

```php
<?php 
$settings = [
     [
         'name' => 'ct.payments.sample_gateway.api.public_key',
         'short_name' => 'public_key',
         'note' => 'ct.payments.sample_gateway.api.public_key.note',
         'type' => 'text',
         'default' => '',
     ],
     [
         'name' => 'ct.payments.sample_gateway.api.private_key',
         'short_name' => 'private_key',
         'type' => 'text',
         'default' => '',
     ],
     [
         'name' => 'ct.payments.sample_gateway.api.sandbox.public_key',
         'short_name' => 'sandbox_public_key',
         'note' => 'ct.payments.sample_gateway.api.sandbox.public_key.note',
         'type' => 'text',
         'default' => '',
     ],
     [
         'name' => 'ct.payments.sample_gateway.api.sandbox.private_key',
         'short_name' => 'sandbox_private_key',
         'type' => 'text',
         'default' => '',
     ],
     [
         'name' => 'ct.payments.sample_gateway.api.mode',
         'short_name' => 'mode',
         'type' => 'select',
         'options' => [
             'test' => 'sandbox',
             'live' => 'live',
         ],
     ],
 ];
```

The above will add a custom form onto the CartThrob Payments Settings page. 

### The Fields Property

This is just an array of field names to generate for your Checkout form when using the `{gateway_fields}` tag. 

```php 
<?php
$fields = [
     'first_name',
     'last_name',
     'address',
     'address2',
     'city',
     'state',
     'zip',
     'company',
     'country_code',
     'shipping_first_name',
     'shipping_last_name',
     'shipping_phone',
     'shipping_address',
     'shipping_address2',
     'shipping_city',
     'shipping_state',
     'shipping_zip',
     'shipping_country_code',
     'phone',
     'email_address',
 ];
```