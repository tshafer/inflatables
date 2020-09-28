@extends('layout')

@section('title', 'Specials')

@section('content')
    <div class="container main-container">
        <div class="row">
            <div class="col-md-12 hero-feature">
                <span class="title">Specials</span>
                @forelse($specials as $special)
                    <h3>{{$special->title}}</h3>
                    @if($special->getMedia('specials')->count() > 0)
                        <img src="{{url('/')}}{{$special->media->first()->getUrl('medium')}}" alt="{{ $special->title }}" class="img-responsive"/>
                    @endif
                    {{ $special->description }}
                @empty
                    No Specials available
                @endforelse
            </div>
        </div>
    </div>
@stop
