<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elite Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { background-color: #f4f7f6; margin: 0; padding: 0; display: flex; }
        
        /* Fixed Sidebar */
        .sidebar { 
            height: 100vh; 
            width: 260px; 
            position: fixed; 
            top: 0; 
            left: 0; 
            background-color: #1e2227; 
            z-index: 1000; 
        }

        .sidebar a { 
            padding: 15px 25px; 
            display: block; 
            color: #a0a6ad; 
            text-decoration: none; 
            transition: 0.3s;
        }

        .sidebar a:hover, .sidebar a.active { 
            background: #2c3138; 
            color: #fff; 
            border-left: 4px solid #1aa1a5; 
        }

        /* Main Content area takes up ALL remaining space */
        .main-content { 
            margin-left: 260px; /* Push content past the fixed sidebar */
            width: calc(100% - 260px); 
            min-height: 100vh;
            padding: 40px;
            display: flex;
            justify-content: center; /* This centers the table horizontally */
        }

        /* Container that holds the table */
        .admin-wrapper {
            width: 100%;
            max-width: 1500px; /* Keeps the table from getting too wide on huge monitors */
        }

        .object-fit-cover { object-fit: cover; }
        .



    </style>
</head>
<body>

    <div class="sidebar shadow">
        <div class="py-4 px-4 mb-3">
            <h4 class="text-white fw-bold m-0">ELITE <span style="color: #1aa1a5;">ADMIN</span></h4>
        </div>
        
        <a href="/admin/orders" class="{{ Request::is('admin/orders') ? 'active' : '' }}">
            <i class="bi bi-cart-check me-2"></i> Orders
        </a>
        
        <a href="/admin/products" class="{{ Request::is('admin/products') ? 'active' : '' }}">
            <i class="bi bi-box-seam me-2"></i> Add Products
        </a>
        
        <div class="mt-4 px-3"><hr class="text-secondary"></div>
        <a href="/"><i class="bi bi-house-door me-2"></i> Back to Shop</a>
        <a href="/logout" class="text-danger mt-4"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
    </div>

    <div class="main-content">
        <div class="admin-wrapper">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>