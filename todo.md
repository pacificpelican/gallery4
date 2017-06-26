TODO for Gallery 4 based on LoveBird from lovebirdsconsulting.com ecommerce web app via djmblog.com 2/8/2016, 2/11/2016, 2/13/2016, 2/28/2016, 3/1/2016, 3/8/2016, 3/21/2016, 6/1/2016, 8/8/2016. 8/13/2016, 6/25/2017 by Dan McKeown http://danmckeown.info

Photographer Module Issues
- Numerous created at/updated at fields are not filled out when the row is created, in the Photo model and maybe Gallerys controller

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

Known Issues
- created_at_epoch is just filling up with nulls in users_payments table, other date is working so it's minor
- What happens when users arbitrarily load /process pages?  I don't know that anything truly terrible is likely to happen but the /process/pay page doesn't even require a user to be logged in to run.  Should probably check for POST data and if not is present then exit and redirect to the front
- when a user tries to change their login to "public" the function in the model returns FALSE before actually editing the account, and it nicely returns the user to the front page with an "account not edited" note but navigating back to the /accounts page makes things get crazy with error messages.  Minor issue but a window into the twisted double-checking that is done when making or editing a login--a query in the controller (I infer) and one in the model may not maximize efficiency but it does protect future private uses of the model function [update May 2016 queries are all being moved into models or in few cases helpers]

Blogs
--currently tags can be created but not edited: the way they are stored in the tags and posts_tags table means that editing them for a post would involved deleting them one at a time from the posts_tags table which is not a simple reflow of the form used to create them because of the processing involved [unlike for other items as seen in the values attributes in the form of the edit post view]--tags are an aysmetric blog attribute

Database Tables
--These tables are in the schema but currently unused and set aside for enabling planned future functionality:
	- blog:
		+ posts_comments
	- social bookmarking
		+ links
		+ users_links
		+ links_tags [depends on sharing the tags table with Blogs]
