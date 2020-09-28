@extends('admin.layout')

@section('title') Category @stop

@section('subtitle')
    @if($category->parent && $category->parent->count())
        <a href="{{route('admin.categories.show',$category->parent()->first()->id) }}"> {!! $category->parent()->first()->name!!}</a> >
    @endif
    {{$category->name}}
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="block">
                <div class="block-title">
                    <h2>Category Content</h2>
                    <div class="block-options pull-right">

                        {!! toolbar_link(['admin.categories.edit', $category->id], 'fa-edit', 'Edit Category') !!}
                        @if($category->isRoot())
                            {!! toolbar_link('admin.categories.create', 'fa-plus', 'New Category') !!}
                        @endif
                    </div>
                </div>
                <h3>{{$category->name}}</h3>
                <table class="table table-striped table-hover">

                    @if($category->parent && $category->parent->count())
                        <tr>
                            <td>Parent Category</td>
                            <td colspan=2">
                                @foreach($category->parent()->get() as $parent)
                                    <a href="{{route('admin.categories.show',$parent->id) }}"> {!! $parent->name!!}</a>
                                @endforeach
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td>Enabled</td>
                        <td colspan=2">{!! $category->is_enabled!!}</td>
                    </tr>
                    <tr>
                        <td> Intro Text</td>
                        <td colspan=2">{!! $category->intro_text!!}</td>
                    </tr>


                    @if($category->media->count() > 0)
                        <tr>
                            <td>Image</td>
                            <td>
                                <img src="{{url('/')}}{!! $category->media->first()->getUrl('adminThumb')!!}"/><br/>

                            </td>
                            <td>
                                <a href="{{ route('admin.categories.image.delete',[$category->id, $category->media->first()->id]) }}"
                                   class="btn btn-warning btn-sm del"">Remove </a>
                            </td>
                        </tr>
                    @endif
                </table>
            </div>

            <div class="block">
                <div class="block-title">
                    <h2>DANGER ZONE</h2>
                </div>
                {!! Form::Form::open(['route' => ['admin.categories.destroy', $category->id], 'method' => 'delete']) !!}
                {!! Form::Form::submit('DELETE CATEGORY', ['class' => 'btn btn-block btn-danger del']) !!}
                {!! Form::Form::close() !!}
                <br/>
            </div>
        @if($category->products->count() > 0)
            <div class="block">
                <div class="block-title">
                    <h2>Products </h2>
                    <div class="block-options pull-right">
                        {!! toolbar_link(['admin.products.create', 'cat='.$category->id], 'fa-plus', 'New Product') !!}
                    </div>
                </div>

                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="min">ID</th>
                        <th>Name</th>
                        <th>Enabled</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @if($category->products->count() > 0)
                        @foreach($category->products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->is_enabled}}</td>
                                <td>
                                    {!! defaultProductImage($product, 'adminThumb') !!}
                                </td>
                                <td class="min">
                                    {!!$product->getTableLinks()!!}
                                    @if($category->products()->count() > 1)
                                        @if(!$loop->first)
                                            <a class="btn btn-xs btn-warning"
                                               href="{{route('admin.products.moveup', $product->id)}}">
                                                <i class="fa fa-arrow-up" aria-Form::hidden(="true"></i>
                                            </a>
                                            <a class="btn btn-xs btn-info"
                                               href="{{route('admin.products.movetop', $product->id)}}">
                                                <i class="fa fa-arrow-circle-up" aria-Form::hidden(="true"></i>
                                            </a>
                                        @endif
                                        @if(!$loop->last)
                                            <a class="btn btn-xs btn-warning"
                                               href="{{route('admin.products.movedown', $product->id)}}"><i
                                                        class="fa fa-arrow-down" aria-Form::hidden(="true"></i></a>
                                                <a class="btn btn-xs btn-info"
                                                   href="{{route('admin.products.movebottom', $product->id)}}"><i
                                                            class="fa fa-arrow-circle-down" aria-Form::hidden(="true"></i></a>
                                        @endif
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">
                                There are no Products Available
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        @endif
    </div>


    </div>
@stop
