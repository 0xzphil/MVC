<div class="dataTables_paginate">
    <a class="first paginate_button" href="index.php?controller=<?php echo $_GET['controller']; ?>&action=show&page=1">First</a>
    <?php 
        if ($_GET['page']>1){ 
    ?>
    <a class="previous paginate_button" href="index.php?controller=<?php echo $_GET['controller']; ?>&action=show&page=<?php echo $_GET['page']-1; ?>">Previous</a>
    <?php 
        } else{ 
    ?>
    <a class="previous paginate_button paginate_button_disabled" href="#">Previous</a>
    <?php
        };
    ?>
    <span>
   
        <a class="paginate_active" href="index.php?controller=<?php echo $_GET['controller']; ?>&action=show&page=<?php echo $_GET['page']; ?>"><?php echo $_GET['page']; ?></a>
        <?php if($_GET['page']<$max_pages){ ?>
        <a class="paginate_button" href="index.php?controller=<?php echo $_GET['controller']; ?>&action=show&page=<?php echo $_GET['page']+1; ?>"><?php echo $_GET['page']+1; ?></a>
        <?php }; ?>
    </span>
    <?php if($_GET['page']<$max_pages){ ?>
    <a class="next paginate_button" href="index.php?controller=<?php echo $_GET['controller']; ?>&action=show&page=<?php echo $_GET['page']+1; ?>">Next</a>
    <?php }else{  ?>
    <a class="next paginate_button paginate_button_disabled" href="#">Next</a>
    <?php }; ?>
    <a class="last paginate_button" href="index.php?controller=<?php echo $_GET['controller']; ?>&action=show&page=<?php echo $max_pages; ?>">Last</a>
</div>