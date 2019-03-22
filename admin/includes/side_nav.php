<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li>
            <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <?php if($session->usergroup == 2) { ?>
        <li>
            <a href="user.php"><i class="fa fa-user"></i> User</a>
        </li>
        <li>
            <a href="usergroup.php"><i class="fa fa-users"></i> Usergroup</a>
        </li>
        <li>
            <a href="category.php"><i class="fa fa-book"></i> Category</a>
        </li>
        <li>
            <a href="product.php"><i class="fa fa-archive"></i> Product</a>
        </li>
        <li>
            <a href="report.php"><i class="fa fa-file"></i> Report</a>
        </li>
        <?php } ?>
        <?php if($session->usergroup == 2 || $session->usergroup == 3) { ?>
        <li>
            <a href="order.php"><i class="fa fa-cc"></i> Order</a>
        </li>
        <?php } ?>
    </ul>
</div>