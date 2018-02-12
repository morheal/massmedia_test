@extends('layouts.app')

@section('content')

<div class="panel panel-default content">
    {{Form::open(array('url' => '/edit_feedback_category/'.$feedback->id, 'method' => 'post', 'class' => 'form_feedback clear_fl'))}}
        <input type="hidden" name="id" value="{{$feedback->id}}">
        {{ Form::text('author', null, array('id'=>'author', 'placeholder' => 'Enter your name')) }}
        {{ Form::text('text', null, array('id'=>'text', 'placeholder' => 'Enter the text')) }}
        {{ Form::submit('Edit feedback') }}
    {{Form::close()}}
</div>

@endsection
