#  Office System - Controle de Manutenções Mecânica.

Dashboard                  |  Painel de Serviço
:-----------------------:|:-------------------------:
![](/OfficeSystem/assets/img/dashboard.jpg)    |  ![](/OfficeSystem/assets/img/painel-mecanico.jpg)

Descrição do sistema
-----------------------------

O Sistema Office System realiza controle de dados de clientes, veiculo e manutenções realizadas salvando de maneira segura e de fácil acesso. O sistema disponibiliza três níveis de acesso para o administrador, atendente e mecânico. Administrador e atendente podendo realizar gerenciamento de dados e emitir relatórios como produção, veiculo, manutenção e colaborador. O mecânico podendo acessar o sistema para iniciar um novo serviço, visualiza o serviço que está realizando e encerrar o serviço executado.

Características
---------------

* Controle de ordem de serviço
* Controle de manutenções
* Relatórios
* Gerenciamentos de dados

Tecnologias Utilizadas
----------------------

* PHP orientado a objetos
* Arquitetura MVC
* URL amigável
* htaccess
* Banco de dados MYSQL
* Linguagem de consulta SQL
* Bootstrap
* JQuery

Uso
---

1. Usar um servidor web Apache e MYSQL exemplo xampp.
2. Configurar servidor web  para o envio  de e-mail, exemplo arquivo sendmail do xampp.
3. Criar um banco de dados com o nome office e importar o arquivo export_sql, ou usar script_sql para criar as tabelas do banco de dados.

* OBS: Caso escolha importa arquivo export_sql, irá conter dados para o acesso do administrador com a matricula: 1, e senha: 123.
