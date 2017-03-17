@extends('layouts.app')
@include('vendor.ueditor.assets')
@section('content')
    <div class="container">
        @include('public.errors')
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">发布问题</div>
                    <div class="panel-body">
                        <form action="{{route('questions.store')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title">标题</label>
                                <input type="text" id="title" value="{{old('title')}}" class="form-control" placeholder="标题" name="title">
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="from-group">
                                <label for="select">标签</label>
                                <select id="select" class="js-example-basic-multiple form-control" multiple="multiple">
                                    <option value="AL">Alabama</option>
                                    ...
                                    <option value="WY">Wyoming</option>
                                </select>
                            </div>
                            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                <label for="container">内容</label>
                                <script id="container" name="body" type="text/plain" style="height:200px">
                                    {!! old('body') !!}
                                </script>
                                @if ($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button class="btn btn-success pull-right" type="submit">发布问题</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var ue = UE.getEditor('container',{
            toolbars: [
                ['bold', 'italic', 'underline', 'strikethrough', 'blockquote', 'insertunorderedlist', 'insertorderedlist', 'justifyleft','justifycenter', 'justifyright',  'link', 'insertimage', 'fullscreen']
            ],
            elementPathEnabled: false,
            enableContextMenu: false,
            autoClearEmptyNode:true,
            wordCount:false,
            imagePopup:false,
            autotypeset:{ indent: true,imageBlockLine: 'center' }
        });
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
    </script>
@endsection
@section('script')
    <script type="text/javascript">
        $(".js-example-basic-multiple").select2();
    </script>
@endsection