<?php
class Depence{
    private string $table = "depances";
    private string $montant;
    private string $date;

    public function __construct(string $montant,string $date) {
        $this->montant = $montant;
        $this->date = $date;
       
    }

    

}