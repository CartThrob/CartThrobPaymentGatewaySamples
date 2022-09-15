<?php

use CartThrob\Transactions\TransactionState;
use Omnipay\Omnipay;
use CartThrob\PaymentGateways\AbstractPaymentGateway;

class Cartthrob_sample_gateway extends AbstractPaymentGateway
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
    public array $nameless_fields = [];

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

        $this->omnipayGateway = Omnipay::create('Dummy');
        $this->omnipayGateway->initialize([]);
    }

    /**
     * @return TransactionState
     */
    public function charge(string $creditCardNumber)
    {
        $params = [
            'card' => [
                'number' => $creditCardNumber,
                'expiryMonth' => ee()->input->post('expiration_month'),
                'expiryYear' => ee()->input->post('expiration_year'),
            ],
            'amount' => $this->total(),
        ];

        try {
            $response = $this->omnipayGateway->purchase($params)->send();
            if (!$response->isSuccessful()) {
                return $this->fail($response->getMessage());
            }

            return $this->authorize($response->getTransactionReference());
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }

    /**
     * @param $transactionId
     * @param $amount
     * @param $lastFour
     * @return TransactionState
     */
    public function refund($transactionId, $amount, $lastFour)
    {
        try {
            $response = $this->omnipayGateway->refund(['transactionReference' => $transactionId])->send();

            if (!$response->isSuccessful()) {
                return $this->fail($response->getMessage());
            }

            return $this->authorize($response->getTransactionReference());
        } catch (\Exception $e) {
            return $this->fail($e->getMessage());
        }
    }
}
