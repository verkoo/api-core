<p class="control has-top-padding">
    {!! Form::label('other', 'Opciones Módulo Hostelería', ['class' => 'label']) !!}
</p>
<p class="control has-top-padding">
    {!! Form::checkbox('recount_stock_when_open_cash', 1, $options->recount_stock_when_open_cash) !!} Recontar Stock al Abrir Caja
</p>
<p class="control has-top-padding">
    {!! Form::checkbox('manage_kitchens', 1, $options->manage_kitchens) !!} Gestionar Cocinas
</p>
