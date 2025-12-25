@extends('layouts.app')

@section('title', 'PawFriends - Temukan Sahabat Baru Anda')

@section('content')

{{-- Hero / Banner Section --}}
@include('home.hero')

{{-- Category Section --}}
@include('home.categories')

{{-- Available Pets Section --}}
@include('home.available-pets')

{{-- CTA Banners --}}
@include('home.cta-banners')

{{-- Popular Pets Section --}}
@include('home.popular-pets')

{{-- Newsletter / Donation Section --}}
@include('home.newsletter')

{{-- Blog Section --}}
@include('home.blog')

{{-- Search Tags & Features --}}
@include('home.search-tags')

@endsection

