@if(isset($article))
    {!! Form::model($article, ['route'=>['admin.articles.update', $article->slug], 'files'=>true, 'method'=>'PATCH', 'class'=>'from-horizontal']) !!}
@else
    {!! Form::open(['route'=>'admin.articles.store', 'files'=>true, 'method'=>'POST', 'class'=>'from-horizontal']) !!}
@endif
<div class="form-group">
    <div class="row">
        <div class="col-md-1">
            <strong>{!! Form::label('title', 'Title: ', ['class'=>'col-form-label']) !!}</strong>
        </div>
        <div class="col-md-11">
            {!! Form::text('title', null, ['class'=>'form-control']) !!}
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-md-1">
            <strong>{!! Form::label('slug', 'Slug: ', ['class'=>'col-form-label']) !!}</strong>
        </div>
        <div class="col-md-11">
            {!! Form::text('slug', null, ['class'=>'form-control']) !!}
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-md-1">
            <strong>{!! Form::label('text', 'Text: ', ['class'=>'col-form-label']) !!}</strong>
        </div>
        <div class="col-md-11">
            {!! Form::textarea('text', null, ['class'=>'form-control', 'id'=>'editor']) !!}
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-md-1">
            <strong>{!! Form::label('created_at', 'Created At: ', ['class'=>'col-form-label']) !!}</strong>
        </div>
        <div class="col-md-11">
            @if(isset($article))
                {!! Form::input('date','created_at', null, ['class'=>'form-control', 'id'=>'editor']) !!}
                @else
                {!! Form::input('date','created_at', date('Y-m-d'), ['class'=>'form-control', 'id'=>'editor']) !!}
            @endif

        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-md-1">
            <strong>{!! Form::label('category', 'Category: ', ['class'=>'col-form-label']) !!}</strong>
        </div>
        <div class="col-md-11">
            {!! Form::select('category_id', $categories, null,['class'=>'form-control', 'placeholder'=>'Pick a category...']) !!}
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-md-1">
            <strong>{!! Form::label('tag_list', 'Tags: ', ['class'=>'col-form-label']) !!}</strong>
        </div>
        <div class="col-md-11">
            {!! Form::select('tag_list[]', $tags, null, ['class'=>'form-control', 'multiple']) !!}
        </div>
    </div>
</div>


<div class="form-group">
    <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-11">
            @if(isset($article->image->min))
                {!! Html::image(asset('/images/articles/'.$article->image->min, null, ['width'=>200])) !!}
                @else
                {!! Html::image(asset('/images/no-image.jpg', null, ['width'=>200])) !!}
            @endif

        </div>
    </div>
</div>


<div class="form-group">
    <div class="row">
        <div class="col-md-1">
            <strong>{!! Form::label('image', 'Image: ', ['class'=>'col-form-label']) !!}</strong>
        </div>
        <div class="col-md-11">
            {!! Form::file('image', null, ['class'=>'form-control-file']) !!}
        </div>
    </div>
</div>

{!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
{!! Form::close() !!}

<script>
    CKEDITOR.replace( 'editor' );
</script>