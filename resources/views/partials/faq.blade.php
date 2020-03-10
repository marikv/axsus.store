<div style="padding-bottom: 40px">

    <div >
        <div class="container" >
            <h1 class=" text-center">{{$page5['name']}}</h1>
            {!! $page5['description'] !!}
        </div>
    </div>

    <div class="container">
        <div class="accordion" id="accordionFaq">

            @foreach($faqs as $k => $faq)
                <div class="card">
                    <div class="card-header" id="heading{{ $k }}">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left"
                                    style="font-size: 20px;font-weight: bold;"
                                    type="button"
                                    data-toggle="collapse"
                                    data-target="#collapse{{ $k }}"
                                    aria-expanded="true"
                                    aria-controls="collapse{{ $k }}">
                                {{$faq['description']}}
                            </button>
                        </h2>
                    </div>

                    <div id="collapse{{ $k }}"
                         class="collapse"
                         aria-labelledby="heading{{ $k }}"
                         data-parent="#accordionFaq">
                        <div class="card-body">
                            {{$faq['answer']}}
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

</div>
