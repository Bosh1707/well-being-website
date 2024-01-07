## About My Project

My aim for this project was to build a website that aimed to improve the general health of everyday people. I wanted to implement several features such as a to-do list, a recipe searcher as well as a simple BMI calculator and a BMI graph. I implemented my website using PHP and Laravel for the front-end and using MySQL for the back-end.

# Login Page

I wanted to use a simple login page using a basic layout asking for the users' email and password. I also designed a similar-looking registration page which additionally asks for the user's name, as well as a confirmation of their password. Both registration and login pages can be accessed by clicking on their respective buttons located on the top right of the page.


# Homepage 

After successfully logging in/ registering, users will be redirected to the homepage displaying 3 options to choose from: a to-do list, a BMI calculator or a recipe searcher. I additionally implemented a menu bar at the top of the website 

# Video demo 

https://youtu.be/6WIeKlxsNds

## Migration

  Schema::create('bmi_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->decimal('weight',5,2);
            $table->decimal('height',5,2);
            $table->decimal('bmi',5,2);
            $table->date('date');
            $table->timestamps();
        });
