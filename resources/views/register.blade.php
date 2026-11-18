@extends('master')
@section('content')

<div class="page-bg justify-content-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="login-card">
                    <h3 class="text-center mb-4 fw-bold" style="color: white; text-shadow: 1px 1px 2px rgba(0,0,0,0.2);">Elite Canvas</h3>
                    <h5 class="text-center mb-4" style="color: #f89724;">Create Client Account</h5>
                    
                    <form action="/register" method="POST">
                        @csrf 
                        <div class="mb-3">
                            <label class="form-label fw-bold" style="color: #f45424;">Full Name</label>
                            <input type="text" name="name" class="form-control shadow-sm" placeholder="John Doe" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold" style="color: #f45424;">Email Address</label>
                            <input type="email" name="email" class="form-control shadow-sm" placeholder="name@example.com" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold" style="color: #f45424;">Password</label>
                            <input type="password" name="password" class="form-control shadow-sm" placeholder="••••••••" required>
                            <small style="color: #e0e0e0;">Minimum 3 characters.</small>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold" style="background-color: #f89724; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">Sign Up</button>
                    </form>

                    <div class="text-center mt-4">
                        <p style="color: white;">Already have an account?</p>
                        <a href="/login" style="color: #f89724; text-decoration: none; font-weight: bold;">Login Here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection