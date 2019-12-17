# Sample project with Symfony 4 and Docker
### Install

run docker:
```
 docker-compose up -d
```
get into the container:
```
 docker-compose exec php sh
```
install dependencies:
```
 composer install
```

index elasticsearch request (made in kibana console) (already inserted, but just in case):
```
 PUT logs
 
 PUT cars
 {
     "settings" : {
         "number_of_shards" : 1
     },
     "mappings" : {
         "_doc" : {
           "properties":{
              "id":{
                 "type":"integer"
              },
              "mark":{
                 "type":"keyword",
                 "index": "true"
              },
              "model":{
                 "type":"keyword",
                 "index": "true"
              },
              "year":{
                 "type":"integer"
              },
              "description":{
                 "type":"text"
              },
              "slug":{
                 "type":"text"
              },
              "enabled":{
                 "type":"boolean"
              },
              "created_at":{
                 "type":"date",
                 "format":"yyyy-MM-dd HH:mm:ss"
              },
              "updated_at":{
                 "type":"date",
                 "format":"yyyy-MM-dd HH:mm:ss"
              },
              "country":{
                 "type":"text"
              },
              "city":{
                 "type":"text"
              },
              "image_filename":{
                 "type":"text"
              }
           }
         }
     }
 }
```

elasticsearch cars data (made in kibana console) (already inserted, but just in case):
```
POST cars/_doc/
{
   "id":1,
   "mark":"mark 0",
   "model":"model 0",
   "year":2000,
   "description":"description 0",
   "slug":"mark-0-model-0-2000",
   "enabled":true,
   "created_at":"2019-05-19 22:46:55",
   "updated_at":"2019-05-19 22:46:55",
   "country":null,
   "city":null,
   "image_filename":null
}

POST cars/_doc/
{
   "id":2,
   "mark":"mark 1",
   "model":"model 1",
   "year":2001,
   "description":"description 1",
   "slug":"mark-1-model-1-2001",
   "enabled":false,
   "created_at":"2019-05-20 22:46:55",
   "updated_at":"2019-05-20 22:46:55",
   "country":null,
   "city":null,
   "image_filename":null
}

POST cars/_doc/
{
   "id":3,
   "mark":"mark 2",
   "model":"model 2",
   "year":2002,
   "description":"description 2",
   "slug":"mark-2-model-2-2002",
   "enabled":true,
   "created_at":"2019-05-21 22:46:55",
   "updated_at":"2019-05-21 22:46:55",
   "country":null,
   "city":null,
   "image_filename":null
}

POST cars/_doc/
{
   "id":4,
   "mark":"mark 3",
   "model":"model 3",
   "year":2003,
   "description":"description 3",
   "slug":"mark-3-model-3-2003",
   "enabled":true,
   "created_at":"2019-05-22 22:46:55",
   "updated_at":"2019-05-22 22:46:55",
   "country":null,
   "city":null,
   "image_filename":null
}

POST cars/_doc/
{
   "id":5,
   "mark":"mark 4",
   "model":"model 4",
   "year":2004,
   "description":"description 4",
   "slug":"mark-4-model-4-2004",
   "enabled":true,
   "created_at":"2019-05-23 22:46:55",
   "updated_at":"2019-05-23 22:46:55",
   "country":null,
   "city":null,
   "image_filename":null
}

POST cars/_doc/
{
   "id":6,
   "mark":"mark 5",
   "model":"model 5",
   "year":2005,
   "description":"description 5",
   "slug":"mark-5-model-5-2005",
   "enabled":true,
   "created_at":"2019-05-24 22:46:55",
   "updated_at":"2019-05-24 22:46:55",
   "country":null,
   "city":null,
   "image_filename":null
}

POST cars/_doc/
{
   "id":7,
   "mark":"mark 6",
   "model":"model 6",
   "year":2006,
   "description":"description 6",
   "slug":"mark-6-model-6-2006",
   "enabled":true,
   "created_at":"2019-05-25 22:46:55",
   "updated_at":"2019-05-25 22:46:55",
   "country":null,
   "city":null,
   "image_filename":null
}

POST cars/_doc/
{
   "id":8,
   "mark":"mark 7",
   "model":"model 7",
   "year":2007,
   "description":"description 7",
   "slug":"mark-7-model-7-2007",
   "enabled":true,
   "created_at":"2019-05-26 22:46:55",
   "updated_at":"2019-05-26 22:46:55",
   "country":null,
   "city":null,
   "image_filename":null
}

POST cars/_doc/
{
   "id":9,
   "mark":"mark 8",
   "model":"model 8",
   "year":2008,
   "description":"description 8",
   "slug":"mark-8-model-8-2008",
   "enabled":true,
   "created_at":"2019-05-27 22:46:55",
   "updated_at":"2019-05-27 22:46:55",
   "country":null,
   "city":null,
   "image_filename":null
}

POST cars/_doc/
{
   "id":10,
   "mark":"mark 9",
   "model":"model 9",
   "year":2009,
   "description":"description 9",
   "slug":"mark-9-model-9-2009",
   "enabled":true,
   "created_at":"2019-05-28 22:46:55",
   "updated_at":"2019-05-28 22:46:55",
   "country":null,
   "city":null,
   "image_filename":null
}

POST cars/_doc/
{
   "id":11,
   "mark":"mark 10",
   "model":"model 10",
   "year":2010,
   "description":"description 10",
   "slug":"mark-10-model-10-2010",
   "enabled":true,
   "created_at":"2019-05-29 22:46:55",
   "updated_at":"2019-05-29 22:46:55",
   "country":"eeuu",
   "city":"Dallas",
   "image_filename":"car1-5ceef19caccd9.jpg"
}
```

put your local IP in ./cars-hex/symfony/behat.yml:
```
base_uri: 'x.x.x.x'
```

put your local IP in ./cars-hex/symfony/.env:
```
LOCAL_IP='x.x.x.x'
```

### Start application

call localhost in your browser:
- [http://localhost](https://localhost/)

### Thanks

For last just give thanks to coloso and his repo -> https://github.com/coloso/symfony-docker which i used his docker base with a few modifications for build this.
