🎮 Games Shell — Sistema de Catálogo e Comparação de Jogos


O Games Shell é uma aplicação web desenvolvida para centralizar informações de jogos digitais e facilitar a comparação de preços entre diferentes lojas.  
O sistema possui uma área pública para visualização dos jogos e um painel administrativo responsável pelo gerenciamento completo dos dados.

---

🛠️ Stack Utilizada

Back-end: PHP 8+  
Front-end: HTML5, CSS3 (Flexbox/Grid), JavaScript  
Banco de Dados: MySQL (MySQL Workbench)  
Ambiente de Execução: XAMPP  

---

👥 Organização do Desenvolvimento

🧑‍💻 Back-end (PHP)
- Implementação da conexão com o banco de dados
- Desenvolvimento do sistema de autenticação (login com sessão)
- Criação das operações de CRUD (Create, Read, Update, Delete)
- Tratamento de dados recebidos via formulários
- Upload e armazenamento de imagens na pasta /uploads
- Proteção de rotas administrativas

🎨 Front-end (HTML, CSS, JavaScript)
- Construção das interfaces (catálogo, login e painel admin)
- Desenvolvimento de layout responsivo
- Estruturação da vitrine de jogos
- Integração com dados dinâmicos via PHP
- Organização visual e experiência do usuário

🗄️ Banco de Dados (MySQL)
- Modelagem das tabelas
- Criação do script inicial (script.sql)
- Definição dos campos e estrutura de armazenamento
- Suporte na integração com o back-end

---

📂 CATALOGO-DE-JOGOS-PROJETO
│
├── /admin
│   ├── crud.admin
│   ├── cadastro.php      # Cadastro de usuário
│   ├── login.php         # Tela de login
│   ├── logout.php        # Logout do sistema
│   └── painel_admin.php  # Painel administrativo (área protegida)
│
├── /banco
│   └── script.sql        # Script do banco de dados
│
├── /includes
│   └── conexao.php       # Conexão com o banco de dados
│
├── /index
│   ├── index.php         # Página principal
│   ├── sidebar.php       # Menu lateral
│   ├── upperbar.php      # Barra superior
│   │
│   ├── /Capas
│   │   ├── capa.png
│   │   ├── capa1.png
│   │   ├── capa2.png
│   │   └── capa3.png
│   │
│   └── /CSS
│       └── estilo.css.txt
│
├── upperbar.php          # (arquivo duplicado fora da pasta index)
│
└── README.md

---

🔄 Fluxo de Versionamento

O projeto segue um padrão de desenvolvimento baseado em branches:

- main → versão estável
- DEV → integração desenvolvimento e contínuo


---

💡 Boas Práticas Adotadas

- Processamento PHP no topo dos arquivos
- Separação lógica entre front-end e back-end
- Commits pequenos e frequentes
- Estrutura simples e escalável
- Código organizado para fácil manutenção

---

📈 Evoluções Planejadas

- Suporte a múltiplas lojas por jogo
- Sistema de busca e filtros
- Paginação de resultados
- Melhorias de interface
- Possível no futuro deploy em ambiente online

---

🎯 Finalidade

Projeto desenvolvido com foco em prática real de desenvolvimento web, trabalho em equipe e construção de portfólio técnico.

Tomás Ernesto Carvalho 
Kaio Richard Amaral Lisboa
Alex José Neves
