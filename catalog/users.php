<?php
require_once 'header.php';

echo "Useri<br><br>";

$sql="SELECT * FROM users";
$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
    echo '<table class="table table-striped table-condensed">
              <thead>
              <tr>
                  <th class="text-center" width="115px">Username</th>
                  <th class="text-center" width="115px">Parolă</th>
                  <th class="text-center" width="115px">Nume</th>
                  <th class="text-center" width="115px">Prenume</th>
                  <th class="text-center" width="115px">Rol</th>
              </tr>
          </thead>';
		while($row = $result->fetch_assoc()) {


			echo '<tr>

          <td class="text-center">'.$row["username"].'</td>
          <td class="text-center">'.$row["password"].'</td>
          <td class="text-center">..</td>
          <td class="text-center">..</td>
          <td class="text-center">..</td>
      </tr>
      <tr>


      </tr>
    </tbody>
    </table><br>';
		}
	}
	else {
		echo "0 results";
	}

 ?>
