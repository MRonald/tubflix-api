# tubflix-api

Uma API feita construída em laravel para gerenciar o backend do projeto [Tubflix](https://tubflix.netlify.app/).

## Autenticação da API

### Login

Faça um POST para o seguinte endpoint:
>[https://tubflix-api.herokuapp.com/api/v1/auth/login](https://tubflix-api.herokuapp.com/api/v1/auth/login)

Modelo de corpo da requisição:
```
{
	"email": "email@email.com.br",
	"password": "12345678"
}
```

Caso o email e a senha sejam válidos, a requisição vai retornar o token, o seu tipo e o tempo de expiração em segundos, use isso para se autenticar na API.

### Logout

Faça um POST (sem corpo) para o seguinte endpoint:
>[https://tubflix-api.herokuapp.com/api/v1/auth/logout](https://tubflix-api.herokuapp.com/api/v1/auth/logout)

## Endpoints da API

URL base para busca de vídeos:
>[https://tubflix-api.herokuapp.com/api/v1/videos](https://tubflix-api.herokuapp.com/api/v1/videos)

Busca do vídeo por ID:
>[https://tubflix-api.herokuapp.com/api/v1/videos/1](https://tubflix-api.herokuapp.com/api/v1/videos/1)

URL base para busca de categorias:
>[https://tubflix-api.herokuapp.com/api/v1/categories](https://tubflix-api.herokuapp.com/api/v1/categories)

Busca de categorias por ID:
>[https://tubflix-api.herokuapp.com/api/v1/categories/1](https://tubflix-api.herokuapp.com/api/v1/categories/1)

Busca de todos os vídeos da categoria por ID:
>[https://tubflix-api.herokuapp.com/api/v1/categories/1/videos](https://tubflix-api.herokuapp.com/api/v1/categories/1/videos)
## Manipulação de dados

### Adicionando vídeos

Faça um POST para o seguinte endpoint:
>[https://tubflix-api.herokuapp.com/api/v1/videos](https://tubflix-api.herokuapp.com/api/v1/videos)

Modelo de corpo da requisição:
```
{
	"active": true,
	"title": "frontend com PHP",
	"description": "Como programar frontend sem usar HTML, CSS e JS",
	"url_featured_image": "https://google.com",
	"url_thumbnail_image": "https://google.com",
	"url_video": "https://google.com",
	"categories": [
		1,
		2
	]
}
```

### Alterando vídeos

Faça um PUT para o seguinte endpoint:
>[https://tubflix-api.herokuapp.com/api/v1/videos/{ID}](https://tubflix-api.herokuapp.com/api/v1/videos/{ID})

Modelo de corpo da requisição:
```
{
    "active": true,
	"title": "backend com JS",
	"description": "JS não serve pra nada",
	"url_featured_image": "https://google.com",
	"url_thumbnail_image": "https://google.com",
	"url_video": "https://google.com",
	"categories": [
		1
	]
}
```

*No lugar de {ID} insira o ID do vídeo (URL).

### Apagando vídeos

Faça um DELETE para o endpoint:
>https://tubflix-api.herokuapp.com/api/v1/videos/{ID}

*No lugar de {ID} insira o ID do vídeo (URL).

### Adicionando categorias

Faça um POST para o seguinte endpoint:
>[https://tubflix-api.herokuapp.com/api/v1/categories](https://tubflix-api.herokuapp.com/api/v1/categories)

Modelo de corpo da requisição:
```
{
	"active": true,
	"name": "Carros"
}
```

### Alterando categorias

Faça um PUT para o seguinte endpoint:
>[https://tubflix-api.herokuapp.com/api/v1/categories/{ID}](https://tubflix-api.herokuapp.com/api/v1/categories/{ID})

Modelo de corpo da requisição:
```
{
	"active": true,
	"name": "Natureza"
}
```

*No lugar de {ID} insira o ID do vídeo (URL).

### Apagando categorias

Faça um DELETE para o endpoint:
>https://tubflix-api.herokuapp.com/api/v1/categories/{ID}

*No lugar de {ID} insira o ID do vídeo (URL).
