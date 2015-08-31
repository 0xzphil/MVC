<!-- HTML -->
<div class="block-fluid table-sorting">
<a href="<?php echo PATH; ?>/index.php?controller=<?php echo $_GET['controller']; ?>&action=add_<?php echo $_GET['controller']; ?>" class="btn btn-add">Add <?php echo $_GET['controller']; ?></a>

<table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable_2">
    <thead>
    <tr>
        <th><input type="checkbox" id="checkAll"  name="checkbox"  value="all" /></th>

        <?php
            foreach ($name_fields as $value) { ?>
            <?php
                if(isset($_GET['order_by'])&& $_GET['order_by']==$value){
                    $class='sorting_'.strtolower($_GET['sort']);
                } else $class="sorting";
            ?>
            
            <th width="15%" class=
            "<?php echo $class; ?>"><a href="<?php echo $_GET['link_show']; ?>&order_by=<?php echo $value; ?>&order_type=<?php echo $_GET['order_type']; ?>">
            <?php echo $value; ?></th>
        <?php
            }
        ?>

        <th width="10%">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
        if($data!=0){
        	for($iter = 0; $iter< count($data['id']) ; $iter++){
                echo "
                    <tr><td width='2%'><input type=\"checkbox\" name=\"checkbox[]\" value=\"".$data['id'][$iter]."\"/></td>";
                    for($pos = 0; $pos<count($name_fields); $pos++){
                        echo "<td>", $data[$name_fields[$pos]][$iter] ,"</td>";
                    }
                echo "<td><a href=\"index.php?controller=".$_GET['controller']."&action=edit_starting&id=".$data['id'][$iter]."\" class=\"btn btn-info\">Edit</a></td></tr>";
            } 
        } else {
        	echo "Nothing";
        }
    ?>
    </tbody>
</table>