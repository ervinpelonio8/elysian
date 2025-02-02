# Elysian - Online Clothing Store

Elysian is a mini e-commerce project featuring AI integration for enhanced shopping experiences. Built using PHP Laravel and Vue.js, it leverages Pinecone for vector database functionality and Gemini API for LLM-powered recommendations.

## Tech Stack

### Backend

- PHP 8.3
- Laravel
- SQLite

### Frontend

- Vue 3

### AI Integration

- Pinecone (Vector Database)
- Gemini API (LLM)

## Installation and Setup

### Prerequisites

Ensure you have the following installed:

- PHP 8.3
- Composer
- Node.js & npm
- SQLite

### Backend Setup

1. Clone the repository:
2. Navigate to the backend directory:

   ```sh
   cd laravel-api
   ```

3. Install dependencies:

   ```sh
   composer install
   ```

4. Copy the environment file and configure settings for both front end and backend:

   ```sh
   cp .env.example .env
   ```

5. Run database migrations:

   ```sh
   php artisan migrate
   ```

6. Start the Laravel server:

   ```sh
   php artisan serve
   ```

### Frontend Setup

1. Navigate to the frontend directory:

   ```sh
   cd my-store
   ```

2. Install dependencies:

   ```sh
   npm install
   ```

3. Start the Vue development server:

   ```sh
   npm run dev
   ```

## AI Integration Setup

### Pinecone Configuration

1. Sign up and create an index on [Pinecone](https://www.pinecone.io/).
2. Add your Pinecone API key to the `.env` file:

   ```env
   PINECONE_API_KEY=your_api_key
   PINECONE_INDEX_HOST=your_index_host
   ```

### Gemini API Configuration

1. Get your API key from [Google AI](https://ai.google.dev/).
2. Add it to the `.env` file:

   ```env
   GOOGLE_API_KEY=your_api_key
   ```

## Running the Application

- Start the Laravel backend with:

  ```sh
  php artisan serve
  ```

- Start the Vue frontend with:

  ```sh
  npm run dev
  ```

The application will be available at `http://localhost:8000` for the backend and `http://localhost:5173` for the frontend.
