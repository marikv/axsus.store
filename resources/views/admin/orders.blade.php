@extends('admin.layout')

@section('content')

    <style>
        .lbl {
            font-size: 13px;
            color: rgb(170, 170, 170);
        }
        </style>

    <h1>Заказы</h1>

    <div class="row mb-5">
        <div class="col-12">
        </div>
    </div>

{{--    {{ dd($tableData) }}--}}

    <table id="loadTable" class="table table-bordered bg-light table-hover">
        <thead>
        <tr>
            <th scope="col" data-col="id" style="width: 50px;">id</th>
            <th scope="col" data-col="" style="width: 100px;">Тип</th>
            <th scope="col" data-col=""></th>
            <th scope="col" data-col="">Товар</th>
            <th scope="col" data-col="" style="width: 50px;">Сумма</th>
            <th scope="col" data-col="actions" style="width: 30px;"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($tableData['data'] as $row)

            <tr class="@if ($row['is_new'] == 1) text-success text-bold @endif"  id="trItem{{ $row['id'] }}">
                <td>{{ $row['id'] }}</td>
                <td scope="col" data-col="">
                    {!! ((int)$row['type'] == 1 ? 'Быстрый заказ' : 'Самостоятельный заказ') !!}
                </td>
                <td>{!! ($row['name'] ? $row['name'] .'<br>' : '') !!}
                    {!! ($row['email'] ? '<span class="lbl">email:</span> ' . $row['email'] .'<br>' : '') !!}
                    {!! ($row['phone'] ? '<span class="lbl">тел:</span> ' . $row['phone'] .'<br>' : '' ) !!}
                    {!! ($row['inn'] ? '<span class="lbl">инн:</span> ' . $row['inn'] .'<br>' : '') !!}
                    {!! ($row['kpp'] ? '<span class="lbl">кпп:</span> ' . $row['kpp'] .'<br>' : '') !!}
                    {!! ($row['contactnoe_lico'] ? '<span class="lbl">Конт.лиц.:</span> ' . $row['contactnoe_lico'] .'<br>' : '') !!}
                    {!! ($row['raschetnyi_schet'] ? '<span class="lbl">Рас.счет.:</span> ' . $row['raschetnyi_schet'] .'<br>' : '') !!}
                    {!! ($row['city'] ? '<span class="lbl">г.</span> ' . $row['city'] .'<br>' : '') !!}
                    {!! ($row['address'] ? '<span class="lbl">адрес:</span> ' . $row['address'] .'<br>' : '') !!}
                    {!! ($row['comment'] ? '<span class="lbl">Комментарий:</span> ' . $row['comment'] .'<br>' : '') !!}
                </td>
                <td>
                    <table style="width: 100%">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>артикул</th>
                            <th>наимено</th>
                            <th>кол-во</th>
                            <th>цена</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($row['order_products'] as $orderProduct)
                            <tr>
                                <td>{{$orderProduct['product_id']}}</td>
                                <td>{{$orderProduct['product']['article']}}</td>
                                <td>{{$orderProduct['product']['name']}}</td>
                                <td>{{$orderProduct['count']}}</td>
                                <td>{{$orderProduct['price']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </td>
                <td>{{ (float)$row['sum'] }} руб.</td>
                <td>
{{--                    <button class="btn btn-success" onclick="editItem({{json_encode($row)}})">--}}
{{--                        <i class="fas fa-pencil-alt"></i>--}}
{{--                    </button>--}}
                    <button class="btn btn-danger" onclick="deleteItem('User', {{ $row['id'] }})"><i
                            class="far fa-trash-alt"></i></button>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>
    {!! $tablePagination !!}
@endsection
