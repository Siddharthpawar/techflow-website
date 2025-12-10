# API Documentation

## Base URL
All API endpoints are located under `/api/`

## Endpoints

### 1. Get All Products
**Endpoint:** `GET /api/products.php`

**Description:** Returns all products in the application in JSON format.

**Response Format:**
```json
{
  "company": "NovaTrail",
  "items": [
    {
      "id": "web-dev",
      "name": "Web Development",
      "price": 2500,
      "company": "NovaTrail",
      "category": "development",
      "thumbnail": "https://images.unsplash.com/...",
      "description": "Custom web applications built with modern frameworks..."
    }
  ]
}
```

**Example:**
```bash
curl http://localhost:8000/api/products.php
```

---

### 2. Rate a Product
**Endpoint:** `POST /api/rate.php`

**Content-Type:** `application/x-www-form-urlencoded`

**Description:** Submit a rating (1-5) and optional comment for a product.

**Request Fields:**
- `product_id` (string, required): The ID of the product to rate
- `rating` (1-5, required): Rating value between 1 and 5
- `comment` (string, optional): Text comment about the product
- `user` (string, optional): User name
- `email` (string, optional): User email

**Request Example:**
```
product_id=p101&rating=5&comment=Great!&user=Lucifer&email=lucifer@example.com
```

**Response Format:**
```json
{
  "success": true,
  "message": "Rating stored",
  "product_id": "p101",
  "ratingAverage": 4.8,
  "ratingCount": 23
}
```

**Example:**
```bash
curl -X POST http://localhost:8000/api/rate.php \
  -H "Content-Type: application/x-www-form-urlencoded" \
  -d "product_id=p101&rating=5&comment=Great!&user=Lucifer&email=lucifer@example.com"
```

---

### 3. Track User Visit
**Endpoint:** `POST /api/track.php`

**Content-Type:** `application/x-www-form-urlencoded`

**Description:** Track when a user visits a product page.

**Request Fields:**
- `product_id` (string, required): The ID of the product being viewed
- `user` (string, required): The user identifier (can be username or email)

**Request Example:**
```
product_id=c101&user=lucifer@example.com
```

**Response Format:**
```json
{
  "success": true,
  "message": "Visit tracked",
  "product_id": "c101"
}
```

**Example:**
```bash
curl -X POST http://localhost:8000/api/track.php \
  -H "Content-Type: application/x-www-form-urlencoded" \
  -d "product_id=c101&user=lucifer@example.com"
```

---

### 4. Get Top 5 Products
**Endpoint:** `GET /api/top-products.php`

**Description:** Returns the top 5 products/services based on visit count and ratings.

**Response Format:**
```json
{
  "company": "NovaTrail",
  "items": [
    {
      "id": "web-dev",
      "name": "Web Development",
      "price": 2500,
      "company": "NovaTrail",
      "category": "development",
      "thumbnail": "https://images.unsplash.com/...",
      "description": "Custom web applications...",
      "visit_count": 150,
      "average_rating": 4.8,
      "rating_count": 25
    }
  ]
}
```

**Example:**
```bash
curl http://localhost:8000/api/top-products.php
```

---

## Database Setup

Before using the rating and tracking endpoints, you need to set up the database:

1. Create the database and tables:
```bash
mysql -u root -p < database.sql
```

2. Update database credentials in `config/db.php` if needed.

**Note:** The API endpoints will work even without a database connection. The `top-products` endpoint will fall back to cookie-based tracking if the database is unavailable.

---

## Error Responses

All endpoints return error responses in the following format:

```json
{
  "status": "error",
  "message": "Error description"
}
```

Common HTTP status codes:
- `400` - Bad Request (missing or invalid parameters)
- `404` - Not Found (product doesn't exist)
- `405` - Method Not Allowed (wrong HTTP method)
- `500` - Internal Server Error (database or server error)

