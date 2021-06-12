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
The "fields" property outlines those fields displayed on the checkout page

The "title" and "overview" properties are handled through the language filter. Be sure to include one in your gateway extension.

You'll need 1 method in your Payment Gateway "charge" though you can have additional methods for additional functionality
1. void (used to void payments)
2. refund (to refund an order)
3. createToken (to create reusable tokens for use in things like Subscriptions)
4. chargeToken (the actual handling of taking a token and requesting money

Both the chargeToken and charge methods MUST return an instance of "CartThrob\Transactions\TransactionState"

You can have custom settings outlined in your object that display automagically in the CartThrob Control Panel.

In your extension to register your new Payment Gateway, you'll code like the below, registered on the "cartthrob_boot" hook:
ee()->lang->load('cartthrob_custom_gateway_payment', $idiom = '', $return = false, $add_suffix = true, $alt_path = __DIR__ . '/');
ee('cartthrob:PluginService')->register(Cartthrob_custom_gateway_payment::class);