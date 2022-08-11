# data base design
* users
    * fullname 
    * username - unique
    * email - unique
    * password
    * status

* categories
    * name
    * slug
    * image
    * parent_id
    * status

* products
    * name
    * short_desc
    * slug
    * content
    * published
    * price
    * promotion
    * quantity
    * view

* product_images
    * id
    * path
    * product_id

* product_categories
    * product_id
    * category_id

* reviews
    * user_id
    * product_id
    * name
    * email
    * rating
    * message

* attributes
    * name
    * type (select - radio)

* attribute_values
    * attribute_id
    * product_id
    * value

* carts
    * product_id
    * attribute_value_id
    * quantity
    * user_id

* orders
    * fullname
    * address
    * email
    * phone
    * note
    * status
    * user_id

* order_details
    * order_id
    * product_id
    * product_attibutes
    * quantity
    * price

* wishlists
    * user_id
    * product_id
    * product_attribute

* categories_post
    * name
    * slug
    * image
    * parent_id
    * status

* posts
    * title
    * short_desc
    * thumbnail
    * content
    * published
    * user_id
    * slug
    * view

* post_categories
    * post_id
    * category_id

* contacts
    * name
    * email
    * subject
    * message

* sliders
    * image
    * title
    * url
    * desc
    * type





