@extends('layout')

@section('content')


    <div class="container row m-auto">
        <div class="col-12 ">
            <h1 class="text-center">Мои заказы</h1>
        </div>

        <div class="container">
            <div class="row">

                <table class="table table-bordered bg-light">
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th scope="col" data-col="id" style="width: 50px;">#</th>--}}
{{--                        <th scope="col" data-col="" style="width: 100px;">Тип</th>--}}
{{--                        <th scope="col" data-col="">Товар</th>--}}
{{--                        <th scope="col" data-col="actions" style="width: 30px;"></th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
                    <tbody>
                    @foreach ($tableData['data'] as $k=>$row)

                        <tr class="" >
                            <td>{{ $k+1 }}</td>
                            <td scope="col" data-col="">
                                {!! ((int)$row['type'] == 1 ? 'Быстрый заказ' : 'Самостоятельный заказ') !!}
                                <br>
                                {!! \Carbon\Carbon::parse($row['created_at'])->format('d.m.Y H:i') !!}
                                <br>
                                {{ number_format($row['sum'],  0, '.', ' ') }} руб.
                            </td>
                            <td>
                                <table class="bg-white" style="width: 100%;margin-bottom: 25px;">
                                    <thead>
                                    <tr>
                                        <th style="width: 120px">артикул</th>
                                        <th>наимено</th>
                                        <th style="width: 50px;">кол</th>
                                        <th style="width: 70px;">цена</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($row['order_products'] as $orderProduct)
                                        <tr>
                                            <td>{{$orderProduct['product']['article']}}</td>
                                            <td>{{$orderProduct['product']['name']}}</td>
                                            <td style="text-align: center;">{{$orderProduct['count']}}</td>
                                            <td>{{$orderProduct['price']}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </td>
                            <td>
                                <a class="btn btn-success" target="_blank" href="/invoice/{{$row['id']}}.pdf">Счет</a>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                {!! $tablePagination !!}

            </div>
        </div>
    </div>

@endsection
