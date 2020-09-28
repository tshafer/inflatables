<div class="col-md-12">
    <div class="block">
        <div class="block-title">
            <h2>Category</h2>
        </div>

        <div class="form-bordered">


            <div class="form-group">
                {!! Form::label('name') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('intro_text') !!}
                {!! Form::textarea('intro_text', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                @if(isset($category) &&  $category->getMedia('categories')->first())
                    <img src="{{url('/')}}{!! $category->getMedia('categories')->first()->getUrl('adminThumb')!!}"/><br/>
                @endif
                {!! Form::label('image') !!}
                {!! file_Form::input('image',['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('enabled') !!}
                {!! checkbox('enabled', true) !!}
            </div>
        </div>

    </div>

    <div class="form-group form-actions">
        {!!Form::submit('Save Category', ['class' => 'btn btn-block btn-primary'])!!}
    </div>
</div>
