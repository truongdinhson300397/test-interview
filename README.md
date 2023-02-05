# Config command in supervisor
    php artisan queue:listen --queue=high,medium,low,default
# Database
### Migrate
    php artisan migrate
### Seed data
    php artisan db:seed

### Calculate point by invite friends
    php artisan point:add-point-by-invite-friends
