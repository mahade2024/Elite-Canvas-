<!DOCTYPE html>
<html lang="en">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elite Canvas</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* =========================================
           1. LAYOUT (master.blade.php)
           ========================================= */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            background-color: #f8f9fa; /* Light grey background for the whole site */
        }
        .main-content {
            flex: 1;
        }
        

       /* Header Nav bar (header.blade.php) */
            .navbar-nav .nav-link {
                color: #F7F5F2 !important;      /* Forces text to be white */
                opacity: 1 !important;        /* Removes Bootstrap's default transparency */
                font-family: 'Montserrat', sans-serif; /* Standard way to call the font family */
                font-weight: 500;             /* Defines the thickness of the text */
                font-size: 14px;              /* Standard size for nav links */
                text-transform: uppercase;    /* Optional: usually matches 'Elite' branding */
            }

        .navbar-nav .nav-link:hover {
            color: #1BA8A8 !important; /* Optional: text turns white when you hover */
        } 

        /* Serch Bar */
            .custom-search-input {
                color: #F7F5F2; /* Dark text so they can see what they type */
                background-color: #F7F5F2; 
            }

            .custom-search-input::placeholder {
                color: #1BA8A8; /* Using your teal brand color for the hint */
                opacity: 1; 
            }

        /* =========================================
           2. LOGIN PAGE (login.blade.php)
           ========================================= */
        .page-bg {
            background-color: #F7F5F2; /* Pink Background */
            min-height: calc(100vh - 100px); /* Adjusts for header/footer */
            width: 100%;
            display: flex;
            align-items: center; 
            justify-content: center;
        }
        .login-card {
            background-color: #b1ca3a; /* Lime Green Card */
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        /* --- Hero Carousel Styles --- */

        .hero-container {
            margin-top: -1px; /* Prevents tiny white gaps at the top */
        }

        .hero-img {
            height: 600px;
            width: 100vw;
            object-fit: cover; /* Ensures image fills space without stretching */
        }

        /* Vertical and Horizontal Centering for Captions */
        .hero-caption {
            display: flex !important;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            bottom: 0 !important;
            left: 0 !important;
            right: 0 !important;
            background: linear-gradient(to top, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0) 100%);
        }

        .hero-title {
            text-shadow: 2px 2px 8px rgba(0,0,0,0.7);
        }

        .hero-subtitle {
            text-shadow: 1px 1px 4px rgba(0,0,0,0.5);
        }

        /* Custom Order Button */
        .btn-hero-order {
            background-color: #1BA8A8;
            color: white !important;
            padding: 10px 30px;
            border-radius: 50px;
            font-weight: 600;
            border: none;
            transition: 0.3s ease-in-out;
        }

        .btn-hero-order:hover {
            background-color: #148a8a;
            transform: scale(1.05);
        }

        /* Circular Carousel Controls */
        .hero-control-icon {
            padding: 1.2rem;
            background-color:  #1BA8A8;
            border-radius: 50%;
            background-size: 20px 20px;
        }

        /* Fix for mobile screens */
        @media (max-width: 768px) {
            .hero-img {
                height: 400px; /* Shorter height for mobile */
            }
            .hero-title {
                font-size: 2rem;
            }
        }


        /* =========================================
           3. Products SLIDER SECTION (product.blade.php)
           ========================================= */

        body {
        background-color: #F7F5F2;

        .slider-img {
            height: 400px !important;
            object-fit: cover; 
            border-radius: 10px;
        }
        .slider-text {
            background-color: rgba(0, 0, 0, 0.4); 
            border-radius: 10px;
            padding: 15px;
            bottom: 30px;
        }

       
           /* Custom Clothing Carousel Styling (product.blade.php)*/
            .carousel-img-container {
                height: 400px; /* Standard height for clothing display */
                background-color: #f8f9fa;
            }

            .slider-img {
                height: 100%;
                width: 100%;
                object-fit: contain; /* Shows the full outfit without cropping parts of the dress */
                background-color: #f8f9fa;
            }

            .bg-dark-overlay {
                background: rgba(0, 0, 0, 0.6); /* Makes text readable over bright clothing colors */
                backdrop-filter: blur(5px);
                max-width: 80%;
                margin: 0 auto 20px auto;
            }

            .text-teal {
                color: #1BA8A8 !important;
            }

            @media (max-width: 768px) {
                .carousel-img-container {
                    height: 350px;
                }
                .slider-text h3 {
                    font-size: 1.2rem;
                }
            }
           
        /* Force 5 columns on large screens */
        @media (min-width: 90vw) {
            .five-cols > .col-xl-custom-5 {
                flex: 0 0 20%;
                max-width: 20%;
            }
        }

        .trending-wrapper {
            margin: 40px auto;
            padding: 0 15px;
            max-width: 90vw;
        }
        .trending-item {
            margin-bottom: 30px;
            text-align: center;
            transition: transform 0.3s ease;
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .trending-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .trending-image {
            width: 100%;
            /* 280px is usually perfect for 4-column layouts, 200px for mobile */
            height: 280px; 
            object-fit: cover;    /* Crops the image to fill the space without stretching */
            object-position: top; /* Focuses on the top of the outfit/garment */
            display: block;
        }

        /* Adjust height for mobile screens to keep them from being too tall */
        @media (max-width: 576px) {
            .trending-image {
                height: 180px; 
            }
        }

        .trending-item {
            transition: transform 0.2s ease-in-out;
        }

        .trending-item:hover {
            transform: translateY(-5px); /* Adds a subtle lift effect on hover */
        }
        .price-text {
            font-size: 1.1rem;      /* Slightly larger than the title */
            color: #1BA8A8;         /* Your signature teal */
            letter-spacing: -0.5px; /* Tighter look common in premium brands */
        }

       
        /* Quick View Button Style */
        .btn-outline-teal {
            color: #086d7e;
            border: 2px solid #086d7e;
            background-color: transparent;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            border-radius: 4px;
        }

        .btn-outline-teal:hover {
            background-color: #086d7e;
            color: #ffffff !important;
            box-shadow: 0 4px 8px rgba(8, 109, 126, 0.3);
            transform: translateY(-1px);
        }

        /* testimonil */
        /* Testimonial Avatar Styles */
            .testimonial-avatar {
                width: 150px;
                height: 150px;
                object-fit: cover;
                border-radius: 50%;
                margin-bottom: 1.5rem;
            }

            .shadow-1-strong {
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            }

            /* Quote Icon Spacing */
            .quote-icon {
                padding-right: 0.5rem; /* Equivalent to pe-2 */
            }

            /* Star Rating Colors */
            .text-warning {
                color: #ffc107 !important;
            }

            /* Positioning the arrows at the ends */
            .side-arrow {
                width: 50px;
                height: 50px;
                background-color: #fff; /* White circle */
                border-radius: 50%;
                color: #1BA8A8; /* Your Teal Color */
                opacity: 1 !important;
                top: 50%;
                transform: translateY(-50%); /* Centers vertically */
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                border: none;
                z-index: 10;
            }

            /* Push to the extreme ends */
            .carousel-control-prev.side-arrow {
                left: 30px; /* Pulls it slightly outside the container for a clean look */
            }

            .carousel-control-next.side-arrow {
                right: 30px;
            }

            /* Arrow Icon Styles */
            .side-arrow i {
                font-size: 1.5rem;
                font-weight: bold;
            }

            .side-arrow:hover {
                background-color: #1BA8A8;
                color: #fff;
                transition: 0.3s;
            }



        /* --- detail.blade.php Styles --- */
            .btn-variant-box {
        border: 1px solid #086d7e;
        color: #086d7e;
        font-size: 13px;
        border-radius: 2px;
        padding: 5px 12px;
        }
        .btn-check:checked + .btn-variant-box {
            background-color: #086d7e;
            color: white;
        }
        .price-display {
            font-size: 32px;
            font-weight: bold;
            color: #d9534f;
            background: #f8d7da;
            padding: 5px 20px;
            border-radius: 4px;
        }
        .btn-teal { background-color: #086d7e; }
        .btn-teal:hover { background-color: #065461; }
        .text-teal { color: #086d7e; }
        
        .thumb-box { width: 80px; height: 80px; cursor: pointer; padding: 2px; }
        .active-thumb { border: 2px solid #086d7e !important; }
        
        .quantity-input input::-webkit-outer-spin-button,
        .quantity-input input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }

        #mainImage {
                        transition: opacity 0.3s ease-in-out;
                        object-fit: cover;
                        
                    }

                    .active-thumb {
                        border: 2px solid #008080 !important; /* Teal highlight */
                    }
        
        /* cartlist.blade.php--General Cart Container */
        
       
        .cart-table thead { background-color: #f8f9fa; border-top: 2px solid #086d7e; }
        .cart-product-img { width: 80px; height: 80px; object-fit: cover; border-radius: 5px; }
        .btn-qty { background: #eee; border: 1px solid #ddd; width: 30px; height: 30px; cursor: pointer; }
        .qty-input { width: 40px; text-align: center; border: 1px solid #ddd; height: 30px; margin: 0 -5px; }
        .btn-checkout { background-color: #086d7e; color: white; padding: 10px 30px; font-weight: bold; }
        .btn-checkout:hover { background-color: #065461; color: white; }
        .remove-link { text-decoration: none; font-size: 12px; }


        /* Checkout Theme Colors */
        .btn-submit-order {
            background-color: #006b7d; /* Teal Color from your image */
            color: white;
            padding: 12px;
            font-size: 1.1rem;
            font-weight: bold;
            border: none;
            border-radius: 4px;
        }

        .btn-submit-order:hover {
            background-color: #005a69;
            color: white;
        }

        /* Form Controls */
        .form-control, .form-select {
            border: 1px solid #ced4da;
            border-radius: 2px;
            padding: 10px;
        }

        .input-group-text {
            background-color: #f8f9fa;
            color: #6c757d;
        }

        /* Cart Summary Sidebar */
        .cart-summary-box {
            border-radius: 4px;
        }

        .text-info {
            color: #17a2b8 !important;
        }
        /*myorders.blade.php*/
            .hover-shadow:hover {
        transform: translateY(-2px);
        transition: 0.3s;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .border-dashed {
        border: 2px dashed #dee2e6;
    }


        /* about.blade.php --- About US Page */

        /* Individual Hero Section CSS */
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                    url('{{ asset('images/1.png') }}'); /* Replace with your image path */
        background-size: cover;
        background-position: center;
        background-attachment: fixed; /* Parallax effect */
        height: 60vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        text-shadow: 2px 2px 10px rgba(0,0,0,0.5);
    }

    .hero-subtitle {
        font-size: 1.25rem;
        max-width: 700px;
        margin: 20px auto;
    }
         .about-header {
        color: #1aa1a5;
        }

        .step-card {
            transition: all 0.3s ease;
            border-left: 5px solid #1aa1a5 !important;
        }

        .step-card:hover {
            transform: translateX(10px);
            background-color: #f0f9f9;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
        }

        .feature-img {
            transition: transform 0.5s ease;
        }

        .feature-img:hover {
            transform: scale(1.03);
        }

        .menu-card {
            border: none;
            border-radius: 15px;
            transition: 0.3s;
        }

        .menu-card:hover {
            background-color: #ffffff;
            box-shadow: 0 8px 20px rgba(26, 161, 165, 0.15) !important;
        }

        .text-brand {
            color: #1aa1a5 !important;
        }

        .bg-brand-light {
            background-color: rgba(26, 161, 165, 0.05);
        }
        /* services.blade.php --Services Page Specific Styling */
                /* Individual Hero CSS for Services */
        .services-hero {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                        url('{{ asset('images/2.png') }}'); /* Ensure this path is correct */
            background-size: cover;
            background-position: center;
            padding: 100px 0;
            color: white;
            margin-bottom: -50px; /* Pulls cards slightly up into the hero area for modern look */
        }

        .service-card {
            border-radius: 20px !important;
            transition: all 0.3s ease-in-out;
            border: none !important;
            background: white;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15) !important;
        }

        .icon-box {
            width: 80px;
            height: 80px;
            background: rgba(26, 161, 165, 0.1);
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
        }

        .service-card:hover .icon-box {
            background: #1aa1a5;
        }

        .service-card:hover .icon-box i {
            color: white !important;
        }

        body {
    background-color: #F7F5F2;
        }

        /* adminproducts.blade.php --Description Styling */
                
                .description-textarea {
            resize: vertical;      /* Allows the user to drag the bottom edge to resize */
            min-height: 400px;     /* Starts comfortably large */
            width: 100%;
        }
        /* footer.blade.php*/
        .text-teal-custom {
            color: #1BA8A8 !important;
        }

    </style>
    @yield('styles')
</head>
<body>
    {{ View::make('header') }}

    <div class="main-content">
        @yield("content") 
    </div>

    {{ View::make('footer') }}

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>