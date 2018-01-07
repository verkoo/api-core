<p class="control has-top-padding">
    {!! Form::label('name', 'Nombre', ['class' => 'label']) !!}
    {!! Form::text('name', null, ['class' => 'input', 'id' => 'name']) !!}
</p>
<p class="control has-top-padding">
    {!! Form::label('description', 'Descripción', ['class' => 'label']) !!}
    {!! Form::textarea('description', null, ['class' => 'textarea']) !!}
</p>