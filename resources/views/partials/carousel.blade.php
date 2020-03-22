<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach($carousels as $k => $carousel)
            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $k }}" class="@if ($k === 0) active @endif"></li>
        @endforeach
    </ol>
    <div class="carousel-inner" >

        @foreach($carousels as $k => $carousel)
            <div class="carousel-item @if ($k === 0) active @endif">
                <div  class="d-block w-100" style="height: 70vh;background-size:cover;background-position: center center;
                background-image: url('{{ $carousel['photo'] }}')">
                </div>

                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $carousel['name'] }}</h5>
                    <p>{{ $carousel['description'] }}</p>
                    <a href="{{ $carousel['link'] }}" class="btn btn-primary">{{ $carousel['button_text'] }}</a>
                </div>
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<style>
</style>


