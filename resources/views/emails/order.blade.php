<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body style="background-color: rgba(230,230,230,0.36);">

<div style="padding: 20px;background-color: rgba(230,230,230,0.36);">
    <div style="max-width: 650px; margin: 20px auto; padding: 20px;background-color: white; border-radius: 4px;">

        <h4 style="color: rgb(113,113,113); font-size: 16px;">
            Добрый день,
        </h4>

        <h3 style="color: rgb(113,113,113); font-size: 20px;">
            Вы оформили заказ номер #<?php echo $details['order']->id; ?>
            на сайте <?=str_replace(['http://', 'https://', 'www.'], '',  \Illuminate\Support\Facades\Config::get('app.url'))?>
        </h3>

        <table cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td style="padding: 2px 15px;font-size: 15px;color: rgb(113,113,113);  font-weight: bold;border-bottom: 1px solid #d0d0d0;text-align: left;min-width: 500px;">
                    Название товара
                </td>
                <td style="padding: 2px 15px;font-size: 15px;color: rgb(113,113,113);  font-weight: bold;border-bottom: 1px solid #d0d0d0;text-align: right;min-width: 100px;">
                    Цена
                </td>
            </tr>
            <?php
            $total = 0;
            foreach ($details['orderProducts'] as $orderProduct) {
            $total += (float)$orderProduct->count * (float)$orderProduct->price;
            ?>
            <tr>
                <td style="padding: 2px 15px;font-size: 13px;color: rgb(113,113,113);  font-weight: normal;border-bottom: 1px solid #d0d0d0;text-align: left;">
                    <?php echo $orderProduct->product_id; ?>
                </td>
                <td style="padding: 2px 15px;font-size: 13px;color: rgb(113,113,113);  font-weight: normal;border-bottom: 1px solid #d0d0d0;text-align: right;">
                    <?php echo $orderProduct->count . ' x ' . $orderProduct->price; ?> руб.
                </td>
            </tr>
            <?php
            }
            ?>
            <tr>
                <td style="padding: 2px 15px;font-size: 16px;color: rgb(113,113,113);  font-weight: bold;border-bottom: none;text-align: right;">
                    Доставка:
                </td>
                <td style="padding: 2px 15px;font-size: 16px;color: rgb(113,113,113);  font-weight: bold;border-bottom: none;text-align: right;">
                    0 руб.
                </td>
            </tr>
            <tr>
                <td style="padding: 2px 15px;font-size: 16px;color: rgb(113,113,113);  font-weight: bold;border-bottom: none;text-align: right;">
                    Сумма заказа:
                </td>
                <td style="padding: 2px 15px;font-size: 16px;color: rgb(113,113,113);  font-weight: bold;border-bottom: none;text-align: right;">
                    <?=$total?> руб.
                </td>
            </tr>
            <tr>
                <td style="padding: 2px 15px;font-size: 16px;color: rgb(113,113,113);  font-weight: bold;border-bottom: none;text-align: right;">
                    ИТОГО:
                </td>
                <td style="padding: 2px 15px;font-size: 16px;color: rgb(113,113,113);  font-weight: bold;border-bottom: none;text-align: right;">
                    <?=$total?> руб.
                </td>
            </tr>
        </table>

        <br><br>

    </div>
</div>

</body>
</html>
