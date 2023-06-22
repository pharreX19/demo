API Documentation - Auth

Description
This API endpoint registers a new user.

Request

Endpoint
`POST /api/v1/auth/register`

### Parameters

-   `email` (required): The email of the user.
-   `name` (required): The name of the user.
-   `password` (required): The password of the user.

### Headers

-   `Content-Type: application/json`

## Response

### Success Response

-   **Status Code:** 201 CREATED
-   **Content-Type:** application/json

```json
{
    "name": "Prof. Name Parker I",
    "email": "lmills@example.com",
    "created_at": "2022-12-11T06:57:34.000000Z",
    "updated_at": "2023-05-20T22:46:11.000000Z"
}
```

Description
This API endpoint logins an existing user.

Request

Endpoint
`POST /api/v1/auth/login`

### Headers

-   `Content-Type: application/json`

## Response

### Success Response

-   **Status Code:** 200 OK
-   **Content-Type:** application/json

```json
{
    "message": "User logged in successfully",
    "token": "2|5b9RmuvLjFfwdY8GMOcHcArnf4912cFBq7oIfBDl"
}
```

### Error Responses

-   **Status Code:** 422 UNPROCESSABLE ENTITY

    -   **Content-Type:** application/json
    -   **Body:**

    ```json
    {
        "message": "The email has already been taken.",
        "errors": {
            "email": ["The email has already been taken."]
        }
    }
    ```

-   **Status Code:** 401 UNAUTHORIZED
    -   **Content-Type:** application/json
    -   **Body:**
    ```json
    {
        "message": "Email & Password does not match with our record.",
        "errors": [["Email & Password does not match with our record."]]
    }
    ```
