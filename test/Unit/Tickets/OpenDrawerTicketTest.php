<?php
namespace Verkoo\Common\Tests\Unit\Tickets;

use Verkoo\Common\Entities\Options;
use Verkoo\Common\Tests\BaseTestCase;

class OpenDrawerTicketTest extends BaseTestCase
{

    /** @test */
    public function getText_returns_a_call_to_openDrawer()
    {
        $ticket = \Mockery::mock('Verkoo\Common\Tickets\OpenDrawerTicket')
            ->shouldAllowMockingProtectedMethods()
            ->makePartial();

        $ticket->shouldReceive('openDrawer')->once()->andReturn('DRAWER OPENED');

        $result = $this->invokeMethod($ticket, 'getText');

        $this->assertEquals('DRAWER OPENED', $result);
    }

    /** @test */
    public function getPrinter_returns_default_printer_in_settings()
    {
        $ticket = \Mockery::mock('Verkoo\Common\Tickets\OpenDrawerTicket')
            ->shouldAllowMockingProtectedMethods()
            ->makePartial();

        Options::first()->update([
            'default_printer' => 'DEFAULT PRINTER'
        ]);

        $result = $this->invokeMethod($ticket, 'getPrinter');

        $this->assertEquals('DEFAULT PRINTER', $result);
    }
}