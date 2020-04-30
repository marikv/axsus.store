@extends('admin.layout')

@section('content')


    <h1>FAQ</h1>

    <div class="row mb-5">
        <div class="col-12">
            <button class="btn btn-success float-right" data-toggle="modal" data-target=".itemModal">Добавить</button>
        </div>
    </div>

    <div class="modal fade itemModal " tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel123"
         aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content  bg-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="itemForm" enctype="multipart/form-data" action="/adm/addOrSaveFaq">
                        <input type="hidden" id="id" name="id" value="0"/>
                        <div class="form-group">
                            <label for="name">Вопрос</label>
                            <textarea class="form-control" name="description" id="description"
                                      rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="name">Ответ</label>
                            <textarea class="form-control" name="answer" id="answer"
                                      rows="2"></textarea>
                        </div>
                        <h3>Settings</h3>
                        <div class="form-group">
                            <label for="name">Сортировка (sort_by)</label>
                            <input type="text" class="form-control" name="order_by" id="order_by">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <span id="result"></span>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    <button type="button" data-dismiss="modal" id="btnSubmit" class="btn btn-primary"
                            onclick="ajaxSubmitForm('itemForm')">Сохранить
                    </button>
                </div>
            </div>
        </div>
    </div>


    <table id="loadTable" class="table table-bordered bg-light table-hover">
        <thead>
        <tr>
            <th scope="col" data-col="id" style="width: 50px;">id</th>
            <th scope="col" data-col="description">Вопрос</th>
            <th scope="col" data-col="answer">Ответ</th>
            <th scope="col" data-col="order_by" style="width: 50px;">Сорт.</th>
            <th scope="col" data-col="actions" style="width: 150px;"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($tableData['data'] as $row)

            <tr id="trItem{{ $row['id'] }}">
                <td>{{ $row['id'] }}</td>
                <td>{{ $row['description'] }}</td>
                <td>{{ $row['answer'] }}</td>
                <td>{{ $row['order_by'] }}</td>
                <td>
                    <button class="btn btn-success" onclick="editItem({{json_encode($row)}})">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button class="btn btn-danger" onclick="deleteItem('Faq', {{ $row['id'] }})"><i
                            class="far fa-trash-alt"></i></button>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>
    {!! $tablePagination !!}
@endsection
