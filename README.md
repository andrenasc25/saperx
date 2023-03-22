# API Saperx
<p align="center">Uma api para Agenda Telefônica</p>

### 🎲 Rodando o Back End

```bash
# Clone este repositório
$ git clone <https://github.com/andre-rep/saperx>

# Acesse a pasta do projeto no terminal/cmd
$ cd saperx

# Instale as dependências
$ composer install

# Executar as migrações
$ php artisan migrate

# Execute o servidor laravel
$ php artisan serve

# O servidor inciará na porta:8000 - acesse <http://localhost:8000>
```

## Verbos Http da API
| Método | Endpoint | Descrição | Exemplo de valores a serem enviados |
|---|---|---|---|
| `POST` | http://localhost:8000/api/contato | Insere um novo contato, no campo telefone é possível adicionar mais de um telefone separando por vírgula | nome:nome, email:email@email.com, data_de_nascimento:10/10/2020, cpf:123456789, telefone:12345678,12345678 |
| `GET` | http://localhost:8000/api/contato/ | Exibe todos os contatos com os seus telefones | Não é necessário fazer envio de valores|
| `GET` | http://localhost:8000/api/nomes | Mostra todos os nomes dos usuários cadastrados na agenda | Não é necessário fazer envio de valores |
| `POST` | http://localhost:8000/api/contato/1?filtro=2 | Atualiza um contato de acordo com um id, no caso da rota mostrada é o id=1, caso seja passado por parâmetro um filtro é possível também atualizar um número de telefone sendo que o id desse telefone deve ser passado como filtro | _method:put, nome:novonome, email:email@novoemail.com, data_de_nascimento:20/20/2020, cpf:12345678911, telefone:123456789 |
| `POST` | http://localhost:8000/api/v1/produto/1,2,3 | Atualiza produtos de acordo com parâmetros e valores passados | _method: put, nome: nome atualizado;nome atualizado2;nome atualizado3 e descrição atualizada;descrição atualizada2; descrição atualizada3 |
| `DELETE` | http://localhost:8000/api/contato/1 | Deleta um contato pelo ID | Não é necessário enviar valores |
| `DELETE` | http://localhost:8000/api/telefone/1?filtro=2 | Deleta um número de telefone, o parâmetro é o id do contato e o filtro é o id do telefone | Não é necessário enviar valores |


### Autor
---

<a href="https://github.com/andre-rep">
 <img style="border-radius:50px;" src="https://avatars.githubusercontent.com/u/36203075?v=4" width="100px;" alt=""/>
 <br />
 <sub><b>André Nascimento</b></sub></a> <a href="https://github.com/andre-rep" title="Github">🚀</a>


Feito com ❤️ por André Nascimento