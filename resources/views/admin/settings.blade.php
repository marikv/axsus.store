@extends('admin.layout')

@section('content')


    <h1>Настройки</h1>

    <table id="loadTable" class="table table-bordered bg-light table-hover">
        <thead>
        <tr>
            <th scope="col" data-col="id" style="width: 50px;">id</th>
            <th scope="col" data-col="name">Наименованеи</th>
            <th scope="col" data-col="description">Значение</th>
            <th scope="col" data-col="actions" style="width: 150px;"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($tableData['data'] as $row)

            <tr id="trItem{{ $row['id'] }}">
                <td>{{ $row['id'] }}</td>
                <td>{{ $row['description'] }}</td>
                <td>
                    <input type="text" style="min-width: 500px;" id="settings_value_{{$row['id']}}" value="{{ $row['value'] }}">
                </td>
                <td>
                    <button class="btn btn-success" onclick="saveSetting({{$row['id']}}, '{{ $row['type'] }}')">
                        <i class="fas fa-save"></i> Сохранить
                    </button>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>
    {!! $tablePagination !!}

    <script>
        var saveSetting = function (id, type) {
            if (!type || type === 'text') {

            }
            var value = document.getElementById('settings_value_' + id).value;

            $.ajax({
                type: 'POST',
                url: '/adm/addOrSaveSetting',
                data: { id: id, value: value },
                success: function (data) {
                    alert('Настройки были успешно сохранены!');
                },
                error: function (e) {
                    alert('ОШИБКА сохранения!');
                }
            });
        }
    </script>
@endsection
