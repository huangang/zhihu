@extends('layouts.app')

@section('content')
    @include('vendor.ueditor.assets')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $question->title }}
                        @foreach($question->topics as $topic)
                            <a class="topic" href="/topic/{{$topic->id}}"> {{$topic->name}} </a>
                        @endforeach
                    </div>
                    <div class="panel-body">
                        {!! $question->body !!}
                    </div>
                    <div class="actions">
                        @if(Auth::check() && Auth::user()->owns($question))
                            <span class="edit"><a href="/questions/{{ $question->id }}/edit">编辑</a></span>
                            <form action="/questions/{{ $question->id }}" method="POST" class="delete-form">
                                {{method_field('delete')}}
                                {{csrf_field ()}}
                                <button class="button is-naked delete-button">删除</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{$question->answers_count}}个回答
                    </div>
                    <div class="panel-body content">
                        @foreach($question->answers as $answer)
                            <div class="media">
                                <div class="media-left">
                                    <span>
                                        <img style=" width:36px ;" src="{{$answer->user->avatar}}" alt="{{ $answer->user->name }}">
                                    </span>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="/user/{{ $answer->user->name }}">
                                            {{ $answer->user->name }}
                                        </a>
                                    </h4>
                                    {!! $answer->body !!}
                                </div>
                            </div>
                        @endforeach
                        <form action="/questions/{{$question->id}}/answer" method="post" >
                            {{csrf_field()}}
                            <div class="form-group {{$errors->has('body')?'has-error':''}}">
                                <label for="body">答案</label>
                                <script id="container"  name="body" type="text/plain" >
                                    {!! (old(('body')))!!}
                                </script>
                                @if($errors->has('body'))
                                    <span class="help-block"></span>
                                    <strong>{{$errors->first('body')}}</strong>
                                @endif
                            </div>
                            <button class="btn btn-success pull-right" type="submit">提交答案</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var ue = UE.getEditor('container', {
            toolbars: [
                ['bold', 'italic', 'underline', 'strikethrough', 'blockquote', 'insertunorderedlist', 'insertorderedlist', 'justifyleft','justifycenter', 'justifyright',  'link', 'insertimage', 'fullscreen']
            ],
            elementPathEnabled: false,
            enableContextMenu: false,
            autoClearEmptyNode:true,
            wordCount:false,
            imagePopup:false,
            autotypeset:{ indent: true,imageBlockLine: 'center' },
            initialFrameHeight: 120
        });
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
    </script>
@endsection