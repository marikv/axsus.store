<html>
<head>

    <style>
        html, body {
            margin: 0;
        }

        body {
            padding: 32px;
        }
    </style>
</head>
<body>
<?php

/**
 * Возвращает сумму прописью
 * @author runcore
 * @uses morph(...)
 */
function num2str($num)
{
    $nul = 'ноль';
    $ten = array(
        array('', 'один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'),
        array('', 'одна', 'две', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять')
    );
    $a20 = array('десять', 'одиннадцать', 'двенадцать', 'тринадцать', 'четырнадцать', 'пятнадцать', 'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать');
    $tens = array(2 => 'двадцать', 'тридцать', 'сорок', 'пятьдесят', 'шестьдесят', 'семьдесят', 'восемьдесят', 'девяносто');
    $hundred = array('', 'сто', 'двести', 'триста', 'четыреста', 'пятьсот', 'шестьсот', 'семьсот', 'восемьсот', 'девятьсот');
    $unit = array(
        array('копейка', 'копейки', 'копеек', 1),
        array('рубль', 'рубля', 'рублей', 0),
        array('тысяча', 'тысячи', 'тысяч', 1),
        array('миллион', 'миллиона', 'миллионов', 0),
        array('миллиард', 'миллиарда', 'миллиардов', 0),
    );

    list($rub, $kop) = explode('.', sprintf("%015.2f", floatval($num)));
    $out = array();
    if ((int)($rub) > 0) {
        foreach (str_split($rub, 3) as $uk => $v) {
            if (!(int)($v)) continue;
            $uk = count($unit) - $uk - 1;
            $gender = $unit[$uk][3];
            list($i1, $i2, $i3) = array_map('intval', str_split($v, 1));
            // mega-logic
            $out[] = $hundred[$i1]; // 1xx-9xx
            if ($i2 > 1) $out[] = $tens[$i2] . ' ' . $ten[$gender][$i3]; // 20-99
            else $out[] = $i2 > 0 ? $a20[$i3] : $ten[$gender][$i3]; // 10-19 | 1-9
            // units without rub & kop
            if ($uk > 1) $out[] = morph($v, $unit[$uk][0], $unit[$uk][1], $unit[$uk][2]);
        }
    } else {
        $out[] = $nul;
    }
    $out[] = morph((int)($rub), $unit[1][0], $unit[1][1], $unit[1][2]); // rub
    $out[] = $kop . ' ' . morph($kop, $unit[0][0], $unit[0][1], $unit[0][2]); // kop
    return trim(preg_replace('/ {2,}/', ' ', implode(' ', $out)));
}

/**
 * Склоняем словоформу
 * @author runcore
 */
function morph($n, $f1, $f2, $f5)
{
    $n = abs((int)($n)) % 100;
    if ($n > 10 && $n < 20) return $f5;
    $n %= 10;
    if ($n > 1 && $n < 5) return $f2;
    if ($n === 1) return $f1;
    return $f5;
}
function mb_ucfirst($string, $encoding)
{
    $strlen = mb_strlen($string, $encoding);
    $firstChar = mb_substr($string, 0, 1, $encoding);
    $then = mb_substr($string, 1, $strlen - 1, $encoding);
    return mb_strtoupper($firstChar, $encoding) . $then;
}

?>

<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
    <tr>
        <td style="border-bottom: 1px solid #000000;padding-bottom: 6px;">
            <img src="<?php echo public_path('img/logo-2.png');?>" style="height: 68px;">
        </td>
        <td style="text-align: right;font-size: 8px;font-weight: bold;line-height: 8px;border-bottom: 1px solid #000000;padding-bottom: 6px;">
            <?=$jur_name ?? ''?><br>
            <?=$jur_address_mini ?? ''?>,<br>
            Tel: <?=$phone1 ?? ''?>,<br>
            e-mail: <?=$email1 ?? ''?>,<br>
            web: www.axsus.ru
        </td>
    </tr>
    <tr>
        <td colspan="2" style="font-size: 6px;text-align: center;padding-top: 6px;">
            Счет действителен до <?=$orderDate ?? ''?>.<br><br>
            Оплата данного счета означает согласие с условиями поставки товара.<br>
            Уведомление об оплате обязательно, в противном случае<br>
            не гарантируется наличие товара на складе.<br>
            Товар отпускается по факту прихода денег на р/с Поставщика, самовывозом,<br>
            при наличии доверенности на получение товара и паспорта получателя.<br><br>
            <strong style="font-size: 8px;">Образец заполнения платежного поручения</strong>
        </td>
    </tr>
</table>


<table style="border-collapse: collapse; width: 100%; font-size: 11px;margin-top: 8px;" border="1" cellspacing="0"
       cellpadding="2">
    <tbody>
    <tr>
        <td style="width: 42.7627%; border-bottom: none; padding: 0px 2px;" colspan="4"><?=$bank ?? ''?></td>
        <td style="width: 7.41244%; padding: 0px 2px;">БИК</td>
        <td style="width: 49.8249%; border-bottom: none; padding: 0px 2px;"><?=$bik ?? ''?></td>
    </tr>
    <tr>
        <td style="width: 42.7627%; border-top: none; font-size: 7px; vertical-align: bottom; padding: 0px 2px;"
            colspan="4">Банк получателя
        </td>
        <td style="width: 7.41244%; padding: 0px 2px;">Сч. №</td>
        <td style="width: 49.8249%; border-top: none; padding: 0px 2px;"><?=$schet_banka ?? ''?></td>
    </tr>
    <tr>
        <td style="width: 4.30509%; padding: 0px 2px;">ИНН</td>
        <td style="width: 19.1949%; padding: 0px 2px;"><?=$inn ?? ''?></td>
        <td style="width: 3.59887%; padding: 0px 2px;">КПП</td>
        <td style="width: 15.6638%; padding: 0px 2px;"><?=$kpp ?? ''?></td>
        <td style="width: 7.41244%; vertical-align: top; padding: 0px 2px;" rowspan="3">Сч. №</td>
        <td style="width: 49.8249%; vertical-align: top; padding: 0px 2px;" rowspan="3"><?=$schet_our ?? ''?></td>
    </tr>
    <tr>
        <td style="width: 42.7627%; border-bottom: none; padding: 0px 2px;" colspan="4"><?=$jur_name ?? ''?></td>
    </tr>
    <tr>
        <td style="width: 42.7627%; border-top: none; font-size: 7px; vertical-align: bottom; padding: 6px 2px 0 2px;"
            colspan="4">Получатель
        </td>
    </tr>
    </tbody>
</table>


<h1 style="font-size: 15px;padding: 9px 0 3px 0;margin: 0;border-bottom: 2px solid #000000">
    Счет № <?=$order_id ?? '';?> от <?=$orderDateRus ?? '';?> г.
</h1>

<table style="width: 100%;font-size: 10px; margin-top: 5px;" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td style="width: 90px; vertical-align: top; padding: 5px 0 8px 0;">Поставщик:</td>
        <td style="font-weight: bold; padding: 5px 0 8px 0;">
            <?=$jur_name ?? ''?>, ИНН <?=$inn?>, КПП <?=$kpp ?? ''?>, <?=$jur_address ?? ''?>, тел.: <?=$phone1 ?? ''?>
        </td>
    </tr>
    <tr>
        <td style="vertical-align: top; padding: 5px 0 8px 0;">Покупатель:</td>
        <td style="font-weight: bold; padding: 5px 0 8px 0;">
            {{$orderModel->name ?? '-'}}, ИНН {{$orderModel->inn ?? '-'}}, КПП {{$orderModel->kpp ?? '-'}}, {{$orderModel->city ?? '-'}} {{$orderModel->address ?? '-'}}
        </td>
    </tr>
</table>


<table style="width: 100%;font-size: 10px; margin-top: 7px;" border="1" cellspacing="0" cellpadding="2">
    <tr>
        <td style="font-weight: bold; text-align: center;width: 15px;">№</td>
        <td style="font-weight: bold; text-align: center;width: 90px;">Артикул</td>
        <td style="font-weight: bold; text-align: center;">Товары</td>
        <td style="font-weight: bold; text-align: center;width: 30px;">Кол-во</td>
        <td style="font-weight: bold; text-align: center;width: 60px;">Цена</td>
        <td style="font-weight: bold; text-align: center;width: 50px;">Ставка НДС</td>
        <td style="font-weight: bold; text-align: center;width: 50px;">Сумма НДС</td>
        <td style="font-weight: bold; text-align: center;width: 60px;">Сумма</td>
    </tr>
    <?php
    $sum_itogo = 0;
    $nds_sum_itogo = 0;
    $count_itogo = 0;
    ?>
    @foreach($orderProductModels as $k => $orderProduct)
        <?php
        $count_itogo += $orderProduct->count;
        $sum = $orderProduct->price * $orderProduct->count;
        $sum_itogo += $sum;
        $nds = 0;
        $nds_sum = 0;
        $nds_sum_text = 0;
        if ($orderProduct->product->nds == '20 % (включен в стоимость') {
            $nds = 20;
        } else if ($orderProduct->product->nds) {
            $nds = (float)filter_var($orderProduct->product->nds, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        }

        if ($nds) {
            $nds_sum = $sum * $nds / (100 + $nds);
            $nds_sum_text = number_format($nds_sum, 2, ',', ' ');
            $nds_sum_itogo += $nds_sum;
        }
        ?>
        <tr>
            <td style="text-align: center;font-size: 9px;">{{$k + 1}}</td>
            <td style="font-size: 9px;">{{$orderProduct->product->article}}</td>
            <td style="font-size: 9px;">{{$orderProduct->product->name}}</td>
            <td style="text-align: center;font-size: 9px;">{{$orderProduct->count}} шт.</td>
            <td style="text-align: right;font-size: 9px;">{{number_format($orderProduct->price, 2,',',' ')}}</td>
            <td style="text-align: right;font-size: 9px;">{{$nds}}%</td>
            <td style="text-align: right;font-size: 9px;">{{$nds_sum_text}}</td>
            <td style="text-align: right;font-size: 9px;">{{number_format($sum, 2,',',' ')}}</td>
        </tr>
    @endforeach
</table>


<table style="width: 100%;font-size: 11px;font-weight: bold; margin-top: 7px;" border="0" cellspacing="0"
       cellpadding="0">
    <tr>
        <td style="text-align: right;">Итого:</td>
        <td width="100" style="text-align: right;width: 100px;">{{number_format($sum_itogo, 2,',',' ')}}</td>
    </tr>
    @if($nds > 0)
        <tr>
            <td style="text-align: right;">В т.ч. НДС ({{$nds}}%):</td>
            <td style="text-align: right;">{{number_format($nds_sum_itogo, 2,',',' ')}}</td>
        </tr>
    @else
        <tr>
            <td colspan="2" style="text-align: right;">Без налога (НДС)</td>
        </tr>
    @endif
</table>

<div style="font-size: 10px; padding: 10px 0 6px 0; border-bottom: 2px solid #000000;margin-bottom: 5px;">
    <div>Всего наименований {{$count_itogo}}, на сумму {{number_format($sum_itogo, 2,',',' ')}} RUB</div>
    <strong><?php

        //echo num2str(25.41);   // Две тысячи пятьсот сорок один рубль 00 копеек.
        echo mb_ucfirst(num2str($sum_itogo), "utf8");
        ?></strong>
</div>

<img src="<?php echo public_path('img/invoice-footer.png');?>" style="width: 100%;">

</body>
</html>
