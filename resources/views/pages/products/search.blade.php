@extends('layouts.app')

@section('title', 'نتائج البحث - عطار الأعشاب')

@section('content')
    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            <h1>نتائج البحث عن: {{ request('q') }}</h1>
            <!-- Add search results here -->
        </div>
    </section>
@endsection
