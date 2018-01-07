<p class="control has-top-padding">
    <label for="name" class="label">Nombre</label>
    {!! Form::text('name', null, ['class' => 'input']) !!}
</p>
<p class="control has-top-padding">
        <label for="dni" class="label">Dni</label>
        {!! Form::text('dni', null, ['class' => 'input', 'placeholder' => '12345678A']) !!}
</p>
<p class="control has-top-padding">
    <label for="phone" class="label">Teléfono</label>
    {!! Form::text('phone', null, ['class' => 'input']) !!}
</p>
<p class="control has-top-padding">
    <label for="phone2" class="label">Teléfono Alternativo</label>
    {!! Form::text('phone2', null, ['class' => 'input']) !!}
</p>
<p class="control has-top-padding">
    {!! Form::label('email', 'E-mail',  ['class' => 'label']) !!}
    {!! Form::text('email', null, [ 'class' => 'input']) !!}
</p>
<p class="control has-top-padding">
    {!! Form::label('contact_person', 'Persona de Contacto',  ['class' => 'label']) !!}
    {!! Form::text('contact_person', null, [ 'class' => 'input']) !!}
</p>
<p class="control" class="label">
    {!! Form::label('comments', 'Observaciones', ['class' => 'label']) !!}
    {!! Form::textarea('comments', null, [ 'class' => 'textarea']) !!}
</p>