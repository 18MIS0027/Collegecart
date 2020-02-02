<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="#"> MENU</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
</button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link"
href="#">Hi <?php echo htmlspecialchars($_SESSION["name"]); ?></a>
      </li>    
      <li class="nav-item">
        <a class="nav-link" href="home.php"><i class="fa fa-home"></i> HOME</a>
      </li>
      <li class="nav-item">
        <a class="nav-link"
href="my-account.php"><i class="fa fa-user"></i> MY ACCOUNT</a>
      </li>  
      <li class="nav-item">
        <a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart"></i> CART</a>
      </li>        
      <li class="nav-item">
        <a class="nav-link" href="manage-myproducts.php"><i class="fa fa-shopping-bag"></i> MY PRODUCTS</a>
      </li>            
      <li class="nav-item">
        <a class="nav-link" href="insert-myproduct.php"><i class="fa fa-shopping-cart"></i> SELL PRODUCTS</a>
      </li>
      <li class="nav-item">
        <a class="nav-link"
href="logout.php"><i class="fa fa-lock"></i> SIGNOUT</a>
      </li>      
    </ul>
  </div>  
</nav>
