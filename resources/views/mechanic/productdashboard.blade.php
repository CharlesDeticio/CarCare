<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carcare - Online Service Provider for your Car Needs</title>

    <!-- Font Awesome & Boxicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/style2.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        :root {
            --primary-color: #4361ee;
            --primary-hover: #3a56d4;
            --danger-color: #f72585;
            --danger-hover: #e5177b;
            --success-color: #4cc9f0;
            --success-hover: #3ab5d9;
            --warning-color: #ff9e00;
            --warning-hover: #e68f00;
            --light-bg: #f8f9fa;
            --dark-text: #2b2d42;
            --gray-text: #6c757d;
            --border-radius: 10px;
            --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: var(--light-bg);
            margin: 0;
            color: var(--dark-text);
            line-height: 1.6;
        }

        .main-content {
            margin-left: 260px;
            padding: 30px;
            margin-top: 70px;
            transition: margin-left 0.3s ease;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 15px;
            }
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            animation: fadeIn 0.5s ease-in-out;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .page-title {
            color: var(--primary-color);
            margin: 0;
            font-size: 1.8rem;
            font-weight: 700;
            position: relative;
            padding-bottom: 10px;
        }

        .page-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--success-color));
            border-radius: 2px;
        }

        hr.divider {
            border: none;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            margin: 25px 0;
        }

        .add-product-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 20px;
            background-color: var(--primary-color);
            color: #fff;
            border-radius: var(--border-radius);
            font-size: 15px;
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
        }

        .add-product-btn i {
            font-size: 16px;
        }

        .add-product-btn:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(67, 97, 238, 0.3);
        }

        /* Filter Section */
        .filter-section {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 25px;
            align-items: center;
        }

        .search-wrapper {
            position: relative;
            flex: 1;
            min-width: 250px;
        }

        .search-wrapper i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-text);
        }

        .filter-section input[type="text"] {
            padding: 12px 15px 12px 40px;
            width: 100%;
            border: 1px solid #e0e0e0;
            border-radius: var(--border-radius);
            font-size: 14px;
            transition: var(--transition);
            background-color: #f8f9fa;
        }

        .filter-section input[type="text"]:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
            background-color: #fff;
        }

        .filter-section select {
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            border-radius: var(--border-radius);
            font-size: 14px;
            background-color: #f8f9fa;
            transition: var(--transition);
            min-width: 200px;
        }

        .filter-section select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        /* Product Grid */
        .product-grid {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .product-header {
            display: flex;
            align-items: center;
            background: linear-gradient(90deg, var(--primary-color), #5a72ef);
            color: #fff;
            padding: 16px 20px;
            font-weight: 600;
            border-radius: var(--border-radius);
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .product-row {
            display: flex;
            align-items: center;
            padding: 16px 20px;
            border-bottom: 1px solid #f0f0f0;
            background-color: #fff;
            transition: var(--transition);
            border-radius: var(--border-radius);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .product-row:hover {
            background-color: #f8f9ff;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .product-row::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background-color: var(--primary-color);
            opacity: 0;
            transition: var(--transition);
        }

        .product-row:hover::before {
            opacity: 1;
        }

        .col {
            padding: 0 15px;
            flex: 1;
            text-align: left;
        }

        .col.image-col {
            flex: 0 0 80px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .product-img {
            width: 70px;
            height: 70px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid #eee;
            transition: var(--transition);
        }

        .product-row:hover .product-img {
            transform: scale(1.05);
        }

        .col.product-name {
            flex: 2;
            font-weight: 500;
        }

        .col.price {
            font-weight: 600;
            color: var(--primary-color);
        }

        .col.inventory {
            font-weight: 500;
        }

        .col.actions {
            flex: 1.5;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        /* Action Buttons */
        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            text-decoration: none;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
            min-width: 80px;
        }

        .action-btn i {
            font-size: 14px;
        }

        .view-btn {
            background-color: var(--primary-color);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
        }

        .view-btn:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(67, 97, 238, 0.3);
        }

        .edit-btn {
            background-color: var(--warning-color);
            box-shadow: 0 4px 12px rgba(255, 158, 0, 0.2);
        }

        .edit-btn:hover {
            background-color: var(--warning-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(255, 158, 0, 0.3);
        }

        .inventory-btn {
            background-color: var(--success-color);
            box-shadow: 0 4px 12px rgba(76, 201, 240, 0.2);
        }

        .inventory-btn:hover {
            background-color: var(--success-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(76, 201, 240, 0.3);
        }

        .delete-btn {
            background-color: var(--danger-color);
            box-shadow: 0 4px 12px rgba(247, 37, 133, 0.2);
        }

        .delete-btn:hover {
            background-color: var(--danger-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(247, 37, 133, 0.3);
        }

        /* Inventory Status */
        .inventory-status {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .inventory-high {
            background-color: rgba(40, 167, 69, 0.1);
            color: #28a745;
        }

        .inventory-medium {
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }

        .inventory-low {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            background-color: #fff;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--gray-text);
            margin-bottom: 15px;
            opacity: 0.5;
        }

        .empty-state h5 {
            color: var(--dark-text);
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: var(--gray-text);
            max-width: 400px;
            margin: 0 auto;
        }

        /* Modal Styles */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s ease-in-out;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-container {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            width: 90%;
            max-width: 450px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            animation: popUp 0.3s ease-in-out;
            position: relative;
        }

        .modal-close {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 24px;
            cursor: pointer;
            background: none;
            border: none;
            color: var(--gray-text);
            transition: var(--transition);
        }

        .modal-close:hover {
            color: var(--danger-color);
            transform: rotate(90deg);
        }

        .modal-header {
            margin-bottom: 20px;
            text-align: center;
        }

        .modal-header h3 {
            color: var(--primary-color);
            margin: 0;
            font-size: 1.5rem;
        }

        .modal-body {
            text-align: center;
        }

        .modal-product-image {
            width: 100%;
            max-width: 200px;
            height: auto;
            border-radius: 8px;
            margin: 0 auto 15px;
            display: block;
            border: 1px solid #eee;
        }

        .modal-info {
            margin-bottom: 20px;
        }

        .modal-info p {
            margin: 8px 0;
            font-size: 16px;
        }

        .modal-info strong {
            color: var(--dark-text);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            text-align: left;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark-text);
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            border-radius: var(--border-radius);
            font-size: 16px;
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        .modal-footer {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 12px 20px;
            border-radius: var(--border-radius);
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            flex: 1;
            border: none;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: #fff;
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(67, 97, 238, 0.3);
        }

        .btn-secondary {
            background-color: #f8f9fa;
            color: var(--dark-text);
        }

        .btn-secondary:hover {
            background-color: #e9ecef;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes popUp {
            from { transform: scale(0.9); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        /* Responsive */
        @media (max-width: 992px) {
            .col.actions {
                flex-direction: column;
                gap: 8px;
            }
            
            .action-btn {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .product-header {
                display: none;
            }

            .product-row {
                flex-direction: column;
                align-items: flex-start;
                padding: 20px;
                gap: 15px;
            }

            .col {
                width: 100%;
                padding: 0;
            }

            .col:before {
                content: attr(data-label);
                font-weight: 600;
                color: var(--gray-text);
                display: block;
                margin-bottom: 5px;
                font-size: 0.85rem;
            }

            .col.actions {
                justify-content: flex-start;
                width: 100%;
                margin-top: 15px;
                padding-top: 15px;
                border-top: 1px dashed #eee;
                flex-direction: row;
            }
            
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .filter-section {
                width: 100%;
            }
            
            .search-wrapper {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <x-sidebar />

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">Product Management</h1>
                <a href="{{ route('mechanic.created') }}" class="add-product-btn">
                    <i class="fa-solid fa-plus"></i> Add New Product
                </a>
            </div>
            
            <hr class="divider" />

            <!-- Filter Section -->
            <div class="filter-section">
                <div class="search-wrapper">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Search products..." onkeyup="filterProducts()" />
                </div>
                
                <select id="category" onchange="filterProducts()">
                    <option value="">All Categories</option>
                    <option value="Engine Parts">Engine Parts</option>
                    <option value="Brakes">Brakes</option>
                    <option value="Suspension">Suspension</option>
                    <option value="Electrical">Electrical</option>
                    <option value="Body Parts">Body Parts</option>
                    <option value="Accessories">Accessories</option>
                </select>
            </div>

            <!-- Product Grid -->
            <div class="product-grid">
                <!-- Header Row -->
                <div class="product-header">
                    <div class="col image-col">Image</div>
                    <div class="col product-name">Product Name</div>
                    <div class="col price">Price</div>
                    <div class="col inventory">Inventory</div>
                    <div class="col actions">Actions</div>
                </div>

                @if ($products->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-box-open"></i>
                    <h5>No Products Found</h5>
                    <p>You haven't added any products yet. Click the "Add New Product" button to get started.</p>
                </div>
                @else
                @foreach ($products as $product)
                <div class="product-row" 
                     data-category="{{ $product->category }}"
                     data-name="{{ strtolower($product->ProductName) }}"
                     onclick="window.location.href='{{ route('mechanic.show', $product->id) }}'">

                    <div class="col image-col" data-label="Image">
                        <img src="{{ $product->image ? asset('upload/' . $product->image) : asset('images/no-image.png') }}"
                            alt="{{ $product->ProductName }}" class="product-img" loading="lazy">
                    </div>

                    <div class="col product-name" data-label="Product Name">
                        {{ $product->ProductName }}
                        <div class="inventory-status 
                            @if($product->Inventory > 20) inventory-high
                            @elseif($product->Inventory > 5) inventory-medium
                            @else inventory-low
                            @endif">
                            @if($product->Inventory > 20) In Stock
                            @elseif($product->Inventory > 5) Low Stock
                            @else Critical
                            @endif
                        </div>
                    </div>
                    
                    <div class="col price" data-label="Price">₱{{ number_format($product->Price, 2) }}</div>
                    
                    <div class="col inventory" data-label="Inventory">{{ $product->Inventory }}</div>

                    <div class="col actions" data-label="Actions" onclick="event.stopPropagation()">
                        <a href="{{ route('mechanic.product.edit', $product->id) }}" class="action-btn edit-btn">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>

                        <button class="action-btn inventory-btn"
                            onclick="openInventoryModal(this)"
                            data-id="{{ $product->id }}"
                            data-name="{{ $product->ProductName }}"
                            data-inventory="{{ $product->Inventory }}"
                            data-image="{{ $product->image }}">
                            <i class="fa-solid fa-plus"></i> Stock
                        </button>

                        <form action="{{ route('mechanic.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this product?')">
                                <i class="fa-solid fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>

    <!-- Inventory Modal -->
    <div id="inventoryModal" class="modal-overlay">
        <div class="modal-container">
            <button class="modal-close" onclick="closeInventoryModal()">&times;</button>
            
            <div class="modal-header">
                <h3 id="modalProductName">Add Inventory</h3>
            </div>
            
            <div class="modal-body">
                <img id="modalProductImage" src="" alt="Product Image" class="modal-product-image">
                
                <div class="modal-info">
                    <p><strong>Current Inventory:</strong> <span id="modalCurrentInventory">0</span></p>
                </div>
                
                <form id="addInventoryForm" method="POST" action="">
                    @csrf
                    <div class="form-group">
                        <label for="inventoryInput">Quantity to Add</label>
                        <input type="number" 
                               name="added_inventory" 
                               id="inventoryInput" 
                               min="1" 
                               required 
                               placeholder="Enter quantity"
                               class="form-control">
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeInventoryModal()">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="inventorySubmitBtn">
                            <span id="submitText">Add to Inventory</span>
                            <span id="loadingSpinner" style="display:none;">
                                <i class="fas fa-spinner fa-spin"></i> Processing...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Filter products by search and category
        function filterProducts() {
            const searchValue = document.getElementById('searchInput').value.toLowerCase();
            const selectedCategory = document.getElementById('category').value.toLowerCase();
            const productRows = document.querySelectorAll('.product-row');

            let visibleCount = 0;

            productRows.forEach(row => {
                const name = row.getAttribute('data-name');
                const category = row.getAttribute('data-category').toLowerCase();

                const matchesSearch = name.includes(searchValue);
                const matchesCategory = !selectedCategory || category === selectedCategory;

                if (matchesSearch && matchesCategory) {
                    row.style.display = 'flex';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Hide empty state if we have products to show
            const emptyState = document.querySelector('.empty-state');
            if (emptyState) {
                emptyState.style.display = visibleCount === 0 ? 'block' : 'none';
            }
        }

        // Inventory modal functions
        function openInventoryModal(button) {
            const productId = button.getAttribute('data-id');
            const productName = button.getAttribute('data-name');
            const productInventory = button.getAttribute('data-inventory');
            const productImage = button.getAttribute('data-image');

            document.getElementById('modalProductName').textContent = 'Add Inventory: ' + productName;
            document.getElementById('modalCurrentInventory').textContent = productInventory;
            document.getElementById('modalProductImage').src = productImage ? 
                `/upload/${productImage}` : `/images/no-image.png`;
            document.getElementById('addInventoryForm').action = `/mechanic/product/add-inventory/${productId}`;
            
            // Reset form
            document.getElementById('inventoryInput').value = '';
            document.getElementById('submitText').style.display = 'inline';
            document.getElementById('loadingSpinner').style.display = 'none';
            document.getElementById('inventorySubmitBtn').disabled = false;
            
            document.getElementById('inventoryModal').classList.add('active');
        }

        function closeInventoryModal() {
            document.getElementById('inventoryModal').classList.remove('active');
        }

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('inventoryModal');
            if (event.target === modal) closeInventoryModal();
        });

        // Form submission handling
        document.addEventListener('DOMContentLoaded', function() {
            const inventoryForm = document.getElementById('addInventoryForm');
            
            inventoryForm.addEventListener('submit', function(e) {
                const submitBtn = document.getElementById('inventorySubmitBtn');
                const submitText = document.getElementById('submitText');
                const loadingSpinner = document.getElementById('loadingSpinner');
                
                submitBtn.disabled = true;
                submitText.style.display = 'none';
                loadingSpinner.style.display = 'inline';
            });
        });

        // Initialize with all products visible
        document.addEventListener('DOMContentLoaded', filterProducts);
    </script>

    <script src="{{ asset('assets/js/script2.js') }}"></script>
</body>

</html>