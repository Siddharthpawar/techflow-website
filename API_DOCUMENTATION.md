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

**Description:** Submit a rating (1-5) for a product.

**Request Body:**
```json
{
  "product_id": "web-dev",
  "rating": 5
}
```

**Response:**
```json
{
  "status": "success",
  "message": "Rating submitted successfully",
  "data": {
    "product_id": "web-dev",
    "rating": 5,
    "average_rating": 4.5,
    "total_ratings": 10
  }
}
```

**Example:**
```bash
curl -X POST http://localhost:8000/api/rate.php \
  -H "Content-Type: application/json" \
  -d '{"product_id": "web-dev", "rating": 5}'
```

---

### 3. Track User Visit
**Endpoint:** `POST /api/track.php` or `GET /api/track.php?product_id=web-dev&user_id=user123`

**Description:** Track when a user visits a product page. **Requires user_id for tracking.**

**POST Request Body:**
```json
{
  "product_id": "web-dev",
  "user_id": "user123",
  "page_url": "/product.php?id=web-dev"
}
```

**GET Parameters:**
- `product_id` (required): The ID of the product being viewed
- `user_id` (required): The ID of the user visiting the product
- `page_url` (optional): The URL of the page being visited

**Note:** If `user_id` is not provided in the request, the API will check the session for `user_id` or `userid`. If still not found, it will return an error.

**Response:**
```json
{
  "status": "success",
  "message": "Visit tracked successfully",
  "data": {
    "product_id": "web-dev",
    "user_id": "user123",
    "page_url": "/product.php?id=web-dev",
    "total_visits": 42,
    "user_visits": 3
  }
}
```

**Example:**
```bash
# POST request
curl -X POST http://localhost:8000/api/track.php \
  -H "Content-Type: application/json" \
  -d '{"product_id": "web-dev", "user_id": "user123", "page_url": "/product.php?id=web-dev"}'

# GET request
curl "http://localhost:8000/api/track.php?product_id=web-dev&user_id=user123"
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

