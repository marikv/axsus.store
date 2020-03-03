<div class="form-group form-search flex-center justify-content-center">
    <meta itemprop="target" content="/search?q={q}">
    <input name="q" id="q" value="" class="form-control form-control-search" placeholder="Поиск"
           itemprop="query-input">
    <button type="submit" name="button" class="btn btn-white btn-round btn-submit">
        <img src="{{asset('img/icons/search-2.svg')}}" style="height: 18px">
    </button>
</div>

<style>
    .form-search {
        padding: 0 15px;
        margin:  auto 0;
        position: relative;
    }
    .form-search .form-control-search {
        background-color: rgb(248, 247, 253);
        box-shadow: none;
        border: 1px solid #cccccc;
        border-radius: 30px;
        box-shadow: 0 0 0;
        display: block;
        font-weight: 300;
        /* height: 40px; */
        /* line-height: 1.42857; */
        padding: 6px 20px;
        vertical-align: middle;
        transition: background-color .2s;
    }
    .form-search .btn-submit {
        position: absolute;
        right: 18px;
        border: none;
        height: 44px;
        line-height: 30px;
        width: 44px;
        display: block;
        top: 3px;
        opacity: .85;
        color: #666666;
        transition: all .2s;
        padding: 0;
        margin: -5px 0 0 0;
    }
    .form-search .btn-submit:active,
    .form-search .btn-submit:focus {
        outline: none;
        box-shadow: none;
    }
</style>
