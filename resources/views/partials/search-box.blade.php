<? $rand = rand(0, 9999); ?>
<div class="form-group form-search flex-center justify-content-center">
    <form action="/search">
        <meta itemprop="target" content="/search?q={q}">
        <input name="q"
               id="q<?=$rand?>"
               class="form-control form-control-search"
               placeholder="Поиск"
               value="<?=$_GET['q']?>"
               itemprop="query-input">
        <button type="submit"
                id="searchSubmit<?=$rand?>"
                class="btn btn-white btn-round btn-submit">
            <img src="{{asset('img/icons/search-2.svg')}}" style="height: 18px">
        </button>
    </form>
</div>
<script>
    var input = document.getElementById("q<?=$rand?>");

    input.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("searchSubmit<?=$rand?>").click();
        }
    });
</script>

<style>
    .form-search {
        padding: 0 15px;
        margin:  auto 0;
        position: relative;
    }
    .form-search .form-control-search {
        /*background-color: rgb(248, 247, 253);*/
        box-shadow: none;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 30px;
        box-shadow: 0 0 0;
        display: block;
        font-weight: 300;
        height: 33px;
        /* line-height: 1.42857; */
        padding: 6px 20px;
        vertical-align: middle;
        transition: background-color .2s;
    }
    .form-search .btn-submit {
        position: absolute;
        right: 18px;
        border: none;
        height: 36px;
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
