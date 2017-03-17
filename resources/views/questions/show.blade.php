@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{$question->title}}
                    </div>
                    <div class="post-meta">
                        @foreach($question->topic as $value)
                            <span class="post-category">
                                <i class="fa fa-folder-o"></i>
                                <a href="#">
                                {{$value->name}}
                                </a>
                                </span>
                        @endforeach
                    </div>
                    <div class="panel-body">
                        <div class="post-detail-content">
                            {!! $question->body !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .panel-body img{
            width: 100%;
        }
    </style>
@endsection
