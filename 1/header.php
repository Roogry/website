<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><?=$_SESSION["nama"];?></a>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="peminjaman.php">Peminjaman</a>
        </li>
        <?php if($_SESSION["level"] != "3"){ ?>
            <li class="nav-item">
                <a class="nav-link" href="pengembalian.php">Pengembalian</a>
            </li>
        <?php } ?>
        <?php if($_SESSION["level"] == "1"){ ?>
            <li class="nav-item">
                <a href="listInvent.php" class="nav-link">Inventaris</a>
            </li>
            <li class="nav-item">
                <a href="report.php" class="nav-link">Laporan</a>
            </li>
        <?php } ?>
    </ul>
    <span class="navbar-text">
        <a href="model/logout.php" class="nav-link text-danger">Logout</a>
    </span>
  </div>
</nav>