# gpu-search

## Description

API d'indexation et de recherche pour le remplacement de mongeosource dans la recherche avancée :

http://www.geoportail-urbanisme.gouv.fr/

## Installation

```bash
composer config --global repositories.dockerforge composer http://satis.dockerforge.ign.fr/satis/
composer config --global secure-http false
composer install

bin/console server:run

```

## Fonctionnalités

### API de gestion d'un indexe pour les documents du GpU

* Liste des documents
* Ajout d'un document
* Modification d'un document
* Suppression d'un document

### API de recherche

* Recherche de documents en fonction de paramètres

Remarque : A calquer au maximum sur l'[API de recherche look4](https://geoservices.ign.fr/documentation/geoservices/look4.html#look4---lapi-de-recherche)

### Démonstrateur

Implémentation du futur formulaire de recherche du GpU afin de tester les recherches.


## Goodies

* Formulaire React
* swagger sur l'API





