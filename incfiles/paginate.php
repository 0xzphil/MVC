<div class="bulk-action">
    <input type="hidden" name="table" value="<?php echo $_GET['table']; ?>">
    <input type="submit" name="act" class="btn btn-success" value="Activate">
    <input type="submit" name="act" class="btn btn-danger" value="Delete" >
    <input type="submit" name="act" class="btn btn-danger" value="Deactivate"></a>
   

</div><!-- /bulk-action-->

<div class="dataTables_paginate">
    <a class="first paginate_button" href=
    "index.php?controller=<?php echo $_GET['controller']; ?>&action=show&page=1<?php echo $_GET['link'],$_GET['link2']; ?>">First</a>

    <?php 
        if ($_GET['page']>1){ 
    ?>
    <a class="previous paginate_button" href=
    "index.php?controller=<?php echo $_GET['controller']; ?>&action=show&page=<?php echo $_GET['page']-1; ?><?php echo $_GET['link'],$_GET['link2']; ?>">
    Previous</a>
    <?php 
        } else{ 
    ?>
    <a class="previous paginate_button paginate_button_disabled" href="#">
    Previous</a>
    <?php
        };
    ?>
    <span>
        <a class="paginate_active" href=
        "index.php?controller=<?php echo $_GET['controller']; ?>&action=show&page=<?php echo $_GET['page']; ?><?php echo $_GET['link'],$_GET['link2']; ?>">
        <?php echo $_GET['page']; ?></a>
        <?php if($_GET['page']<$max_pages){ ?>
        <a class="paginate_button" href=
        "index.php?controller=<?php echo $_GET['controller']; ?>&action=show&page=<?php echo $_GET['page']+1; ?><?php echo $_GET['link'],$_GET['link2']; ?>">
        <?php echo $_GET['page']+1; ?></a>
        <?php }; ?>
    </span>

    <?php if($_GET['page']<$max_pages){ ?>
    <a class="next paginate_button" href=
    "index.php?controller=<?php echo $_GET['controller']; ?>&action=show&page=<?php echo $_GET['page']+1; ?><?php echo $_GET['link'],$_GET['link2']; ?>">
    Next</a>
    <?php }else{  ?>
    <a class="next paginate_button paginate_button_disabled" href="#">
    Next</a>
    <?php }; ?>
    <a class="last paginate_button" href="index.php?controller=<?php echo $_GET['controller']; ?>&action=show&page=<?php echo $max_pages; ?><?php echo $_GET['link'],$_GET['link2']; ?>">
    Last</a>
</div>