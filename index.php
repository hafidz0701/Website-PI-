<?php 
include 'db.php';
session_start();
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HalalFroz</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet"> 
</head>
<body>

<header>
         <div class="container">
            <h1><a href="index.php">HalalFroz</a></h1>
            <ul>
                <li><a href="user/produk.php">Produk</a></li>
                <li><a href="user/keranjang.php">Keranjang</a></li>
                <!-- jika sudah login(ada sesion pelanggan) -->
                <?php if(isset($_SESSION["user"])): ?>
                        <li><a href="user/logout.php">Logout</a></li>
                <!-- selainitu(blm login || blm ada sesion pelanggan) -->
                <?php else: ?>
                    <li><a href="user/login.php">Login</a></li>
                <?php endif ?>     
                <li><a href="user/checkout.php">Checkout</a></li>
                <li><a href="user/riwayat.php">Riwayat</a></li>
            </ul>
        </div>
    </header>

    <!-- search -->
    <div class="search">
        <div class="container">
            <form action="user/produk.php">
                <input type="text" name="search" placeholder="Cari Produk">
                <input type="submit" name="cari" value="Cari Produk">
            </form>
        </div>
    </div>

    <!-- category -->
    <div class="section">
        <div class="container">
            <h3>Kategori</h3>
            <div class="box">
                <?php 
                    $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                    if(mysqli_num_rows($kategori) > 0){
                        while($k = mysqli_fetch_array($kategori)){
                ?>
                    <a href="user/produk.php?kat=<?php echo $k['category_id'] ?>">
                        <div class="col-5">
                            <img src="img/kategori ikon.png" width="50px" style="margin-bottom:5px;">
                            <P><?php echo $k['category_name'] ?></P>
                        </div>
                        </a>
                <?php }}else{ ?>
                    <p>kategori tidak ada</p>    
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- new product -->
    <div class="section">
        <div class="container">
            <h3>Produk Terbaru</h3>
            <div class="box">
                <?php 
                    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 ORDER BY product_id DESC LIMIT 8");
                    if(mysqli_num_rows($produk) > 0){
                        while($p = mysqli_fetch_array($produk)){
                ?>
                    <a href="user/detail-produk.php?id=<?php echo $p['product_id'] ?>">
                        <div class="col-4">
                            <img width="400px" src="produk/<?php echo $p['product_image'] ?>">
                            <p class="nama"><?php echo substr($p['product_name'], 0, 30) ?></p>
                            <p class="harga">Rp. <?php echo number_format($p['product_price']) ?></p>
                        </div>
                    </a>
                 <?php }}else{ ?>
                    <p>Produk tidak ada</p>
                 <?php } ?>
            </div>
        </div>
    </div>
    
    <!-- <?php 
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
    ?> -->

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <small>Copyright &copy; 2022 - HalalFroz.</small>
        </div>
    </footer>
</body>
</html>
