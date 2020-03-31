@extends('admin.layout')

@section('content')


    <h1>Варианты поставки продуктов</h1>

    <form method="get" id="searchForm" action="">
        <div class="row mb-5">
            <div class="col-2">
                <div class="form-group">
                    <label for="brand_id_search">Бренд</label>
                    <select onchange="this.form.submit()" class="form-control" name="brand_id_search"
                            id="brand_id_search">
                        <option value="">Все</option>
                        @foreach ($brands as $row)
                            <option
                                @if($brand_id_search==$row['id'])
                                selected="selected"
                                @endif
                                value="{{ $row['id'] }}"
                            >{{ $row['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="product_group_id_search">Продукт</label>
                    <select onchange="this.form.submit()" class="form-control" name="product_group_id_search"
                            id="product_group_id_search">
                        <option value="">Все</option>
                        @foreach ($productGroups as $row)
                            <option
                                @if($product_group_id_search==$row['id'])
                                selected="selected"
                                @endif
                                value="{{ $row['id'] }}"
                            >{{ $row['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="article_search">Артикул</label>
                    <input type="text" class="form-control" name="article_search"  id="article_search" value="{{ $article_search }}"/>
                    <script>
                        $("#article_search").on('keyup', function (e) {
                            if (e.keyCode === 13) {
                                document.getElementById('searchForm').submit();
                            }
                        });
                    </script>
                </div>
            </div>
            <div class="col-4 pt-4">
                <button class="btn btn-success float-right mt-2" type="button" data-toggle="modal" onclick="editItem({})">
                    Добавить
                </button>
            </div>
        </div>
    </form>

    <div class="modal fade itemModal " tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel123"
         aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content  bg-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Вариант поставки</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="itemForm" enctype="multipart/form-data" action="/adm/addOrSaveProduct">
                        <input type="hidden" id="id" name="id" value="0"/>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="photo">изображение записи</label>
                                    <div>
                                        <img id="photo_img" src="/uploads/no-image.png" style="height: 90px;"/>
                                        <input type="file" name="photo" id="photo" placeholder=""/>
                                        <input type="hidden" name="photoHidden" id="photoHidden" value=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="name">Категория</label>
                                    @foreach ($categories as $row)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox"
                                                   class="custom-control-input checkbox-group category_id-cb"
                                                   value="{{ $row['id'] }}"
                                                   name="categories[]"
                                                   id="categories_{{ $row['id'] }}">
                                            <label class="custom-control-label"
                                                   for="categories_{{ $row['id'] }}">{{ $row['name'] }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-9">
                                <div class="form-group">
                                    <label for="name">Наименование</label>
                                    <input type="text" class="form-control" name="name" onkeyup="copyValueTo(this.value, 'meta_title')" style="font-weight: bold;" id="name">
                                </div>
                            </div>
                            <div class="col-3">

                                <div class="form-group">
                                    <label for="article">Артикул</label>
                                    <input type="text" class="form-control" name="article" id="article">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="brand_id">Бренд</label>
                                    <select class="form-control" name="brand_id" id="brand_id"
                                            onchange="showHideProductGroupOptions()">
                                        @foreach ($brands as $row)
                                            <option value="{{ $row['id'] }}">{{ $row['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="form-group">
                                    <label for="product_group_id">Продукт</label>
                                    <select class="form-control"
                                            name="product_group_id"
                                            id="product_group_id">
                                        @foreach ($productGroupsAll as $row)
                                            <option
                                                brand_id="{{ $row['brand_id'] }}"
                                                value="{{ $row['id'] }}"
                                            >{{ $row['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="name">Цена</label>
                                    <input type="text" class="form-control" name="price" id="price">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="name">Старая цена</label>
                                    <input type="text" class="form-control" name="old_price" id="old_price">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="nds">НДС:</label>
                                    <input type="text" class="form-control" data-default-value="Не облагается" name="nds" id="nds"/>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="delivery_type_id">Тип поставки:</label>
                                    <select class="form-control"  name="delivery_type_id" id="delivery_type_id">
                                        @foreach (\App\Models\Product::$deliveryTypes as $type_id => $type_name)
                                            <option value="{{ $type_id }}" >{{ $type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Язык (версия):</label>
                                    @foreach (\App\Models\Product::$languages as $lang_id => $lang_name)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="{{$lang_id}}"
                                                   id="language_id_{{$lang_id}}"
                                                   name="language_id[]"
                                                   class="language_id-cb custom-control-input">
                                            <label class="custom-control-label" for="language_id_{{$lang_id}}">{{$lang_name}}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Платформа:</label>
                                    @foreach (\App\Models\Product::$platforms as $os_id => $os_name)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" value="{{ $os_id }}" id="os_{{ $os_id }}" name="os[]" class="os-cb custom-control-input">
                                            <label class="custom-control-label" for="os_{{ $os_id }}">{{ $os_name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="article">Срок поставки лицензионной программы или ключа активации:</label>
                                    <input type="text" class="form-control" value="3-14 рабочих дней" name="delivery_days" id="delivery_days">
                                </div>
                            </div>

                            <div class="col-6">
                            <div class="form-group">
                                <label for="name">Примечания</label>
                                <textarea class="form-control" name="notes" id="notes"
                                          rows="5"></textarea>
                            </div>
                            </div>

                                <div class="col-6">
                            <div class="form-group">
                                <label for="name">Краткое описание</label>
                                <textarea class="form-control" name="mini_description" id="mini_description"
                                          rows="5"></textarea>
                            </div>
                                </div>
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label for="description">Описание</label>--}}
{{--                            <textarea class="form-control my-wysiwyg" id="description" rows="3"></textarea>--}}
{{--                        </div>--}}
{{--                        <h3>SEO</h3>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="name">META Title</label>--}}
{{--                            <input type="text" class="form-control" name="meta_title" id="meta_title">--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="name">META keywords</label>--}}
{{--                            <textarea class="form-control" name="meta_keywords" id="meta_keywords"--}}
{{--                                      rows="3"></textarea>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="name">META description</label>--}}
{{--                            <textarea class="form-control" name="meta_description" id="meta_description"--}}
{{--                                      rows="3"></textarea>--}}
{{--                        </div>--}}
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

    <pre><? //print_r($tableData); ?></pre>

    <table id="loadTable" class="table table-bordered bg-light table-hover">
        <thead>
        <tr>
            <th scope="col" data-col="id" style="width: 50px;">id</th>
            <th scope="col" data-col="photo">фото</th>
            <th scope="col" data-col="brand_id">Бренд</th>
            <th scope="col" data-col="product_group_id">Продукт</th>
            <th scope="col" data-col="article">Артикул</th>
            <th scope="col" data-col="name">Наименование</th>
            <th scope="col" data-col="mini_description">Краткое описание</th>
            <th scope="col" data-col="price" style="width: 100px;">Цена</th>
            <th scope="col" data-col="order_by" style="width: 50px;">Сорт.</th>
            <th scope="col" data-col="actions" style="width: 130px;"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($tableData['data'] as $row)
            <tr id="trItem{{ $row['id'] }}">
                <td>{{ $row['id'] }}</td>
                <td><img src="{{ $row['photo'] ?: 'no-image.png' }}" style="height: 70px;"/></td>
                <td>{{ $row['brand']['name'] ?? '' }}</td>
                <td>{{ $row['product_group']['name'] ?? '' }}</td>
                <td>{{ $row['article'] }}</td>
                <td>{{ $row['name'] }}</td>
                <td>{{ $row['mini_description'] }}</td>
                <td>
                    <? if (!empty($row) && $row['old_price']) {
                        echo '<div class="old-price">' . $row['old_price'] . '</div>';
                    } ?>
                    {{ ($row['price']?: 0) }}
                </td>
                <td>{{ $row['order_by'] }}</td>
                <td>
                    <button class="btn btn-success btn-grid-action mb-1" onclick="editItem({{json_encode($row)}})"><i class="fas fa-pencil-alt"></i></button>
                    <button class="btn btn-danger btn-grid-action mb-1" onclick="deleteItem('Product', {{ $row['id'] }})"><i class="far fa-trash-alt"></i></button>
                    <button class="btn btn-primary btn-grid-action mb-1" onclick="copyItem({{json_encode($row)}})"><i class="far fa-copy"></i></button>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>
    {!! $tablePagination !!}


    <script>
        $('.itemModal').find('input,textarea').on('keyup', function () {
            $(this).addClass('input-visited');
        })
    </script>
    <style>
        .input-visited {
            box-shadow: 0 0 7px #4caf505c;
            background-color: #f2fff5;
        }
    </style>
@endsection
