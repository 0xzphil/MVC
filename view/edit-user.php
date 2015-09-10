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
                            <div class="span9"><input type="text" name="username" value="<?php echo $user['username'];?>" /></div>
                            <div class="clear"></div>
                        </div> 
                    	<div class="row-form">
                            <div class="span3">Email:</div>
                            <?php if(isset($error['email'])) echo $error['email']; ?>
                            <div class="span9"><input type="text" name="email" value="<?php echo $user['email'];?>"/></div>
                            <div class="clear"></div>
                        </div> 
                    	<div class="row-form">
                            <div class="span3">Password:</div>
                            <?php if(isset($error['password'])) echo $error['password']; ?>
                            <div class="span9"><input type="password" name="password" placeholder="" /></div>
                            <div class="clear"></div>
                        </div> 
                    	<div class="row-form">
                            <div class="span3">Upload Avatar:</div>

                            <div class="span9">
                            <img src="<?php echo $user['avatar'];?>" height="100" width="100" >
                            <?php if(isset($error['avatar'])) echo $error['avatar']; ?><br/>
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
                                    <option value="Activate" <?php if($user['activate']=='Activate'){ ; ?> selected="" <?php }; ?> >Activate</option>
                                    <option value="Deactivate" <?php if($user['activate']=='Deactivate'){ ; ?> selected="" <?php }; ?> >Deactivate</option>
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