<?php
class Cartthrob_sample_gateway extends Cartthrob_payment_gateway
{
    public function charge($creditCardNumber): \CartThrob\Transactions\TransactionState
    {
        parent::charge($creditCardNumber); // TODO: Change the autogenerated stub
    }

    public function refund($transactionId, $amount, $creditCardNumber): \CartThrob\Transactions\TransactionState
    {
        parent::refund($transactionId, $amount, $creditCardNumber); // TODO: Change the autogenerated stub
    }
}