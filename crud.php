<?php
    require("connection.php");

    function image_upload($img){
            $tmp_loc = $img['tmp_name'];
            $new_name = random_int(11111,99999).$img['name'];
            $new_loc = UPLOAD_SRC.$new_name;
            if(!move_uploaded_file($tmp_loc, $new_loc))
            {
                header("location:index.php?alert=img_upload");
                exit;
            }else{
               return $new_name;
            }
    }

    function image_remove($img)
    {
        if(!unlink(UPLOAD_SRC.$img))
        {
            header("location:index.php?alert=img_rem_fail");
            exit;

        }else{
            echo "Not deleted";
        }
    }
    if(isset($_POST['addProduct']))
    {
        // print_r($_POST);
        // print_r($_FILES['image']);
        foreach($_POST as $key => $value)
        {
            $_POST[$key] =mysqli_real_escape_string($con, $value);
        }
        $imgPath = image_upload($_FILES['image']);

        $query = "INSERT INTO `products`(`name`, `price`, `description`, `image`)
        VALUES ('$_POST[name]','$_POST[price]','$_POST[desc]','$imgPath')";
        if(mysqli_query($con,$query))
        {
            header("location:index.php?success=added");
        }
        else{
            header("location:index.php?alert=add_failed");
        }
    }


if(isset($_GET['rem']) && $_GET['rem']>0) {
    $query = "SELECT * FROM `products` WHERE `id`='$_GET[rem]'";
    $result = mysqli_query($con, $query);
    $fetch = mysqli_fetch_assoc($result);

    image_remove($fetch['image']);
    $query = "DELETE FROM `products` WHERE `id`='$_GET[rem]'";
    if(mysqli_query($con, $query)) {
        header("location:index.php?success=removed");
    } else {
        header("location:index.php?alert=removed_failed");
    }
}
?>