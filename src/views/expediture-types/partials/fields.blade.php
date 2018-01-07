<p class="control has-top-padding">
    {!! Form::label('name', 'Nombre', ['class' => 'label']) !!}
    {!! Form::text('name', null, ['class' => 'input']) !!}
</p>
<p class="control has-top-padding">
    {!! Form::label('parent', 'Tipo de Gasto Padre', ['class' => 'label']) !!}
    <span class="select">
        {!! Form::select('parent', [ '' => '(Sin Tipo de Gasto Padre)' ] + $expeditureTypes, null, ['class' => 'input']) !!}
    </span>
</p>