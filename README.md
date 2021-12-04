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

## Principais end-points da API

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

## Paginação da API

Busca ordenada vídeos:
>[https://tubflix-api.herokuapp.com/api/v1/videos?size=5&page=2&order=title,desc](https://tubflix-api.herokuapp.com/api/v1/videos?size=5&page=2&order=title,desc)

Busca ordenada categorias:
>[https://tubflix-api.herokuapp.com/api/v1/categories?size=5&page=1&order=title,asc](https://tubflix-api.herokuapp.com/api/v1/categories?size=5&page=1&order=name,asc)

Busca ordenada de todos os vídeos da categoria por ID:
>[https://tubflix-api.herokuapp.com/api/v1/categories/1/videos?size=5&page=2&order=created_at,desc](https://tubflix-api.herokuapp.com/api/v1/categories/1/videos?size=5&page=2&order=created_at,desc)

Detalhes:
>size - Define o número de itens por página.

>page - Define o número da página a ser acessada.

>order - Recebe dois parâmetros, o campo de ordenação dos dados e a forma de ordenação (asc ou desc).

*Nenhum dos parâmetros é obrigatório.

## Manipulação de dados

>### Vídeos

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

**Ao apagar um vídeo todos os relacionamentos com ele também serão apagados.

### Marcando vídeo como assistido

Faça um POST para o seguinte endpoint:
>https://tubflix-api.herokuapp.com/api/v1/videos/{ID}/view

Modelo de corpo da requisição:
```
{
	"user_id": "3"
}
```

O user_id recebe o id do usuário que assitiu o vídeo.

*No lugar de {ID} insira o ID do vídeo (URL).

### Adicionando vídeo à lista pessoal

Faça um POST para o seguinte endpoint:
>https://tubflix-api.herokuapp.com/api/v1/videos/{ID}/list

Modelo de corpo da requisição:
```
{
	"user_id": "3",
    "action": "add"
}
```

O user_id recebe o id do usuário que adicionou o vídeo à sua lista.
O parâmetro action vai adicionar ou remover o vídeo da lista de acordo com o seu valor ("add" ou "remove").

*No lugar de {ID} insira o ID do vídeo (URL).

### Like ou dislike no vídeo

Faça um POST para o seguinte endpoint:
>https://tubflix-api.herokuapp.com/api/v1/videos/{ID}/like

Modelo de corpo da requisição:
```
{
	"user_id": "3",
    "like": true,
    "dont_like": false,
}
```

O user_id recebe o id do usuário que marcou o vídeo como "gostei" ou "não gostei".
Para gravar um like, o parâmetro "like" deve ser TRUE e o "dont_like" deve ser FALSE.
Para gravar um dislike, o parâmetro "like" deve ser FALSE e o "dont_like" deve ser TRUE.
Para remover a avaliação do usuário sobre o vídeo, "like" e "dont_like" devem ter o valor FALSE.

*No lugar de {ID} insira o ID do vídeo (URL).

>### Categorias

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

**Ao apagar uma categoria todos os relacionamentos com ela também serão apagados.

>### Usuários

### Listando usuários

Faça um GET para o seguinte endpoint:
>[https://tubflix-api.herokuapp.com/api/v1/users](https://tubflix-api.herokuapp.com/api/v1/users)

*Para acessar este end-point você precisa estar logado com privilégios de administrador.

### Adicionando usuários

Faça um POST para o seguinte endpoint:
>[https://tubflix-api.herokuapp.com/api/v1/users](https://tubflix-api.herokuapp.com/api/v1/users)

Modelo de corpo da requisição:
```
{
	"name": "Usuário",
	"email": "email@email.com",
	"password": "12345678"
}
```

### Alterando usuários

Faça um PUT para o seguinte endpoint:
>[https://tubflix-api.herokuapp.com/api/v1/users/{ID}](https://tubflix-api.herokuapp.com/api/v1/users/{ID})

Modelo de corpo da requisição:
```
{
	"name": "Usuário",
	"email": "email@email.com",
	"password": "12345678"
}
```

*No lugar de {ID} insira o ID do vídeo (URL).

### Apagando usuários

Faça um DELETE para o endpoint:
>https://tubflix-api.herokuapp.com/api/v1/users/{ID}

*No lugar de {ID} insira o ID do vídeo (URL).

**Logado como usuário comum você consegue apagar apenas o seu cadastro. Para apagar qualquer usuário você precisa de privilégios de administrador.
