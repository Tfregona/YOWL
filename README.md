# YOWL

## Project setup

### Database 

Run your server (Wamp, Xampp) and create a database 'yowl'

### In the repo 
```
npm install
```

### Run the web app 
```
php artisan migrate
```

### Run the web app 
```
php artisan serve
```

## Web App Preview

### Home page

Display some categories and the last comments <br>
All the 'read' part of the application is accessible for non-connected users

<p align="center">
  <img src=".github/yowl_homepage.jpg" width="90%;" />
</p>

### Sign up

Form for inscription 

<p align="center">
  <img src=".github/yowl_signup.jpg" width="90%;" />
</p>

### Sign in

Form for inscription with a search in the data base for the user

<p align="center">
  <img src=".github/yowl_signin.jpg" width="90%;" />
</p>
<p align="center">
  <img src=".github/yowl_signin_wrong.jpg" width="90%;" />
</p>

The user is logged so he can log out now in the navbar

### Profile page

Different if the user connected is an admin or not

<p align="center">
  <img src=".github/yowl_user_page.jpg" width="90%;" />
</p>
<p align="center">
  <img src=".github/yowl_admin_page.jpg" width="90%;" />
</p>

### Update the profile

Form for update user profile 

<p align="center">
  <img src=".github/yowl_update_profile.jpg" width="90%;" />
</p>

### Admin CRUD

Page only accessible for admin users where they can see, create, update, delete anything

<p align="center">
  <img src=".github/yowl_admin_control.jpg" width="90%;" />
</p>

### Update form

Form for update a content 

<p align="center">
  <img src=".github/yowl_update_form.jpg" width="90%;" />
</p>

### Navigation to see the posts

Page where all categories are display 

<p align="center">
  <img src=".github/yowl_categories.jpg" width="90%;" />
</p>

When the user clicks on a category, he is diricted on the subcategories

<p align="center">
  <img src=".github/yowl_subcategories.jpg" width="90%;" />
</p>

And finally posts that are in this subcategory 

<p align="center">
  <img src=".github/yowl_posts.jpg" width="90%;" />
</p>

Page for each post with related comments and if the user is logged, the possibility to comment

<p align="center">
  <img src=".github/yowl_postshow.jpg" width="90%;" />
</p>

### Posting a subject

Firstly the user need to choose the category of his futur post 

<p align="center">
  <img src=".github/yowl_create_post1.jpg" width="90%;" />
</p>

Firstly the user need to choose the category of his futur post 

<p align="center">
  <img src=".github/yowl_create_post1.jpg" width="90%;" />
</p>

And then the form 

<p align="center">
  <img src=".github/yowl_create_post2.jpg" width="90%;" />
</p>