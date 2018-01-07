<p class="control has-top-padding">
    {!! Form::label('name', 'Nombre', ['class' => 'label']) !!}
    {!! Form::text('name', null, ['class' => 'input']) !!}
</p>
<p class="control has-top-padding">
    {!! Form::label('parent', 'Categoría Padre', ['class' => 'label']) !!}
    <span class="select">
            {!! Form::select('parent', [ '' => '(Sin Categoría Padre)' ] + $categories, null, ['class' => 'input']) !!}
    </span>
</p>
<p class="control has-top-padding">
    {!! Form::label('tax_id', 'Tipo de Iva', ['class' => 'label']) !!}
    <span class="select">
            {!! Form::select('tax_id', [ '' => '(Utilizar Iva por defecto)' ] + $taxes) !!}
    </span>
</p>
<p class="control has-top-padding">
    {!! Form::label('photo', 'Foto', ['class' => 'label']) !!}
    @if($category->photo)
        <div class="product-photo-form">
            <img src="/storage/{{ $category->photo }}" width="100px">
        </div>
        <div>
            <label for="delete_photo">Eliminar</label>
            {!! Form::checkbox('delete_photo', 1, 0) !!}
        </div>
    @endif
    {!! Form::file('photo', null, ['class' => 'input']) !!}
</p>
<p class="control has-top-padding">
    {!! Form::checkbox('recount_stock', 1, $category->recount_stock) !!} Recontar Stock al Abrir Caja
</p>