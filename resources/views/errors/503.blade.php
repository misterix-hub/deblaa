@extends('errors::minimal')

@section('title', __('Service Indisponible'))
@section('code', '503')
@section('message', __($exception->getMessage() ?: 'Service Indisponible'))
