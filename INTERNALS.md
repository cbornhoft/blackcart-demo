# Developer Setup & Application Internals

This API was built using Laravel 8 and Sail, Laravel's own containerized development
solution. The authentication portion leverages Laravel Sanctum.

---

## Initial Setup

To get started, ensure you have Docker Desktop installed on your host
machine, and follow the steps below:

1. Clone this repo

        git clone https://github.com/cbornhoft/blackcart-demo.git

1. Move to the application directory

        cd blackcart-demo

1. Before the containers can start, you'll need to run composer using a temporary
container

        docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v $(pwd):/opt \
        -w /opt \
        laravelsail/php80-composer:latest \
        composer install --ignore-platform-reqs

1. You can build and start your containers!

        ./vendor/bin/sail up -d

1. Run the artisan migrations

        ./vendor/bin/sail artisan migrate

1. Optionally, you can populate the `stores` and `products` tables with some initial data,
if you want to do some manual calls or tests using Postman, Paw, etc.

        INSERT INTO blackcart_demo.stores (platform)
        VALUES ('shopify'), ('woocommerce');

        INSERT INTO blackcart_demo.products (store_id, name, prices, inventory, variations, weight, created_at, updated_at)
        VALUES (1, 'A Ball', 'CAD: 49.99, USD: 9.99, Exchange Rate: Priceless', 200, 'N/A', '1kg', '2021-04-26 9:03:27', '2021-04-26 9:03:27'),
        (2, 'A Cube', 'EUR: 5.00', 7, 'colours: blue, red', '7oz', '2021-04-26 9:03:27', '2021-04-26 9:03:27'),
        (1, 'A Void', 'CAD: -inf', 0, 'Nothing, Black Hole', 'A Googol kg', '2021-04-26 9:03:27', '2021-04-26 9:03:27');

---

## Testing

To run the full test suite, simply run

    ./vendor/bin/sail artisan test

For manual testing, you'll need to register a user and create a token. See
[API Usage and Endpoints](https://github.com/cbornhoft/blackcart-demo/API-USAGE.md)
for how to make those requests.

---

## Notes

- For simplicity, the `store_id` column in the table `products` is not a "true"
  (constrained) foreign key. In a real application, this would be properly linked to
  the `stores` table.
- The `prices`, `inventory`, `variations` and `weight` columns in the table `products`
  are just simple integers and strings. They would typically be JSON fields, or ideally,
  each would have their own table, linked by a foreign key.
