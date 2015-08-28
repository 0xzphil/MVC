<?php 
    include "incfiles/header.php";
    include "incfiles/menu_left.php"; 
?>


<div class="content">


    <div class="breadLine">

        <ul class="breadcrumb">
            <li><a href="index.php?controller=product&action=show&page=1">List Products</a> <span class="divider">></span></li>
            <li class="active">Add</li>
        </ul>

    </div>

    <div class="workplace">

        <div class="row-fluid">

            <div class="span12">
                <div class="head">
                    <div class="isw-grid"></div>
                    <h1>Products Management</h1>

                    <div class="clear"></div>
                </div>
                <div class="block-fluid">
                    <form action="index.php?controller=product&action=insert_product" method="POST" enctype="multipart/form-data">
                    	<div class="row-form">
                            <div class="span3">Product Name:</div>
                            <?php if(isset($error['product_name'])) echo $error['product_name']; ?>
                            <div class="span9"><input type="text" name="product_name" placeholder="some text value..."/></div>
                            <div class="clear"></div>
                        </div> 
                        <div class="row-form">
                            <div class="span3">Category:</div>
                            <div class="span9">
                                <select name="category_id">
                                <option value="0">choose a option...</option>
                                <?php
                                    foreach ($data as $category) {
                                        # code...
                                        echo "<option value=\"".$category['id']."\">".$category['category_name']."</option>";
                                    }
                                ?> 
                                </select>
                            </div>
                            <div class="clear"></div>
                        </div> 
                    	<div class="row-form">
                            <div class="span3">Price:</div>
                            <?php if(isset($error['price'])) echo $error['price']; ?>
                            <div class="span9"><input type="text" name="price" placeholder="some text value..."/></div>
                            <div class="clear"></div>
                        </div> 
                    	<div class="row-form">
                            <div class="span3">Description:</div>
                            <?php if(isset($error['details'])) echo $error['details']; ?>
                            <div class="span9"><textarea name="details" placeholder="Textarea field placeholder..."></textarea></div>
                            <div class="clear"></div>
                        </div> 
                    	<div class="row-form">
                            <div class="span3">Upload Image:</div>
                            <?php if(isset($error['avatar'])) echo $error['avatar']; ?>
                            <div class="span9"><input type="file" name="avatar" size="19"></div>
                            <div class="clear"></div>
                        </div> 
                        <div class="row-form">
                            <div class="span3">Activate:</div>
                            <?php if(isset($error['activate'])) echo $error['activate']; ?>
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
                        	<button class="btn btn-success" type="submit" name="Creat">Create</button>
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
