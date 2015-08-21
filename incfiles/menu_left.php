<div class="menu">

    <div class="breadLine">
        <div class="arrow"></div>
        <div class="adminControl active">
            Hi, <?php echo $_SESSION['username']; ?>
        </div>
    </div>

    <div class="admin">
        <div class="image">
            <img src="<?php echo PATH;?>/public/img/users/avatar.jpg" class="img-polaroid"/>
        </div>
        <ul class="control">
            <li><span class="icon-cog"></span> <a href="index.php?controller=user&action=edit_starting&id=<?php echo $_SESSION['id']; ?>">Update Profile</a></li>
            <li><span class="icon-share-alt"></span> <a href="index.php?controller=user&action=logout">Logout</a></li>
        </ul>
    </div>

    <ul class="navigation">
        <li>
            <a href="index.php?controller=category&action=show&page=1">
                <span class="isw-grid"></span><span class="text">Categories</span>
            </a>
        </li>
        <li>
            <a href="index.php?controller=product&action=show&page=1">
                <span class="isw-list"></span><span class="text">Products</span>
            </a>
        </li>
        <li>
            <a href="index.php?controller=user&action=show&page=1">
                <span class="isw-user"></span><span class="text ">Users</span>
            </a>
        </li>
    </ul>

</div>