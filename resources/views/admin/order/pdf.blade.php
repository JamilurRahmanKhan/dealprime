<!DOCTYPE html>
<html>
<head>
    <style>
        /* Include your inline styles here */
    </style>
</head>
<body>
    <div class="invoice-box">
        <table>
            <!-- Your invoice HTML structure here, with Blade syntax -->
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{ asset('website/assets/images/logo/deal.jpg') }}" style="height: 70px; width:200px" alt="Logo">
                            </td>
                            <td>
                                Invoice #: {{ $order->order_number }}<br>
                                Created: {{ date('F j, Y') }}<br>
                                Order Date: {{ date('ymj', strtotime($order->order_date)) }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <!-- Repeat other parts of the HTML, using Blade syntax -->
        </table>
    </div>
</body>
</html>
