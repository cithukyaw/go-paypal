# GoPayPal - PHP PayPal Payment API Helper

This class can generate HTML for Paypal buttons and forms.

It can set a list of parameters for the payments and generates HTML to embed in pages several types of buttons and forms to redirect the user to perform the specified payments in the PayPal site.

Currently it can generate buy now buttons, donate buttons, buy gift certificate buttons, buy subscription buttons, add a product to a shopping cart and display the cart and upload a multiple products to buy from a third party shopping cart.

# Features

1. Generate HTML Forms for PayPal API, including Buy now, Donations, Subscriptions, Shopping carts and Gift certificates.
2. Process PayPal payments and return transactions from PayPal so you can do all processing.

# Supported PayPal API

1. Buy Now
2. Subscriptions
3. Donations
4. Buy Gift Certificates
4. Add To Cart
6. Single Item with PayPal Shopping Cart
7. Multiple Items with Third Party Shopping Cart

# Pre-defined constants for all API types

These following constants are needed to use when creating GoPayPal class instant

- `BUY_NOW` - Buy Now button implementation
- `ADD_TO_CART` - Add To Cart button implementation
- `PAYPAY_CART` - Indivitual items with PayPal shopping cart implementation
- `THIRD_PARTY_CART` - Third-party shopping cart implementation with multiple items
- `DONATE` - Donate button implementation
- `GIFT_CERTIFICATE` - Buy Gift Certificate button implementation
- `SUBSCRIBE` - Subscribe button implementation

# Documentation for HTML variables

[HTML Variables for PayPal Website Payments Standard](http://www.phplucidframe.com/sithu/GoPayPal/doc)

# Examples

All API usages are available in the [examples](https://github.com/cithukyaw/go-paypal/tree/master/examples) directory

Live examples are available at [sithukyaw.com/GoPayPal](http://www.phplucidframe.com/sithu/GoPayPal)
