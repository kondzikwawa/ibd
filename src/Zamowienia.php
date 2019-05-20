<?php

namespace Ibd;

class Zamowienia
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
     * Dodaje zamówienie.
     * 
     * @param int $idUzytkownika
     * @return int Id zamówienia
     */
    public function dodaj($idUzytkownika)
    {
        return $this->db->dodaj('zamowienia', [
            'id_uzytkownika' => $idUzytkownika,
            'id_statusu' => 1
        ]);
    }

    public function pokazHistorieZamowien($idUzytkownika)
    {
        $parmsEmpty = [];
        $sql = "SELECT z.id as 'nr_zamowienia', nazwa as 'status', data_dodania FROM zamowienia as z JOIN zamowienia_statusy as zs ON z.id_statusu = zs.id where z.id_uzytkownika = {$idUzytkownika}";
        return $this->db->pobierzWszystko($sql, $parmsEmpty);
    }

    public function pokazSzczegolyZamowienia($idUzytkownika, $idZamowienia)
    {
        $parmsEmpty = [];
        $sql = "SELECT id from zamowienia where md5(id) = '{$idZamowienia}' and id_uzytkownika = {$idUzytkownika}";
        //echo '<script>console.log('.$sql.')</script>';
		$wiersze = $this->db->pobierzWszystko($sql, $parmsEmpty);
        $numerZamówienia = $wiersze[0][0];
        $sql = "SELECT k.tytul as 'tytul', zs.cena as 'cena', zs.liczba_sztuk as 'liczba_sztuk' from ksiazki as k join zamowienia_szczegoly as zs on zs.id_ksiazki = k.id where zs.id_zamowienia = {$numerZamówienia}";
        return $this->db->pobierzWszystko($sql, $parmsEmpty);
    }

    /**
     * Dodaje szczegóły zamówienia.
     * 
     * @param int $idZamowienia
     * @param array $dane Książki do zamówienia
     */
    public function dodajSzczegoly($idZamowienia, $dane)
    {
        foreach ($dane as $ksiazka) {
            $this->db->dodaj('zamowienia_szczegoly', [
                'id_zamowienia' => $idZamowienia,
                'id_ksiazki' => $ksiazka['id'],
                'cena' => $ksiazka['cena'],
                'liczba_sztuk' => $ksiazka['liczba_sztuk']
            ]);
        }
    }

}
