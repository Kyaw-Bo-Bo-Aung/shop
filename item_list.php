<?php 
    require "backend_header.php";
    require "db_connect.php";
    $sql = "SELECT items.*, brands.name as bname, brands.id bid, subcategories.name as sname, 
            subcategories.id as sid
            FROM items
            INNER JOIN brands
            ON items.brand_id = brands.id
            INNER JOIN subcategories
            ON items.subcategory_id = subcategories.id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $items = $stmt->fetchAll();
 ?>

        <div class="app-title">
                        <div>
                            <h1> <i class="icofont-list"></i> Item </h1>
                        </div>
                        <ul class="app-breadcrumb breadcrumb side">
                            <a href="item_new.php" class="btn btn-outline-primary">
                                <i class="icofont-plus"></i>
                            </a>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tile">
                                <div class="tile-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered" id="sampleTable">
                                            <thead>
                                                <tr>
                                                  <th>#</th>
                                                  <th>Name</th>
                                                  <th>Price</th>
                                                  <th>Subcategory</th>
                                                  <th>Brand</th>
                                                  <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $j=1; foreach($items as $item):
                                                    $codeno = $item['codeno'];
                                                    $name = $item['name'];
                                                    $price = $item['price'];
                                                    $discount = $item['discount'];
                                                    $description = $item['description'];
                                                    $id = $item['id'];
                                                    $brand_id = $item['brand_id'];
                                                    $subcategory_id = $item['subcategory_id'];
                                                    $bname = $item['bname'];
                                                    $sname = $item['sname'];

                                                 ?>
                                                <tr>
                                                    <td><?= $j++ ?></td>
                                                    <td><?= $name ?></td>
                                                    <td><?= $price ?></td>                           
                                                    <td><?= $sname ?></td>
                                                    <td><?= $bname ?></td>
                                                    <td>
                                                        <a href="itemlist_edit.php?id=<?= $id?>" class="btn btn-warning">
                                                            <i class="icofont-ui-settings"></i>
                                                        </a>
                                                        <form action="item_delete.php" method="POST" onsubmit= "return confirm('Are you sure to delete?')" class="d-inline-block">
                                                            <input type="hidden" name="id" value= "<?= $id; ?>">
                                                            <button class="btn btn-outline-danger"> <i class="icofont-close"></i></button>
                                                        </form>

                                                        
                                                    </td>

                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



<?php 
        require "backend_footer.php";
 ?>