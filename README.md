# NoSQL 🚩
## Installation ⬇️
### To run the project / import the csv, you'll need :

- install WSL 2 : https://learn.microsoft.com/fr-fr/windows/wsl/install

- Install Git : ```sudo apt-get install git```

- Install Docker Desktop : https://www.docker.com/products/docker-desktop/

- Launch the docker client

- Install the RedisInsight-v2 Client on windows : https://docs.redis.com/latest/ri/installing/install-redis-desktop/ 

Now on your WSL terminal follow these instructions :

- Clone the repository on : ```git clone https://github.com/Ayatooo/Ynov-nosql.git```

- Move inside the repository : ```cd /Ynov-nosql ```

- Install the dependencies : 
```
docker run --rm --interactive --tty \
--volume $PWD:/app \
composer install --ignore-platform-reqs
```

- Copy and paste the .env.example in the .env, you don't have to  change it 

- Run : ```./vendor/bin/sail up```

- Connect your RedisInsight-v2 client to the database with this configuration :
```Host : 127.0.0.1```
```Port : 6379```
```Database alias: 127.0.0.1:6379```

- Now, you will see your database clear

- You can import the csv file, you only need to make a get or post request on ```http://localhost/import-csv```and wait

- Atfer you get the status message (success), refresh the RedisInsight-v2 client database, and now it has been fulfilled

