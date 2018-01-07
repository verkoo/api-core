<?php

namespace Verkoo\Common\Http\Controllers;

use Verkoo\Common\Entities\DeliveryNote;
use Verkoo\Common\Entities\Invoice;
use Verkoo\Common\Entities\Order;
use Verkoo\Common\Entities\Quote;

class PdfDocumentController extends Controller
{
    private $types = [
      'invoices' => [
          'class' => Invoice::class,
          'typeName' => 'Factura',
      ],
      'delivery-notes' => [
          'class' => DeliveryNote::class,
          'typeName' => 'Albarán',
      ],
      'orders' => [
          'class' => Order::class,
          'typeName' => 'Pedido',
      ],
      'quotes' => [
          'class' => Quote::class,
          'typeName' => 'Presupuesto',
      ]
    ];

    public function index($type, $id)
    {
        $class = $this->types[$type]['class'];
        $typeName = $this->types[$type]['typeName'];

        $document = $class::findOrFail($id);

        $lines = $document->lines->groupBy('customer_delivery_note_number');

        $allergenIcons = $document->allergenIcons;

        $pdf = \PDF::loadView('verkooCommon::pdf.document', compact('document', 'lines', 'typeName', 'allergenIcons'));

        return $pdf->inline("{$type}_{$id}.pdf");
    }
}
