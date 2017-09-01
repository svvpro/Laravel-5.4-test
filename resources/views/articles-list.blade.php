@if(isset($articles))
    @foreach($articles as $article)
        <div class="row">
            <div class="col-md-4">
                {!! Html::image(asset('images/articles/'.$article->image->min), null, ['width'=>150]) !!}
            </div>
            <div class="col-md-8">
               <h3> <a href="/articles/{!! $article->slug !!}">{!! $article->title !!}</a></h3>
            </div>
        </div>
    @endforeach
@endif