<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page
    header("Location: login/index.php");
    exit();
}

include('config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

  include('NavBar.php');

    // Fetch template and background image
    $sql = "SELECT * FROM tbl_class WHERE status = '1'";
    $stmt = $conn->prepare($sql);  
    $stmt->execute();
    $result = $stmt->get_result();
   
	$data = [];
    while ($row = $result->fetch_assoc()) {
		$data[] = $row; // Store the result in the array
	}
     	

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Teacher Portal</title>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   <link rel="stylesheet" type="text/css" href="style_students_list.css">
</head>
<body>
<div class="row mt-3 ">
<div class="col-sm-9">
    <h3 class="User" style="color: #FC9DCC;">Hi, <?php echo strtoupper($_SESSION['username']); ?> Welcome to Student Management Portal</h3>
</div>
<div class="col-sm-3">
	<button type="button"  class="add1 btn btn-dark">Add Student Data</button>
</div>
</div>
	<div class="table-container">
	
           <table class="table table-hover">			
				<thead>
					<tr>
						<th>Name</th>
						<th>Subject</th>
						<th>Mark</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($data as $row): ?>
						<tr>
							<td class="data" data-id="<?php echo $row['id']; ?>" data-column="name"><?php echo htmlspecialchars($row['name']); ?></td>
							<td class="data" data-id="<?php echo $row['id']; ?>" data-column="subject"><?php echo htmlspecialchars($row['subject']); ?></td>
							<td class="data" data-id="<?php echo $row['id']; ?>" data-column="mark"><?php echo htmlspecialchars($row['marks']); ?></td>
							<td>
								<button class="save">Save</button>
								<button class="edit">Edit</button>
								<button class="delete">Delete</button>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
	</div>
    	
	 <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h4 style="color:#FC9DCC">Add New Student Data</h4>
            <form id="addForm">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <i class="fas fa-user"></i>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <i class="fas fa-book"></i>
                    <input type="text" id="subject" name="subject" required>
                </div>
                <div class="form-group">
                    <label for="mark">Marks:</label>
                    <i class="fas fa-graduation-cap"></i>
                    <input type="text" id="mark" name="mark" required>
                </div>
                <button type="submit" class="save1">Add</button>
            </form>
        </div>
    </div>

   

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	 <script>
        // Convert input text to uppercase
        document.querySelectorAll('input[type="text"]').forEach(function (input) {
            input.addEventListener('input', function () {
                this.value = this.value.toUpperCase();
            });
        });

        // Modal functionality (optional if you want the modal to show/hide)
        var modal = document.getElementById("myModal");
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    
        // Modal functionality
        var modal = document.getElementById("myModal");
        var btn = document.querySelector(".add1");
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
		
		function addOrUpdateStudent(name, subject, mark, confirmUpdate = false) {
		$.ajax({
			url: 'add.php',
			type: 'POST',
			data: {
				name: name,
				subject: subject,
				mark: mark,
				confirm_update: confirmUpdate // Send this parameter to backend
			},
			success: function(response) {
				const data = JSON.parse(response);
				if (data.status === 'confirm') {
					if (confirm(data.message)) {
						// User confirmed, send the request again with confirmation
						addOrUpdateStudent(name, subject, mark, true);
					}
				} else if (data.status === 'success') {
					alert(data.message);
					location.reload(); // This will reload the entire page
				} else {
					alert(data.message);
				}
			}
		});
	}

	// Example usage
	$('#addForm').on('submit', function(e) {
		e.preventDefault();
		const name = $('#name').val();
		const subject = $('#subject').val();
		const mark = $('#mark').val();
		addOrUpdateStudent(name, subject, mark);
	});

	$(document).on('click', '.edit', function() {
			$(this).closest('tr').find('td.data').each(function() {
				var content = $(this).text();
				$(this).html('<input class="form-group" value="' + content + '" />');
			});

			// Add input listener to force uppercase as the user types
			$(this).closest('tr').find('input').each(function() {
				$(this).on('input', function() {
					this.value = this.value.toUpperCase();
				});
			});

			$(this).siblings('.save').show();
			$(this).siblings('.delete').hide();
			$(this).hide();
	});

		$(document).on('click', '.save', function() {
			var row = $(this).closest('tr');
			var id = row.find('td.data').first().data('id');
			var updatedData = {};

			row.find('td.data').each(function() {
				var col = $(this).data('column');
				var value = $(this).find('input').val();
				updatedData[col] = value;
			});

			// Ensure 'id' and column names match those expected by update.php
			$.ajax({
				url: 'update.php',
				type: 'POST',
				data: {
					id: id,
					name: updatedData.name,
					subject: updatedData.subject,
					mark: updatedData.mark
				},
				success: function(response) {
					alert('Data updated successfully');
					row.find('td.data').each(function() {
						var value = $(this).find('input').val();
						$(this).text(value);
					});
					row.find('.save').hide();
					row.find('.edit').show();
					row.find('.delete').show();
				},
				error: function() {
					alert('Error updating data');
				}
			});
		});



		$(document).on('click', '.delete', function() {
			var row = $(this).closest('tr');
			var id = row.find('td.data').first().data('id');
			
			// Ask for confirmation
			var confirmation = confirm("Are you sure you want to delete this data?");
			
			if (confirmation) {
				$.ajax({
					url: 'delete.php',
					type: 'POST',
					data: { id: id },
					success: function(response) {
						console.log('Server Response:', response); // Log server response
						if (response.success) {
							row.remove(); // Remove row only if deletion was successful
							alert('Data deleted successfully');
						} else {
							alert('Error deleting data on the server.');
						}
					},
					error: function(xhr, status, error) {
						console.error('AJAX Error:', error);
						alert('Error deleting data');
					}
				});
			}
		});

        $('.add').click(function() {
            $('.table tbody').append('<tr><td class="data"></td><td class="data"></td><td class="data"></td><td><button class="save">Save</button><button class="edit">Edit</button><button class="delete">Delete</button></td></tr>');
        });
    </script>
</body>
</html>
