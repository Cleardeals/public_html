<?php
$servername = "localhost"; 
$username = "cleardealsconi_awards"; 
$password = "Himesh@21"; 
$dbname = "cleardealsconi_awards";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM awards";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Awards List</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .awards {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .award {
            border: 1px solid #ccc;
            margin: 10px;
            padding: 10px;
            width: calc(33% - 20px);
            box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .award img {
            max-width: 100%;
            cursor: pointer; /* Change cursor to pointer for images */
        }

        /* Modal styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.8); /* Black w/ opacity */
        }

        .modal-content {
            margin: 15% auto; /* 15% from the top and centered */
            display: block;
            width: 80%; /* Could be more or less, depending on screen size */
            max-width: 700px; /* Maximum width */
            color: white; /* Text color for modal */
            text-align: justify;
        }

        .close {
            position: absolute;
            top: 20px;
            right: 35px;
            color: #fff;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Awards List</h2>
        <div class="awards">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='award'>";
                    echo "<img src='" . $row['award_image'] . "' alt='" . $row['award_name'] . "' class='award-img' />";
                    echo "<h3>" . $row['award_name'] . "</h3>";
                    echo "<p>" . $row['award_date'] . "</p>";
                    echo "<p>" . $row['award_place'] . "</p>";

                    // Check the length of description and add the "Read More" button if needed
                    $description = $row['award_description'];
                    $words = explode(' ', $description);
                    if (count($words) > 20) {
                        $shortDescription = implode(' ', array_slice($words, 0, 15)) . '...';
                        echo "<p>" . $shortDescription . " <button class='read-more' data-description='" . htmlspecialchars($description, ENT_QUOTES) . "'>Read More</button></p>";
                    } else {
                        echo "<p>" . $description . "</p>";
                    }
                    echo "</div>";
                }
            } else {
                echo "No awards found.";
            }
            ?>
        </div>
    </div>

    <!-- Modal for Read More -->
    <div id="descriptionModal" class="modal">
        <span class="close" id="closeModal">&times;</span>
        <div class="modal-content" id="modalDescription"></div>
    </div>

    <!-- Modal for Images -->
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">
    </div>

    <script>
        // Get the modal for description
        var descriptionModal = document.getElementById("descriptionModal");
        var modalDescription = document.getElementById("modalDescription");

        // Handle Read More button click
        document.querySelectorAll('.read-more').forEach(function(button) {
            button.onclick = function() {
                var fullDescription = this.getAttribute('data-description');
                modalDescription.innerHTML = fullDescription;
                descriptionModal.style.display = "block";
            }
        });

        // Close description modal
        var closeDescription = document.getElementById("closeModal");
        closeDescription.onclick = function() { 
            descriptionModal.style.display = "none";
        }

        // Handle image modal
        var modal = document.getElementById("myModal");
        var images = document.querySelectorAll('.award-img');
        var modalImg = document.getElementById("img01");

        images.forEach(function(image) {
            image.onclick = function(){
                modal.style.display = "block";
                modalImg.src = this.src;
            }
        });

        // Close image modal
        var span = document.getElementsByClassName("close")[0];
        span.onclick = function() { 
            modal.style.display = "none";
        }
        
        // Close the modal when user clicks anywhere outside of the image
        window.onclick = function(event) {
            if (event.target == modal || event.target == descriptionModal) {
                modal.style.display = "none";
                descriptionModal.style.display = "none";
            }
        }
    </script>
</body>
</html>
