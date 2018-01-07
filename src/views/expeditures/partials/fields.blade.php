<p class="control has-top-padding">
    {!! Form::label('date', 'Fecha', ['class' => 'label']) !!}
    {!! Form::text('date', null, ['class' => 'input']) !!}
</p>
<p class="control has-top-padding">
    {!! Form::label('expediture_type_id', 'Tipo de Gasto', ['class' => 'label']) !!}
    <span class="select">
        {!! Form::select('expediture_type_id', [ '' => '(Sin Tipo de Gasto)' ] + $expediture_types) !!}
    </span>
</p>
<p class="control has-top-padding">
    {!! Form::label('name', 'Nombre', ['class' => 'label']) !!}
    {!! Form::text('name', null, ['class' => 'input']) !!}
</p>
<p class="control has-top-padding">
    {!! Form::label('amount', 'Importe', ['class' => 'label']) !!}
    {!! Form::text('amount', null, ['class' => 'input']) !!}
</p>
<p class="control has-top-padding">
    {!! Form::checkbox('recurring', 1) !!} Recurrente
</p>