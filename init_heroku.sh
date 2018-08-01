 #!/bin/bash
APP_NAME=${1:-undanganmu}

heroku create $APP_NAME
heroku addons:create heroku-postgresql:hobby-dev -a $APP_NAME
# heroku addons:attach heroku-postgresql:hobby-dev # seemed doesn't really required
# DB_URL=$(heroku config:get DATABASE_URL -a $APP_NAME)
APP_KEY=$(php artisan key:generate --show)

# heroku config:set YAHYA_DB_URL=$DB_URL APP_ENV=production APP_KEY=$APP_KEY -a $APP_NAME
heroku config:set APP_ENV=production APP_KEY=$APP_KEY -a $APP_NAME

git push heroku master
