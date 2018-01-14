<?php

use Illuminate\Support\Collection;
use Orchestra\Testbench\TestCase;
use Verkoo\Common\Tickets\KitchenTicket;

class KitchenTicketTest extends TestCase
{
    /** @test */
    public function RunningMigration()
    {
//        $this->assertEquals('NORMALFONT', $stub->normalFont());
        $lines = new Collection();
        $table = 1;
        $mock = \Mockery::mock('Verkoo\Common\Tickets\KitchenTicket', [
            $lines,
            $table,
        ])->shouldAllowMockingProtectedMethods()->makePartial();;
        $mock->shouldReceive([
            'normalFont' => 'NORMALFONT',
        ]);
        $ticket = new KitchenTicket($lines, $table);
        var_dump($this->invokeMethod($ticket, 'getText'));
//        $this->assertEquals('NORMALFONT', $this->invokeMethod($ticket, 'getText'));
    }

    /**
     * Call protected/private method of a class.
     *
     * @param object &$object    Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}