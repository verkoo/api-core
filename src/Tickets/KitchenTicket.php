<?php

namespace Verkoo\Common\Tickets;

use Illuminate\Support\Collection;

class KitchenTicket extends Ticket
{
    private $lines;
    private $table;

    public function __construct(Collection $lines, $table)
    {
        $this->lines = $lines;
        $this->table = $table;
    }

    protected function getText()
    {
        $text = $this->normalFont()
            ->align('center')
            ->doubleHeight()
            ->newLine("MESA $this->table");

        $text .= $this->normalFont()
            ->newLine("[{$this->getDate()}]");

        $text .= $this->newEmptyLine();

        $text .= $this->doubleHeight()
            ->newLine("CANT ------ PRODUCTO -------");

        foreach ($this->lines as $line) {
                $lineText = (isset($line->parent) ? '   ->' : $line->remaining ) . '       '. $line->product_name;
                $text .= $this->normalFont()
                    ->newLine($lineText);
        }

        $text .= $this->cutPaper();
        
        return $text;
    }

    protected function getPrinter()
    {
        return $this->lines->first()->printer;
    }
}