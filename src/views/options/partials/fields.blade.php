<p class="control has-top-padding">
    {!! Form::label('company_name', 'Empresa', ['class' => 'label']) !!}
    {!! Form::text('company_name', null, ['class' => 'input']) !!}
</p>
<p class="control has-top-padding">
    {!! Form::label('address', 'Dirección', ['class' => 'label']) !!}
    {!! Form::text('address', null, ['class' => 'input']) !!}
</p>
<p class="control has-top-padding">
    {!! Form::label('cp', 'Código Postal', ['class' => 'label']) !!}
    {!! Form::text('cp', null, ['class' => 'input']) !!}
</p>
<p class="control has-top-padding">
    {!! Form::label('city', 'Ciudad', ['class' => 'label']) !!}
    {!! Form::text('city', null, ['class' => 'input']) !!}
</p>
<p class="control has-top-padding">
    {!! Form::label('phone', 'Teléfono', ['class' => 'label']) !!}
    {!! Form::text('phone', null, ['class' => 'input']) !!}
</p>
<p class="control has-top-padding">
    {!! Form::label('web', 'Web', ['class' => 'label']) !!}
    {!! Form::text('web', null, ['class' => 'input']) !!}
</p>
<p class="control has-top-padding">
    {!! Form::label('cif', 'CIF', ['class' => 'label']) !!}
    {!! Form::text('cif', null, ['class' => 'input']) !!}
</p>
<p class="control has-top-padding">
    {!! Form::label('pagination', 'Elementos por página', ['class' => 'label']) !!}
    {!! Form::text('pagination', null, ['class' => 'input']) !!}
</p>
<p class="control has-top-padding">
    {!! Form::label('default_printer', 'Impresora Principal', ['class' => 'label']) !!}
    {!! Form::text('default_printer', null, ['class' => 'input']) !!}
</p>
<p class="control has-top-padding">
    {!! Form::label('payment_id', 'Forma de pago de Contado', ['class' => 'label']) !!}
    <span class="select">
        {!! Form::select('payment_id', $payments) !!}
    </span>
</p>
<p class="control has-top-padding">
    {!! Form::label('default_tpv_serie', 'Serie de Facturación de TPV', ['class' => 'label']) !!}
    <span class="select">
        {!! Form::select('default_tpv_serie', config('options.series')) !!}
    </span>
</p>
<p class="control has-top-padding">
    {!! Form::label('tax_id', 'Tipo de Iva por defecto', ['class' => 'label']) !!}
    <span class="select">
        {!! Form::select('tax_id', $taxes, null, ['class' => 'input']) !!}
    </span>
</p>
<p class="control has-top-padding">
    {!! Form::label('other', 'Otras Opciones', ['class' => 'label']) !!}
</p>
<p class="control has-top-padding">
    {!! Form::checkbox('print_ticket_when_cash', 1, $options->print_ticket_when_cash) !!} Imprimir Factura al Cobrar
</p>
<p class="control has-top-padding">
    {!! Form::checkbox('cash_pending_ticket', 1, $options->cash_pending_ticket) !!} Imprimir Nota de Cobro en Impresora de Tickets
</p>
<p class="control has-top-padding">
    {!! Form::checkbox('open_drawer_when_cash', 1, $options->open_drawer_when_cash) !!} Abrir cajón al Cobrar
</p>
<p class="control has-top-padding">
    {!! Form::checkbox('hide_out_of_stock', 1, $options->hide_out_of_stock) !!} Ocultar Productos Sin Stock
</p>
<p class="control has-top-padding">
    {!! Form::checkbox('show_stock_in_photo', 1, $options->show_stock_in_photo) !!} Mostrar Stock en Foto del Producto
</p>
<p class="control has-top-padding">
    {!! Form::checkbox('break_down_taxes_in_ticket', 1, $options->break_down_taxes_in_ticket) !!} Desglosar Iva en Ticket
</p>
@include("verkooCommon::options.partials.fields-" . \Verkoo\Common\Entities\Settings::get('module'))