<?php 
    require "backend_header.php";
    require "db_connect.php";
    $sql = "SELECT * FROM subcategories ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $subcategories = $stmt->fetchAll();

    $query = "SELECT * FROM brands ORDER BY id DESC";
    $statement = $conn->prepare($query);
    $statement->execute();
    $brands = $statement->fetchAll();

    $id = $_GET['id'];
    $sql1 = "SELECT * FROM items WHERE id=:id" ;
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bindParam(":id",$id);
    $stmt1->execute();
    $item = $stmt1->fetch(PDO::FETCH_ASSOC);  
    

?>

	<div class="app-title">
        <div>
            <h1> <i class="icofont-list"></i> Item Edit Form </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <a href="item_list.php" class="btn btn-outline-primary">
                <i class="icofont-double-left"></i>
            </a>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form action="item_update.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $item['id']; ?>">
                        <input type="hidden" name="oldphoto" value="<?= $item['photo'] ?>">
                        
                        <div class="form-group row">
                            <label for="name_id" class="col-sm-2 col-form-label"> codeno </label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="name_id" name="codeno" value="<?= $item['codeno']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name_id" class="col-sm-2 col-form-label"> Name </label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="name_id" name="name" value="<?= $item['name']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name_id" class="col-sm-2 col-form-label"> Price </label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="name_id" name="price" value="<?= $item['price']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name_id" class="col-sm-2 col-form-label"> Discount </label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="name_id" name="discount" value="<?= $item['discount']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name_id" class="col-sm-2 col-form-label"> Description </label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="name_id" name="description" value="<?= $item['description']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name_id" class="col-sm-2 col-form-label"> Brand </label>
                            <div class="col-sm-10">
                                <select class="form-control" name = 'brand_id'>

                                    <?php foreach ($brands as $brand) :
                                        $id = $brand["id"];
                                        $name = $brand["name"];
                                    ?>
                                        <option value="<?= $id; ?>" <?php if($id==$item['brand_id']){ echo 'selected'; };?>>
                                            <?= $name; ?>
                                                
                                        </option>
                                    <?php endforeach; ?>

                                </select>
                            </div>
                        </div>



                         <div class="form-group row">
                            <label for="name_id" class="col-sm-2 col-form-label"> Subcategory </label>
                            <div class="col-sm-10">
                                <select class="form-control" name = 'subcategory_id'>

                                    <?php foreach ($subcategories as $subcategory) :
                                        $id = $subcategory["id"];
                                        $name = $subcategory["name"];
                                    ?>
                                        <option value="<?= $id; ?>" <?php if($id==$item['subcategory_id']){echo "selected";}; ?>>
                                            <?= $name; ?>
                                                
                                        </option>
                                    <?php endforeach; ?>

                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="photo_id" class="col-sm-2 col-form-label"> Photo </label>
                            <div class="col-sm-10">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                      <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Old Photo</a>
                                      </li>
                                      <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">New Photo</a>
                                      </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <img src="<?= $item['photo']?>" class="img-fluid">
                                      </div>
                                      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                            <input type="file" id="photo_id" name="newphoto">
                                      </div>
                                    </div>
                              
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">
                                    <i class="icofont-save"></i>
                                    Update
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


<?php require "backend_footer.php" ?>