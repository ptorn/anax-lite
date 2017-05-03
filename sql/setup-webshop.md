#Webshop Database API
These are the commands to be used for the database.

##Product
###Create a product
```
CALL createProduct(name, description, image, price);
```
+ `name` VARCHAR(20)
+ `description` VARCHAR(400)
+ `image` VARCHAR(20)
+ `price` DECIMAL


###Add product to category
```
CALL addProd2Cat(prod_id, cat_id);
```
+ `prod_id` INT
+ `cat_id` INT


###Update a product
```
CALL updateProduct(newName, newDescription, newImage, newPrice, prod_id);
```
+ `newName` VARCHAR(20)
+ `newDescription` VARCHAR(400)
+ `newImage` VARCHAR(20)
+ `newPrice` DECIMAL
+ `prod_id` INT


###Delete product
```
CALL deleteProduct(prod_id);
```
+ `prod_id` INT


##Shopping cart
###Create a cart
```
CALL createCart(in_customer_id);
```
+ `in_customer_id` INT


###Add product to cart
```
CALL addProd2Cart(in_cart_id, in_prod_id, in_amount);
```
+ `in_cart_id` INT
+ `in_prod_id` INT
+ `in_amount` INT


###Remove product from cart
```
CALL removeProdFromCart(in_cart_id, in_prod_id, in_amount);
```
+ `in_cart_id` INT
+ `in_prod_id` INT
+ `in_amount` INT



##Order management
###Create a order
Create order from cart_id
```
CALL createOrder(in_cart_id, in_customer_id);
```
+ `in_cart_id` INT
+ `in_customer_id` INT


###Delete order
Delete order using order id.
```
CALL deleteOrder(in_order_id);
```
+ `in_order_id` INT



## Views to get data
###VProducts
```
SELECT * FROM VProducts;
```
Get all product information on all products.


###VInventory
```
SELECT * FROM VInventory;
```
Get all data from the inventory and its positions.


###VInvProducts
```
SELECT * FROM VInventory;
```
Get inventory of the products.


###VShoppingCartDetails
```
SELECT * FROM VShoppingCartDetails;
```
Display all details about all shoppingcarts.


###VOrderDetails
```
SELECT * FROM VOrderDetails;
```
Get all orderdetails.


###VInventoryLow
```
SELECT * FROM VInventoryLow;
```
Get all events from InventoryLow
