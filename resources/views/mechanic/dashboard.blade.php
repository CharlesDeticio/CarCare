<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Service Dashboard - Carcare</title>

  <!-- Font Awesome & Boxicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />

  <!-- Custom Stylesheet -->
  <link rel="stylesheet" href="{{ asset('assets/css/style2.css') }}">

  <style>
    :root {
      --primary-color: #4361ee;
      --primary-hover: #3a56d4;
      --danger-color: #f72585;
      --danger-hover: #e5177b;
      --success-color: #4cc9f0;
      --light-bg: #f8f9fa;
      --dark-text: #2b2d42;
      --gray-text: #6c757d;
      --border-radius: 12px;
      --box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
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
      transition: margin-left 0.3s ease;
      margin-top: 70px;
      padding: 30px;
    }

    @media (max-width: 768px) {
      .main-content {
        margin-left: 0 !important;
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

    h4 {
      color: var(--primary-color);
      margin-bottom: 25px;
      font-size: 1.8rem;
      font-weight: 700;
      text-align: left;
      position: relative;
      padding-bottom: 10px;
    }

    h4::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 60px;
      height: 4px;
      background: linear-gradient(90deg, var(--primary-color), var(--success-color));
      border-radius: 2px;
    }

    hr {
      border: none;
      border-top: 1px solid rgba(0, 0, 0, 0.05);
      margin: 25px 0;
    }

    .header-actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
      flex-wrap: wrap;
      gap: 15px;
    }

    .add-service-btn {
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

    .add-service-btn i {
      font-size: 16px;
    }

    .add-service-btn:hover {
      background-color: var(--primary-hover);
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(67, 97, 238, 0.3);
    }

    .filter-container {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      align-items: center;
    }

    .search-wrapper {
      position: relative;
      min-width: 250px;
    }

    .search-wrapper i {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--gray-text);
    }

    .filter-container input[type="text"] {
      padding: 12px 15px 12px 40px;
      width: 100%;
      border: 1px solid #e0e0e0;
      border-radius: var(--border-radius);
      font-size: 14px;
      transition: var(--transition);
      background-color: #f8f9fa;
    }

    .filter-container input[type="text"]:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
      background-color: #fff;
    }

    .service-grid {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .grid-header {
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

    .grid-row {
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

    .grid-row:hover {
      background-color: #f8f9ff;
      transform: translateY(-3px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    .grid-row::before {
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

    .grid-row:hover::before {
      opacity: 1;
    }

    .col {
      padding: 0 15px;
      flex: 1;
      text-align: left;
    }

    .col.image {
      flex: 0 0 90px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .col.image img {
      width: 80px;
      height: 80px;
      border-radius: 10px;
      object-fit: cover;
      border: 1px solid #eee;
      transition: var(--transition);
    }

    .grid-row:hover .col.image img {
      transform: scale(1.05);
    }

    .col.service-name {
      flex: 2;
      font-weight: 500;
      color: var(--dark-text);
    }

    .col.price {
      font-weight: 600;
      color: var(--primary-color);
    }

    .col.actions {
      flex: 1.5;
      display: flex;
      justify-content: flex-end;
      gap: 10px;
    }

    .edit-btn,
    .delete-btn {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 16px;
      border-radius: 8px;
      font-size: 0.85rem;
      text-decoration: none;
      color: #fff;
      border: none;
      cursor: pointer;
      transition: var(--transition);
      font-weight: 500;
    }

    .edit-btn {
      background-color: var(--primary-color);
      box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
    }

    .edit-btn:hover {
      background-color: var(--primary-hover);
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(67, 97, 238, 0.3);
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

    .no-results {
      display: none;
      text-align: center;
      padding: 40px 20px;
      background-color: #fff;
      border-radius: var(--border-radius);
      box-shadow: var(--box-shadow);
    }

    .no-results i {
      font-size: 3rem;
      color: var(--gray-text);
      margin-bottom: 15px;
      opacity: 0.5;
    }

    .no-results h5 {
      color: var(--dark-text);
      font-size: 1.2rem;
      margin-bottom: 10px;
    }

    .no-results p {
      color: var(--gray-text);
      max-width: 400px;
      margin: 0 auto;
    }

    /* Status Badge */
    .status-badge {
      display: inline-block;
      padding: 4px 10px;
      border-radius: 50px;
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .status-active {
      background-color: rgba(76, 201, 240, 0.1);
      color: #4cc9f0;
    }

    /* Animations */
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Responsive */
    @media (max-width: 992px) {
      .col.actions {
        flex-direction: column;
        gap: 8px;
      }
      
      .edit-btn, .delete-btn {
        width: 100%;
        justify-content: center;
      }
    }

    @media (max-width: 768px) {
      .grid-header {
        display: none;
      }

      .grid-row {
        flex-direction: column;
        align-items: flex-start;
        padding: 20px;
        gap: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      }

      .col {
        width: 100%;
        padding: 0;
      }

      .col.image {
        justify-content: flex-start;
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
        margin-top: 10px;
        padding-top: 15px;
        border-top: 1px dashed #eee;
        flex-direction: row;
      }
      
      .header-actions {
        flex-direction: column;
        align-items: flex-start;
      }
      
      .filter-container {
        width: 100%;
      }
      
      .search-wrapper {
        width: 100%;
      }
    }

    /* Loading Skeleton */
    .skeleton {
      animation: skeleton-loading 1.5s linear infinite alternate;
      opacity: 0.7;
      border-radius: 4px;
    }
    
    .skeleton-text {
      width: 100%;
      height: 1rem;
      margin-bottom: 0.5rem;
    }
    
    .skeleton-image {
      width: 80px;
      height: 80px;
    }
    
    @keyframes skeleton-loading {
      0% {
        background-color: hsl(200, 20%, 85%);
      }
      100% {
        background-color: hsl(200, 20%, 95%);
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

      <!-- Page Title -->
      <h4>Service Management</h4>
      <hr />

      <!-- Header Actions -->
      <div class="header-actions">
        <a href="{{ route('mechanic.service.add') }}" class="add-service-btn">
          <i class="fa-solid fa-plus"></i> Add New Service
        </a>
        
        <div class="filter-container">
          <div class="search-wrapper">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Search services..." onkeyup="filterServices()" />
          </div>
        </div>
      </div>

      <!-- Service Grid -->
      <div class="service-grid">

        <!-- Header Row -->
        <div class="grid-header">
          <div class="col image"></div>
          <div class="col service-name">Service Name</div>
          <div class="col price">Price</div>
          <div class="col actions">Actions</div>
        </div>

        <!-- Service Rows -->
        @if ($services->isEmpty())
        <div class="no-results" style="display: flex; flex-direction: column; align-items: center;">
          <i class="fas fa-car-mechanic"></i>
          <h5>No Services Found</h5>
          <p>You haven't added any services yet. Click the "Add New Service" button to get started.</p>
        </div>
        @else
        @foreach ($services as $service)
        <div class="grid-row"
          onclick="window.location.href='{{ route('mechanic.shows', $service->id) }}'"
          data-name="{{ strtolower($service->name) }}">

          <div class="col image" data-label="Service Image">
            @if ($service->image)
            <img src="{{ asset('upload/' . $service->image) }}" alt="{{ $service->name }}" loading="lazy">
            @else
            <img src="{{ asset('placeholder-image.jpg') }}" alt="No Image Available" loading="lazy">
            @endif
          </div>

          <div class="col service-name" data-label="Service Name">
            {{ $service->name }}
            {{-- <div class="status-badge status-active">Active</div> --}}
          </div>
          
          <div class="col price" data-label="Price">₱{{ number_format($service->price, 2) }}</div>

          <div class="col actions" data-label="Actions" onclick="event.stopPropagation();">
            <a href="{{ route('mechanic.edit', $service->id) }}" class="edit-btn">
              <i class="fa-solid fa-pen-to-square"></i> Edit
            </a>

            <form action="{{ route('mechanic.destroys', $service->id) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this service?')">
                <i class="fa-solid fa-trash"></i> Delete
              </button>
            </form>
          </div>

        </div>
        @endforeach
        @endif

        <div class="no-results" id="noResultsMessage">
          <i class="fas fa-search"></i>
          <h5>No Matching Services</h5>
          <p>We couldn't find any services matching your search criteria.</p>
        </div>

      </div>
    </div>
  </div>

  <!-- JS Search Filter -->
  <script>
    function filterServices() {
      const searchInput = document.getElementById('searchInput').value.toLowerCase();
      const serviceRows = document.querySelectorAll('.service-grid .grid-row');
      const noResultsMessage = document.getElementById('noResultsMessage');
      let visibleCount = 0;

      serviceRows.forEach(row => {
        const serviceName = row.getAttribute('data-name');
        if (serviceName.includes(searchInput)) {
          row.style.display = 'flex';
          visibleCount++;
        } else {
          row.style.display = 'none';
        }
      });

      // Show/hide the no results message
      noResultsMessage.style.display = (visibleCount === 0) ? 'flex' : 'none';
      
      // Also hide the empty state if it exists
      document.querySelector('.no-results[style*="display: flex"]')?.style.setProperty('display', 'none', 'important');
    }

    // Add loading state simulation (for demo purposes)
    document.addEventListener('DOMContentLoaded', function() {
      // This would be replaced with actual loading logic in a real app
      setTimeout(() => {
        document.querySelectorAll('.skeleton').forEach(el => {
          el.classList.remove('skeleton');
        });
      }, 800);
    });
  </script>

  <script src="{{ asset('assets/js/script2.js') }}"></script>

</body>

</html>