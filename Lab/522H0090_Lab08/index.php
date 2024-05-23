<?php

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

require "db.php";
$sql = "SELECT * FROM product";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Trang chủ - Danh sách sản phẩm</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        td {
            vertical-align: middle;
        }

        img {
            max-height: 100px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-md-10">
                <h3 class="my-4 text-center">Product List</h3>
                <div class="d-flex justify-content-between">
                    <a class="btn btn-sm btn-secondary mb-4" href="add_product.php">Add Product</a>
                    <a href="logout.php">Logout</a>
                </div>
                <table class="table-bordered table table-hover text-center">
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                    <?php

                    $total_products = 0;

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td class='align-middle'><img src='images/{$row['image']}'></td>";
                        echo "<td class='align-middle'>{$row['name']}</td>";
                        echo "<td class='align-middle'>{$row['price']} VND</td>";
                        echo "<td class='align-middle'>{$row['description']}</td>";
                        echo "<td class='align-middle'>";
                        echo "<button class='btn btn-sm btn-primary mr-1 edit-btn'> <i class='fas fa-pen'></i></button>";
                        echo "<button class='btn btn-sm btn-danger delete-btn'> <i class='fas fa-trash-alt'></i></button>";
                        echo "</td>";
                        echo "</tr>";

                        $total_products++;
                    }

                    ?>
                </table>
                <<p class="text-right">Total products: <strong><?php echo $total_products; ?></strong></p>
            </div>
        </div>
    </div>

    <!-- Delete Confirm Modal -->
    <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete a Product</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this product?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="deleteConfirmBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit Confirm Modal -->
    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <div class="form-group">
                            <label for="editName">Name</label>
                            <input type="text" class="form-control" id="editName">
                        </div>
                        <div class="form-group">
                            <label for="editPrice">Price</label>
                            <input type="number" class="form-control" id="editPrice">
                        </div>
                        <div class="form-group">
                            <label for="editDescription">Description</label>
                            <input type="text" class="form-control" id="editDescription">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveEditBtn">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            // show delete confirm
            $(".delete-btn").click(function() {
                $('#deleteModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            });

            // show edit confirm
            $(".edit-btn").click(function() {
                $('#editModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            });
        });

        // Delete button
        $(document).ready(function() {
            // Variable to store the product ID to be deleted
            let productIdToDelete = null;

            // Function to handle click event on delete button
            $(".delete-btn").click(function() {
                // Get the product ID associated with the delete button
                productIdToDelete = $(this).closest("tr").data("product-id");
                // Show the delete confirmation modal
                $('#deleteModal').modal('show');
            });

            // Function to handle click event on delete confirm button
            $("#deleteConfirmBtn").click(function() {
                // Send an AJAX request to delete the product
                $.ajax({
                    type: "POST",
                    url: "delete_product.php", // Specify the URL to handle the delete operation
                    data: {
                        productId: productIdToDelete
                    },
                    success: function(response) {
                        // Check if the delete operation was successful
                        if (response.success) {
                            // Reload the page to reflect the changes
                            window.location.reload();
                        } else {
                            // Handle the error condition appropriately
                            alert(response.message);
                        }
                    }
                });
            });
        });

        // Edit Button
        $(document).ready(function() {
            // Variable to store the product ID to be edited
            let productIdToEdit = null;

            // Function to handle click event on edit button
            $(".edit-btn").click(function() {
                // Get the product ID associated with the edit button
                productIdToEdit = $(this).closest("tr").data("product-id");
                // Retrieve the product details from the table and populate the edit form
                let productName = $(this).closest("tr").find("td:eq(1)").text();
                let productPrice = $(this).closest("tr").find("td:eq(2)").text();
                let productDescription = $(this).closest("tr").find("td:eq(3)").text();
                $("#editName").val(productName);
                $("#editPrice").val(productPrice);
                $("#editDescription").val(productDescription);
                // Show the edit modal
                $('#editModal').modal('show');
            });

            // Function to handle click event on save changes button
            $("#saveEditBtn").click(function() {
                // Get the updated product details from the edit form
                let editedName = $("#editName").val();
                let editedPrice = $("#editPrice").val();
                let editedDescription = $("#editDescription").val();
                // Send an AJAX request to update the product
                $.ajax({
                    type: "POST",
                    url: "update_product.php", // Specify the URL to handle the update operation
                    data: {
                        productId: productIdToEdit,
                        name: editedName,
                        price: editedPrice,
                        description: editedDescription
                    },
                    success: function(response) {
                        // Check if the update operation was successful
                        if (response.success) {
                            // Reload the page to reflect the changes
                            window.location.reload();
                        } else {
                            // Handle the error condition appropriately
                            alert(response.message);
                        }
                    }
                });
            });
        });
    </script>

</body>

</html>