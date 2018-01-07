<p class="control has-top-padding">
    {!! Form::label('address', 'Dirección', ['class' => 'label']) !!}
    {!! Form::text('address', null, ['class' => 'input']) !!}
</p>
<p class="control has-top-padding">
    {!! Form::label('postcode', 'C. Postal', ['class' => 'label']) !!}
    {!! Form::text('postcode', null, ['class' => 'input']) !!}
</p>
<p class="control has-top-padding">
    {!! Form::label('city', 'Ciudad', ['class' => 'label']) !!}
    {!! Form::text('city', null, ['class' => 'input']) !!}
</p>
<p class="control has-top-padding">
    {!! Form::label('province', 'Provincia', ['class' => 'label']) !!}
    <span class="select">
        {!! Form::select('province', config('options.provinces')) !!}
    </span>
</p>

@if(
    !isset($address) && $customer->addresses->count() ||
    isset($address) && $customer->addresses->count() > 1  && !$address->default
    )
    <p class="control has-top-padding">
        {!! Form::checkbox('default', 1) !!} Dirección por defecto
    </p>
@endif