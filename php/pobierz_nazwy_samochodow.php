<?php
  $config_file = 'config.json';
  $config_data = file_get_contents($config_file);
  $config = json_decode($config_data, true);

  $servername = $config['db_host'];
  $username = $config['db_user'];
  $password = $config['db_password'];
  $dbname = $config['db_name'];

  // Tworzenie połączenia z bazą danych
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Sprawdzanie połączenia z bazą danych
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Zapytanie SQL pobierające markę i model z tabeli samochody
  $sql = "SELECT CONCAT(marka, ' ', model) AS nazwa FROM samochody";

  $result = $conn->query($sql);

  $output = array();

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      array_push($output, $row["nazwa"]);
    }
  }

  echo json_encode($output);

  $conn->close();
?>
