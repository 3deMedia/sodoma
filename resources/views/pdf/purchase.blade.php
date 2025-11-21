<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra Coins</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <style>
        @font-face {
            font-family: Texturina;
            font-weight: normal;
            font-style: normal;
            src: "{{asset('fonts/Texturina.ttf')}}";
        }
        html {
            margin: 0;
            padding: 30px;
        }
        .header {
            padding: 10px 20px;
            width: 100%;
        }
        .brand-logo {
            margin: 20px 10px 10px 40px;
            height: 50px;
        }
        .brand-info {
            bpurchase-bottom: 2px solid #91C6DD;
            width: 50%;
            position: absolute;
            padding-right: 10px;
            top: 40px;
            right: 0;
        }
        .header-icon {
            height: 14px;
        }
        .body {
            margin-top: 0;
        }
        .intro {
            background-color: #ffffff;
            padding: .5rem 2rem;
            bpurchase-radius: 10px 10px 0 0;
            bpurchase: 1px solid;
        }
        .customer-info {
            margin: 16px 10px;
            padding: 10px;
        }
        .customer-info h3 {
            margin: 0px 0px 4px;
        }
        .customer-info p {
            margin: 2px 0;
            font-size: 14px;
        }
        table {
            width: 100%;
        }
        .table1 {
            padding-bottom: 6px;
        }
        .table1 tbody tr td {
            font-size: 12px;
            margin: 1px 0;
        }
        thead {
            font-size: 16px;
        }
        .for-title {
            color: #2b6077;
            padding: 0 20px;
        }
        .budget-data {
            position: absolute;
            top: 200px;
            right: 40px;
        }
        .budget-data p {
            font-size: 12px;
            text-align: right;
            margin: 2px 0;
        }
        .budget-data h3 {
            font-size: 18px;
            text-align: right;
            margin: 4px 0;
            color: #2b6077;
        }
        .table tbody tr td {
            height: 33px;
            font-size: 14px;
        }
        .table tbody tr:nth-child(even) {
            background-color: #e2eef3;
        }
        .terms {
            padding: 20px;
            width: 480px;
        }
        .terms p {
            margin: 8px 0;
        }
        .personal-info {
            text-align: center;
            position: absolute;
            bottom: 0;
            width: 100%;
            background-color: #131f3c;
            color: #39ff84;
            float: right;
        }
        .personal-info p {
            margin: 3px 0;
            padding: 2px 20px;
        }
        .text-sm {
            font-size: 10px
        }
        footer {
            position: absolute;
            bottom: 0;
            text-align: 'center'
        }
        footer p {
            text-align: 'center';
            width: 100%;
        }
        .conditions {}
        .conditions h3, .observations h3 {
            font-weight: bold;
            color: #2b6077;
            margin: 4px 0;
        }
        .conditions p, .observations ul li {
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="header">
        <img class="brand-logo" src="{{asset('images')}}/escortssecrets-logoblack.png">
        <div class="brand-info">Secrets Publicidad . Vía augusta 13. Barcelona 08006 Spain
        </div>


    </div>
    <br><br>

    <div class="body">

        <div style="padding:0 20px;">

            <p class="for-title"><b>Cliente:</b> {{ $profile->name }}</p>
            <div class="customer-info"> Tel: {{ $profile->phone }}<br />
                {{ $profile->Address->City->name }},  {{ $profile->Address->Region->name }}


            </div>

        </div>
        <br>
        <div class="budget-data">
            <h3>Factura</h3>
            <p> <b>FECHA : </b> {{\Carbon\Carbon::parse($purchase->created_at)->format('d / m / Y')}}</p>

            <p> <b>Nº: </b> {{ \Carbon\Carbon::parse($purchase->created_at)->format('Y')."$purchase->id"}}</p>
        </div>

        <div style="padding:0 40px;">
            <table class="table">
                <thead>
                    <tr style="background-color: #efe9e9;">
                        <th style="padding:10px 0;">Método de Pago</th>
                        <th>Concepto</th>
                        <th>Precio</th>

                    </tr>
                </thead>
                <tbody>


                        <tr>
                            <td scope="row" style="text-align:center"><b>{{ $purchase->payment_method}}</b></td>
                            @php
                                $coins= DB::table('payment_amounts')->where('euros',$purchase->amount)->first()->coins;
                            @endphp

                            <td style="text-align:center">
                                {{ $coins }} SecretCoins
                            </td>
                            <td scope="row" style="text-align:center">{{ $purchase->amount}} €</td>

                        </tr>

                </tbody>
            </table>
            <br><br>
            <div class="observations">
        </div>
    </div>
</body>
</html>
