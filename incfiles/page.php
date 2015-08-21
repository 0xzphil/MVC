<?php
if($data!=0){
	for($iter = 0; $iter< count($data['id']) ; $iter++){
        echo "
            <tr>
                <td><input type=\"checkbox\" name=\"checkbox[]\" value=\"".$data['id'][$iter]."\"/></td>";
            for($pos = 0; $pos<count($name_fields); $pos++){
                echo "<td>", $data[$name_fields[$pos]][$iter] ,"</td>";
            }
        echo "<td><a href=\"index.php?controller=".$_GET['controller']."&action=edit_starting&id=".$data['id'][$iter]."\" class=\"btn btn-info\">Edit</a></td></tr>";
    } 
} else {
	echo "Nothing";
}

?>