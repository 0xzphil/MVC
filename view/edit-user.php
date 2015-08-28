<?php 
    include "incfiles/header.php";
    include "incfiles/menu_left.php";
?>


<div class="content">


    <div class="breadLine">

        <ul class="breadcrumb">
            <li><a href="index.php?controller=user&action=show&page=1">List Users</a> <span class="divider">></span></li>
            <li class="active">Edit</li>
        </ul>

    </div>

    <div class="workplace">

        <div class="row-fluid">

            <div class="span12">
                <div class="head">
                    <div class="isw-grid"></div>
                    <h1>Users Management</h1>

                    <div class="clear"></div>
                </div>
                <div class="block-fluid">
                    <form action="index.php?controller=user&action=edited_user&id=<?php echo $_GET['id']; ?>" enctype="multipart/form-data" method="POST">
                    	<div class="row-form">
                            <div class="span3">Username:</div>
                            <?php if(isset($error['username'])) echo $error['username']; ?>
                            <div class="span9"><input type="text" name="username" value="<?php echo $_POST['username'];?>" /></div>
                            <div class="clear"></div>
                        </div> 
                    	<div class="row-form">
                            <div class="span3">Email:</div>
                            <?php if(isset($error['email'])) echo $error['email']; ?>
                            <div class="span9"><input type="text" name="email" value="<?php echo $_POST['email'];?>"/></div>
                            <div class="clear"></div>
                        </div> 
                    	<div class="row-form">
                            <div class="span3">Password:</div>
                            <?php if(isset($error['password'])) echo $error['password']; ?>
                            <div class="span9"><input type="text" name="password" placeholder="some text value..."/></div>
                            <div class="clear"></div>
                        </div> 
                    	<div class="row-form">
                            <div class="span3">Upload Avatar:</div>
                            <?php if(isset($error['avatar'])) echo $error['avatar']; ?>
                            <div class="span9">
                            <?php
                                // Load image
                                $imgLoad = ['jpg', 'jpeg', 'png', 'gif'];
                                foreach ($imgLoad as $value) {
                                    if(file_exists("uploads/".$_GET['controller']."/".$_POST['username'].".".$value)){
                                        $link = "uploads/".$_GET['controller']."/".$_POST['username'].".".$value;
                                }
                                if(!isset($link)) $link = "uploads/".$_GET['controller']."/default.jpg";
                            }
                            ?>
                            <img src="<?php echo PATH; ?>/<?php echo $link; ?>"  height="100" width="100" ><br/>
                            <input type="file" name="avatar">
                            </div>
                            <div class="clear"></div>
                        </div> 
                        <div class="row-form">
                            <div class="span3">Activate:</div>
                            <?php if(isset($error['activate'])) echo $error['activate']; ?>
                            <div class="span9">
                                <select name="activate">
                                    <option value="0">choose a option...</option>
                                    <option value="Activate" autofocus>Activate</option>
                                    <option value="Deactivate">Deactivate</option>
                                </select>
                            </div>
                            <div class="clear"></div>
                        </div>                          
                        <div class="row-form">
                        	<input type="submit" class="btn btn-success" name="update" value="Update">
							<div class="clear"></div>
                        </div>
                    </form>
                    <div class="clear"></div>
                </div>
            </div>

        </div>
        <div class="dr"><span></span></div>

    </div>

</div>

</body>
</html>