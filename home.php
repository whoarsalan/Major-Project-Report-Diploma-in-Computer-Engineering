<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image) VALUES('$user_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
      $message[] = 'product added to cart!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>


   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/style2.css">
   
   <script>
    !function(t,e){var o,n,p,r;e.__SV||(window.posthog=e,e._i=[],e.init=function(i,s,a){function g(t,e){var o=e.split(".");2==o.length&&(t=t[o[0]],e=o[1]),t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}}(p=t.createElement("script")).type="text/javascript",p.async=!0,p.src=s.api_host+"/static/array.js",(r=t.getElementsByTagName("script")[0]).parentNode.insertBefore(p,r);var u=e;for(void 0!==a?u=e[a]=[]:a="posthog",u.people=u.people||[],u.toString=function(t){var e="posthog";return"posthog"!==a&&(e+="."+a),t||(e+=" (stub)"),e},u.people.toString=function(){return u.toString(1)+".people (stub)"},o="capture identify alias people.set people.set_once set_config register register_once unregister opt_out_capturing has_opted_out_capturing opt_in_capturing reset isFeatureEnabled onFeatureFlags".split(" "),n=0;n<o.length;n++)g(u,o[n]);e._i.push([i,s,a])},e.__SV=1)}(document,window.posthog||[]);
    posthog.init('phc_nOzobWOKwiL1fMEOP7W2MekRgzStts0qfzQo4iVGDvy',{api_host:'https://app.posthog.com'})
</script>
</head>
<body>
   
<?php include 'header.php'; ?>

<section class="home">

   <div class="content">
      <h3>Hand Picked Book to your door.</h3>
      <p>This is the place where you can find relevant books for Academics purposes. <br>Read full books online easily.</p>
      <a href="about.php" class="white-btn">Discover more</a>
   </div>

</section>

<section class="products">

   <h1 class="title">Latest Products</h1>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price">Rs<?php echo $fetch_products['price']; ?>/-</div>
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="add to cart" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
      <!-- For free products -->
    <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `free_products` LIMIT 6") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <!-- <form action="" method="post" class="box"> -->
        <div class="box" style="padding:32px;">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="Download" name="add_to_cart" class="btn">
     <!-- </form> -->
    </div>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

</section>
        <!-- Other Books -->
        <section class="book-genre-container mx-auto p-1">
            <h1 class="font-style-2 font-size-md color-2  border-bottom my-1 py-1 black-highlight pointer"><img
                    src="assets/images/opportunity.svg" alt="academic" class="category-heading-icons mr-half">Other
                Books</h1>
            <section class="book-cards-container d-flex flex-wrap justify-between">
                <h2 class="d-none">This is hidden</h2>
                <article class="book-card bg-white my-1">
                    <h2 class="d-none">This is hidden</h2>
                    <img src="./assets/images/1.jpg" alt="academic-img-1" class="book-card-img d-block">
                    <div class="p-half pointer d-flex flex-column justify-between h-200">
                        <p class="font-style-1 font-size-md color-3 py-1 gray-highlight">The man who ended history</p>
                        <div>
                            <p class="font-size-sm font-style-2 color-3 gray-highlight">by Liu 
                            </p>
                            <p class="font-size-s font-style-2 color-3  py-1 gray-highlight">Rating: 3.57/5</p>
                            <p class="py-1 d-flex justify-center align-center"><a href="./books/Liu, Ken - The man who ended history.pdf">
                                <span class="font-size-md color-1 font-style-2 gray-highlight justify-center">
                                    <input type="submit" value="Download" name="" class="btn download-btn">
                                </span>
                                </a>
                            </p>
                        </div>
                    </div>
                </article>
                <article class="book-card bg-white my-1">
                    <h2 class="d-none">This is hidden</h2>
                    <img src="./assets/images/2.jpg" alt="academic-img-2" class="book-card-img d-block">
                    <div class="p-half pointer d-flex flex-column justify-between h-200">
                        <p class="font-style-1 font-size-md color-3 py-1 gray-highlight">The Collected Poems</p>
                        <div>
                            <p class="font-size-sm font-style-2 color-3 gray-highlight">by Lorde</p>
                            <p class="font-size-s font-style-2 color-3  py-1 gray-highlight">Rating: 4.94/5</p>
                            <p class="py-1 d-flex justify-center align-center"><a href="./books/Lorde, Audre - The Collected Poems.pdf">
                                <span class="font-size-md color-1 font-style-2 gray-highlight justify-center">
                                    <input type="submit" value="Download" name="" class="btn download-btn">
                                </span>
                                </a>
                            </p>
                        </div>
                    </div>
                </article>
                <article class="book-card bg-white my-1">
                    <h2 class="d-none">This is hidden</h2>
                    <img src="./assets/images/3.jpg" alt="academic-img-3" class="book-card-img d-block">
                    <div class="p-half pointer d-flex flex-column justify-between h-200">
                        <p class="font-style-1 font-size-md color-3 py-1 gray-highlight">Red Bird</p>
                        <div>
                            <p class="font-size-sm font-style-2 color-3 gray-highlight">by Oliver Mary
                                White</p>
                            <p class="font-size-s font-style-2 color-3  py-1 gray-highlight">Rating: 4.19/5</p>
                            <p class="py-1 d-flex justify-center align-center"><a href="./books/Oliver, Mary - Red Bird.pdf">
                                <span class="font-size-md color-1 font-style-2 gray-highlight justify-center">
                                    <input type="submit" value="Download" name="" class="btn download-btn">
                                </span>
                                </a>
                            </p>
                        </div>
                    </div>
                </article>
                <article class="book-card bg-white my-1">
                    <h2 class="d-none">This is hidden</h2>
                    <img src="./assets/images/4.jpg" alt="academic-img-4" class="book-card-img d-block">
                    <div class="p-half pointer d-flex flex-column justify-between h-200">
                        <p class="font-style-1 font-size-md color-3 py-1 gray-highlight">If Not, Winter</p>
                        <div>
                            <p class="font-size-sm font-style-2 color-3 gray-highlight">by Sappho)</p>
                            <p class="font-size-s font-style-2 color-3  py-1 gray-highlight">Rating: 4.22/5</p>
                            <p class="py-1 d-flex justify-center align-center"><a href="./books/Sappho - If Not, Winter.pdf">
                                <span class="font-size-md color-1 font-style-2 gray-highlight justify-center">
                                    <input type="submit" value="Download" name="" class="btn download-btn">
                                </span>
                                </a>
                            </p>
                        </div>
                    </div>
                </article>
            </section>
        </section>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/5.jpg" alt="">
      </div>

      <div class="content">
         <h3>About Us</h3>
         <p>We offer a tremendous gathering of books in the various classifications of Computers, Engineering, College and School content references books proposed by various foundations as schedule the nation over. Other than this, we likewise offer an expansive gathering of E-Books at reasonable valuing.</p>
         <a href="about.php" class="btn">Read more</a>
      </div>

   </div>

</section>

<section class="home-contact">

   <div class="content">
      <h3>Have any Questions?</h3>
      <p>Leave a message to us and we will surely answer you shortly!</p>
      <a href="contact.php" class="white-btn">Contact Us</a>
   </div>

</section>





<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>