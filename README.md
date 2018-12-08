## SETUP

PHP VERSION 5.6*,.7.*

Symfony Console Lib - main point for execution of CLI App

SQLITE 
- you should install Sqlite library for your system by enabling load of it in php.ini define don your system. You can
make it by uncommenting .so (Linux) or .dll sqlite line
- after making changes please restart your web server service (Apache , Nginx)

NOTE: on Linux ou should probably install Sqlite before:
$ sudo apt install sqlite3

## DOCS

Apllication helps for managing a simple in memeory stored inventory and shopping cart.
For prpoper running please follow the instructions below.

Main functionalities are:

- you can fill  your inventory with  products with by defining main data (sku, name, , qty, price) before halting inventory state and switching to shopping cart management
- by execution of different commands available you can add, remove, reset items from shoppin cart
- for adding a product to shopping cart your products must be already available in inGventory system and in amount which is equal or higher than amount stated on ADDING TO CART.
- if no amount left or you willing amount(qty) is higher than Stock no execution to be made
- SKU filed is unique identificator of a Product and cannot be any duplicate entries on SKUs

Command list:

Inventory stage
-----------------------
Command call pattern:
$ cd ./inventory COMMAND_NAME

ADD -adding product to inventory system
END - ending the inventory fill proccess

Shopping cart stage
-------------------------------
Command call pattern:
$ cd ./cart COMMAND_NAME

ADD -add product (sku, qty) combo
REMOVE - remove on same way by substarcting defined amount
END - finsih a App and exit
CHECKOUT - printing of shopping cart info with subtotal and FINAL TOTAL for paying. Also after each checkout your cart 
would be emty again and ready for a new order!

