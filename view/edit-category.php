<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>

    <title>NTQ Solution Admin Control Panel</title>

    <link rel="icon" type="image/ico" href="favicon.ico"/>

    <link href="public/css/stylesheets.css" rel="stylesheet" type="text/css"/>

</head>
<body>

<div class="header">
    <a class="logo" href="index.php?controller=category&action=show&page=1">
        <img src="public/img/logo.png" alt="NTQ Solution - Admin Control Panel" title="NTQ Solution - Admin Control Panel"/>
    </a>
    
</div>

<?php include "incfiles/menu_left.php"; ?>

<div class="content">


    <div class="breadLine">

        <ul class="breadcrumb">
            <li><a href="index.php?controller=category&action=show&page=1">List Categories</a> <span class="divider">></span></li>
            <li class="active">Edit</li>
        </ul>

    </div>

    <div class="workplace">

        <div class="row-fluid">

            <div class="span12">
                <div class="head">
                    <div class="isw-grid"></div>
                    <h1>Categories Management</h1>

                    <div class="clear"></div>
                </div>
                <div class="block-fluid">
                    <form action="index.php?controller=category&action=edited_category&id=<?php echo $_GET['id']; ?>" method="POST">
                    	<div class="row-form">
                            <div class="span3">Category Name:</div>
                            <div class="span9"><input type="text" name="category_name" value="<?php echo $category_name; ?>" /></div>
                            <div class="clear"></div>
                        </div> 
                        <div class="row-form">
                            <div class="span3">Activate:</div>
                            <div class="span9">
                                <select name="activate">
                                        <option value="0">choose a option...</option>
                                        <option value="Activate">Activate</option>
                                        <option value="Deactivate">Deactivate</option>
                                </select>
                            </div>
                            <div class="clear"></div>
                        </div>                          
                        <div class="row-form">
                        	<button class="btn btn-success" type="submit" name="Update">Update</button>
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