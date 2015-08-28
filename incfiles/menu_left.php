<div class="menu">

    <div class="breadLine">
        <div class="arrow"></div>
        <div class="adminControl active">
            Hi, <?php echo $_SESSION['username']; ?>
        </div>
    </div>

    <div class="admin">
        <div class="image">
            <?php
                // Load avatar image
                $imgLoad = ['jpg', 'jpeg', 'png', 'gif'];
                foreach ($imgLoad as $value) {
                    if(file_exists("uploads/user/".$_SESSION['username'].".".$value)){
                        $my_avatar = "uploads/user/".$_SESSION['username'].".".$value;
                }
                if(!isset($my_avatar)) $my_avatar = "uploads/user/default.jpg";
            }
            ?>
            <img src="<?php echo PATH; ?>/<?php echo $my_avatar ; ?>"  height="100" width="50" class="img-polaroid"/>
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

