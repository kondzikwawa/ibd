<?php

namespace Ibd;

/**
 * Klasa obsługująca połączenie z bazą danych MySQL.
 * 
 */
class Db
{
	/**
	 * Dane dostępowe do bazy.
	 */
	private $dbLogin = 'root';
	private $dbPassword = '';
	private $dbHost = 'localhost';
	private $dbName = 'ibd';

	/**
	 * @var \PDO
	 */
	private $pdo;
	
	public function __construct()
	{
		$this->pdo = new \PDO('mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName, $this->dbLogin, $this->dbPassword);
		$this->pdo->query("SET NAMES utf8");
	}

	/**
	 * Wykonuje podane zapytanie i zwraca wynik w postaci talicy.
	 * 
	 * @param $sql string Zapytanie SQL
	 * @param array $params Tablica z parametrami zapytania
	 * @return array|bool Tablica z danymi, false jeśl nie udało się wysłać zapytania
	 */
	public function pobierzWszystko($sql, $params = null)
	{
		$stmt = $this->pdo->prepare($sql);
		
		if(!empty($params) && is_array($params)) {
			foreach($params as $k => $v)
				$stmt->bindParam($k, $v);
		}
		
		return $stmt->execute() ? $stmt->fetchAll() : false;
	}

	/**
	 * Pobiera rekord o podanym ID z wybranej tabeli.

	 * @param string $table
	 * @param integer $id
	 * @return array|bool
	 */
	public function pobierz($table, $id)
	{
		$sql = "SELECT * FROM $table WHERE id = :id";
		$stmt = $this->pdo->prepare($sql);
		
		return $stmt->execute([':id' => $id]) ? $stmt->fetch() : false;
	}

	public function pobierzSzczeg($id)
	{
		$sql = "SELECT zdjecie, tytul, k.id, concat(imie, ' ', nazwisko) as author, c.nazwa, opis, liczba_stron, isbn, k.cena from ksiazki k join autorzy a on k.id_autora=a.id join kategorie c ON k.id_kategorii=c.id WHERE k.id = :id";
		$stmt = $this->pdo->prepare($sql);
		
		return $stmt->execute([':id' => $id]) ? $stmt->fetch() : false;
	}
		/**
	 * Liczy rekordy zwrócone przez zapytanie.
	 * 
	 * @param string $sql
	 * @param array $params
	 * @return int
	 */
	public function policzRekordy($sql, $params)
	{
		$stmt = $this->pdo->prepare($sql);
		
		if (!empty($params) && is_array($params)) {
			foreach($params as $k => $v) {
				$stmt->bindParam($k, $v);
			}
		}
		$stmt->execute();
		
		return $stmt->rowCount();
	}
}