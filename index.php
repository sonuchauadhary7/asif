<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Floating labels example for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <!-- Custom styles for this template -->
	
<style>
	:root {
	--input-padding-x: .75rem;
	--input-padding-y: .75rem;
	}

	html,
	body {
	height: 100%;
	}

	body {
	display: -ms-flexbox;
	display: flex;
	-ms-flex-align: center;
	align-items: center;
	padding-top: 40px;
	padding-bottom: 40px;
	background-color: #f5f5f5;
	}

	.form-signin {
	width: 100%;
	max-width: 420px;
	padding: 15px;
	margin: auto;
	}

	.form-label-group {
	position: relative;
	margin-bottom: 1rem;
	}

	.form-label-group > input,
	.form-label-group > label {
	padding: var(--input-padding-y) var(--input-padding-x);
	}

	.form-label-group > label {
	position: absolute;
	top: 0;
	left: 0;
	display: block;
	width: 100%;
	margin-bottom: 0; /* Override default `<label>` margin */
	line-height: 1.5;
	color: #495057;
	border: 1px solid transparent;
	border-radius: .25rem;
	transition: all .1s ease-in-out;
	}

	.form-label-group input::-webkit-input-placeholder {
	color: transparent;
	}

	.form-label-group input:-ms-input-placeholder {
	color: transparent;
	}

	.form-label-group input::-ms-input-placeholder {
	color: transparent;
	}

	.form-label-group input::-moz-placeholder {
	color: transparent;
	}

	.form-label-group input::placeholder {
	color: transparent;
	}

	.form-label-group input:not(:placeholder-shown) {
	padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
	padding-bottom: calc(var(--input-padding-y) / 3);
	}

	.form-label-group input:not(:placeholder-shown) ~ label {
	padding-top: calc(var(--input-padding-y) / 3);
	padding-bottom: calc(var(--input-padding-y) / 3);
	font-size: 12px;
	color: #777;
	}
	</style>
  </head>

  <body>
    <form class="form-signin" method="post">
      <div class="text-center mb-4">
        <?php 
			
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "company_data";

			// Create connection
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			// Check connection
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}

			
			if(isset($_POST['inputSalary'])) {
				
				$sql = "INSERT INTO salary (company_id, designation_id, salary)
				VALUES ('{$_POST['companyName']}', '{$_POST['companyDesignation']}', '{$_POST['inputSalary']}')";

				if ($conn->query($sql) === TRUE) {
					echo "New record created successfully";
					$last_id = $conn->insert_id;
					header('Location: download.php?id=' . $last_id);
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
			}

		 ?>
		 <h1 class="h3 mb-3 font-weight-normal">Employee Details</h1>
      </div>

      <div class="form-label-group">
		<select class="form-control" name="companyName" required autodocus>
			<option >Choose Company</option>
			<?php 
				$sql = "SELECT * FROM company_details";
				$result = $conn->query($sql);
				if (mysqli_num_rows($result) > 0) {
					// output data of each row
					while($row = mysqli_fetch_assoc($result)) {
						echo "<option value=' " . $row["id"]. "'>" . $row["name"]. "</option>";
					}
				} 
			?>
			
		</select>
        <!-- <label for="companyEmail">Company Name</label> -->
      </div>

      <div class="form-label-group">
        <select class="form-control"  name="companyDesignation" required>
			<option value="0">Choose Designation</option>
			<?php 
				$sql = "SELECT * FROM designations";
				$result = $conn->query($sql);
				if (mysqli_num_rows($result) > 0) {
					// output data of each row
					while($row = mysqli_fetch_assoc($result)) {
						echo "<option value=' " . $row["id"]. "'>" . $row["name"]. "</option>";
					}
				} 
			?>
		</select>
      </div>
	  
	  <div class="form-label-group">
        <input type="number" id="inputSalary" name="inputSalary" class="form-control" placeholder="Salary" min="5000" max="7000" required>
        <label for="inputSalary">Salary</label>
      </div>
	  
      <button class="btn btn-lg btn-primary btn-block" type="submit">Submit Details</button>
    </form>
  </body>
</html>
