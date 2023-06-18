# 18KI-C | UTS Studi Independen GITS ID

<img src="https://user-images.githubusercontent.com/75787853/231803124-2fbb1e77-ac0b-467d-9c34-e1a49645adcc.png" width=50% height=70%><br>

## :rocket: Team
- ``` Ferdy Hahan Pradana ```
- ``` Laksono Prasetyo ```
- ``` Gupron Nurjalil ```
- ``` Bagas Aditya Mukti ```
- ``` Fazlul Rachmat Mubbaraq ```

## :pushpin: Description
- This repository was created to fulfill a mid-semester assignment in the Independent Fullstack Web Developer Study program by GITS.id partner, MSIB Batch 4.
- Detailed information regarding the application can be seen in the group report.

## :open_book: How To Use
1.  Clone this repository
    ```
    git clone https://github.com/ferdyhape/18KI-C.git
    ```
2.  Copy paste **.env.example** file and rename as **.env**
3.  Adjust the database name in the env file on **DB_DATABASE**

3.  Generate Key
    ```
    php artisan key:generate
    ```
4.  Install dependencies
    ```
    composer install
    ```
5.  Generate mirror link
    ```
    php artisan storage:link
    ```
6.  Migrate the tables
    ```
    php artisan migrate
    ```

7.  Insert the data from seeder to database
    ```
    php artisan db:seed
    ```

8.  Start the server
    ```
    php artisan serve
    ```

9.  Login with this crediential

    Email: 
    ```
    admin@admin.com
    ```
    Password: 
    ```
    password
    ```
        
10. Enjoy use!

## :gear: Stack Used:

 - Jquery 3.6.4
 - Google Font
 - SweetAlert
 - Bootstrap 5.2
 - Bootstrap Icon
 - DompPDF
