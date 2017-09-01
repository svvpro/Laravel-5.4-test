{!! link_to_route('admin.articles.create', 'Create', null, ['class'=>'btn btn-primary']) !!}
@if(isset($articles))
    <table class="table table-striped">
        <thead>
        <tr>
            <th></th>
            <th>Title</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
                <tr>
                    <td>
                        @if(isset($article->image))
                            {!! Html::image(asset('images/articles/'.$article->image->min), null, ['width'=>150]) !!}
                            @else
                            {!! Html::image(asset('images/no-image.jpg'), null, ['width'=>150]) !!}
                        @endif
                    </td>
                    <td>{{ $article->title }}</td>
                    <td>{!! link_to_route('admin.articles.edit', 'Edit', $article->slug, ['class'=>'btn btn-warning']) !!}</td>
                    <td>
                        {!! Form::open(['route'=>['admin.articles.destroy', $article->slug], 'method'=>'DELETE']) !!}
                        {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif