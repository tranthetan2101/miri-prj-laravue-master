<?php

namespace App\Observers\Order;

use App\Models\Order;
use App\Services\CrmService;

/**
 * Class OrderObserver.
 */
class OrderObserver
{
    public function __construct(CrmService $crmService)
    {
        $this->crmService = $crmService;
    }

    /**
     * Listen to the Order created event.
     *
     * @param  \App\Models\Order  $order
     */
    public function created(Order $order) : void
    {
        /// post customer to Crm
        $this->crmService->saveCustomerFromOrder($order);
    }

}
