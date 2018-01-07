<?php

namespace Verkoo\Common\Events;

use Illuminate\Queue\SerializesModels;
use Verkoo\Common\Entities\Order;

class OrderCashed
{
    use SerializesModels;
    /**
     * @var Order
     */
    public $order;
    public $diners;

    /**
     * Create a new event instance.
     *
     * @param Order $order
     * @param $diners
     */
    public function __construct(Order $order, $diners = 1)
    {
        $this->order = $order;
        $this->diners = $diners;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
