@extends('admin.layout')

@section('title') Categories @stop

@section('content')
    <div class="block">
        <div class="block-title">
            <div class="block-options pull-right">
                {!! toolbar_link('admin.categories.create', 'fa-plus', 'New Category') !!}
            </div>
            <h2>Categories</h2>
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
            @if($categories->count() > 0)
                @foreach($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->is_enabled}}</td>
                        <td>
                            @if($category->media->count() > 0)
                                <img src="{!! $category->media->first()->getUrl('adminThumb')!!}"/>
                            @endif
                        </td>
                        <td class="min">
                            {!!$category->getTableLinks()!!}
                            @if($categories->count() > 1)
                                @if(!$loop->first)
                                    <a class="btn btn-xs btn-warning"
                                       href="{{route('admin.categories.moveup', $category->id)}}">
                                        <i class="fa fa-arrow-up" aria-Form::hidden(="true"></i>
                                    </a>
                                @endif
                                @if(!$loop->last)
                                    <a class="btn btn-xs btn-warning"
                                       href="{{route('admin.categories.movedown', $category->id)}}"><i
                                                class="fa fa-arrow-down" aria-Form::hidden(="true"></i></a>
                                @endif
                            @endif
                            <a class="btn btn-xs btn-warning" href="{{route('category', $category->slug)}}"
                               target="_blank">
                                <i class="fa fa-external-link" aria-Form::hidden(="true"></i>
                            </a>
                        </td>

                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">
                        There are no Categories Available
                    </td>
                </tr>
            @endif

            </tbody>
        </table>
        {!! paginate($categories) !!}
    </div>
@stop
