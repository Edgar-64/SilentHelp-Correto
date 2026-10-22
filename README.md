# SilentHelp

O **SilentHelp** é uma aplicação web desenvolvida com o objetivo de auxiliar pessoas em situações de risco, permitindo o envio de alertas de emergência, o compartilhamento de localização e o acompanhamento por responsáveis conectados ao sistema.

A plataforma reúne ferramentas de segurança, comunicação e monitoramento em uma interface responsiva, buscando facilitar o acesso às informações importantes em momentos de necessidade.

## Funcionalidades

### Usuários e autenticação
- [x] Cadastro de usuários
- [x] Login e controle de sessão
- [x] Separação entre usuários protegidos, responsáveis e administradores
- [x] Consulta e gerenciamento de dados
- [x] Edição de perfil
- [x] Gerenciamento de informações pessoais

### Segurança e emergências
- [x] Emissão de alertas de emergência
- [x] Envio de alertas ao responsável conectado
- [x] Histórico de alertas
- [x] Filtros para consultar diferentes tipos de ocorrência
- [x] Visualização dos detalhes dos alertas
- [x] Gerenciamento de contatos de emergência
- [x] Registro de informações relacionadas às ocorrências

### Localização e mapas
- [x] Geolocalização por GPS do navegador
- [x] Mapa interativo 3D
- [x] Visualização de localizações e marcadores
- [x] Recursos de navegação pelo mapa
- [x] Integração planejada entre localização, alertas e QR Codes

### Comunicação e acompanhamento
- [x] Interface de chat entre usuário protegido e responsável
- [x] Área do responsável para acompanhamento
- [x] Consulta de informações relacionadas ao usuário protegido
- [x] Visualização de alertas recebidos

### Dispositivos e configurações
- [x] Tela de dispositivos conectados
- [x] Consulta de informações de bateria
- [x] Indicação do estado de conexão do dispositivo
- [x] Configurações de localização
- [x] Modo discreto
- [x] Configurações de alertas e notificações
- [x] Configuração de sons para notificações

### Interface e administração
- [x] Interface responsiva para diferentes tamanhos de tela
- [x] Dashboard com informações resumidas
- [x] Painel administrativo
- [x] Navegação entre as páginas do sistema
- [x] Interface dedicada às funcionalidades de segurança

## Tecnologias utilizadas

- **PHP** — processamento no servidor e integração com o banco de dados.
- **JavaScript** — interatividade, filtros, comunicação com a API e funcionalidades da interface.
- **MySQL** — armazenamento persistente de usuários, configurações e demais registros do sistema.
- **HTML5** — estrutura das páginas.
- **CSS3** — estilização e responsividade.
- **Leaflet** — biblioteca utilizada para a implementação de mapas interativos.
- **InfinityFree** — hospedagem web utilizada no projeto.

> Algumas funcionalidades dependem da configuração do servidor, das permissões do navegador e da integração com o banco de dados.

## Instalação

### 1. Obtenha o projeto

Clone o repositório:

```bash
git clone https://github.com/Edgar-64/SilentHelp-Correto
```

Entre na pasta:

```bash
cd SilentHelp-Correto
```

### 2. Configure o banco de dados

Crie um banco de dados MySQL e importe o arquivo SQL de estrutura disponibilizado pelo projeto, caso exista.

Configure as credenciais de conexão no arquivo responsável pela conexão com o banco, como `db.php` ou `config.php`, conforme a estrutura utilizada na versão do projeto.

**Importante:** não publique senhas reais, credenciais do banco ou outros dados sensíveis no repositório.

### 3. Configure o servidor

Utilize um servidor compatível com PHP e MySQL, como um ambiente local com XAMPP ou a hospedagem InfinityFree.

Coloque os arquivos na pasta pública do servidor e confirme se:
- O PHP está habilitado.
- O banco de dados está acessível.
- As credenciais estão corretas.
- As páginas conseguem acessar os endpoints da API.

### 4. Execute o sistema

Acesse o endereço local ou público configurado para o projeto pelo navegador.

Em um ambiente local, o endereço dependerá da configuração do servidor web e da pasta em que os arquivos foram instalados.

## 📁 Estrutura do projeto

A estrutura pode variar conforme a versão. Entre os arquivos e diretórios utilizados no projeto estão:

```text
SilentHelp/
├── admin/
├── assets/
│   └── db-sync.js
├── api.php
├── db.php
├── config.php
├── inicio.php
├── mapa.php
├── historico.php
├── perfil.php
├── contatos-emergencia.php
├── diario.php
├── dispositivo-conectado.php
└── qrcode.php
```

- `admin/` — páginas da área administrativa.
- `assets/` — arquivos JavaScript, estilos e recursos da interface.
- `api.php` — endpoints para operações e comunicação entre a interface e o servidor.
- `db.php` — conexão com o banco de dados.
- `config.php` — página de configurações do usuário.
- `inicio.php` — tela inicial do usuário protegido.
- `mapa.php` — recursos relacionados à localização e aos mapas.
- `historico.php` — consulta ao histórico de alertas.
- `perfil.php` — gerenciamento do perfil.
- `contatos-emergencia.php` — gerenciamento de contatos de emergência.
- `diario.php` — área de registros pessoais.
- `dispositivo-conectado.php` — informações e gerenciamento de dispositivos.
- `qrcode.php` — funcionalidade relacionada a QR Codes.

## 🔐 Segurança e privacidade

O SilentHelp lida com informações potencialmente sensíveis. Por isso, sua implantação deve considerar:

- Proteção das credenciais do banco de dados.
- Controle de acesso às páginas e aos endpoints.
- Validação dos dados recebidos pelo servidor.
- Proteção das sessões de usuário.
- Uso de HTTPS para acesso à localização e à aplicação.
- Respeito às permissões de localização e notificações do navegador.

O projeto é uma ferramenta de apoio e não substitui serviços oficiais de emergência. Antes de utilizá-lo em situações reais, é necessário testar suas funcionalidades e garantir a confiabilidade da infraestrutura.

## 🚀 Melhorias futuras

- Aprimoramento das notificações em tempo real.
- Integração com dispositivos físicos de rastreamento.
- Expansão do sistema de QR Codes e localização.
- Melhorias na visualização de mapas e ambientes internos.
- Aprimoramento da comunicação entre usuários protegidos e responsáveis.
- Ampliação dos testes de segurança e confiabilidade.

## 🧑‍💻 Autor

**Edgar Maia**

- GitHub: https://github.com/Edgar-64

---

*SilentHelp — tecnologia e informação para apoiar a segurança e o acompanhamento de pessoas.*