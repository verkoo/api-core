<?php
namespace Verkoo\Common\Tickets;

use Carbon\Carbon;
use Verkoo\Common\Entities\Settings;

abstract class Ticket
{
    protected $format = 0;
    protected $align = 0;

    protected function envIsLocal()
    {
        return (\Config::get('app.env') == 'local');
    }

    protected function getDate() 
    {
        return Carbon::now()->format('d-m-Y h:i:s A');;
    }

    protected function header()
    {
        $text = $this->align('center')
            ->doubleHeight()
            ->bold()
            ->newLine(Settings::get('company_name'));

        $text .= $this->align('center')->newLine(Settings::get('address'));
        $text .= $this->align('center')->newLine(Settings::get('cp') . ' - ' . Settings::get('city'));
        $text .= $this->align('center')->newLine('TLF: ' . Settings::get('phone'));
        $text .= $this->align('center')->newLine(Settings::get('cif'));
        $text .= $this->newEmptyLine();

        return $text;
    }

    protected function lines($lines, $menus)
    {
        $text = chr(27) . chr(51) . chr(1);

        foreach ($lines as $line) {
            $quantity = $line->parent ? '' : $line->quantity;
            $price    = $line->parent ? '' : $line->price;

            $lineText = str_pad($quantity, 4, " ", STR_PAD_BOTH) .
                str_pad(substr($line->product_name,0,20), 22, " ", STR_PAD_RIGHT) .
                str_pad($price, 7, " ", STR_PAD_LEFT) .
                str_pad($line->total, 8, " ", STR_PAD_LEFT);

            $text .= $this->normalFont()
                ->newLine($lineText);
        }

        if ($menus) {
             foreach ($menus as $menu) {

                 $lineText = str_pad(1, 4, " ", STR_PAD_BOTH) .
                     str_pad(substr($menu->name,0,28), 28, " ", STR_PAD_RIGHT) .
                     str_pad($menu->price, 7, " ", STR_PAD_LEFT) .
                     str_pad($menu->price, 8, " ", STR_PAD_LEFT);

                 $text .= $this->normalFont()
                     ->newLine($lineText);
             }
        }

        $text .= $this->newEmptyLine();
        $text .= $this->align('center')->doubleHeight()->bold()->newLine('TOTAL: '. number_format($this->event->order->total,2,',',''));

        return $text;
    }

    protected function taxes($taxes)
    {
        $text = $this->newEmptyLine();

        foreach ($taxes as $key => $value) {
            $text .= $this->align('center')
                ->newLine("BASE: {$value["base"]} IVA {$key}%: {$value["vat"]}.");
        }

        return $text;
    }

    protected function footer()
    {
        $text = $this->newEmptyLine();
        $text .= $this->align('center')
            ->newLine('IVA incluido.');
        $text .= $this->align('center')
            ->newLine('Gracias por su visita.');
        $text .= $this->newEmptyLine();
        $text .= $this->newEmptyLine();
        $text .= $this->newEmptyLine();
        $text .= $this->newEmptyLine();
        $text .= $this->newEmptyLine();
        $text .= $this->newEmptyLine();
        $text .= $this->newEmptyLine();
        $text .= $this->newEmptyLine();
        $text .= $this->newEmptyLine();
        $text .= $this->newEmptyLine();
        $text .= $this->newEmptyLine();
        $text .= $this->newEmptyLine();

        return $text;
    }

    protected function write($text)
    {
        $align =  chr(27) . chr(97) . chr($this->align);
        $format = chr(27) . chr(33) . chr($this->format);
        $this->resetFormat();
        $this->resetAlign();
        return $align . $format . $text;
    }

    protected function newLine($text) {
        if ($this->envIsLocal()) {
            return "\r\n$text";
        }
        return chr(27) . chr(100) . chr(1) . $this->write($text);
    }

    protected function newEmptyLine() 
    {
        if ($this->envIsLocal()) {
            return "\r\n";
        }
        return chr(27) . chr(100) . chr(1) . ' ';
    }

    protected function resetFormat() 
    {
        $this->format = 0;
        return $this;
    }
    
    protected function resetAlign() 
    {
        $this->align = 0;
        return $this;
    }
    
    protected function bold()
    {
        $this->format += 8;
        return $this;
    }

    protected function italics()
    {
        $this->format += 64;
        return $this;
    }
    protected function doubleHeight()
    {
        $this->format += 16;
        return $this;
    }
    protected function doubleWidth()
    {
        $this->format += 32;
        return $this;
    }

    protected function underline()
    {
        $this->format += 128;
        return $this;
    }
    
    protected function align($type)
    {
        if ($type == 'center') {
            $this->align = 1;
        }
        elseif ($type == 'right') {
            $this->align = 2;
        }
        else {
            $this->align = 0;
        }
        
        return $this;
    }

    protected function openDrawer()
    {
        return chr(27) . chr(112) . chr(0) . chr(25) . chr(250);
    }

    protected function cutPaper()
    {
        //29 = GS
        //86 = V
        //0 - 48 TOTAL (65)
        //1-49 TOTAL MENOS UN PUNTO (66)
        //0 FEED

        return chr(10).chr(10).chr(10).chr(10).chr(10).chr(10).
        chr(10).chr(10).chr(10).chr(10).chr(10).chr(10).chr(29).chr(86).chr(49).chr(12);
    }

    protected function restart()
    {
        return chr(27) . chr(64);
    }

    protected function lineSpace($space)
    {
        return chr(27) . chr(32) . chr($space);
    }
    
    protected function normalFont()
    {
        $this->format += 2;
        return $this;
    }
    protected function smallFont()
    {
        $this->format += 1;
        return $this;
    }

    abstract protected function getText();

    abstract protected function getPrinter();

    public function printTicket()
    {
        if (\Config::get('app.env') == 'testing') {
            return;
        }
        if ($this->envIsLocal()) {
            file_put_contents(
            public_path() . '/log/log.txt',
            $this->getText(),
            FILE_APPEND
            );
        }
        else {
            if ($printer = $this->getPrinter()) {
                file_put_contents(
                    'ticket',
                    $this->getText()
                );
                if (env('OS') === "linux") {
                    shell_exec("cat ticket > $printer");
                }
                else if (env('OS') === "Windows_NT") {
                    shell_exec("type ticket > $printer");
                }
            }
        }
    }
}