# API Usage Documentation

## Authentication

All primary store endpoints (does not include secondary/nested endpoints) require
a valid authentication token in order to interact with them. To authenticate
yourself, provide your provisioned token as a HTTP header in the format
`Authorization: Bearer <your-token>`.

Example:

    Authorization: Bearer 1|5FdD0RAgNUZ9P3HcmNAM7BSIsTybqflVKj1S5q1w

If the token is invalid or not provided, the HTTP response will be
`401 Unauthorized`, along with the content:

```json
{
    "message": "Unauthenticated."
}
```

---

# User Endpoints

## Register User

* URL `/register`
* Method `POST`
* Authorization `None`
* Form Fields

      Required:
        - name (string)
        - email (string|email)
        - password (string)

* Sample Response `/register`

    ```json
    {
        "user": {
            "name": "Chris",
            "email": "chris@example.com",
            "updated_at": "2021-04-26T13:01:09.000000Z",
            "created_at": "2021-04-26T13:01:09.000000Z",
            "id": 1
        }
    }
    ```

## Create User Token

* URL `/token`
* Method `POST`
* Authorization `Required (Form Email/Password)`
* Form Fields

      Required:
        - email (string|email)
        - password (string)
        - device_name (string)

* Sample Response `/token`

    ```json
    {
        "token": "1|5FdD0RAgNUZ9P3HcmNAM7BSIsTybqflVKj1S5q1w"
    }
    ```

---

# Store Endpoints

There are 5 endpoints, providing basic CRUD

## List Stores

* URL `/stores`
* Method `GET`
* Authorization `Required (Token)`
* Sample Response `/stores`

    ```json
    [
        {
            "id": 1,
            "platform": "shopify"
        },
        {
            "id": 2,
            "platform": "woocommerce"
        }
    ]
    ```

## Find Store

* URL `/stores/:storeId`
* Method `GET`
* Authorization `Required (Token)`
* URL Params

      Required:
        - storeId (integer)

* Sample Response `/stores/1`

    ```json
    {
        "id": 1,
        "platform": "shopify"
    }
    ```

## Create New Store

* URL `/stores`
* Method `POST`
* Authorization `Required (Token)`
* Form Fields

      Required:
        - platform (string)

* Sample Response `/stores`

    ```json
    {
        "platform": "steam",
        "id": 3
    }
    ```

## Edit / Update Store

* URL `/stores/:storeId`
* Method `PUT`
* Authorization `Required (Token)`
* URL Params

      Required:
        - storeId (integer)

* Form Fields

      Required:
        - platform (string)

* Sample Response `/stores/3`

    ```json
    {
        "platform": "steamedit",
        "id": 3
    }
    ```

## Delete Store

* URL `/stores/:storeId`
* Method `DELETE`
* Authorization `Required (Token)`
* URL Params `storeId (int)`
* Sample Response from `/stores/4`

    ```json
    1
    ```

---

# Store Product Endpoints

As requested, there is only one endpoint for products.

## List Products

* URL `/stores/:storeId/products`
* Method `GET`
* Required Params `storeId (int)`
* Sample Response `/stores/1/products`

    ```json
    [
        {
            "id": 1,
            "name": "A Ball",
            "prices": "CAD: 49.99, USD: 9.99, Exchange Rate: Priceless",
            "inventory": 200,
            "variations": "N/A",
            "weight": "1kg"
        },
        {
            "id": 3,
            "name": "A Void",
            "prices": "CAD: -inf",
            "inventory": 0,
            "variations": "Nothing, Black Hole",
            "weight": "A Googol kg"
        }
    ]
    ```
