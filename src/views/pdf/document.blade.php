<html>
<head>
    <meta charset="utf-8">
    <title>{{ $typeName }}</title>

    <style>
        .invoice-box{
            max-width:800px;
            margin:auto;
            padding:10px;
            font-size:16px;
            line-height:24px;
            font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color:#555;
        }

        .invoice-box table {
            width:100%;
            line-height:inherit;
        }

        .invoice-box table.total {
            text-align:right;
        }

        .invoice-box table td{
            padding:5px;
            vertical-align:top;
        }

        .invoice-box table.lines td:not(:first-child){
            width: 10%;
            text-align:right;
        }

        .invoice-box table tr.heading td{
            background:#eee;
            border-bottom:1px solid #ddd;
            font-weight:bold;
        }

        .invoice-box table.lines tr.item td{
            border-bottom:1px solid #eee;
        }

        .invoice-box table.lines tr.item.last td{
            border-bottom:none;
        }

        .invoice-box table.lines tr.total td:nth-child(2){
            text-align: right;
            border-top:2px solid #eee;
            font-weight:bold;
        }

        .logo {
            font-weight: bold;
        }

        .info {
            clear: both;
            padding: 40px 0;
        }

        .group {
            font-style: italic;
            font-weight: bold;
            font-size: 12px;
        }
        .footer {
            position: absolute;
            bottom: 0;
        }
        .icons img {
            width: 50px;
            height: 50px;
        }
    </style>
</head>

<body>
<div class="invoice-box">
    <div class="logo">
        <div style="float: left">
            <img src="{{ public_path('/img/invoice_logo.png') }}" style="width:100%; max-width:300px;">
        </div>

        <div style="text-align: right; width: 100%">
            {{ $typeName }} #: {{ $document->serie }}-{{ $document->number }}<br>
            Fecha: {{ $document->date }}<br>
            Vencimiento: {{ $document->date }}
        </div>
    </div>
    <div class="info">
        <div style="float: left">
            {{ \Verkoo\Common\Entities\Settings::get('company_name') }}<br>
            {{ \Verkoo\Common\Entities\Settings::get('address') }}, {{ \Verkoo\Common\Entities\Settings::get('cp') }} - {{ \Verkoo\Common\Entities\Settings::get('city') }}<br>
            {{ \Verkoo\Common\Entities\Settings::get('cif') }}<br>
            {{ \Verkoo\Common\Entities\Settings::get('web') }}
        </div>

        <div style="float: right">
            {{ $document->customer->name }}<br>
            {{ $document->customer->full_address }}<br>
            {{ $document->customer->dni }}
        </div>
    </div>
    <div style="clear: both; padding-top: 40px">
        <table cellpadding="0" cellspacing="0" class="lines">
            <tr class="heading">
                <td>Producto</td>
                <td>Cant</td>
                <td>Precio</td>
                <td>Total</td>
            </tr>

            @foreach($lines as $key => $l)
                @if($key)
                    <tr class="item @if($loop->last) last @endif">
                        <td colspan="4"><span class="group"> Albarán {{ $key }}</span></td>
                    </tr>
                @endif
                @foreach($l as $line)
                    <tr class="item @if($loop->last) last @endif">
                        <td>{{ $line->product_name }}</td>
                        <td>{{ $line->quantity}}</td>
                        <td>{{ $line->price}} €</td>
                        <td>{{ $line->total}} €</td>
                    </tr>
                @endforeach
            @endforeach
        </table>

        <div class="footer">
            <table class="total">
                <tr class="heading">
                    <td>Subtotal</td>
                    <td>Descuento</td>
                    <td>Total</td>
                </tr>
                <tr>
                    <td>{{ $document->subtotal }} €</td>
                    <td>{{ $document->discount }} €</td>
                    <td>{{ $document->total }} €</td>
                </tr>
            </table>

            @unless($allergenIcons->isEmpty())
                <div class="icons">
                    <p>Los productos anteriores pueden contener los siguientes alérgenos:</p>
                    @foreach($allergenIcons as $icon)
                        <img src="{{ public_path("/img/alergenos/{$icon}.png") }}">
                    @endforeach
                </div>
            @endunless
        </div>
    </div>
</div>

</body>
</html>