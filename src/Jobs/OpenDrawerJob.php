<?php

namespace Verkoo\Common\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Verkoo\Common\Factories\TicketFactory;

class OpenDrawerJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @param TicketFactory $ticketFactory
     */
    public function handle(TicketFactory $ticketFactory)
    {
        $ticketFactory->createOpenDrawerTicket()->printTicket();
    }
}
