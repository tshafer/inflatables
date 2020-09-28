<div class="form-bordered">

    <div class="form-group">
        {!! Form::label('email') !!}
        {!! email('email', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('name') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password') !!}
        {!! Form::password('password',['class' => 'form-control']) !!}
    </div>

    <div class="form-group form-actions">
        {!! Form::submit('Save User', ['class' => 'btn btn-success']) !!}
    </div>
</div>
