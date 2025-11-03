@extends('layouts.app')

@section('title', 'سلة التسوق - عطار الأعشاب')

@section('content')
    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            <h1 class="fw-bold mb-4">سلة التسوق</h1>
            <p>سلة التسوق فارغة</p>
            @dump($cartItems)
        </div>
    </section>
@endsection
