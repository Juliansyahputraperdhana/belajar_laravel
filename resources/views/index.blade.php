<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List - CRUD Laravel 12</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Reset & Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #001570ff 0%, #000000ff 100%);
            min-height: 100vh;
            color: #000000ff;
            line-height: 1.6;
        }

        .page-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        /* Header Styles */
        .header-section {
            background: rgba(149, 244, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 1);
        }

        .header-grid {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 2rem;
            align-items: center;
        }

        .title-primary {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #000000ff, #000000ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
        }

        /* Button Styles */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, #0c00e7ff, #0c00e7ff);
            color: white;
            box-shadow: 0 10px 15px -3px rgba(0, 225, 255, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(79, 70, 229, 0.4);
        }

        .btn-view {
            background: linear-gradient(135deg, #0c00e7ff, #0c00e7ff);
            color: white;
            padding: 0.5rem 1rem;
            font-size: 0.75rem;
        }

        .btn-edit {
            background: linear-gradient(135deg, #00a038ff, #00a038ff);
            color: white;
            padding: 0.5rem 1rem;
            font-size: 0.75rem;
        }

        .btn-delete {
            background: linear-gradient(135deg, #a30000ff, #a30000ff);
            color: white;
            padding: 0.5rem 1rem;
            font-size: 0.75rem;
        }

        .btn-view:hover, .btn-edit:hover, .btn-delete:hover {
            transform: translateY(-1px);
            filter: brightness(110%);
        }

        /* Card & Table Container */
        .table-container {
            background: rgba(149, 244, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 8, 255, 0.2);
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .custom-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-thead th {
            background: linear-gradient(135deg, #000000ff, #000000ff);
            color: #ffffffff;
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 1.5rem 1.5rem;
            text-align: left;
            border-bottom: 2px solid #484848ff;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .table-thead th:first-child {
            border-top-left-radius: 20px;
        }

        .table-thead th:last-child {
            border-top-right-radius: 20px;
            text-align: center;
        }

        .table-row {
            transition: all 0.2s ease;
        }

        .table-row:hover {
            background: linear-gradient(135deg, #0084ffff, #0084ffff);
            transform: scale(1.01);
        }

        .table-cell {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #000000ff;
            font-size: 0.875rem;
            vertical-align: middle;
        }

        .table-row:last-child .table-cell {
            border-bottom: none;
        }

        /* Action Buttons Container */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* Alert Styles */
        .alert-success {
            background: linear-gradient(135deg, #0a00ccff, #0a00ccff);
            color: white;
            padding: 1.25rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.4);
        }

        .alert-success::before {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 1.25rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #64748b;
        }

        .empty-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .page-container {
                padding: 1rem 0.5rem;
            }

            .header-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
                text-align: center;
            }

            .title-primary {
                font-size: 2rem;
            }

            .header-section {
                padding: 1.5rem;
                border-radius: 15px;
            }

            .table-container {
                border-radius: 15px;
            }

            .table-thead th:first-child {
                border-radius: 0;
            }

            .table-thead th:last-child {
                border-radius: 0;
            }

            .table-thead th,
            .table-cell {
                padding: 1rem 0.75rem;
            }

            .action-buttons {
                flex-direction: column;
                gap: 0.25rem;
            }

            .btn-view, .btn-edit, .btn-delete {
                padding: 0.5rem;
                font-size: 0.7rem;
            }
        }

        /* Number Badge */
        .number-badge {
            background: linear-gradient(135deg, #000000ff, #000000ff);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.75rem;
        }

        /* Price Display */
        .price-display {
            font-weight: 700;
            color: #0300b4ff;
        }

        /* Stock Badge */
        .stock-badge {
            background: linear-gradient(135deg, #008f13ff, #008f13ff);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.75rem;
        }
    </style>
</head>
<body>
    <div class="page-container">
        <!-- Header Section -->
        <div class="header-section">
            <div class="header-grid">
                <div>
                    <h1 class="title-primary">
                        <i class="fas fa-box-open" style="margin-right: 0.5rem; color: #667eea;"></i>
                        Manajemen Produk
                    </h1>
                    <p style="margin-top: 0.5rem; color: #64748b; font-size: 1rem;">
                        Kelola inventaris produk Anda dengan mudah.
                    </p>
                </div>
                <div>
                    <a href="{{ route('product.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Tambahkan Produk Baru
                    </a>
                </div>
            </div>
        </div>

        <!-- Success Alert -->
        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table Container -->
        <div class="table-container">
            <div class="table-wrapper">
                <table class="custom-table">
                    <thead class="table-thead">
                        <tr>
                            <th><i class="#" style="margin-right: 0.5rem;"></i>No</th>
                            <th><i class="fas fa-tag" style="margin-right: 0.5rem;"></i>Nama Produk</th>
                            <th><i class="fas fa-barcode" style="margin-right: 0.5rem;"></i>Kode</th>
                            <th><i class="fas fa-cubes" style="margin-right: 0.5rem;"></i>Stok</th>
                            <th><i class="fas fa-dollar-sign" style="margin-right: 0.5rem;"></i>Harga</th>
                            <th><i class="fas fa-cogs" style="margin-right: 0.5rem;"></i>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="table-row">
                                <td class="table-cell">
                                    <span class="number-badge">{{ $loop->iteration }}</span>
                                </td>
                                <td class="table-cell">
                                    <div style="font-weight: 600; color: #1e293b;">{{ $product->name }}</div>
                                </td>
                                <td class="table-cell">
                                    <code style="background: #f1f5f9; padding: 0.25rem 0.5rem; border-radius: 6px; font-size: 0.75rem;">
                                        {{ $product->code }}
                                    </code>
                                </td>
                                <td class="table-cell">
                                    <span class="stock-badge">{{ $product->stock }} units</span>
                                </td>
                                <td class="table-cell">
                                    <span class="price-display">${{ number_format($product->price, 2) }}</span>
                                </td>
                                <td class="table-cell">
                                    <div class="action-buttons">
                                        <a href="{{ route('product.show', $product) }}" class="btn btn-view">
                                            <i class="fas fa-eye"></i>
                                            View
                                        </a>
                                        <a href="{{ route('product.edit', $product) }}" class="btn btn-edit">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </a>
                                        <form onsubmit="return confirm('Are you sure you want to delete this product?');" 
                                              action="{{ route('product.destroy', $product) }}" 
                                              method="POST" 
                                              style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete">
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="table-cell">
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <i class="fas fa-inbox"></i>
                                        </div>
                                        <h3 style="margin-bottom: 0.5rem; color: #64748b;">No Products Found</h3>
                                        <p style="color: #94a3b8;">Start by adding your first product to the inventory.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            {{ $products->links() }}
        </div>
    </div>
</body>
</html>
