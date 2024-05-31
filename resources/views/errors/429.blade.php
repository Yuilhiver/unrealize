@extends('errors::minimal')

@section('title', __('Too Many Requests'))
@section('code', 'ERROR 429')
@section('message', 'Слишком много запросов')
