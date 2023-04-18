<?php
// Sprawdzenie, czy formularz został wysłany
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Ustawienie zmiennych z danymi z formularza
    $nazwa = isset($_POST['nazwa']) ? htmlspecialchars(trim($_POST['nazwa'])) : '';
    $miejsceOdbioru = isset($_POST['miejsceOdbioru']) ? htmlspecialchars(trim($_POST['miejsceOdbioru'])) : '';
    $dataOdbioru = isset($_POST['dataOdbioru']) ? htmlspecialchars(trim($_POST['dataOdbioru'])) : '';
    $godzinaOdbioru = isset($_POST['godzinaOdbioru']) ? htmlspecialchars(trim($_POST['godzinaOdbioru'])) : '';
    $dataZwrotu = isset($_POST['dataZwrotu']) ? htmlspecialchars(trim($_POST['dataZwrotu'])) : '';
    $godzinaZwrotu = isset($_POST['godzinaZwrotu']) ? htmlspecialchars(trim($_POST['godzinaZwrotu'])) : '';
	$telefon = isset($_POST['telefon']) ? htmlspecialchars(trim($_POST['telefon'])) : '';
	$from = $_POST['email']; // adres e-mail odbiorcy
    $fotelik = isset($_POST['fotelik']) ? true : false;
    $podkladka = isset($_POST['podkladka']) ? true : false;
    $gps = isset($_POST['gps']) ? true : false;
    $brudneAuto = isset($_POST['brudneAuto']) ? true : false;
    $wyjazdZaGranice = isset($_POST['wyjazdZaGranice']) ? true : false;
    
    // Obliczenie ceny rezerwacji na podstawie danych z formularza
    $cena = 50; // cena za dzień wynajmu
    $cena += $fotelik ? 10 : 0; // dodatkowa opłata za fotelik
    $cena += $podkladka ? 5 : 0; // dodatkowa opłata za podkładkę
    $cena += $gps ? 7 : 0; // dodatkowa opłata za nawigację GPS
    $cena += $brudneAuto ? 15 : 0; // dodatkowa opłata za oddanie brudnego auta
    $cena += $wyjazdZaGranice ? 50 : 0; // dodatkowa opłata za wyjazd za granicę
    
    // Wysłanie wiadomości email z danymi z formularza
    $to = 'info@wypozyczalniasamochodow.com'; // adres email odbiorcy
    $subject = 'Nowa rezerwacja samochodu'; // temat wiadomości
    $message = 'Dane rezerwacji:' . "\r\n\r\n";
    $message .= 'Nazwa auta: ' . $nazwa . "\r\n";
    $message .= 'Miejsce odbioru: ' . $miejsceOdbioru . "\r\n";
    $message .= 'Data odbioru: ' . $dataOdbioru . "\r\n";
    $message .= 'Godzina odbioru: ' . $godzinaOdbioru . "\r\n";
	$message .= 'Data zwrotu: ' . $dataZwrotu . "\r\n";
	$message .= 'Godzina zwrotu: ' . $godzinaZwrotu . "\r\n";
    $message .= 'Telefon kontaktowy: ' . $telefon . "\r\n";

	if(isset($_POST['fotelik'])) {
		$message .= 'Fotelik dla dziecka: Tak' . "\r\n";
		$cena += 50;
	} else {
		$message .= 'Fotelik dla dziecka: Nie' . "\r\n";
	}

	if(isset($_POST['podkladka'])) {
		$message .= 'Podkładka dla dziecka: Tak' . "\r\n";
		$cena += 30;
	} else {
		$message .= 'Podkładka dla dziecka: Nie' . "\r\n";
	}

	if(isset($_POST['nawigacja'])) {
		$message .= 'Nawigacja GPS: Tak' . "\r\n";
		$cena += 20;
	} else {
		$message .= 'Nawigacja GPS: Nie' . "\r\n";
	}

	if(isset($_POST['brudne_auto'])) {
		$message .= 'Możliwość oddania brudnego auta: Tak' . "\r\n";
		$cena += 30;
	} else {
		$message .= 'Możliwość oddania brudnego auta: Nie' . "\r\n";
	}

	if(isset($_POST['wyjazd_zagraniczny'])) {
		$message .= 'Wyjazd poza granicę kraju: Tak' . "\r\n";
		$cena += 100;
	} else {
		$message .= 'Wyjazd poza granicę kraju: Nie' . "\r\n";
	}

	$message .= 'Cena wynajmu: ' . $cena . ' zł' . "\r\n";

	$headers = 'From: ' . $from . "\r\n" .
		'Reply-To: ' . $from . "\r\n" .
		'X-Mailer: PHP/' . phpversion();

	$success = mail($to, $subject, $message, $headers);
}
?>