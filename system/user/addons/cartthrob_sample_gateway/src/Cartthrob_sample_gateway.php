<?php

use CartThrob\Transactions\TransactionState;

class Cartthrob_sample_gateway extends Cartthrob_payment_gateway
{
    /**
     * This is the public name for your Gateway. It's displayed within the CartThrob Payments
     * It's a good idea to use a language key for this so you won't have to look to change later
     * @var string
     */
    public $title = 'ct.payments.sample_gateway.title';

    /**
     * This is the Overview that's dispalyed within the CartThrob Payments Settings page when managing this
     * Payment Gateway's Settings.
     * @var string
     */
    public $overview = 'ct.payments.sample_gateway.overview';

    /**
     * The Settings form is generated using the below array. Note that the Payment Gatway Settings use
     * ExpressionEngine's Form Builder format and can generate any form field that ExpressionEngine can.
     * @var array
     */
    public $settings = [
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

    /**
     * A simple list of fields to autogenerate for Payment using the {gateway_fields) tag
     * @var string[]
     */
    public $fields = [
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

    /**
     * @param $creditCardNumber
     * @return TransactionState
     */
    public function charge($creditCardNumber): \CartThrob\Transactions\TransactionState
    {
        $state = new TransactionState();
        $trans_id = uniqid('', true); //you'd want to use the return from the Remote Gateway
        return $state->setAuthorized()->setTransactionId($trans_id);
    }

    /**
     * @param $transactionId
     * @param $amount
     * @param $creditCardNumber
     * @return TransactionState
     */
    public function refund($transactionId, $amount, $creditCardNumber): \CartThrob\Transactions\TransactionState
    {
        $state = new TransactionState();
        return $state->setRefunded();
    }

    /**
     * @param $creditCardNumber
     * @return Cartthrob_token
     */
    public function createToken($creditCardNumber): \Cartthrob_token
    {
        $token = uniqid('', true); //this would normally be the Token from the Gateway
        return new Cartthrob_token(['token' => $token]);
    }

    /**
     * @param $token
     * @param $customerId
     * @param $offsite
     * @return TransactionState
     */
    public function chargeToken($token, $customerId, $offsite): \CartThrob\Transactions\TransactionState
    {
        $state = new TransactionState();
        $trans_id = uniqid('', true); //you'd want to use the return from the Remote Gateway
        return $state->setAuthorized()->setTransactionId($trans_id);
    }
}