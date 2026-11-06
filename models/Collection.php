<?php
// Classe technique "Collection" (annexe D)
class Collection
{
    private $elements = [];

    // Nombre d'éléments de la collection
    public function Cardinal(): int
    {
        return count($this->elements);
    }

    // Vrai si l'objet appartient à la collection
    public function Contient($unObjet): bool
    {
        return in_array($unObjet, $this->elements, true);
    }

    // Index de l'objet (le premier a pour index 0), -1 si absent
    public function Index($unObjet): int
    {
        $index = array_search($unObjet, $this->elements, true);
        return ($index === false) ? -1 : $index;
    }

    // Retourne l'objet d'index donné
    public function Extraire(int $unIndex)
    {
        return $this->elements[$unIndex];
    }

    // Ajoute un objet à la collection
    public function Ajouter($unObjet): void
    {
        $this->elements[] = $unObjet;
    }

    // Supprime un objet de la collection
    public function Enlever($unObjet): void
    {
        $index = $this->Index($unObjet);
        if ($index !== -1) {
            array_splice($this->elements, $index, 1);
        }
    }
}
