@extends('layouts.app')

@section('title', 'اتصل بنا - عطار الأعشاب')

@section('content')
    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            <div class="page-header text-center mb-5">
                <h1 class="fw-bold">اتصل بنا</h1>
                <p class="lead text-muted">نحن هنا للإجابة على استفساراتكم</p>
            </div>
            
            <div class="row g-4 mb-5">
                <div class="col-lg-4">
                    <div class="card text-center h-100 shadow-sm">
                        <div class="card-body">
                            <div class="text-success mb-3">
                                <i class="fas fa-map-marker-alt fa-3x"></i>
                            </div>
                            <h4 class="fw-bold">العنوان</h4>
                            <p class="text-muted">الرياض، المملكة العربية السعودية</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card text-center h-100 shadow-sm">
                        <div class="card-body">
                            <div class="text-success mb-3">
                                <i class="fas fa-phone fa-3x"></i>
                            </div>
                            <h4 class="fw-bold">الهاتف</h4>
                            <p class="text-muted" dir="ltr">+966 50 000 0000</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card text-center h-100 shadow-sm">
                        <div class="card-body">
                            <div class="text-success mb-3">
                                <i class="fas fa-envelope fa-3x"></i>
                            </div>
                            <h4 class="fw-bold">البريد الإلكتروني</h4>
                            <p class="text-muted">info@athar-herb.com</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-body p-4">
                            <h3 class="fw-bold mb-4">أرسل لنا رسالة</h3>
                            
                            <form action="{{ route('contact') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">الاسم الكامل</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">البريد الإلكتروني</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">رقم الهاتف</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" required>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="subject" class="form-label">الموضوع</label>
                                        <input type="text" class="form-control" id="subject" name="subject" required>
                                    </div>
                                    
                                    <div class="col-12">
                                        <label for="message" class="form-label">الرسالة</label>
                                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                                    </div>
                                    
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-success btn-lg w-100">
                                            <i class="fas fa-paper-plane ms-2"></i>
                                            إرسال الرسالة
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
