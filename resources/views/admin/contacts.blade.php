@extends('admin.layout')

@section('content')


    <h1>Список сообщений отправленных через контактную форму</h1>

    <div class="row mb-5">
        <div class="col-12">

        </div>
    </div>

    <table id="loadTable" class="table table-bordered bg-light table-hover">
        <thead>
        <tr>
            <th scope="col" data-col="id" style="width: 50px;">id</th>
            <th scope="col" data-col="description">ФИО</th>
            <th scope="col" data-col="answer">Email/Телефон</th>
            <th scope="col" data-col="answer">Текст</th>
            <th scope="col" data-col="answer">ip</th>
            <th scope="col" data-col="answer">Дата/Время</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($tableData['data'] as $row)

            <tr class="@if (!$row['read']) text-success text-bold @else text-gray @endif" id="trContact{{ $row['id'] }}">
                <td>{{ $row['id'] }}</td>
                <td>{{ $row['fio'] }}</td>
                <td>{{ $row['email'] }}</td>
                <td>{{ $row['message'] }}</td>
                <td>{{ $row['ip'] }}</td>
                <td>{{ $row['created_at'] }}</td>
            </tr>

        @endforeach
        </tbody>
    </table>
@endsection
