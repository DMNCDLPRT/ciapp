<!DOCTYPE html>
<html lang="en">

<?php include 'header.php'; ?>

<body class="sidebar-mini layout-fixed text-sm layout-navbar-fixed">
    <div class="wrapper">

        <!-- <div class="preloader flex-column justify-content-center align-items-center">
           <h1>CIAPP</h1>
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div> -->

      

      <?php include 'menu.php'; ?>

        <div class="content-wrapper">
            <?= $this->renderSection('content') ?>
        </div>

        <?php include 'footer.php'; ?>

        <aside class="control-sidebar control-sidebar-dark">

        </aside>

    </div>
   
    <?php include 'scripts.php'; ?>
    <?= $this->renderSection('javascripts') ?>
</body>

</html>