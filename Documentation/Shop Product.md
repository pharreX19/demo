API Documentation - Shop Product

Description
This API endpoint retrieves a single item from product list.

Request

Endpoint
`GET /api/v1/products/{id}`

### Parameters

-   `id` (required): The unique identifier of the product.

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
    "shop_brand_id": 1,
    "name": "Digitized homogeneous support",
    "slug": "digitized-homogeneous-support",
    "sku": "28314790",
    "barcode": "4871252783524",
    "description": "The Mouse did not dare to disobey, though she knew she had gone through that day. 'That PROVES his guilt,' said the Mock Turtle sang this, very slowly and sadly:-- '\"Will you walk a little of her.",
    "qty": 5,
    ...
}
```

Description
This API endpoint retrieves the paginated product list.

Request

Endpoint
`GET /api/v1/products/`

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
            "id": 1,
            "shop_brand_id": 1,
            "name": "Digitized homogeneous support",
            "slug": "digitized-homogeneous-support",
            "sku": "28314790",
            "barcode": "4871252783524",

        },
        {
            "id": 2,
            "shop_brand_id": 2,
            "name": "Networked dynamic productivity",
            "slug": "networked-dynamic-productivity",
            "sku": "15040510",
            "barcode": "3120914498308",

        }
    ],
    "first_page_url": "http://localhost:8000/api/v1/products?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/v1/products?page=1",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "http://localhost:8000/api/v1/products?page=1",
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
    "path": "http://localhost:8000/api/v1/products",
    "per_page": 15,
    "prev_page_url": null,
    "to": 2,
    "total": 2
}
```

Description
This API endpoint updates an item in the product list.

Request

Endpoint
`PUT /api/v1/products/{id}`

### Parameters

-   `id` (required): The unique identifier of the product.

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
    "shop_brand_id": 1,
    "name": "Digitized homogeneous support",
    "slug": "digitized-homogeneous-support",
    "sku": "28314790",
    "barcode": "4871252783524",
    "description": "The Mouse did not dare to disobey, though she knew she had gone through that day. 'That PROVES his guilt,' said the Mock Turtle sang this, very slowly and sadly:-- '\"Will you walk a little of her.",
    "qty": 5,
    ...
}
```

Description
This API endpoint deletes an item from the product list.

Request

Endpoint
`DELETE /api/v1/products/{id}`

### Parameters

-   `id` (required): The unique identifier of the product.

### Headers

-   `Content-Type: application/json`
-   `Authorization: Bearer {access_token}`

## Response

### Success Response

-   **Status Code:** 204 HTTP_NO_CONTENT
-   **Content-Type:** application/json

```json

```

### Error Responses

### Validation Rules

```json
{
    "shop_brand_id": "required|exists:shop_brands,id",
    "name": "required",
    "slug": "required|unique:shop_products,slug",
    "sku": "required|unique:shop_products,sku",
    "barcode": "sometimes|nullable|string",
    "description": "sometimes|nullable|string",
    "qty": "sometimes|nullable|numeric|min:1",
    "security_stock": "sometimes|nullable|string",
    "featured": "sometimes|nullable|string",
    "is_visible": "sometimes|nullable|boolean",
    "old_price": "sometimes|nullable|numeric",
    "price": "sometimes|nullable|string|numeric",
    "cost": "sometimes|nullable|string",
    "type": "sometimes|nullable|string",
    "backorder": "sometimes|nullable|string",
    "requires_shipping": "boolean|sometimes|nullable",
    "published_at": "sometimes|nullable|date",
    "seo_title": "sometimes|nullable|string",
    "seo_description": "sometimes|nullable|string",
    "weight_value": "sometimes|nullable|string",
    "weight_unit": "sometimes|nullable|string",
    "height_value": "sometimes|nullable|string",
    "height_unit": "sometimes|nullable|string",
    "width_value": "sometimes|nullable|string",
    "width_unit": "sometimes|nullable|string",
    "depth_value": "sometimes|nullable|string",
    "depth_unit": "sometimes|nullable|string",
    "volume_value": "sometimes|nullable|string",
    "volume_unit": "sometimes|nullable|string"
}
```

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
