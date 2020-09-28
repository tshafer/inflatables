<div class="col-md-12">
    <div class="block">
        <div class="block-title">
            <h2>Unit</h2>
        </div>

        <div class="form-bordered">

            <div class="form-group">
                {!! Form::label('product') !!}
                {!! select('product', $products, $productId, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('name') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
            </div>


            <div class="form-group">
                {!! Form::label('height') !!}
                {!! Form::text('height', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('width') !!}
                {!! Form::text('width', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('length') !!}
                {!! Form::text('length', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('weight') !!}
                {!! Form::text('weight', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('price') !!}
                {!! Form::text('price', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('model') !!}
                {!! Form::text('model', null, ['class' => 'form-control']) !!}
            </div>
        </div>

    </div>

    <div class="form-group form-actions">
        {!!Form::submit('Save Unit', ['class' => 'btn btn-block btn-primary'])!!}
    </div>
</div>

