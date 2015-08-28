<?php 
    include "incfiles/header.php";
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
                    <form action="index.php?controller=category&action=act" method="POST">
                    <form  method="POST" action="index.php?controller=user&action=act">
                    <?php 
                        include "incfiles/page.php";
                        include "incfiles/paginate.php";
                    ?>
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