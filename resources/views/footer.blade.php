<footer class="text-white pt-5 pb-4 mt-5" style="background-color: #1A1A1A;">
    <div class="container text-center text-md-left">
        <div class="row text-center text-md-left">
            
        <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                {{-- Logo Container --}}
                <div class="mb-3 d-flex justify-content-center justify-content-md-start">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('assets/common-images/logo.png') }}" 
                            alt="Elite Canvas Logo" 
                            style="width: 160px; height: auto; object-fit: contain;">
                    </a>
                </div>

                {{-- Address Text --}}
                <p class="small text-center text-md-start" style="color: rgba(255,255,255,0.8);">
                    <i class="bi bi-geo-alt-fill me-2"></i>
                    Office Location: Dhaka, Bangladesh, 1207
                </p>
            </div> {{-- Fixed the </di" error here --}}
        
        <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-teal-custom">OUR COMPANY</h5>
                <p>Premium catering services for weddings, corporate events, and private parties. We bring taste to your special moments.</p>
            </div>

            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-teal-custom">Services</h5>
                <p><a href="#" class="text-white" style="text-decoration: none;">Wedding Catering</a></p>
                <p><a href="#" class="text-white" style="text-decoration: none;">Corporate Lunch</a></p>
                <p><a href="#" class="text-white" style="text-decoration: none;">Event Planning</a></p>
            </div>

            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-teal-custom">Contact</h5>
                <p><i class="bi bi-envelope mr-3"></i> owner@elitecanvas.com</p>
                <p><i class="bi bi-phone mr-3"></i> +8801731012053</p>
                <p><i class="bi bi-phone mr-3"></i> +8801711777102</p>
            </div>

        </div>

        <hr class="mb-4" style="border: 0; border-top: 2px solid black; opacity: 1;">

        <div class="row align-items-center justify-content-center">
            <div class="col-md-7 col-lg-8 text-center">
                <p class="text-white">© 2026 Copyright: <strong>Elite Canvas</strong>. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>