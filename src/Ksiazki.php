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
		$sql = "SELECT zdjecie, tytul, k.id, concat(imie, ' ', nazwisko) as author, c.nazwa, k.cena from ksiazki k join autorzy a on k.id_autora=a.id join kategorie c ON k.id_kategorii=c.id ORDER BY RAND() LIMIT 5";

		return $this->db->pobierzWszystko($sql);
	}

}
