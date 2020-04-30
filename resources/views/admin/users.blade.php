@extends('admin.layout')

@section('content')


    <h1>Клиенты</h1>

    <div class="row mb-5">
        <div class="col-12">
        </div>
    </div>


    <table id="loadTable" class="table table-bordered bg-light table-hover">
        <thead>
        <tr>
            <th scope="col" data-col="id" style="width: 50px;">id</th>
            <th scope="col" data-col="photo" style="width: 200px;">ФИО</th>
            <th scope="col" data-col="name">email</th>
            <th scope="col" data-col="mini_description">Телефон</th>
            <th scope="col" data-col="actions" style="width: 150px;"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($tableData['data'] as $row)

            <tr id="trItem{{ $row['id'] }}">
                <td>{{ $row['id'] }}</td>
                <td>{{ $row['name'] }}</td>
                <td>{{ $row['email'] }}</td>
                <td>{{ $row['phone'] }}</td>
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
