<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>

    <title>NTQ Solution Admin Control Panel</title>

    <link rel="icon" type="image/ico" href="favicon.ico"/>

   <link href="<?php echo PATH; ?>/public/css/stylesheets.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="header">
    <a class="logo" href="index.php?controller=category&action=show&page=1">
        <img src="<?php echo PATH; ?>/public/img/logo.png" alt="NTQ Solution - Admin Control Panel" title="NTQ Solution - Admin Control Panel"/>
    </a>
    
</div>

<?php 
    include "incfiles/menu_left.php";
?>

<div class="content">


    <div class="breadLine">

        <ul class="breadcrumb">
            <li><a href="index.php?controller=category&action=show&page=1">List Categories</a></li>
        </ul>

    </div>

    <div class="workplace">

        <div class="row-fluid">
            <div class="span12 search">
                <form action="index.php" method="GET">
                    <input type="hidden" name="controller" value="category">
                    <input type="hidden" name="action" value="show">
                    <input type="hidden" name="page" value="1">
                    <input type="text" name="search" class="span11" placeholder="Some text for search..."/>
                    <button class="btn span1" type="submit" >Search</button>
                </form>
            </div>
        </div>
        <!-- /row-fluid-->

        <div class="row-fluid">

            <div class="span12">
                <div class="head">
                    <div class="isw-grid"></div>
                    <h1>Categories Management</h1>

                    <div class="clear"></div>
                </div>
                <div class="block-fluid table-sorting">
                    <a href="index.php?controller=category&action=add_category" class="btn btn-add">Add Category</a>
                    <form action="index.php?controller=category&action=box" method="POST">
                    <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable_2">
                        <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll"/></th>
                            <th width="15%" class="sorting"><a href="#">ID</a></th>
                            <th width="35%" class="sorting"><a href="#">Category Name</a></th>
                            <th width="20%" class="sorting"><a href="#">Activate</a></th>
                            <th width="10%" class="sorting"><a href="#">Time Created</a></th>
                            <th width="10%" class="sorting"><a href="#">Time Updated</a></th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                           include "incfiles/page.php";
                        ?>
                        </tbody>
                    </table>
                    <div class="bulk-action">
                    
                        <input type="hidden" name="table" value="categories">
                        <input type="submit" name="activate" value="Activate" class="btn btn-success">
                        <input type="submit" name="delete" value="Delete" class="btn btn-danger">
                        <input type="submit" name="deactivate" value="Deactivate" class="btn btn-danger">

                    </form>
                    </div><!-- /bulk-action-->
                    <?php
                        include "incfiles/paginate.php";
                    ?>
                    <div class="clear"></div>
                </div>
            </div>

        </div>
        <div class="dr"><span></span></div>

    </div>

</div>

</body>
</html>