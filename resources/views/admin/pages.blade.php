@extends('admin.layout')

@section('content')


    <h1>Страницы</h1>

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
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Страница</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="itemForm" enctype="multipart/form-data" action="/adm/addOrSavePage">
                        <input type="hidden" id="id" name="id" value="0"/>
{{--                        <div class="form-group">--}}
{{--                            <label for="photo">изображение записи</label>--}}
{{--                            <div>--}}
{{--                                <img id="photo_img" src="/uploads/no-image.png" style="height: 90px;"/>--}}
{{--                                <input type="file" name="photo" id="photo" placeholder=""/>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="form-group">
                            <label for="name">Тема</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="name">Краткое описание</label>
                            <textarea class="form-control" name="mini_description" id="mini_description"
                                      rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <textarea class="form-control my-wysiwyg" id="description" rows="3"></textarea>
                        </div>
                        <h3>SEO</h3>
                        <div class="form-group">
                            <label for="name">META Title</label>
                            <input type="text" class="form-control" name="meta_title" id="meta_title">
                        </div>
                        <div class="form-group">
                            <label for="name">META keywords</label>
                            <textarea class="form-control" name="meta_keywords" id="meta_keywords" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="name">META description</label>
                            <textarea class="form-control" name="meta_description" id="meta_description"
                                      rows="3"></textarea>
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
{{--            <th scope="col" data-col="photo" style="width: 200px;">фото</th>--}}
            <th scope="col" data-col="name">Тема</th>
            <th scope="col" data-col="mini_description">Краткое описание</th>
            <th scope="col" data-col="actions" style="width: 150px;"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($tableData['data'] as $row)

            <tr id="trItem{{ $row['id'] }}">
                <td>{{ $row['id'] }}</td>
{{--                <td><img src="/uploads/{{ $row['photo'] ?: 'no-image.png' }}" style="height: 70px;"/></td>--}}
                <td>{{ $row['name'] }}</td>
                <td>{{ $row['mini_description'] }}</td>
                <td>
                    <button class="btn btn-success" onclick="editItem({{json_encode($row)}})">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button class="btn btn-danger" onclick="deleteItem('Page', {{ $row['id'] }})"><i
                            class="far fa-trash-alt"></i></button>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>
    {!! $tablePagination !!}
@endsection
