<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Online Bookstore</title>
    <link
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="dashboard.css" />
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 d-none d-md-block bg-blueviolet sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <h4>Dashboard</h4>
                <li class="nav-item">
                <a class="nav-link">
                  <i class="fas fa-book"></i> Accueil
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="catalog.php">
                  <i class="fas fa-book"></i> Book Catalog
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="shoppingcart.php">
                  <i class="fas fa-shopping-cart"></i> Shopping Cart
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="orderprocessing.php">
                  <i class="fas fa-box"></i> Order Processing
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="userprofile.php">
                  <i class="fas fa-user"></i> User Profiles
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="adminpanel.php">
                  <i class="fas fa-cogs"></i> Admin Panel
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">
                  <i class="fas fa-sign-out-alt"></i> Deconnexion
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <!-- Main Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
          >
            <h1 class="h2">Admin Dashboard</h1>
          </div>

          <div class="row">
            <div class="col-lg-4 col-md-6">
              <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                  <h5 class="card-title">Manage Book Catalog</h5>
                  <p class="card-text">
                    Add, edit, and remove books in the catalog.
                  </p>
                  <a href="" class="btn btn-light"
                    >View Catalog</a
                  >
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6">
              <div class="card text-white bg-success mb-3">
                <div class="card-body">
                  <h5 class="card-title">Shopping Cart</h5>
                  <p class="card-text">
                    View and manage customer shopping carts.
                  </p>
                  <a href="" class="btn btn-light"
                    >View Cart</a
                  >
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6">
              <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                  <h5 class="card-title">Order Processing</h5>
                  <p class="card-text">
                    Process and track orders from customers.
                  </p>
                  <a href="" class="btn btn-light"
                    >View Orders</a
                  >
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6">
              <div class="card text-white bg-info mb-3">
                <div class="card-body">
                  <h5 class="card-title">User Profiles</h5>
                  <p class="card-text">Manage user accounts and preferences.</p>
                  <a href="" class="btn btn-light"
                    >View Profiles</a
                  >
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6">
              <div class="card text-white bg-dark mb-3">
                <div class="card-body">
                  <h5 class="card-title">Admin Panel</h5>
                  <p class="card-text">
                    Access the admin panel for managing content.
                  </p>
                  <a href="" class="btn btn-light"
                    >Admin Settings</a
                  >
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6">
              <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                  <h5 class="card-title">Deconnexion</h5>
                  <p class="card-text">Log out of the admin panel.</p>
                  <a href="" class="btn btn-light">Log Out</a>
                </div>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  </body>
</html>
