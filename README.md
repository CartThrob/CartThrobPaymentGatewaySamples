# CartThrob Sample Payment Gateways

The purpose of this repository is to demonstrate how a CartThrob Payment Gateway should, ideally, be laid out as a program.
They're pretty simple at the core, by design, though depending on your use case can be challenging in their own right. To help with this,
this repository contains multiple branches with different use cases and examples.

Be sure to check out the Wiki for details about the internals of a [CartThrob Payment Gateway](https://github.com/CartThrob/CartThrobPaymentGatewaySamples/wiki). 

### Branch Breakdown

#### Develop
This is our internal development branch for the repository. Nothing to see here, move along.

#### Main
For pure custom solutions without any external requirements; implement however you want.

#### Omnipay
This example outlines how to use Omnipay within your custom Payment Gateway.

#### Offsite
How to handle Payment Gateways that require users to verify their purchases offsite.

#### Embedded Form
Adding custom form elements from remote payment gateways.