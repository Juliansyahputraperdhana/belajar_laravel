<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $product->name }} - Product Details</title>
    <style>
        /* Reset & Base Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    background: linear-gradient(135deg, #ffffffff 0%, #aaaaaaff 100%);
    min-height: 100vh;
    color: #000000ff;
    line-height: 1.6;
}

/* Container */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem 1rem;
}

/* Header Section */
.header-section {
    margin-bottom: 2rem;
}

.breadcrumb {
    margin-bottom: 1rem;
}

.back-link:hover {
    color: #0f172a;
}

.icon-back {
    width: 1.25rem;
    height: 1.25rem;
    margin-right: 0.25rem;
}

.page-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 0.5rem;
}

.page-subtitle {
    color: #000000ff;
    font-size: 1rem;
}

/* Product Card */
.product-card {
    background: white;
    border-radius: 1.5rem;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    overflow: hidden;
    border: 1px solid #e2e8f0;
}

/* Product Header */
.product-header {
    background: linear-gradient(135deg, #001570ff 0%, #000000ff 100%);
    padding: 2rem;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1.5rem;
}

.header-info .header-label {
    color: #ffffffff;
    font-size: 0.875rem;
    font-weight: 500;
    margin-bottom: 0.25rem;
}

.header-info .header-value {
    color: white;
    font-size: 1.75rem;
    font-weight: 700;
    letter-spacing: 0.05em;
}

.stock-badge {
    background: rgba(0, 13, 255, 0.2);
    backdrop-filter: blur(10px);
    border-radius: 2rem;
    padding: 1rem 1.5rem;
    text-align: center;
}

.stock-label {
    color: #ffffffff;
    font-size: 0.75rem;
    font-weight: 500;
    margin-bottom: 0.25rem;
}

.stock-value {
    color: white;
    font-size: 1.5rem;
    font-weight: 700;
}

/* Product Details */
.product-details {
    padding: 2rem;
}

.details-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
}

/* Detail Cards */
.detail-card {
    border-radius: 1rem;
    padding: 1.5rem;
    transition: transform 0.2s, box-shadow 0.2s;
}

.detail-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
}

.card-blue {
    background: linear-gradient(135deg, #ffffffff 0%, #0004ffff 200%);
    border: 1px solid #000000ff;
}

.card-green {
    background: linear-gradient(135deg, #ecfdf5 0%, #006100ff 200%);
    border: 1px solid #000000ff;
}

.card-yellow {
    background: linear-gradient(135deg, #fffbeb 0%, #833900ff 200%);
    border: 1px solid #000000ff;
}

.card-purple {
    background: linear-gradient(135deg, #faf5ff 0%, #350064ff 200%);
    border: 1px solid #000000ff;
}

.card-content {
    display: flex;
    gap: 1rem;
    align-items: flex-start;
}

.card-icon {
    border-radius: 0.75rem;
    padding: 0.75rem;
    flex-shrink: 0;
}

.icon-blue {
    background: #0003a4ff;
}

.icon-green {
    background: #006100ff;
}

.icon-yellow {
    background: #833900ff;
}

.icon-purple {
    background: #350064ff;
}

.icon {
    width: 1.5rem;
    height: 1.5rem;
    color: white;
    margin-top: 4px;
}

.card-content {
    display: flex;
    gap: 1rem;
    align-items: center; /* Ubah dari flex-start ke center */
}

.card-text {
    flex: 1;
}

.card-label {
    color: #0003a4ff;
    font-size: 0.875rem;
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.label-green {
    color: #006100ff;
}

.label-yellow {
    color: #833900ff;
}

.label-purple {
    color: #350064ff;
}

.card-value {
    color: #0f172a;
    font-size: 1.25rem;
    font-weight: 700;
}

.value-green {
    color: #006100ff;
}

.value-yellow {
    color: #833900ff;
}

.value-purple {
    color: #350064ff;
    font-family: 'Courier New', monospace;
}

/* Action Buttons */
.action-buttons {
    background: #000000ff;
    padding: 1.5rem 2rem;
    border-top: 1px solid #e2e8f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.btn {
    display: inline-flex;
    align-items: center;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    border-radius: 0.75rem;
    text-decoration: none;
    transition: all 0.2s;
    border: none;
    cursor: pointer;
    font-size: 0.95rem;
}

.btn-icon {
    width: 1rem;
    height: 1rem;
    margin-right: 0.5rem;
}

.btn-secondary {
    background: linear-gradient(135deg, #001570ff 0%, #000000ff 100%);
    color: #ffffffff;
    border: 2px solid #ffffffff;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
}

.btn-secondary:hover {
    background: linear-gradient(135deg, #005b09ff 0%, #000000ff 100%);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.btn-primary {
    background: linear-gradient(135deg, #001570ff 0%, #000000ff 100%);
    color: white;
    box-shadow: 0 10px 15px -3px rgba(255, 255, 255, 0.4);
}

.btn-primary:hover {
    background: linear-gradient(135deg, #005b09ff 0%, #000000ff 100%);
    box-shadow: 0 20px 25px -5px rgba(255, 255, 255, 0.5);
    transform: translateY(-2px);
}

/* Footer Info */
.footer-info {
    margin-top: 1.5rem;
    text-align: center;
    color: #000000ff;
    font-size: 0.875rem;
}

/* Responsive */
@media (max-width: 768px) {
    .page-title {
        font-size: 2rem;
    }
    
    .header-content {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .stock-badge {
        width: 100%;
    }
    
    .details-grid {
        grid-template-columns: 1fr;
    }
    
    .action-buttons {
        flex-direction: column;
        align-items: stretch;
    }
    
    .btn {
        justify-content: center;
        width: 100%;
    }
}

@media (max-width: 480px) {
    .container {
        padding: 1rem 0.75rem;
    }
    
    .product-header,
    .product-details,
    .action-buttons {
        padding: 1.5rem 1rem;
    }
    
    .page-title {
        font-size: 1.75rem;
    }
}
    </style>
</head>

<body>

<div class="container">
    
    <!-- Header Section -->
    <div class="header-section">
    <h1 class="page-title">{{ $product->name }}</h1>
    <p class="page-subtitle">Informasi dan detail produk</p>
    </div>

    <!-- Main Content Card -->
    <div class="product-card">
        
        <!-- Product Header -->
        <div class="product-header">
            <div class="header-content">
                <div class="header-info">
                    <p class="header-label">Kode Produk</p>
                    <p class="header-value">{{ $product->code }}</p>
                </div>
                <div class="stock-badge">
                    <p class="stock-label">Status Stok</p>
                    <p class="stock-value">{{ $product->stock }}</p>
                </div>
            </div>
        </div>

        <!-- Product Details Grid -->
        <div class="product-details">
            <div class="details-grid">
                
                <!-- Product Name Card -->
                <div class="detail-card card-blue">
                    <div class="card-content">
                        <div class="card-icon icon-blue">
                            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <div class="card-text">
                            <p class="card-label">Nama Produk</p>
                            <p class="card-value">{{ $product->name }}</p>
                        </div>
                    </div>
                </div>

                <!-- Price Card -->
                <div class="detail-card card-green">
                    <div class="card-content">
                        <div class="card-icon icon-green">
                            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="card-text">
                            <p class="card-label label-green">Harga</p>
                            <p class="card-value value-green">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Stock Card -->
                <div class="detail-card card-yellow">
                    <div class="card-content">
                        <div class="card-icon icon-yellow">
                            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div class="card-text">
                            <p class="card-label label-yellow">Stok Tersedia</p>
                            <p class="card-value value-yellow">{{ $product->stock }} units</p>
                        </div>
                    </div>
                </div>

                <!-- Product Code Card -->
                <div class="detail-card card-purple">
                    <div class="card-content">
                        <div class="card-icon icon-purple">
                            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                            </svg>
                        </div>
                        <div class="card-text">
                            <p class="card-label label-purple">Kode Produk</p>
                            <p class="card-value value-purple">{{ $product->code }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ route('product.index') }}" class="btn btn-secondary">
                <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Daftar
            </a>
            
            <a href="{{ route('product.edit', $product) }}" class="btn btn-primary" id="edit-product-btn">
                <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Produk
            </a>
        </div>

    </div>

    <!-- Additional Info Footer -->
    <div class="footer-info">
        <strong>Tutorial Design CRUD Laravel 12</strong>
    </div>

</div>

</body>

</html>