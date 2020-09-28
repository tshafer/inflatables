@extends('admin.layout')

@section('title') Product @stop

@section('subtitle')
    {{$product->name}}
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">

            <div class="block">
                <div class="block-title">
                    <h2>Product Content</h2>
                    <div class="block-options pull-right">

                        {!! toolbar_link(['admin.products.edit', $product->id], 'fa-edit', 'Edit Product') !!}
                        {!! toolbar_link('admin.products.create', 'fa-plus', 'New Product') !!}
                        <a class="btn btn-alt btn-sm btn-default"
                           href="{{route('product', [$product->categories->slug, $product->slug])}}"
                           target="_blank">
                            <i class="fa fa-external-link" aria-Form::hidden(="true"></i>
                        </a>
                    </div>
                </div>
                <h3>{{$product->name}}</h3>
                <table class="table table-striped table-hover">

                    <tr>
                        <td> Description</td>
                        <td>{!! $product->description!!}</td>
                    </tr>
                    <tr>
                        <td>Enabled</td>
                        <td>{!! $product->is_enabled!!}</td>
                    </tr>
                    <tr>
                        <td>Featured</td>
                        <td>{!! $product->is_featured!!}</td>
                    </tr>
                    <tr>
                        <td>Season</td>
                        <td>{!! $product->season!!}</td>
                    </tr>

                    @if($product->categories()->count() > 0)
                        <tr>
                            <td>Categories</td>
                            <td>
                                    <a href="{{route('admin.categories.show', $product->categories->id)}}">{{ $product->categories->name }}</a>
                            </td>
                        </tr>
                    @endif

                    @if($product->units->count() > 0)
                        <tr>
                            <td>Units</td>
                            <td>
                                @foreach($product->units as $unit)
                                    <a href="{{route('admin.units.show', $unit->id)}}">{{ $unit->name }}</a>,
                                @endforeach
                            </td>

                        </tr>
                    @endif

                    <tr>
                        <td colspan="2">Images</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            {!!Form::open(['route' => ['admin.products.images.add',$product->id],'files' => true])!!}
                            {{ Form::hidden('productId', $product->id) }}
                            <ul class="imageGallery">
                                @foreach ($product->getMedia('products') as $photo)
                                    <li>
                                        <div>
                                            <img src="{{$photo->getUrl('thumb') }}"/>
                                        </div>
                                        <div class="btn-group">
                                            @if(array_get($photo->custom_properties, 'default') == null)
                                            <a href="{{ route('admin.products.images.delete',[$product->id, $photo->id]) }}"
                                               class="btn btn-danger btn-sm del">Delete</a>
                                            @endif
                                            <a href="{{ route('admin.products.images.default',[$product->id, $photo->id]) }}"
                                               class="btn btn-sm {{(array_get($photo->custom_properties, 'default') == 1) ? 'disabled btn-success' : 'btn-warning'}}">Default</a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <br/><br/>
                            <div id="fine-uploader-gallery"></div>
                            {!! Form::close() !!}
                        </td>

                    </tr>
                    <tr>
                        <td colspan="2">Accessories</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            {!!Form::open(['route' => ['admin.products.images.accessories.add',$product->id],'files' => true])!!}
                            {{ Form::hidden('productId', $product->id) }}
                            <ul class="imageGallery">
                                @foreach ($product->getMedia('accessories') as $photo)
                                    <li>
                                        <div>
                                            <img src="{{$photo->getUrl('adminThumb') }}"/>
                                        </div>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.products.images.accessories.delete',[$product->id, $photo->id]) }}"
                                               class="btn btn-danger btn-sm del">Delete</a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <br/><br/>
                            <div id="accessory-uploader-gallery"></div>
                            {!! Form::close() !!}
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
                {!! Form::Form::open(['route' => ['admin.products.destroy', $product->id], 'method' => 'delete']) !!}
                {!! Form::Form::submit('DELETE PRODUCT', ['class' => 'btn btn-block btn-danger del']) !!}
                {!! Form::Form::close() !!}
                <br/>
            </div>
        </div>
    </div>
    <script type="text/template" id="qq-template-gallery">
        <div class="qq-uploader-selector qq-uploader qq-gallery" qq-drop-area-text="Drop files here">
            <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
                <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                     class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
            </div>
            <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
                <span class="qq-upload-drop-area-text-selector"></span>
            </div>
            <div class="qq-upload-button-selector qq-upload-button">
                <div>Upload a file</div>
            </div>
            <span class="qq-drop-processing-selector qq-drop-processing">
                <span>Processing dropped files...</span>
                <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
            </span>
            <ul class="qq-upload-list-selector qq-upload-list" role="region" aria-live="polite"
                aria-relevant="additions removals">
                <li>
                    <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
                    <div class="qq-progress-bar-container-selector qq-progress-bar-container">
                        <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                             class="qq-progress-bar-selector qq-progress-bar"></div>
                    </div>
                    <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                    <div class="qq-thumbnail-wrapper">
                        <img class="qq-thumbnail-selector" qq-max-size="120" qq-server-scale>

                    </div>
                    <button type="button" class="qq-upload-cancel-selector qq-upload-cancel">X</button>
                    <button type="button" class="qq-upload-retry-selector qq-upload-retry">
                        <span class="qq-btn qq-retry-icon" aria-label="Retry"></span>
                        Retry
                    </button>

                    <div class="qq-file-info">
                        <div class="qq-file-name">
                            <span class="qq-upload-file-selector qq-upload-file"></span>
                            <span class="qq-edit-filename-icon-selector qq-edit-filename-icon"
                                  aria-label="Edit filename"></span>
                        </div>
                        <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                        <span class="qq-upload-size-selector qq-upload-size"></span>
                        <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">
                            <span class="qq-btn qq-delete-icon" aria-label="Delete"></span>
                        </button>
                        <button type="button" class="qq-btn qq-upload-pause-selector qq-upload-pause">
                            <span class="qq-btn qq-pause-icon" aria-label="Pause"></span>
                        </button>
                        <button type="button" class="qq-btn qq-upload-continue-selector qq-upload-continue">
                            <span class="qq-btn qq-continue-icon" aria-label="Continue"></span>
                        </button>
                    </div>
                </li>
            </ul>

            <dialog class="qq-alert-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Close</button>
                </div>
            </dialog>

            <dialog class="qq-confirm-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">No</button>
                    <button type="button" class="qq-ok-button-selector">Yes</button>
                </div>
            </dialog>

            <dialog class="qq-prompt-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <input type="text">
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Cancel</button>
                    <button type="button" class="qq-ok-button-selector">Ok</button>
                </div>
            </dialog>
        </div>
    </script>

@stop
