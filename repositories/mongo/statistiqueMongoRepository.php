<?php

class StatistiqueMongoRepository
{
    private $collection;

    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    /**
     * Récupère toutes les statistiques menus
     */
    public function findAll()
    {
        $cursor = $this->collection->find();

        return iterator_to_array($cursor);
    }

    /**
     * Récupère les statistiques avec filtres
     */
    public function findByFilter(array $filter)
    {
        $cursor = $this->collection->find($filter);

        return iterator_to_array($cursor);
    }

    /**
     * Statistiques par menu
     */
    public function aggregateMenus()
    {
        return $this->collection->aggregate([
            [
                '$group' => [
                    '_id' => '$menu_nom',
                    'nb_commandes' => ['$sum' => 1]
                ]
            ],
            [
                '$sort' => [
                    'nb_commandes' => -1
                ]
            ]
        ])->toArray();
    }
}