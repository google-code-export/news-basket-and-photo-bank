// search index for WYSIWYG Web Builder
var database_length = 0;

function SearchPage(url, title, keywords, description)
{
   this.url = url;
   this.title = title;
   this.keywords = keywords;
   this.description = description;
   return this;
}

function SearchDatabase()
{
   database_length = 0;
   this[database_length++] = new SearchPage("home_user.html", "Untitled Page", "untitled page user menu edit profile change your password browse my image welcome folder all sport culture social education upload download new delete search nbsp ", "");
   this[database_length++] = new SearchPage("upload_user.html", "Untitled Page", "untitled page user menu edit profile change your password browse my image welcome folder all sport culture social education upload download new delete search nbsp ", "");
   this[database_length++] = new SearchPage("login_user_admin.html", "Untitled Page", "untitled page login username nbsp password ", "");
   this[database_length++] = new SearchPage("manage_user.html", "Untitled Page", "untitled page admin menu edit profile change your password folder browse my image welcome manage user category add new list name nbsp ", "");
   this[database_length++] = new SearchPage("admin/upload_admin.html", "Untitled Page", "untitled page admin menu edit profile change your password folder browse my image welcome all sport culture social education upload download new delete search manage user category nbsp ", "");
   this[database_length++] = new SearchPage("admin/manage_category.html", "Untitled Page", "untitled page admin menu edit profile change your password folder browse my image welcome manage user category add new list name nbsp ", "");
   this[database_length++] = new SearchPage("admin/home_admin.html", "Untitled Page", "untitled page new folder delete admin menu edit profile change your password browse my image welcome search all sport culture social education upload download manage user category nbsp ", "");
   return this;
}
