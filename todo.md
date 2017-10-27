**TODO for Gallery 4** 
[Gallery 4](http://gallery4.pacificio.com) based on LoveBird from lovebirdsconsulting.com & djmblog.com 2016-2017 by [Dan McKeown](http://danmckeown.info)

**Gallerys controller issues/toDo**
- ✅? When a user is selected as a customer at /gallerys/upload it seems to fail at naming the gallery and the title field stays as null
- ✅ Build admin UI for adding photos to existing gallerys [/album]
- ✅ Build admin UI for deleting photos from existing gallerys
- ✅ Build customer UI for viewing their photos
- ✅ Build process_upload method to upload two sets of photos--one with watermarks and one that is a direct copy of the uploaded image.  ✅ Watermarked version should have different type of name and should be stored in a new column in the table.
- User-set persmissions of some sort should be available per-gallery so people can decide whether to share links and store private uploads [although to an extent this can be done by using /files]

**Known Issues**
- What happens when users arbitrarily load /process pages?  I don't know that anything truly terrible is likely to happen but the /process/pay page doesn't even require a user to be logged in to run.  Should probably check for POST data and if not is present then exit and redirect to the front
- when a user tries to change their login to "public" the function in the model returns FALSE before actually editing the account, and it nicely returns the user to the front page with an "account not edited" note but navigating back to the /accounts page makes things get crazy with error messages.  Minor issue but a window into the twisted double-checking that is done when making or editing a login--a query in the controller (I infer) and one in the model may not maximize efficiency but it does protect future private uses of the model function [update May 2016 queries are all being moved into models or in few cases helpers]

**Blogs**
--currently tags can be created but not edited: the way they are stored in the tags and posts_tags table means that editing them for a post would involved deleting them one at a time from the posts_tags table which is not a simple reflow of the form used to create them because of the processing involved [unlike for other items as seen in the values attributes in the form of the edit post view]--tags are an aysmetric blog attribute

**Database Tables**
--These tables are in the schema but currently unused and set aside for enabling planned future functionality:
	- blog:
		+ posts_comments
	- social bookmarking
		+ links
		+ users_links
		+ links_tags [depends on sharing the tags table with Blogs]
