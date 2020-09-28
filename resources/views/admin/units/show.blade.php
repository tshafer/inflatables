@extends('admin.layout')

@section('title') Unit @stop

@section('subtitle')
    {{$unit->name}}
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">

            <div class="block">
                <div class="block-title">
                    <h2>Product Content</h2>
                    <div class="block-options pull-right">

                        {!! toolbar_link(['admin.units.edit', $unit->id], 'fa-edit', 'Edit Unit') !!}
                        {!! toolbar_link('admin.units.create', 'fa-plus', 'New Unit') !!}
                    </div>
                </div>
                <h3>{{$unit->name}}</h3>
                <table class="table table-striped table-hover">

                    <tr>
                        <td> Description</td>
                        <td>{!! $unit->description!!}</td>
                    </tr>
                    <tr>
                        <td>Height</td>
                        <td>{!! $unit->height!!}</td>
                    </tr>
                    <tr>
                        <td>Width</td>
                        <td>{!! $unit->width!!}</td>
                    </tr>
                    <tr>
                        <td>Length</td>
                        <td>{!! $unit->length!!}</td>
                    </tr>
                    <tr>
                        <td>Weight</td>
                        <td>{!! $unit->weight!!}</td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td>{!! $unit->price!!}</td>
                    </tr>
                    <tr>
                        <td>Model</td>
                        <td>{!! $unit->model!!}</td>
                    </tr>
                    <tr>
                        <td>Product</td>
                        <td>
                            <a href="{{route('admin.products.show', $unit->product->id)}}">{{ $unit->product->name  }}</a>
                        </td>
                    </tr>
                </table>
            </div>

        </div>

        <div class="col-md-4">


            <div class="block">
                <div class="block-title">
                    <h2>DANGER ZONE</h2>
                </div>
                {!! Form::Form::open(['route' => ['admin.units.destroy', $unit->id], 'method' => 'delete']) !!}
                {!! Form::Form::submit('DELETE UNIT', ['class' => 'btn btn-block btn-danger del']) !!}
                {!! Form::Form::close() !!}
                <br/>
            </div>
        </div>
    </div>


@stop
