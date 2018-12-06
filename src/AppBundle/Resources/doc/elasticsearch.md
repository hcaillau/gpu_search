# ElasticSearch (ES)

## Description

Notes sur l'utilisation des indexes ES pour les besoins de la mise en oeuvre de l'API

## Création d'un indexe

Pour l'instant, l'indexe est créé automatiquement lors de l'ajout du premier document.

Il conviendra vraissemblablement de configurer l'indexe à la création pour gérer les spécificités de la recherche.

Voir [https://www.elastic.co/guide/en/elasticsearch/reference/current/indices-create-index.html#mappings](ES - Mappings)

## Suppression d'un indexe

`DELETE /{nomIndexe}`

Voir [ES - Delete Index](https://www.elastic.co/guide/en/elasticsearch/reference/current/indices-delete-index.html)


## Ajout d'un document à l'index

```bash
curl -X PUT "localhost:9200/gpu-search/api/index/{nomIndexe}/{idDocument}" -H 'Content-Type: application/json' -d'
{
    "name1" : "value1",
    "name2" : "value2"    
}
'
```

## Suppression d'un document de l'index

```bash
curl -X DELETE -i "localhost:9200/gpu-search/api/index/{nomIndexe}/{idDocument}"
```

## Modification d'un document a partir de l'index 

```bash
curl -X PUT "localhost:9200/gpu-search/api/index/{nomIndexe}/{idDocument}" -H 'Content-Type: application/json' -d'
{
    "name1" : "value1",
    "name2" : "value2"    
} 
'
```

## Liste des éléments de l'indexe avec pagination

https://www.elastic.co/guide/en/elasticsearch/reference/current/search-request-from-size.html

```bash
curl -X GET -i "localhost:9200/gpu-search/api/index/{nomIndexe}/_search/{page}"
```
