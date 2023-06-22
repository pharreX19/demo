API Documentation - Shop Brand

Description
This API endpoint retrieves a single brand from the brands list.

Request

Endpoint
`GET /api/v1/brands/{id}`

### Parameters

-   `id` (required): The unique identifier of the brand.

### Headers

-   `Content-Type: application/json`
-   `Authorization: Bearer {access_token}`

## Response

### Success Response

-   **Status Code:** 200 OK
-   **Content-Type:** application/json

```json
{
    "name": "brand one",
    "slug": "seo-title",
    "website": "http://example.com",
    "description": "description",
    "position": 2,
    "is_visible": true,
    "seo_title": "seo_title",
    "sort": 1,
    "updated_at": "2023-06-22T11:47:28.000000Z",
    "created_at": "2023-06-22T11:47:28.000000Z",
    "id": 6
}
```

Description
This API endpoint retrieves the paginated brand list.

Request

Endpoint
`GET /api/v1/brands/`

### Headers

-   `Content-Type: application/json`
-   `Authorization: Bearer {access_token}`

## Response

### Success Response

-   **Status Code:** 206 HTTP_PARTIAL_CONTENT
-   **Content-Type:** application/json

```json
"current_page": 1,
    "data": [
        {
            "name": "brand one",
            "slug": "seo-title",
            "website": "http://example.com",
            "description": "description",
            "position": 2,
            "is_visible": true,
            "seo_title": "seo_title",
            "sort": 1,
            "updated_at": "2023-06-22T11:47:28.000000Z",
            "created_at": "2023-06-22T11:47:28.000000Z",
            "id": 6
        }
    ],
    "first_page_url": "http://localhost:8000/api/v1/brands?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/v1/brands?page=1",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "http://localhost:8000/api/v1/brands?page=1",
            "label": "1",
            "active": true
        },
        {
            "url": null,
            "label": "Next &raquo;",
            "active": false
        }
    ],
    "next_page_url": null,
    "path": "http://localhost:8000/api/v1/brands",
    "per_page": 15,
    "prev_page_url": null,
    "to": 2,
    "total": 2
}
```

Description
This API endpoint updates an item in the brand list.

Request

Endpoint
`PUT /api/v1/brands/{id}`

### Parameters

-   `id` (required): The unique identifier of the brand.

### Headers

-   `Content-Type: application/json`
-   `Authorization: Bearer {access_token}`

## Response

### Success Response

-   **Status Code:** 200 OK
-   **Content-Type:** application/json

```json
{
    "id": 1,
    "name": "Prof. Name Parker I",
    "email": "lmills@example.com",
    "photo": null,
    "gender": "female",
    "phone": "1-956-784-8279",
    "birthday": "2003-01-19T00:00:00.000000Z",
    "created_at": "2022-12-11T06:57:34.000000Z",
    "updated_at": "2023-05-20T22:46:11.000000Z",
    "deleted_at": null
}
```

Description
This API endpoint deletes an item from the brand list.

Request

Endpoint
`DELETE /api/v1/brands/{id}`

### Parameters

-   `id` (required): The unique identifier of the brand.

### Headers

-   `Content-Type: application/json`
-   `Authorization: Bearer {access_token}`

## Response

### Success Response

-   **Status Code:** 204 HTTP_NO_CONTENT
-   **Content-Type:** application/json

```json

```

### Create Validation Rules

```json
{
    "name": "required|unique:shop_brands,name",
    "slug": "required|unique:shop_brands,slug",
    "website": "required|url",
    "description": "required",
    "position": "required|integer",
    "is_visible": "required|boolean",
    "seo_title": "required|string|min:5|max:60",
    "seo_description": "sometimes|nullable|string|max:160",
    "sort": "required|integer"
}
```

### Error Responses

-   **Status Code:** 401 Unauthorized

    -   **Content-Type:** application/json
    -   **Body:**

    ```json
    {
        "error": "Unauthorized"
    }
    ```

-   **Status Code:** 404 Not Found
    -   **Content-Type:** application/json
    -   **Body:**
    ```json
    {
        "error": "User not found"
    }
    ```
