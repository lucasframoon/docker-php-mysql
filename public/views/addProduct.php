<!doctype html>
<html ⚡>

<head>
  <title>Webjump | Backend Test | Add Product</title>
  <meta charset="utf-8">

  <link rel="stylesheet" type="text/css" media="all" href="/views/assets/css/style.css" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,800" rel="stylesheet">
  <meta name="viewport" content="width=device-width,minimum-scale=1">
  <style amp-boilerplate>
    body {
      -webkit-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
      -moz-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
      -ms-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
      animation: -amp-start 8s steps(1, end) 0s 1 normal both
    }

    @-webkit-keyframes -amp-start {
      from {
        visibility: hidden
      }

      to {
        visibility: visible
      }
    }

    @-moz-keyframes -amp-start {
      from {
        visibility: hidden
      }

      to {
        visibility: visible
      }
    }

    @-ms-keyframes -amp-start {
      from {
        visibility: hidden
      }

      to {
        visibility: visible
      }
    }

    @-o-keyframes -amp-start {
      from {
        visibility: hidden
      }

      to {
        visibility: visible
      }
    }

    @keyframes -amp-start {
      from {
        visibility: hidden
      }

      to {
        visibility: visible
      }
    }
  </style><noscript>
    <style amp-boilerplate>
      body {
        -webkit-animation: none;
        -moz-animation: none;
        -ms-animation: none;
        animation: none
      }
    </style>
  </noscript>
  <script async src="https://cdn.ampproject.org/v0.js"></script>
  <script async custom-element="amp-fit-text" src="https://cdn.ampproject.org/v0/amp-fit-text-0.1.js"></script>
  <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
  <script src="/views/assets/javascript/util.js"></script>
</head>
<!-- Header -->
<amp-sidebar id="sidebar" class="sample-sidebar" layout="nodisplay" side="left">
  <div class="close-menu">
    <a on="tap:sidebar.toggle">
      <img src="/views/assets/images/bt-close.png" alt="Close Menu" width="24" height="24" />
    </a>
  </div>
  <a href="dashboard.php"><img src="/views/assets/images/menu-go-jumpers.png" alt="Welcome" width="200" height="43" /></a>
  <div>
    <ul>
      <li><a href="categories.html" class="link-menu">Categorias</a></li>
      <li><a href="products.html" class="link-menu">Produtos</a></li>
    </ul>
  </div>
</amp-sidebar>
<header>
  <div class="go-menu">
    <a on="tap:sidebar.toggle">☰</a>
    <a href="dashboard.html" class="link-logo"><img src="/views/assets/images/go-logo.png" alt="Welcome" width="69" height="430" /></a>
  </div>
  <div class="right-box">
    <span class="go-title">Administration Panel</span>
  </div>
</header>
<!-- Header -->
<!-- Main Content -->

<main class="content">
  <h1 class="title new-item">New Product</h1>

  <form>
    <div class="input-field">
      <label for="sku" class="label">Product SKU</label>
      <input type="text" id="sku" class="input-text" />
    </div>
    <div class="input-field">
      <label for="name" class="label">Product Name</label>
      <input type="text" id="name" class="input-text" />
    </div>
    <div class="input-field">
      <label for="price" class="label">Price</label>
      <input type="text" id="price" class="input-text" />
    </div>
    <div class="input-field">
      <label for="quantity" class="label">Quantity</label>
      <input type="text" id="quantity" class="input-text" />
    </div>
    <div class="input-field">
      <label for="category" class="label">Categories</label>
      <select multiple id="category" class="input-text">
        <option value="">Category 1</option>
        <!-- <option>Category 2</option>
        <option>Category 3</option>
        <option>Category 4</option> -->
      </select>
    </div>
    <div class="input-field">
      <label for="description" class="label">Description</label>
      <textarea id="description" class="input-text"></textarea>
    </div>
    <div class="actions-form">
      <a href="products.html" class="action back">Back</a>
      <input class="btn-submit btn-action" type="submit" value="Save Product" />
    </div>

  </form>
</main>
<!-- Main Content -->

<!-- Footer -->
<footer>
  <div class="footer-image">
    <img src="/views/assets/images/go-jumpers.png" width="119" height="26" alt="Go Jumpers" />
  </div>
  <div class="email-content">
    <span>go@jumpers.com.br</span>
  </div>
</footer>
<!-- Footer -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
  $(document).ready(function() {

    $.ajax({
      url: '/source/App/category/getAllCategories.php',
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        listCategories = response.listCategories;
        listCategories.forEach(item => {
          $('#category').append(`<option value="${item.id_category}" >${item.nm_category}</option>`);
        });
      }
    });

    if (getParameterByName('id') != null) {
      $.ajax({
        url: '/source/App/product/getProduct.php',
        type: 'POST',
        dataType: 'json',
        data: {
          idProduct: getParameterByName('id')
        },
        success: function(response) {
          $('#sku').val(response.product.nr_sku);
          $('#name').val(response.product.nm_product);
          $('#price').val(response.product.vl_product);
          $('#quantity').val(response.product.qt_product);
          $('#description').val(response.product.ds_description);

          $("#category").val(response.productCategories);
        }
      });
    }

  });


  $("form").submit(function(e) {
    e.preventDefault();

    formData = new FormData();
    formData.append("id_product", '');
    formData.append("nr_sku", $("#sku").val());
    formData.append("nm_product", $("#name").val());
    formData.append("vl_product", $("#price").val());
    formData.append("qt_product", $("#quantity").val());
    formData.append("id_category", $("#category").val());
    formData.append("ds_description", $("#description").val());
    // formData.append("image", $("#image").prop("files")[0]);

    $.ajax({
      url: 'http://localhost:45000/source/App/product/saveProduct.php',
      dataType: 'json',
      type: 'POST',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(response) {
        if (response.success) {
          alert("Product saved successfully");
          location.assign('./addProduct.php?id=' + response.idProduct);
        } else {
          alert("Error saving product");
        }
      },

    });
  });
</script>
</body>

</html>