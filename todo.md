TODO for lovebirdsconsulting.com ecommerce web app which powers djmblog.com 2/8/2016, 2/11/2016, 2/13/2016, 2/28/2016, 3/1/2016, 3/8/2016, 3/21/2016, 6/1/2016, 8/8/2016. 8/13/2016 by Dan McKeown http://danmckeown.info

Photographer Module Issues
- The photos cart [appointment version] may not unset after purchases
- Numerous created at/updated at fields are not filled out when the row is created, in the Photo model and maybe Gallerys controller
- /myphotos/cart throws errors when user has no photos in that cart

Store Issues - Physical
- The admin still needs a UI to see which physical good orders need to be fulfilled and to keep track of that

Store Issues - non-Physical
- the /purchases page lists empty bullet points for any puchases of since-deleted digital store items

Messages
- the delete feature appears broken--it will delete a post, just not necessarily the post the user chooses

Writing Over Blindfire
- In building the /myphotos Pro Photographer Client and Asset Management System, the old /blindfire module was written over in a way that means it still works--except it loudly throws an exception on the after-upload page because there is no customer id (users_id) as now expected when processing the post data--maybe there could be a little check for this which could ensure the continued utility of the /blindfire pattern (even if upload customer photos + don't add a customer works as an alternative)
- Overall the Gallerys controller is very large, as it does a cascade of access checks for each step to ensure secutity.  It is very likely that a lot of this logic could be put into model or helper methods and called.

Gallerys
- set minimum photos that user can buy at checkout as constant
- round with two decimals the totals in cart screen

Gallerys controller issues/toDo
- x? When a user is selected as a customer at /gallerys/upload it seems to fail at naming the gallery and the title field stays as null
- x Build admin UI for adding/deleting photos to existing gallerys
- Build admin UI for deleting photos from existing gallerys
- x Build customer UI for viewing their photos
- xBuild process_upload method to upload two sets of photos--one small with watermarks and one full size.  Watermarked version should have different type of name and should be stored in a new column in the table.  Users must pay for access to full-size, non-watermarked version
- x A photos_purchases table must be created in order to keep track of who has bought what
- User-set persmissions of some sort should be available per-gallery so people can decide whether to share links

[future enhancements]

Plans: the Road to 1.0
- As of June 1, 2016, the loveBirdsStore software is at 0.9.2.  Work has been done recently to harden against mySQL injection attacks, and the changes given their importance have also been pushed back to the (live-deployed) djmblog.com store.  That site is now split off essentially as a living 0.9.0 project while the development of the store moves forward.
The dev LoveBirdsConsulting.com store is using Foundation 6 and has had most of the classes needed for basic layout already added.  (djmblog.com remains on the Bootstrap design).  Going forward I can experiment with changing the site's appearance by adjusting the Foundation SCSS, creating custom style sheets, and integrating Material Design Lite as a third front-end library/set of classes in HTML.
Highly critical features to be added in dev soon:
	- Order handling/physical goods buildout
	- Scheduling tool
	- Subscription payment tool/Patreon clone
	- Product page front-end enhancements

Known Issues
- created_at_epoch is just filling up with nulls in users_payments table, other date is working so it's minor
- What happens when users arbitrarily load /process pages?  I don't know that anything truly terrible is likely to happen but the /process/pay page doesn't even require a user to be logged in to run.  Should probably check for POST data and if not is present then exit and redirect to the front
- when a user tries to change their login to "public" the function in the model returns FALSE before actually editing the account, and it nicely returns the user to the front page with an "account not edited" note but navigating back to the /accounts page makes things get crazy with error messages.  Minor issue but a window into the twisted double-checking that is done when making or editing a login--a query in the controller (I infer) and one in the model may not maximize efficiency but it does protect future private uses of the model function [update May 2016 queries are all being moved into models or in few cases helpers]

Store
- product page overall design is an important step; the current look is derivative of the blog and once the functionality is completed the store--at least and especially the product page--should be redesigned
- for the Store model, a good function [are_products_digital($productTuple)] would be one that took a set of products (like in a user's 'cart') and tested if any were non-digital and returned false if any were but true otherwise
- add session cart for unlogged-in users and add awareness to cart page to list session cart items if users is not logged in
- promo codes need to be added as a feature

Blogs
--currently tags can be created but not edited: the way they are stored in the tags and posts_tags table means that editing them for a post would involved deleting them one at a time from the posts_tags table which is not a simple reflow of the form used to create them because of the processing involved [unlike for other items as seen in the values attributes in the form of the edit post view]--tags are an aysmetric blog attribute

Database Tables
--These tables are in the schema but currently unused and set aside for enabling planned future functionality:
	- social:
		+ users_friends
		+ users_followers
		+ photos
		+ gallerys
	- physical good sales:
		+ orders_status
	- store:
		+ products_photos [this one may not be necessary given other options like /files]
		+ products_reviews
		promo_codes
	- blog:
		+ posts_comments
	- stocks:
		+ stocks_exchanges
		+ stocks
		+ portfolios
		+ stocks_portfolios
	- social bookmarking
		+ links
		+ users_links
		+ links_tags [depends on sharing the tags table with Blogs]

[finished or deferred or wontfix]

404
- x make custom 404 page

Accounts
- x login page at /login should redirect to /account if user is already logged in; if a user logs in to a different account it appears to work okay but some security issue could be exposed during that tenuous handoff when the user stays logged in but from one account to another

Blogs
- x Manage Content: Edit Content link in Account page for level 2 and higher users to edit their blog posts
- w> Manage Content: View Profile link in Account page for level 2 and higher users to see their public profile (blog posts)
- w> edit screen for blog posts is too permissive--it will show a post to anyone, logged in or not, owner of post or not, even though efforts to edit the post will be stymied while the change request is being processed
- w> the edit screen actually exposes a deeper rathole--that even DELETED posts can be found on it due to the users_posts entry being used to find the post id using the normal post page but the edit page still just uses the simpler not-joined query for the post based on ID.  The deletion tool actaully deletes the entry from users_posts but not posts.

Users
- x generate an API key using some hash or whatever whenever a user creates an account

CSS
- x img max width 100% needed in djmblog.css

E-Commerce (Stores)
- x build edit inventory numbers admin page for store items page
- x build edit price admin page for store items page
- x build admin inventory list page with specific links to 'edit inventory' and 'edit price' pages & a (dangerous) 'delete product' button
- x enhance product page with description (done) and 'add to cart button' and image if one is available via link in the products table as the products_photo column or whereever and the photo should can be an absolute URL or a relative one i.e. a non-null entry with just the file name and not http in it--then the program will know to look for the file in assets/images/store.  If the photo field is null [or if the photo returns 404] a default image [for this site perhaps djmblogstore.jpg] can be loaded
- x build checkout flow which totals price, checks if nonzero (and if not asks user to select payment button and checks for authorization and writes in users_payments before continuing) and then starts the fulfillment process which should include writing to the orders, --->>orders_status<<--- [as yet unimplemented--is more of a physical store thing], and sales tables
- w the fulfillment process may have onffline components but there should be a digital checkout workflow as well, which points users to links for their content:
	+ purchases should be kept track of for users so they can return to the item's page and see the (previously unavailable) download link for digital purchases
	+ inventory must be checked for physical goods both w/r/t the customer (either by not listing 0 inventory physical items or by eliminating them from the cart at checkout) and then inventory should be updated by the admin in the shipping checklist admin page
- z front-end for store look and feel: new sidebar, a little flash for item pages, possibly even different header than blog
- w> bonus: reviews engine for users who purchased the item, should write to products_reviews
- w> products_photos may be deprecated and the image URLs can perhaps be supplied by a (future) built-in gallery application
- x things to add to the /admin/store main page:
	1. link to admin product list page
	2. link to add payment provider page
	3. link to the add suppliers page
	4. link to the add products page
	5. link to the (as-yet-unbuilt) fulfillment todo page which can edit the status field in the orders table from unfilled to filled for example
- w> should there be a customer admin page beyond the fulfillment page
- w> bonus: a UI for deleting and editing suppliers
- w> /store front page should list all current products in a paginated way or something like that

E-Commerce (Carts)
- y> add DB table for cart which has id, users_id [note: this one may not be necessary; when would users_id and id not have a 1 to 1 relationship?]
- x add DB table for carts_products which has id, carts_id [note: or just users_id], quantity and products_id
- x add handling for when user selects an item to add which includes adding item to user's cart
- z> add cart page which shows items currently in user's cart, link to add payments, allows deletions and has a checkout button
x--once a checkout completes the cart should have all of its items wiped out
- w> bonus: add wishlist feature for passive/sidelined/future cart items (maybe add a DB table called users_wishes)
- z> users need a page to view:
	1. purchases history (list of everything they've bought)
	2. cart (list of all items in cart but not yet purchases where user can remove items or or manage payment methods or press check out)
	3. store (list of all the items available in the store, perhaps paginated or something)
	4. check out page - list out all items

z: 4 (+1) screens need to be built
- x /store (list all items available)
- x cart (list all user's items in cart, link for add payment method, button for checkout)
- x checkout (list items and total, allow user to press confirm button)
- w> thankyou (notify user of successful transaction and providle links and info as necessary)
- x purchased (list all items in sales that are associated with users_id)

- x product page still needs to have the price listed: needs to do add data to view array
- x credit card information has to be run through Stripe for pay transasctions intead of just going to an info screen that says the transaction didn't go through
