
# API Documentation

## Overview
This API provides authentication, blog, category, and tag management functionalities. The endpoints allow users to register, log in, manage blog posts, categories, and tags.

## Base URL
```
https://roadmap.sh/projects/blogging-platform-api
```

---

## **Authentication API**

### **POST /auth/register**
Register a new user and obtain an authentication token.

#### Request:
- **Method:** `POST`
- **URL:** `/auth/register`

#### Body (JSON):
```json
{
  "name": "User Name",
  "email": "user@example.com",
  "password": "password",
  "password_confirmation": "password"
}
```

#### Response:
```json
{
  "access_token": "jwt_token",
  "token_type": "bearer",
  "expires_in": 3600
}
```

---

### **POST /auth/login**
Login a user and return a JWT token.

#### Request:
- **Method:** `POST`
- **URL:** `/auth/login`

#### Body (JSON):
```json
{
  "email": "user@example.com",
  "password": "password"
}
```

#### Response:
```json
{
  "access_token": "jwt_token",
  "token_type": "bearer",
  "expires_in": 3600
}
```

---

### **GET /auth/me**
Get the authenticated user’s information.

#### Request:
- **Method:** `GET`
- **URL:** `/auth/me`

#### Response:
```json
{
  "id": 1,
  "name": "User Name",
  "email": "user@example.com"
}
```

---

### **POST /auth/logout**
Logout the user and invalidate the token.

#### Request:
- **Method:** `POST`
- **URL:** `/auth/logout`

#### Response:
```json
{
  "message": "Successfully logged out"
}
```

---

### **POST /auth/refresh**
Refresh the JWT token.

#### Request:
- **Method:** `POST`
- **URL:** `/auth/refresh`

#### Response:
```json
{
  "access_token": "new_jwt_token",
  "token_type": "bearer",
  "expires_in": 3600
}
```

---

## **Blog API**

### **GET /v1/blog**
List all blog posts (Paginated).

#### Request:
- **Method:** `GET`
- **URL:** `/v1/blog?search=term`

#### Response:
```json
{
  "data": [
    {
      "id": 1,
      "user_id": 1,
      "category_id": 1,
      "title": "Post Title",
      "content": "Post Content"
    },
    ...
  ]
}
```

---

### **POST /v1/blog**
Create a new blog post.

#### Request:
- **Method:** `POST`
- **URL:** `/v1/blog`

#### Body (JSON):
```json
{
  "title": "New Post Title",
  "content": "New Post Content",
  "category_id": 1
}
```

#### Response:
```json
{
  "message": "Post Created Successfully",
  "data": {
    "id": 1,
    "user_id": 1,
    "category_id": 1,
    "title": "New Post Title",
    "content": "New Post Content"
  }
}
```

---

### **GET /v1/blog/{id}**
Show a specific blog post.

#### Request:
- **Method:** `GET`
- **URL:** `/v1/blog/{id}`

#### Response:
```json
{
  "data": {
    "id": 1,
    "user_id": 1,
    "category_id": 1,
    "title": "Post Title",
    "content": "Post Content"
  }
}
```

---

### **PUT /v1/blog/{id}**
Update a specific blog post.

#### Request:
- **Method:** `PUT`
- **URL:** `/v1/blog/{id}`

#### Body (JSON):
```json
{
  "title": "Updated Post Title",
  "content": "Updated Post Content",
  "category_id": 1
}
```

#### Response:
```json
{
  "message": "Post Updated Successfully",
  "data": {
    "id": 1,
    "user_id": 1,
    "category_id": 1,
    "title": "Updated Post Title",
    "content": "Updated Post Content"
  }
}
```

---

### **DELETE /v1/blog/{id}**
Delete a specific blog post.

#### Request:
- **Method:** `DELETE`
- **URL:** `/v1/blog/{id}`

#### Response:
```json
{
  "message": "Post Deleted Successfully"
}
```

---

## **Category API**

### **GET /v1/category**
List all categories (Paginated).

#### Request:
- **Method:** `GET`
- **URL:** `/v1/category`

#### Response:
```json
{
  "data": [
    {
      "id": 1,
      "name": "Category Name"
    },
    ...
  ]
}
```

---

### **POST /v1/category**
Create a new category.

#### Request:
- **Method:** `POST`
- **URL:** `/v1/category`

#### Body (JSON):
```json
{
  "name": "New Category"
}
```

#### Response:
```json
{
  "message": "Category Created Successfully",
  "data": {
    "id": 1,
    "name": "New Category"
  }
}
```

---

### **GET /v1/category/{id}**
Show a specific category.

#### Request:
- **Method:** `GET`
- **URL:** `/v1/category/{id}`

#### Response:
```json
{
  "data": {
    "id": 1,
    "name": "Category Name"
  }
}
```

---

### **PUT /v1/category/{id}**
Update a specific category.

#### Request:
- **Method:** `PUT`
- **URL:** `/v1/category/{id}`

#### Body (JSON):
```json
{
  "name": "Updated Category Name"
}
```

#### Response:
```json
{
  "message": "Category Updated Successfully",
  "data": {
    "id": 1,
    "name": "Updated Category Name"
  }
}
```

---

### **DELETE /v1/category/{id}**
Delete a specific category.

#### Request:
- **Method:** `DELETE`
- **URL:** `/v1/category/{id}`

#### Response:
```json
{
  "message": "Category Deleted Successfully"
}
```

---

## **Tag API**

### **GET /v1/tag**
List all tags (Paginated).

#### Request:
- **Method:** `GET`
- **URL:** `/v1/tag`

#### Response:
```json
{
  "data": [
    {
      "id": 1,
      "name": "Tag Name"
    },
    ...
  ]
}
```

---

### **POST /v1/tag**
Create a new tag.

#### Request:
- **Method:** `POST`
- **URL:** `/v1/tag`

#### Body (JSON):
```json
{
  "name": "New Tag"
}
```

#### Response:
```json
{
  "message": "Tag Created Successfully",
  "data": {
    "id": 1,
    "name": "New Tag"
  }
}
```

---

### **GET /v1/tag/{id}**
Show a specific tag.

#### Request:
- **Method:** `GET`
- **URL:** `/v1/tag/{id}`

#### Response:
```json
{
  "data": {
    "id": 1,
    "name": "Tag Name"
  }
}
```

---

### **PUT /v1/tag/{id}**
Update a specific tag.

#### Request:
- **Method:** `PUT`
- **URL:** `/v1/tag/{id}`

#### Body (JSON):
```json
{
  "name": "Updated Tag Name"
}
```

#### Response:
```json
{
  "message": "Tag Updated Successfully",
  "data": {
    "id": 1,
    "name": "Updated Tag Name"
  }
}
```

---

### **DELETE /v1/tag/{id}**
Delete a specific tag.

#### Request:
- **Method:** `DELETE`
- **URL:** `/v1/tag/{id}`

#### Response:
```json
{
  "message": "Tag Deleted Successfully"
}
```

---

# Installation Guide

## Requirements
- PHP >= 7.4
- Composer
- MySQL or any other supported database
- Laravel 8 or above

## Steps to Install

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-repository-name.git
   cd your-repository-name
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Copy `.env.example` to `.env`**
   ```bash
   cp .env.example .env
   ```

4. **Generate the application key**
   ```bash
   php artisan key:generate
   ```

5. **Set up your database**
   - Configure your `.env` file with the database credentials:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=your_database_name
     DB_USERNAME=your_database_username
     DB_PASSWORD=your_database_password
     ```

6. **Run the migrations**
   ```bash
   php artisan migrate
   ```

7. **Set up API authentication (if using JWT)**
   ```bash
   php artisan api:install
   ```

8. **Serve the application**
   ```bash
   php artisan serve
   ```

9. **Install composer packages**
   ```bash
   composer install
   ```

10. **Access the API**
   - The API will be available at `http://127.0.0.1:8000/api`.

---

## Conclusion

This API allows users to authenticate and manage blog posts, categories, and tags. It is built with Laravel, follows best practices for API development, and includes pagination for retrieving posts, categories, and tags.