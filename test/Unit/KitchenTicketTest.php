<?php
namespace Verkoo\Common\Tests\Unit;

use Illuminate\Support\Collection;
use Verkoo\Common\Tests\BaseTestCase;

class KitchenTicketTest extends BaseTestCase
{
    /** @test */
    public function getText_return_expected_data()
    {
        $lineA = new \stdClass();
        $lineA->remaining = 2;
        $lineA->product_name = 'PRODUCT A';

        $lineB = new \stdClass();
        $lineB->parent = 12;
        $lineB->product_name = 'PRODUCT B';

        $lines = new Collection([
            $lineA,
            $lineB
        ]);
        $table = 1;
        $ticket = \Mockery::mock('Verkoo\Common\Tickets\KitchenTicket', [
            $lines,
            $table,
        ])
            ->shouldAllowMockingProtectedMethods()
            ->makePartial();

        $ticket->shouldReceive('normalFont')->andReturnSelf();
        $ticket->shouldReceive('align')->once()->with('center')->andReturnSelf();
        $ticket->shouldReceive('doubleHeight')->andReturnSelf();
        $ticket->shouldReceive('getDate')->once()->andReturn('DATE');
        $ticket->shouldReceive('newLine')->once()->with('MESA 1');
        $ticket->shouldReceive('newLine')->once()->with('[DATE]');
        $ticket->shouldReceive('newEmptyLine')->once();
        $ticket->shouldReceive('newLine')->once()->with('CANT ------ PRODUCTO -------');
        $ticket->shouldReceive('newLine')->once()->with('2       PRODUCT A');
        $ticket->shouldReceive('newLine')->once()->with('   ->       PRODUCT B');
        $ticket->shouldReceive('cutPaper')->once()->andReturn('');

        $this->invokeMethod($ticket, 'getText');
    }
}