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
        margin: auto;
        padding: 40px;
        width: 100%;
        display: table;
    }

    .row {
        padding: 8px 0;
        font-size: 18px;
        background: #f6f6f6;
    }
    .row:nth-of-type(odd) {
        background: #ffffff;
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

    .price {
        width: 100px;
    }
    .product {
        width: 500px;
    }
    .title {
        font-family: "Bookman Old Style", Helvetica, Arial;

        font-size: 30px;
        font-weight: bold;
        padding: 20px;
    }
    .total {
        float: right;
        font-weight: bold;
    }
</style>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

    <div class="title" style="text-align: center;">
        - {{ \Verkoo\Common\Entities\Settings::get('company_name') }} -
    </div>

    <div style="text-align: center; padding-bottom: 10px; font-size: 20px">
        <b>{{ date('d-m-Y') }}</b>
    </div>

    <div class="table">
        @foreach($products as $product)
            <div class="row">
                <div class="cell product">
                    {{ $product->name }}
                </div>
                <div class="cell price">
                    {{ $product->price }} €
                </div>
            </div>
        @endforeach
    </div>

    <div class="title" style="text-align: center">
        {{ \Verkoo\Common\Entities\Settings::get('web') }} - {{ \Verkoo\Common\Entities\Settings::get('phone') }}
    </div>

</html>


