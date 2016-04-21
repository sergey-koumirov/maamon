# maamon


git clone git@github.com:sergey-koumirov/maamon.git
cd maamon
#create db maamon_dev
./yii migrate

get new transactions
./yii trans

mysqldump -u root -p maamon_dev --no-data > maamon.sql