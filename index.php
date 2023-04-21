<?php
  require("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Store</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container bg-dark text-light p-3 rounded my-4">
        <div class="d-flex align-item-center justify-content-between px-3">
            <h2>
                <a href="index.php" class="text-white text-decoration-none">
                    <i class="bi bi-bar-chart-fill"></i>Product Store
                </a>
            </h2>

            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProduct">
                <i class="bi bi-plus"></i>Add Product
            </button>
        </div>
    </div>

   <!-- <?php print_r($_SERVER['DOCUMENT_ROOT'])?> -->

   <div class="container mt-5 p-0">
        <table class="table table-hover text-center">
            <thead class="bg-dark text-light">
                <tr>
                    <th width="10%" scope="col" class="rounded-start">Sr.No</th>
                    <th width="15%" scope="col">Image</th>
                    <th width="10%" scope="col">Name</th>
                    <th width="10%" scope="col">Price</th>
                    <th width="35%" scope="col">Description</th>
                    <th width="20%" scope="col" class="rounded-end">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <?php
                    $query = "SELECT * FROM `products`";
                    $result = mysqli_query($con, $query);
                    $i=1;
                    $fetch_src=FETCH_SRC;
                    while($fetch = mysqli_fetch_assoc($result))
                    {
                        echo<<<product
                            <tr class="align-middle">
                                <th scope="row">$i</th>
                                <td><img src="$fetch_src$fetch[image]" width="150px"></td>
                                <td>$fetch[name]</td>
                                <td>$$fetch[price]</td>
                                <td>$fetch[description]</td>
                                <td>
                                    <a>Edit</a>
                                    <button onclick="confirm_rem($fetch[id])" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                        product;
                        $i++;
                    }
                ?>
            </tbody>
        </table>
   </div>
<!-- Modal -->
    <div class="modal fade" id="addProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="crud.php" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Product</h5>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Name</span>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Price</span>
                            <input type="number" class="form-control" name="price"  min ="1" required>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Description</span>
                            <textarea class="form-control" name="desc" required></textarea>
                        </div>

                        <div class="input-group mb-3">
                            <label class="input-group-text">Image</label>
                            <input type="file" class="form-control" name="image" accept=".jpg,.png,.svg"required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success" name="addProduct">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


<script>
    function confirm_rem(id)
    {
       if(confirm("Are you sure,you want to delete this item?"))
       {
            window.location.href="crud.php?rem="+id;
       }
    }
</script>
</body>
</html>