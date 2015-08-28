<?php 
    include "incfiles/header.php";
    include "incfiles/menu_left.php"; 
?>

<div class="content">


    <div class="breadLine">

        <ul class="breadcrumb">
            <li><a href="index.php?controller=product&action=show&page=1">List Products</a></li>
        </ul>

    </div>

    <div class="workplace">

        <div class="row-fluid">
            <div class="span12 search">
                <form action="index.php" method="GET">
                    <input type="hidden" name="controller" value="product">
                    <input type="hidden" name="action" value="show">
                    <input type="hidden" name="page" value="1">
                    <input type="text" class="span11" placeholder="Some text for search..." name="search">
                    <button class="btn span1" type="submit">Search</button>
                </form>
            </div>
        </div>
        <!-- /row-fluid-->

        <div class="row-fluid">

            <div class="span12">
                <div class="head">
                    <div class="isw-grid"></div>
                    <h1>Products Management</h1>

                    <div class="clear"></div>
                </div>
                <div class="block-fluid table-sorting">
                    <a href="index.php?controller=product&action=add_product" class="btn btn-add">Add Product</a>
                    <form action="index.php?controller=product&action=act" method="POST">
                    <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable_2">
                        <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll" name="checkbox" value="all" /></th>
                            <th width="10%" class="sorting"><a href="#">ID</a></th>
                            <th width="30%" class="sorting"><a href="#">Product Name</a></th>
                            <th width="10%" class="sorting"><a href="#">Category</a></th>
                            <th width="10%" class="sorting"><a href="#">Price</a></th>
                            <th width="10%" class="sorting"><a href="#">Activate</a></th>
                            <th width="10%" class="sorting"><a href="#">Time Created</a></th>
                            <th width="10%" class="sorting"><a href="#">Time Updated</a></th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <?php
                            include "incfiles/page.php";
                        ?>
                    </table>
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