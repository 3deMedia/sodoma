@extends('errors::illustrated-layout')

@section('image')
 <img loading="lazy"  src="{{ asset('images/LOGO.svg')}}" />
@endsection
@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
