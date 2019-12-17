@extends('errors::minimal')

@section('title', __('Interdit'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Interdit'))
