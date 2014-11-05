@extends('admin.layouts.default')

<!-- app/views/nerds/index.blade.php -->

	<title> Lista Equipos</title>

<div class="container">
{{Form::model($user, ['url' => array('user.update', $user->id) ])}}

  {{ Form::input('text', 'username', null, null )}}

  {{ Form::input('text', 'email', null, null )}}


{{Form::close()}}