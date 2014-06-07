Ukrainian center of education quality testing emulator
========================

This project is emulating work of certificate data validation service.
Database contains data from testing version of EDBO and can be used for reception operator training.

Remember. This is NOT official software!
Any bugreports must be posted on GitHub only.

## How to deploy ##

    $ app/console --env=prod cache:clear
    $ app/console --env=prod cache:warmup
    $ app/console --env=prod doctrine:database:create
    $ app/console --env=prod doctrine:schema:create
    $ app/console --env=prod doctrine:fixtures:load
