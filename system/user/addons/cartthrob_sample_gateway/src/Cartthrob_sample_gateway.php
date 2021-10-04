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
        'card_type',
        'credit_card_number',
        'CVV2',
        'expiration_year',
        'expiration_month',
    ];

    /**
     * If you want to have any of the above $fields displayed without
     * names on the inputs put them here.
     * @var array
     */
    public $nameless_fields = [];

    /**
     * Any of the $fields you want to be required by the form
     *  Be sure to not try this with any $nameless_fields
     * @var string[]
     */
    public $required_fields = [
        'card_type',
        'credit_card_number',
        'CVV2',
        'expiration_year',
        'expiration_month',
        'email_address',
    ];

    /**
     * Any arbitrary HTML you want included at the bottom
     *  of the form
     * @var string
     */
    public $embedded_fields = '';

    /**
     * The hidden form fields you want to include in the HTML form
     * @var string[]
     */
    public $hidden = [];

    /**
     * Custom per gateway
     * @var bool
     */
    protected $publicKey;

    /**
     * Custom per gateway
     * @var bool
     */
    protected $privateKey;

    public function __construct()
    {
        $this->publicKey = ($this->plugin_settings('mode') === 'live') ? $this->plugin_settings('public_key') : $this->plugin_settings('sandbox_public_key');
        $this->privateKey = ($this->plugin_settings('mode') === 'live') ? $this->plugin_settings('private_key') : $this->plugin_settings('sandbox_private_key');
    }

    /**
     * @param $creditCardNumber
     */
    public function charge($creditCardNumber): TransactionState
    {
        $state = new TransactionState();
        $trans_id = uniqid('sample_charge_', true); //you'd want to use the return from the Remote Gateway

        return $state->setAuthorized()->setTransactionId($trans_id);
    }

    /**
     * @param $transactionId
     * @param $amount
     * @param $creditCardNumber
     */
    public function refund($transactionId, $amount, $creditCardNumber): TransactionState
    {
        $state = new TransactionState();
        $token = uniqid('sample_refund_', true); //this would normally be the Token from the Gateway

        return $state->setAuthorized()->setTransactionId($token);
    }

    /**
     * @param $creditCardNumber
     */
    public function createToken($creditCardNumber): Cartthrob_token
    {
        $token = uniqid('sample_token_', true); //this would normally be the Token from the Gateway

        return new Cartthrob_token(['token' => $token]);
    }

    /**
     * @param $token
     * @param $customerId
     * @param $offsite
     */
    public function chargeToken($token, $customerId, $offsite): TransactionState
    {
        $state = new TransactionState();
        $trans_id = uniqid('sample_token_charge_', true); //you'd want to use the return from the Remote Gateway

        return $state->setAuthorized()->setTransactionId($trans_id);
    }
}
