@extends('master')
@section('content')

<div class="page-bg justify-content-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="login-card">
                    <h3 class="text-center mb-4 fw-bold" style="color: white; text-shadow: 1px 1px 2px rgba(0,0,0,0.2);">Elite Canvas</h3>
                    
                    <form action="/login" method="POST">
                        @csrf 
                        <div class="mb-4">
                            <label class="form-label fw-bold" style="color: #f45424;">Email Address</label>
                            <input type="email" name="email" class="form-control shadow-sm" placeholder="name@example.com" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold" style="color: #f45424;">Password</label>
                            <input type="password" name="password" class="form-control shadow-sm" placeholder="••••••••" required>
                            
                            <div class="text-end mt-1">
                                <a href="/forgot-password" style="color: #f45424; font-size: 0.9rem; text-decoration: none;">Forgot Password?</a>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold" style="background-color: #f89724; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">Login</button>
                    </form>

                    <div class="text-center mt-4">
                        <p style="color: white;">Don't have an account?</p>
                        <a href="/register" class="btn btn-outline-light w-100 py-2 fw-bold" style="border: 2px solid #f89724; color: #f89724;">Create New Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection