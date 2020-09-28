<div class="col-md-12">
    <div class="block">
        <div class="block-title">
            <h2>Product</h2>
        </div>

        <div class="form-bordered">

            <div class="form-group">
                {!! Form::label('category') !!}
                {!! select('categories', $nestedList, $parentId, ['class' => 'form-control']) !!}
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
                {!! Form::label('accessories') !!}<br/>
                @if(isset($product))
                    You can manage accessories <a href="{{route('admin.products.show', $product->id)}}">here</a>.
                @else
                    You can add accessories once you you create a new product.
                @endif
            </div>

            <div class="form-group">
                {!! Form::label('Wet') !!}
                {!! radio('season', 'wet', null) !!}
                {!! Form::label('Dry') !!}
                {!! radio('season', 'dry', null) !!}
                {!! Form::label('Both') !!}
                {!! radio('season', 'both', null) !!}
            </div>

            <div class="form-group">
                {!! Form::label('images') !!}<br/>
                @if(isset($product))
                    You can manage images <a href="{{route('admin.products.show', $product->id)}}">here</a>.
                @else
                    You can add images once you you create a new product.
                @endif
            </div>

            <div class=" form-group">
                {!! Form::label('enabled') !!}
                {!! checkbox('enabled', true) !!}
            </div>

            <div class=" form-group">
                {!! Form::label('featured') !!}
                {!! checkbox('featured') !!}
            </div>
        </div>

    </div>

    <div class="form-group form-actions">
        {!!Form::submit('Save Product', ['class' => 'btn btn-block btn-primary'])!!}
    </div>
</div>

