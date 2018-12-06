# Recherche sur les documents

## Modèle des documents

| Attribut    | Description               | Exemple                            | Source                                                  |
|-------------|---------------------------|------------------------------------|---------------------------------------------------------|
| type        | Type de document          | PLU, POS, CC...                    | GpU `document.type`                                     |
| title       | Titre du document         | PLU de la commune de Thyez (74278) | Calculé avec la même méthode que pour les flux ATOM (1) |
| supCategory | Catégorie de SUP          | AC1, AC2, etc.                     | GpU `document.supCategory`                              |
| gridName    | Identifiant du territoire | 25349                              | GpU `document.grid.name` (2)                            |
| producer    | Producteur de la donnée   | Marie de Loray                     | `document.producer` (4)                                 |
| geometry    | Géométrie document        | GeoJSON                            | `document.grid.geometry` (3)                            |

* (1) Voir s'il faut ajouter `document.title` dans la base du GpU (calculé une fois pour toute)
* (2) Il va peut-être être intéressant de faire un `gridNames` avec tous les identifiants des parents (`["25349","25","R21","FR"]`)
* (3) On a rien de mieux dans un premier temps sur les SUP, on ne récupère pas la géométrie des zones urbas pour les DU
* (4) **TODO : récupérer depuis métadonnées**

## Paramètres de recherche

* title : titre recherché
* types : filtrage suivant une liste de type
* supCategories : filtrage suivant une liste 
* producer : filtrage par organisme producteur
* geometry : filtrage suivant une géométrie (union calculée côté GpU avant appel)

## Ressources

* [gpu/gpu-search-extractor](http://gitlab.dockerforge.ign.fr/gpu/gpu-search-extractor/blob/master/bin/extract-documents) : Génération d'un jeu test à partir de l'API du GPU


