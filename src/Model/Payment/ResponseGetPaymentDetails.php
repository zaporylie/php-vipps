<?php

namespace Vipps\Model\Payment;

use JMS\Serializer\Annotation as Serializer;

class ResponseGetPaymentDetails
{

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $orderId;

    /**
     * @var \Vipps\Model\Payment\TransactionSummary
     * @Serializer\Type("Vipps\Model\Payment\TransactionSummary")
     */
    protected $transactionSummary;

    /**
     * @var \Vipps\Model\Payment\TransactionLog[]
     * @Serializer\Type("array<Vipps\Model\Payment\TransactionLog>")
     */
    protected $transactionLogHistory;
}
