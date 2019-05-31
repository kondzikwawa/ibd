<?php

namespace Ibd;

class Ksiazki
{
	/**
	 * Instancja klasy obsługującej połączenie do bazy.
	 *
	 * @var Db
	 */
	private $db;

	public function __construct()
	{
		$this->db = new Db();
	}

	/**
	 * Pobiera wszystkie książki.
	 *
	 * @return array
	 */
	public function pobierzWszystkie()
	{
		$sql = "SELECT zdjecie, tytul, k.id, concat(imie, ' ', nazwisko) as author, c.nazwa, k.cena from ksiazki k join autorzy a on k.id_autora=a.id join kategorie c ON k.id_kategorii=c.id";

		return $this->db->pobierzWszystko($sql);
	}

	/**
	 * Pobiera dane książki o podanym id.
	 * 
	 * @param int $id
	 * @return array
	 */
	public function pobierz($id)
	{
		return $this->db->pobierz('ksiazki', $id);
	}

	public function pobierzSzczegoly($id)
	{
		return $this->db->pobierzSzczeg($id);
	}

	/**
	 * Pobiera najlepiej sprzedające się książki.
	 * 
	 */
	public function pobierzBestsellery()
	{
		$sql = "SELECT zdjecie, tytul, opis, k.id, concat(imie, ' ', nazwisko) as author, c.nazwa, k.cena from ksiazki k join autorzy a on k.id_autora=a.id join kategorie c ON k.id_kategorii=c.id ORDER BY RAND() LIMIT 5";

		return $this->db->pobierzWszystko($sql);
	}

	/**
	 * Pobiera zapytanie SELECT oraz jego parametry;
	 *
	 * @return array
	 */
	public function pobierzZapytanie($params)
	{
		$parametry = [];
		$sql = "SELECT zdjecie, tytul, k.id, concat(imie, ' ', nazwisko) as author, c.nazwa, k.cena from ksiazki k join autorzy a on k.id_autora=a.id join kategorie c ON k.id_kategorii=c.id WHERE 1=1 ";

		// dodawanie warunków do zapytanie
		if (!empty($params['fraza'])) {
		$sql = "SELECT zdjecie, tytul, k.id, concat(a.imie, ' ', a.nazwisko) as author, c.nazwa, k.cena from ksiazki k join autorzy a on k.id_autora=a.id join kategorie c ON k.id_kategorii=c.id WHERE 1=1 ";
			$sql .= "AND (k.tytul LIKE :fraza OR opis like :fraza or concat(imie, ' ', nazwisko) LIKE :fraza)";
			$parametry['fraza'] = "%$params[fraza]%";
		}
		if (!empty($params['id_kategorii'])) {
			$sql .= "AND k.id_kategorii = :id_kategorii ";
			$parametry['id_kategorii'] = $params['id_kategorii'];
		}
		
		// dodawanie sortowania
		if (!empty($params['sortowanie'])) {
			$kolumny = ['k.tytul', 'k.cena', 'a.nazwisko'];
			$kierunki = ['ASC', 'DESC'];
			list($kolumna, $kierunek) = explode(' ', $params['sortowanie']);
			
			if (in_array($kolumna, $kolumny) && in_array($kierunek, $kierunki)) {
				$sql .= " ORDER BY " . $params['sortowanie'];
			}
		}
		//var_dump($sql);
		return ['sql' => $sql, 'parametry' => $parametry];
	}

/**
	 * Pobiera stronę z danymi książek.
	 * 
	 * @param string $select
	 * @param array $params
	 * @return array
	 */
	public function pobierzStrone($select, $params)
	{
		return $this->db->pobierzWszystko($select, $params);
	}



}
