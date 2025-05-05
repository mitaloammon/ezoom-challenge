# Desafio Técnico – Desenvolvedor Fullstack/Mobile Pleno (Ezoom)

Este projeto consiste em uma aplicação completa (frontend em **Ionic + Vue.js** e backend em **CodeIgniter 4**) para envio e listagem de notificações de usuários, conforme os requisitos do desafio técnico proposto pela empresa Ezoom.

## 🧰 Tecnologias utilizadas

- **Frontend:** Ionic + Vue 3 + TypeScript + Axios
- **Backend:** CodeIgniter 4 + PHP + MySQL
- **Banco de dados:** MySQL
- **API RESTful:** Implementada no CodeIgniter
- **Gerenciamento de pacotes:** npm

---

## 🚀 Como rodar o projeto localmente

### 🔧 Requisitos

- Node.js (v18+ recomendado)
- NPM ou Yarn
- PHP (8.1+)
- MySQL (5.7+ ou 8.0+)
- Composer
- Ionic CLI (`npm install -g @ionic/cli`)

### 📦 Backend (API REST - CodeIgniter)

1. Clone o repositório:
   ```bash
   git clone https://github.com/mitaloammon/ezoom-challenge
   cd challenge-developer/backend-project
   ```

2. Instale as dependências:
   ```bash
   composer install
   ```

### 📦 Configuração do Banco de Dados

1. Crie uma base de dados com o nome **`ezoom`**.

2. Em seguida, execute o seguinte script SQL para criar a tabela **`notifications`**, que será utilizada no projeto:

```sql

CREATE TABLE `notifications` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT(10) UNSIGNED NOT NULL,
  `title` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
  `message` TEXT NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
  `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_0900_ai_ci'
ENGINE=InnoDB;
```

> 🔔 Esta tabela será utilizada para armazenar as notificações enviadas aos usuários.

3. Configure o `.env`:
   Copie o arquivo `.env.example` para `.env` e configure os dados do banco:
   ```dotenv
   database.default.hostname = localhost
   database.default.database = ezoom
   database.default.username = root
   database.default.password = 
   database.default.DBDriver = MySQLi
   database.default.DBPrefix =
   database.default.port = 3306
   ```

4. Execute as migrations:
   ```bash
   php spark migrate
   ```

5. Inicie o servidor:
   ```bash
   php spark serve
   ```

A API estará disponível em: `http://localhost:8080`

### 📱 Frontend (Ionic + Vue.js)

1. Vá para o diretório do frontend:
   ```bash
   cd ../frontend-project
   ```

2. Instale as dependências:
   ```bash
   npm install
   ```

3. Inicie o app no navegador:
   ```bash
   ionic serve
   ```

---

## 🧪 Funcionalidades implementadas

- ✅ Envio de notificações (via POST na API)
- ✅ Listagem de notificações por usuário
- ✅ Visualização detalhada da notificação
- ✅ API REST com validação e ordenação
- ✅ Integração completa entre frontend e backend
- ✅ Interface responsiva com Ionic
- ✅ Componente de loading e refresh de notificações
- ⏳ Marcar como lida (em progresso ou futuro)

---

## 🧭 Instruções de uso

### No App:

- **HomePage**: Lista as notificações do usuário
- **ViewNotificationPage**: Exibe detalhes da notificação

---

## 📌 Decisões técnicas

- **Ionic + Vue 3**: Pela rapidez no protótipo, responsividade nativa e familiaridade.
- **CodeIgniter 4**: Framework PHP leve, rápido e com boa documentação.
- **Axios**: Biblioteca robusta para requisições HTTP no Vue.js.
- **Arquitetura RESTful**: Facilita a manutenção e escalabilidade da aplicação.
- **Componentização**: Separação de responsabilidades no frontend para melhor manutenção.

---

# 📦 Converter Ionic + Vue App para APK (Android)

## ✅ Pré-requisitos

1. **Node.js e npm** instalados.
2. **Ionic CLI** globalmente instalado:
   ```bash
   npm install -g @ionic/cli
   ```
3. **Android Studio** instalado e configurado:
   - Defina a variável de ambiente `ANDROID_HOME`.
   - Instale o SDK, AVD, e ferramentas CLI.

4. **Java JDK 11 ou superior** instalado.

---

## 🚀 Etapas para gerar o APK

### 1. Instale o Capacitor

Se ainda não estiver instalado:
```bash
npm install @capacitor/core @capacitor/cli
npx cap init
```

### 2. Adicione a Plataforma Android
```bash
npx cap add android
```

### 3.Construa o projeto da web
```bash
ionic build
```
> Isso irá gerar arquivos em `dist/` ou `www/`, dependendo do seu `angular.json` ou `vite.config.js`.

### 4. Copie os arquivos para a plataforma Android
```bash
npx cap copy
```

### 5. Abra o Android Studio
```bash
npx cap open android
```

> Isso iniciará o Android Studio. Daqui:

- Aguarde a conclusão do **Gradle Sync**.
- Escolha um emulador ou dispositivo físico.
- Vá para **Construir > Construir pacote(s) / APK(s) > Construir APK(s)**.
- O Android Studio gerará um arquivo **APK** e mostrará a localização.

---

## 🛠️  Dica Extra: Atalhos Úteis

- Para sincronizar após alterações:
  ```bash
  npx cap sync
  ```
- Para executar diretamente em um dispositivo:
  ```bash
  npx cap run android
  ```

