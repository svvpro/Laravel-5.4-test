@if(isset($article))
    {!! Html::image(asset('images/articles/'.$article->image->max)) !!}
    <h2>{{$article->title}}</h2>
    <div><strong>Author: </strong>{!! $article->user->name !!}<strong> Created at: </strong>{{$article->created_at }}
    </div>
    <p>
        {!!  $article->text !!}
    </p>
@endif

@if($article->tags)
    <strong>Tag:</strong>
    <ul>
        @foreach($article->tags as $tag)
            <li>{{$tag->name}}</li>
        @endforeach
    </ul>
@endif
<a href="{{ URL::previous() }}" class="btn btn-primary">Back</a>