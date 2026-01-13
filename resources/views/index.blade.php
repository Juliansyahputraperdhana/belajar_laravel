<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk Elektronik CRUD Laravel 12</title>
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
            background: linear-gradient(135deg, #00118eff 0%, #00bfffff 100%);
            min-height: 100vh;
            color: #1e293b;
            line-height: 1.6;
        }

        .page-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        /* Header Section */
        .header-section {
            background: rgba(149, 244, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2);
            border: 2px solid #000000;
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
            color: #000000;
            display: flex;
            align-items: center;
        }

        /* Button Styles */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
        }

        .btn-primary { background: #0c00e7; color: white; }
        .btn-view { background: #0c00e7; color: white; padding: 0.5rem 0.8rem; }
        .btn-edit { background: #00a038; color: white; padding: 0.5rem 0.8rem; }
        .btn-delete { background: #a30000; color: white; padding: 0.5rem 0.8rem; }

        .btn:hover {
            transform: translateY(-2px);
            filter: brightness(1.2);
        }

        /* Table Container & Grid Styles */
        .table-container {
            background: rgba(149, 244, 255, 0.95);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3);
            border: 2px solid #000000;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse; /* Membuat garis antar sel menyatu */
            background: transparent;
        }

        /* Header Tabel dengan Garis */
        .table-thead th {
            background: #000000;
            color: #ffffff;
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 1.25rem 1rem;
            text-align: left;
            border: 1px solid #484848; /* Garis lurus pembatas header */
        }

        /* Sel Tabel dengan Garis Lurus */
        .table-cell {
            padding: 1rem;
            border: 1px solid #000000; /* Garis lurus pembatas antar kolom dan baris */
            font-size: 0.875rem;
            vertical-align: middle;
            color: #000000;
        }

        .table-row {
            transition: background 0.2s;
        }

        .table-row:hover {
            background: rgba(0, 132, 255, 0.1);
        }

        /* Badges & Decorators */
        .number-badge {
            background: #000000;
            color: white;
            padding: 0.25rem 0.6rem;
            border-radius: 50%;
            font-size: 0.75rem;
        }

        .stock-badge {
            background: #008f13;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.75rem;
        }

        .price-display {
            font-weight: 800;
            color: #0300b4;
        }

        code {
            background: #e2e8f0;
            padding: 0.2rem 0.4rem;
            border-radius: 4px;
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            gap: 0.4rem;
            justify-content: center;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-grid { grid-template-columns: 1fr; text-align: center; }
            .title-primary { justify-content: center; font-size: 1.8rem; }
            .action-buttons { flex-direction: column; }
        }
    </style>
</head>
<body>

    <div class="page-container">
        <div class="header-section">
            <div class="header-grid">
                <div>
                    <h1 class="title-primary">
                        <i class="fas fa-box-open" style="margin-right: 1rem; color: #0c00e7;"></i>
                        Manajemen Produk Elektronik Yang Berkualitas
                    </h1>
                    <p style="margin-top: 0.5rem; color: #475569;">
                        Di kelola ini inventaris produk elektronik dengan sistem tabel terstruktur.
                    </p>
                </div>
                <div>
                    <a href="{{ route('product.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambahkan Produk Baru
                    </a>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div style="background: #00a038; color: white; padding: 1rem; border-radius: 10px; margin-bottom: 1.5rem; border: 2px solid #000;">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div class="table-container">
            <div class="table-wrapper">
                <table class="custom-table">
                    <thead class="table-thead">
                        <tr>
                            <th style="width: 50px; text-align: center;">No</th>
                            <th><i class="fas fa-tag"></i> Nama Produk</th>
                            <th><i class="fas fa-barcode"></i> Kode</th>
                            <th><i class="fas fa-cubes"></i> Stok</th>
                            <th><i class="fas fa-dollar-sign"></i> Harga</th>
                            <th style="text-align: center;"><i class="fas fa-cogs"></i> Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="table-row">
                                <td class="table-cell" style="text-align: center;">
                                    <span class="number-badge">{{ $loop->iteration }}</span>
                                </td>
                                <td class="table-cell" style="font-weight: 700;">
                                    {{ $product->name }}
                                </td>
                                <td class="table-cell">
                                    <code>{{ $product->code }}</code>
                                </td>
                                <td class="table-cell">
                                    <span class="stock-badge">{{ number_format($product->stock) }} units</span>
                                </td>
                                <td class="table-cell">
                                    <span class="price-display">${{ number_format($product->price, 2) }}</span>
                                </td>
                                <td class="table-cell">
                                    <div class="action-buttons">
                                        <a href="{{ route('product.show', $product) }}" class="btn btn-view" title="View">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        <a href="{{ route('product.edit', $product) }}" class="btn btn-edit" title="Edit">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');" 
                                              action="{{ route('product.destroy', $product) }}" 
                                              method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete" title="Delete">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="table-cell" style="text-align: center; padding: 4rem;">
                                    <i class="fas fa-inbox" style="font-size: 3rem; color: #cbd5e1; display: block; margin-bottom: 1rem;"></i>
                                    <p style="color: #64748b; font-weight: 600;">Belum ada produk tersedia.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div style="margin-top: 1.5rem;">
            {{ $products->links() }}
        </div>
    </div>

</body>
</html>