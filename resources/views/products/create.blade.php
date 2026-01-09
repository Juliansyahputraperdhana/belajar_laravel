<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Create New Product - Tutorial CRUD Laravel 12</title>
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
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem 1rem;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Header Section */
        .header-section {
            background: rgba(134, 231, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
        }

        .title-primary {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #000000ff, #000000ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
            margin-bottom: 0.5rem;
        }

        .subtitle {
            color: #000000ff;
            font-size: 1rem;
            font-weight: 400;
        }

        /* Form Container */
        .form-container {
            background: rgba(134, 231, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 1);
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 2rem;
            position: relative;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            font-size: 0.875rem;
            color: #000000ff;
            margin-bottom: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .label-icon {
            color: #000399ff;
            font-size: 1rem;
        }

        /* Input Styling */
        .form-input {
            width: 100%;
            padding: 1rem 1.25rem 1rem 3rem;
            font-size: 1rem;
            color: #000000ff;
            background: #ffffffff;
            border: 2px solid #000000ff;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #000000ff;
            font-size: 1rem;
            z-index: 10;
            transition: color 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #007a0eff;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            background: #fefefe;
        }

        .form-input:focus + .input-icon {
            color: #007a0eff;
        }

        .form-input::placeholder {
            color: #000000ff;
            font-style: italic;
        }

        /* Error Styling */
        .error-message {
            background: linear-gradient(135deg, #9c0000ff, #9c0000ff);
            color: white;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin-top: 0.5rem;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            animation: slideDown 0.3s ease;
        }

        .error-message::before {
            content: '\f071';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-input.error {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        /* Button Styling */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            padding: 1rem 2rem;
            border-radius: 12px;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            letter-spacing: 0.05em;
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
            background: linear-gradient(135deg, #000000ff, #000000ff);
            color: white;
            box-shadow: 0 10px 15px -3px rgba(255, 255, 255, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(255, 255, 255, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #000000ff, #000000ff);
            color: white;
            box-shadow: 0 10px 15px -3px rgba(255, 255, 255, 0.4);
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(255, 255, 255, 0.4);
        }

        /* Loading Animation */
        .loading {
            position: relative;
        }

        .loading::after {
            content: '';
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            border: 2px solid transparent;
            border-top: 2px solid currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: translateY(-50%) rotate(360deg); }
        }

        /* Form Validation Success */
        .form-input.success {
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .success-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #10b981;
            font-size: 1rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .page-container {
                padding: 1rem 0.5rem;
            }

            .header-section {
                padding: 1.5rem;
                border-radius: 15px;
            }

            .form-container {
                padding: 2rem;
                border-radius: 15px;
            }

            .title-primary {
                font-size: 2rem;
            }

            .button-group {
                flex-direction: column;
            }

            .btn {
                justify-content: center;
                width: 100%;
            }
        }

        /* Focus Ring for Accessibility */
        .btn:focus,
        .form-input:focus {
            outline: 2px solid #667eea;
            outline-offset: 2px;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 2px;
            transition: width 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="page-container">
        <!-- Header Section -->
        <div class="header-section">
            <h1 class="title-primary">
                <i class="fas fa-plus-circle" style="margin-right: 0.5rem; color: #667eea;"></i>
                Buat Produk Baru
            </h1>
            <p class="subtitle">Tambahkan produk baru ke inventaris Anda</p>
        </div>

        <!-- Form Container -->
        <div class="form-container">
            <!-- Progress Indicator -->
            <div class="form-progress">
                <div class="progress-bar" style="width: 0%" id="formProgress"></div>
            </div>

            <form action="{{ route('product.store') }}" method="POST" id="productForm">
                @csrf

                <!-- Product Name -->
                <div class="form-group">
                    <label class="form-label" for="name">
                        <i class="fas fa-tag label-icon"></i>
                        Nama Produk
                    </label>
                    <div class="input-wrapper">
                        <input 
                            type="text" 
                            class="form-input @error('name') error @enderror" 
                            name="name" 
                            id="name"
                            value="{{ old('name') }}" 
                            placeholder="Masukkan nama produk..."
                            required>
                        <i class="fas fa-tag input-icon"></i>
                        @if(!$errors->has('name') && old('name'))
                            <i class="fas fa-check success-icon"></i>
                        @endif
                    </div>
                    @error('name')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Product Code -->
                <div class="form-group">
                    <label class="form-label" for="code">
                        <i class="fas fa-barcode label-icon"></i>
                        Kode Produk
                    </label>
                    <div class="input-wrapper">
                        <input 
                            type="text" 
                            class="form-input @error('code') error @enderror" 
                            name="code" 
                            id="code"
                            value="{{ old('code') }}" 
                            placeholder="Masukkan kode produk..."
                            required>
                        <i class="fas fa-barcode input-icon"></i>
                        @if(!$errors->has('code') && old('code'))
                            <i class="fas fa-check success-icon"></i>
                        @endif
                    </div>
                    @error('code')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Price -->
                <div class="form-group">
                    <label class="form-label" for="price">
                        <i class="fas fa-dollar-sign label-icon"></i>
                        Harga
                    </label>
                    <div class="input-wrapper">
                        <input 
                            type="number" 
                            step="0.01"
                            class="form-input @error('price') error @enderror" 
                            name="price" 
                            id="price"
                            value="{{ old('price') }}" 
                            placeholder="0.00"
                            required>
                        <i class="fas fa-dollar-sign input-icon"></i>
                        @if(!$errors->has('price') && old('price'))
                            <i class="fas fa-check success-icon"></i>
                        @endif
                    </div>
                    @error('price')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Stock -->
                <div class="form-group">
                    <label class="form-label" for="stock">
                        <i class="fas fa-cubes label-icon"></i>
                        Kuantitas Stok
                    </label>
                    <div class="input-wrapper">
                        <input 
                            type="number" 
                            class="form-input @error('stock') error @enderror" 
                            name="stock" 
                            id="stock"
                            value="{{ old('stock') }}" 
                            placeholder="Masukkan jumlah stok..."
                            required>
                        <i class="fas fa-cubes input-icon"></i>
                        @if(!$errors->has('stock') && old('stock'))
                            <i class="fas fa-check success-icon"></i>
                        @endif
                    </div>
                    @error('stock')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="button-group">
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <i class="fas fa-save"></i>
                        Simpan Produk
                    </button>
                    <a href="{{ route('product.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Kembali ke Daftar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Form Progress Tracking
        const form = document.getElementById('productForm');
        const inputs = form.querySelectorAll('input[required]');
        const progressBar = document.getElementById('formProgress');
        const submitBtn = document.getElementById('submitBtn');

        function updateProgress() {
            const filledInputs = Array.from(inputs).filter(input => input.value.trim() !== '');
            const progress = (filledInputs.length / inputs.length) * 100;
            progressBar.style.width = progress + '%';
        }

        // Add event listeners to inputs
        inputs.forEach(input => {
            input.addEventListener('input', updateProgress);
            input.addEventListener('blur', updateProgress);
        });

        // Form submission handling
        form.addEventListener('submit', function() {
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;
            setTimeout(() => {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
            }, 100);
        });

        // Auto-format price input
        const priceInput = document.getElementById('price');
        priceInput.addEventListener('input', function() {
            let value = this.value;
            if (value && !isNaN(value)) {
                // Ensure two decimal places
                value = parseFloat(value).toFixed(2);
                if (value !== this.value) {
                    this.value = value;
                }
            }
        });

        // Auto-format code input (uppercase)
        const codeInput = document.getElementById('code');
        codeInput.addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });

        // Initial progress check
        updateProgress();

        // Real-time validation
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                const inputWrapper = this.parentElement;
                const successIcon = inputWrapper.querySelector('.success-icon');
                
                if (this.value.trim() !== '' && this.checkValidity()) {
                    this.classList.add('success');
                    this.classList.remove('error');
                    
                    if (!successIcon && !this.closest('.form-group').querySelector('.error-message')) {
                        const icon = document.createElement('i');
                        icon.className = 'fas fa-check success-icon';
                        inputWrapper.appendChild(icon);
                    }
                } else {
                    this.classList.remove('success');
                    if (successIcon) {
                        successIcon.remove();
                    }
                }
            });
        });
    </script>
</body>
</html>
