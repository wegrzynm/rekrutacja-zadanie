# rekrutacja
Pakiety i komendy potrzebne do uruchomienia aplikacji:
  - composer install
  - npm install
  - npm run dev
  
   Do utworzenia lokalnej bazy danych na serverze MySQL
  - php bin/console doctrine:database:create
  - php bin/console make:migration
  - php bin/console doctrine:migrations:migrate

W tym momencie można uruchomić aplikację poleceniem

symfony server:start

**Zadania:**


  **1.Aplikacja ma za pomocą komendy konsolowej pobierać posty (końcówka /posts) a API REST jsonplaceholder.typicode.com i zapisywać je do bazy wraz z imieniem i       nazwiskiem autora (pobrane w relacji z końcówki /users)**
    
    
    Do uruchomienia komendy wystarczy wpisać w konsoli:
    
    php bin/console getAPIData
    
  **2. Aplikacja na podstronie /lista powinna wyświetlać listę pobranych postów z możliwości ich usunięcia z lokalnej bazy danych. Podstrona ta ma być dostępna po          zalogowaniu - proszę użyć wbudowanych modułów autoryzacyjnych**
  
  
  Dane logowania:
  
  
  **login:** admin 

  **hasło:** admin123

     
       
 **3. Z pomocą API platform aplikacja ma udostępniać końcówkę /posts z metodą GET do pobierania postów z lokalnej bazy danych**  
      Dostęp za pomocą podstrony /api
 

