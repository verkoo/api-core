<html>
<style>
    body {
        font-family: "Helvetica Neue", Helvetica, Arial;
        font-size: 14px;
        line-height: 20px;
        font-weight: 400;
        color: #3b3b3b;
        -webkit-font-smoothing: antialiased;
        font-smoothing: antialiased;
    }

    .wrapper {
        margin: 0 auto;
        padding: 40px;
        max-width: 800px;
    }

    .table {
        margin: 0 0 40px 0;
        width: 100%;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        display: table;
    }

    .row {
        display: table-row;
        background: #f6f6f6;
    }
    .row:nth-of-type(odd) {
        background: #e9e9e9;
    }
    .row.header {
        font-weight: 900;
        color: #ffffff;
        background: #ea6153;
    }
    .row.green {
        background: #27ae60;
    }
    .row.blue {
        background: #2980b9;
    }
    .cell {
        padding: 6px 12px;
        display: table-cell;
    }

    .customer {
        width: 300px;
    }
    .title {
        padding: 20px;
        /*background: #27ae60;*/
        color: black;
        margin-bottom: 2em;
    }
    .total {
        float: right;
        font-weight: bold;
    }
</style>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

<div class="wrapper">
    <div class="title">
        <p>{{ \Verkoo\Common\Entities\Settings::get('company_name') }}</p>
        <p>{{ \Verkoo\Common\Entities\Settings::get('address') }}</p>
        <p>{{ \Verkoo\Common\Entities\Settings::get('cp') }} - {{ \Verkoo\Common\Entities\Settings::get('city') }}</p>
        <p>{{ \Verkoo\Common\Entities\Settings::get('cif') }}</p>
    </div>
    <div class="table">
        <div class="row header green" >
            <div class="cell">
                Fecha: {{ date('d/m/Y') }}
            </div><div class="cell">
                Cliente: {{ $customer->name }}
            </div>
            <div class="cell">
                Entrega: {{ $data['amount'] }}
            </div>
        </div>
    </div>

    <div class="table">
        <div class="row header blue">
            <div class="cell">
                Fecha
            </div><div class="cell">
                Número
            </div>
            <div class="cell">
                Cobrado
            </div>
        </div>

        @foreach($data['items']['full'] as $line)
            <div class="row">
                <div class="cell">
                    {{ $line['date'] }}
                </div>
                <div class="cell customer">
                    {{ $line['number'] }}
                </div>
                <div class="cell">
                    TOTAL
                </div>
            </div>
        @endforeach
        @foreach($data['items']['partial'] as $line)
            <div class="row">
                <div class="cell">
                    {{ $line['date'] }}
                </div>
                <div class="cell customer">
                    {{ $line['number'] }}
                </div>
                <div class="cell">
                    PARCIAL
                </div>
            </div>
        @endforeach
    </div>
    <div class="total">Total Pendiente: {{ $data['pending'] }} €.</div>
</div>
</html>


