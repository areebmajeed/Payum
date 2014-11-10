<?php
namespace Payum\OmnipayBridge;

use Omnipay\Common\GatewayInterface;
use Payum\Core\Action\ExecuteSameRequestWithModelDetailsAction;
use Payum\Core\Action\GetHttpRequestAction;
use Payum\Core\Payment;
use Payum\Core\Extension\EndlessCycleDetectorExtension;
use Payum\OmnipayBridge\Action\CaptureAction;
use Payum\OmnipayBridge\Action\FillOrderDetailsAction;
use Payum\OmnipayBridge\Action\StatusAction;

abstract class PaymentFactory
{
    /**
     * @param \Omnipay\Common\GatewayInterface $gateway
     *
     * @return Payment
     */
    public static function create(GatewayInterface $gateway)
    {
        $payment = new Payment;
        
        $payment->addApi($gateway);
        
        $payment->addExtension(new EndlessCycleDetectorExtension);

        $payment->addAction(new CaptureAction);
        $payment->addAction(new FillOrderDetailsAction);
        $payment->addAction(new StatusAction);
        $payment->addAction(new ExecuteSameRequestWithModelDetailsAction);
        $payment->addAction(new GetHttpRequestAction);

        return $payment;
    }

    /**
     */
    private function __construct()
    {
    }
}