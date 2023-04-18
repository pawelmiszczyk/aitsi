  <?php
	$config_file = 'config.json';
	$config_data = file_get_contents($config_file);
	$config = json_decode($config_data, true);

	$servername = $config['db_host'];
	$username = $config['db_user'];
	$password = $config['db_password'];
	$dbname = $config['db_name'];
	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Nieudane połączenie z bazą danych: " . $conn->connect_error);
	}

	// Pobranie danych z tabeli samochody
	$sql = "SELECT * FROM samochody";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			echo '<article>';
			echo '<h3>' . $row['marka'] . ' ' . $row['model'] . '</h3>';
			echo '<img src="data:image/jpeg;base64,' . base64_encode($row['zdjecie']) . '" alt="' . $row['marka'] . ' ' . $row['model'] . '">';
			echo '<ul>';
			echo '<li>Typ silnika: ' . $row['typ_silnika'] . '</li>';
			echo '<li>Pojemność silnika: ' . $row['pojemnosc_silnika'] . ' l</li>';
			echo '<li>Moc silnika: ' . $row['moc_silnika'] . ' KM</li>';
			echo '<li>Spalanie: ' . $row['spalanie'] . ' l/100 km</li>';
			echo '<li>Ilość drzwi: ' . $row['ilosc_drzwi'] . '</li>';
			echo '<li>ABS: ' . ($row['abs'] ? 'tak' : 'nie') . '</li>';
			echo '<li>Centralny zamek: ' . ($row['centralny_zamek'] ? 'tak' : 'nie') . '</li>';
			echo '<li>Komputer pokładowy: ' . ($row['komputer_pokladowy'] ? 'tak' : 'nie') . '</li>';
			echo '<li>Elektryczne szyby: ' . ($row['elektryczne_szyby'] ? 'tak' : 'nie') . '</li>';
			echo '<li>Klimatyzacja: ' . ($row['klimatyzacja'] ? 'tak' : 'nie') . '</li>';
			echo '<li>Cena za dobę: ' . $row['cena_za_dobe'] . ' PLN</li>';
			echo '</ul>';
			echo '</article>';
		}
	} else {
		echo "Brak danych w bazie.";
	}
	$conn->close();
  ?>