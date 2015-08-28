<?php 
    include "incfiles/header.php";
    include "incfiles/menu_left.php";
?>

<div class="content">


    <div class="breadLine">

        <ul class="breadcrumb">
            <li><a href="index.php?controller=user&action=show&page=1">List Users</a></li>
        </ul>

    </div>

    <div class="workplace">

        <div class="row-fluid">
            <div class="span12 search">
                <form action="index.php" method="GET">
                    <input type='hidden' name='controller' value='user'/>
                    <input type='hidden' name='action' value='show'/>
                    <input type='hidden' name='page' value='1'/>
                    <input type="text" class="span11" placeholder="Some text for search..." name="search"/>
                    <button class="btn span1" type="submit">Search</button>
                </form>
            </div>
        </div>
        <!-- /row-fluid-->

        <div class="row-fluid">

            <div class="span12">
                <div class="head">
                    <div class="isw-grid"></div>
                    <h1>Users Management</h1>

                    <div class="clear"></div>
                </div>
                <form  method="POST" action="index.php?controller=user&action=act">
                <div class="block-fluid table-sorting">
                    <a href="<?php echo PATH; ?>/index.php?controller=user&action=add_user" class="btn btn-add">Add User</a>
                    
                    <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable_2">
                        <thead>
                        <tr>
                            <?php ?>
                            <th><input type="checkbox" id="checkAll"  name="checkbox"  value="all" /></th>
                            <th width="15%" class="sorting_<?php echo strtolower($_GET['sort'])?>"><a href="<?php echo $_GET['link_show']; ?>&order_by=id&order_type=<?php echo $_GET['order_type']; ?>">ID</th>
                            <th width="35%" class="sorting_<?php echo strtolower($_GET['sort'])?>"><a href="<?php echo $_GET['link_show']; ?>&order_by=username&order_type=<?php echo $_GET['order_type']; ?>">Username</a></th>
                            <th width="20%" class="sorting_<?php echo strtolower($_GET['sort'])?>"><a href="<?php echo $_GET['link_show']; ?>&order_by=activate&order_type=<?php echo $_GET['order_type']; ?>">Activate</a></th>
                            <th width="10%" class="sorting_<?php echo strtolower($_GET['sort'])?>"><a href="<?php echo $_GET['link_show']; ?>&order_by=time_created&order_type=<?php echo $_GET['order_type']; ?>">Time Created</a></th>
                            <th width="10%" class="sorting_<?php echo strtolower($_GET['sort'])?>"><a href="<?php echo $_GET['link_show']; ?>&order_by=time_updated&order_type=<?php echo $_GET['order_type']; ?>">Time Updated</a></th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                           include "incfiles/page.php";
                        ?>
                        </tbody>
                    </table>
                    

                    <?php 
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