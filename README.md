![](https://raw.githubusercontent.com/bitbybit/ibls/master/screenshot.png)

```bash
git clone git@github.com:bitbybit/ibls.git
cd ./ibls/back
composer -a -o install
./bin/console doctrine:migrations:migrate
./bin/console doctrine:fixtures:load
cd ../front
npm install
npm run prod
```
