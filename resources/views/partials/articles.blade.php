
<div style="background-color: #F2EFEC;padding-bottom: 30px;">
    <h1 class="text-center">{{$page3['name']}}</h1>
    <div class="container" >
        {!! $page3['description'] !!}
    </div>

    @foreach($lastArticles as $k => $article)

        <div class="container row m-auto position-relative">
            <div class="article-for-img__circle"></div>
            @if ($k % 2 == 0)
                <div class="col-6 m-0 wrapper-article-mini" >
                    <h2>{{ $article['name'] }}</h2>
                    <p>
                        {!! $article['mini_description'] !!}
                    </p>
                    <a href="/article/{{ $article['id'] }}" class="btn btn-rounded btn-primary">Подробнее</a>
                </div>
                <div class="col-6 m-0 wrapper-article-for-img p-0">
                    <div class="article-for-img"
                         style="background-image: url('{{ $article['photo'] }}')">

                    </div>
                </div>
            @else
                <div class="col-6 m-0 wrapper-article-for-img p-0">
                    <div class="article-for-img"
                         style="background-image: url('{{ $article['photo'] }}')">

                    </div>
                </div>
                <div class="col-6 m-0 wrapper-article-mini" >
                    <h2>{{ $article['name'] }}</h2>
                    <p>
                        {!! $article['mini_description'] !!}
                    </p>
                    <a href="/article/{{ $article['id'] }}" class="btn btn-rounded btn-primary">Подробнее</a>
                </div>
            @endif
        </div>
    @endforeach

</div>

<style>
    .wrapper-article-mini {
        background-color: white;
        height: 400px;
        padding: 50px 60px;
    }
    .wrapper-article-mini p{
        margin: 1em 0;
        line-height: 1.7;
        font-size: 20px;
        max-height: 160px;
        height: 160px;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .article-for-img__circle {
        position: absolute;
        width: 40px;
        height: 40px;
        background:white;
        border-radius: 50%;
        left: calc(50% - 20px);
        top: 50%;
        z-index: 1;
    }
    .wrapper-article-for-img {
        overflow: hidden;
        height: 400px;
    }
    .article-for-img {
        height: 400px;
        position: relative;
        text-align: center;
        cursor: pointer;
        background-position: center;
        background-size: cover;
        overflow: hidden;
        -webkit-transition: all 0.3s ease-in-out;
    }

    .article-for-img:hover {
        -webkit-transform: scale(1.4, 1.4);
        transform: scale(1.4, 1.4);
        -webkit-transition: all 0.3s ease-in-out;
    }
</style>
