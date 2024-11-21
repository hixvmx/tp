<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="style.css" media="all" />
    <style>
        * {}

        body {
            font-family: calibri;
            color: #001028;
            background: #FFFFFF;
            font-size: 12px;
        }

        main {
            width: 100%;
            max-width: 900px;
            padding: 2rem 0;
            margin: 0 auto;
        }

        .footer {
            padding: 10px 0;
            margin-bottom: 30px;
        }

        .dirLeft {
            text-align: left;
        }

        .dirRight {
            text-align: right;
        }

        .dirCenter {
            text-align: center;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        /* .table tr:nth-child(2n-1) td {
            background: #f4f6fd;
        } */

        .table th,
        .table td {
            padding: 0.5rem;
        }

        .table th {
            border-bottom: 1px solid #d5d7da;
            white-space: nowrap;
            font-weight: normal;
        }

        .table td {
            color: #5D6975;
        }

        .pagination_numbers {
            padding: 1rem 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <main>
        <table
            style="width: 100%;border-collapse: collapse;border-spacing: 0;margin-bottom: 30px;margin-bottom: 10px;border-bottom: 1px solid #2d54de0f;">
            <tbody>
                <tr>
                    <td class="dirLeft" style="padding:0.5rem;">hixvm.com</td>
                    <td class="dirRight" style="padding:0.5rem;">{{ $date }}</td>
                </tr>
            </tbody>
        </table>

        <table style="width: 100%;border-collapse: collapse;border-spacing: 0;">
            <tbody>
                <tr>
                    <td class="dirLeft" style="padding-top:2rem;padding-bottom:1rem;">
                        <b style="font-size: 35px;font-weight: bold;color: #000000;">{{ $title }}</b>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table">
            <thead>
                <tr>
                    <th class="dirLeft">ID</th>
                    <th class="dirLeft">
                        Product name
                    </th>
                    <th class="dirLeft">
                        Price
                    </th>
                    <th class="dirLeft">
                        Total Quantity
                    </th>
                    <th class="dirLeft">
                        Sold Quantity
                    </th>
                    <th class="dirLeft">
                        Available Quantity
                    </th>
                    <th class="dirRight">Created_at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="bg-white border-b">
                        <td class="dirLeft">#{{ $product->id }}</td>
                        <th class="dirLeft">
                            {{ $product->name }}
                        </th>
                        <td class="dirLeft">
                            {{ $product->price }}
                        </td>
                        <td class="dirLeft">
                            {{ $product->total_quantity }}
                        </td>
                        <td class="dirLeft">
                            {{ $product->sold_quantity }}
                        </td>
                        <td class="dirLeft">
                            {{ $product->available_quantity }}
                        </td>
                        <td class="dirRight">{{ $product->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>
</html>
