@extends('layouts.app')

@section('content')

<div class="panel panel-default content">
    {{Form::open(array('url' => '/edit_category/'.$category->id, 'method' => 'post', 'class' => 'form_category clear_fl'))}}
        <input type="hidden" name="id" value="{{$category->id}}">
        {{ Form::text('name', null, array('id'=>'name', 'placeholder' => 'Enter category name')) }}
        {{ Form::text('description', null, array('id'=>'description', 'placeholder' => 'Enter description')) }}
        {{ Form::submit('Edit category') }}
    {{Form::close()}}
</div>

@endsection
