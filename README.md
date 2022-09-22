# full-stack-interview-prac

Commands:
  - composer update
  - composer install
  - npm install
  - npm run dev
  - php artisan serve
  
  Instruction:
   - The idea of the repository is the usage of API as the backend and using vueJS as the front-end
   - VueJS access the API using axios and sending data to the created API from laravel API route
   - We have a validation if the product name is empty
   - If the product already exist, it will not be duplicated by the existing name
   - If the product do exist while the tags don't, the system will still add the tag
   - Deleting product also deletes the connection of it to a specific tag
  
