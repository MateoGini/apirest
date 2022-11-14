Base URL: www.localhost/web2/tpe-rest/api

Endpoints:
METHOD/URL
GET/cocas	
GET/cocas/:ID
POST/cocas  
body:{
        "tipo_coca": "tipo_coca",
        "envase": envase,
        "stock": stock
    }

DELETE/cocas/:id	

SORTING

/cocas?sortby=example&order=desc

sortby puede tomar valores como id, envase, tipococa, stock

order alterna en desc y asc

FILTER

/cocas?filterByType=example

example puede tomar los valores de los envases que se encuentren.

