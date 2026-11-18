@extends('master')
@section('content')

<div class="page-bg justify-content-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="login-card">
                    <h3 class="text-center mb-4 fw-bold" style="color: white; text-shadow: 1px 1px 2px rgba(0,0,0,0.2);">Reset Password</h3>
                    <p class="text-center mb-4" style="color: #e0e0e0; font-size: 0.9rem;">
                        Enter your email address and we'll send you a link to reset your password.
                    </p>
                    
                    <form action="/send-reset-link" method="POST">
                        @csrf 
                        <div class="mb-4">
                            <label class="form-label fw-bold" style="color: #f45424;">Email Address</label>
                            <input type="email" name="email" class="form-control shadow-sm" placeholder="name@example.com" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold" style="background-color: #f89724; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                            Send Reset Link
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <a href="/login" style="color: white; text-decoration: none;">
                            <i class="fas fa-arrow-left"></i> Back to Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection