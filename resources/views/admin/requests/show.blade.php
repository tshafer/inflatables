@extends('admin.layout')

@section('title') Requests @stop

@section('subtitle')
    {{$unitRequest->name}}
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">

            <div class="block">
                <div class="block-title">
                    <h2>Request Content</h2>
                </div>
                <h3>{{$unitRequest->first_name}} {{$unitRequest->last_name}}</h3>
                <table class="table table-striped table-hover">

                    <tr>
                        <td>Date</td>
                        <td>{!! $unitRequest->created_at!!}</td>
                    </tr>
                    <tr>
                        <td>Company Name</td>
                        <td>{!! $unitRequest->company_name!!}</td>
                    </tr>
                    <tr>
                        <td>Company Website</td>
                        <td>{!! $unitRequest->company_website!!}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{!! $unitRequest->email!!}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>{!! $unitRequest->phone!!}</td>
                    </tr>
                    <tr>
                        <td>Message</td>
                        <td>{!! $unitRequest->message!!}</td>
                    </tr>
                    @if($unitRequest->units->count() > 0)
                        <tr>
                            <td>Units</td>
                            <td>
                                @foreach($unitRequest->units as $unit)
                                    <a href="{{route('admin.units.show', $unit->id)}}">{{ $unit->name }}</a><br/>
                                @endforeach
                            </td>
                        </tr>
                    @endif

                    @if($unitRequest->cart)
                        <tr>
                            <td>Cart</td>
                            <td>


                                <table class="table table-bordered tbl-cart cart table-hover table-condensed">
                                    <thead>
                                    <tr>
                                        <td>Product</td>
                                        <td>Price</td>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($cart as $unit)
                                        <tr>
                                            <td data-th="Product">
                                                <div class="row">
                                                    <div class="col-sm-4 Form::hidden(-xs">
                                                        @if($unit->options->image)
                                                            <a href="{{route('product', [$unit->options->categorySlug, $unit->options->productSlug])}}">
                                                                <img src="{{$unit->options->image}}"
                                                                     alt="{{$unit->options->product_name}}" title=""
                                                                     width="150"/>
                                                            </a>
                                                        @endif
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <a href="{{route('product', [$unit->options->categorySlug, $unit->options->productSlug])}}">{{$unit->options->product_name}}</a>
                                                        - ({{$unit->options->width}} x {{$unit->options->length}}
                                                        x {{$unit->options->height}}) - ({{$unit->options->weight}} LBS)
                                                        -
                                                        (#{{$unit->options->model}})
                                                    </div>
                                                </div>
                                            </td>

                                            <td data-th="Price" class="text-center">
                                                ${{number_format($unit->price,2)}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td class="Form::hidden(-xs"></td>
                                        <td class="total text-center">Total:
                                            ${{number_format($total,2)}}
                                    </tr>
                                    </tfoot>
                                </table>
                            </td>
                        </tr>
                    @endif
                </table>
            </div>

        </div>

        <div class="col-md-4">
            <div class="block">
                <div class="block-title">
                    <h2>DANGER ZONE</h2>
                </div>
                {!! Form::Form::open(['route' => ['admin.unitrequests.destroy', $unitRequest->id], 'method' => 'delete']) !!}
                {!! Form::Form::submit('DELETE REQUEST', ['class' => 'btn btn-block btn-danger del']) !!}
                {!! Form::Form::close() !!}
                <br/>
            </div>
        </div>
    </div>


@stop
