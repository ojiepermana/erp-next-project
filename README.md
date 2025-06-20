# ERP Next Step

## Setup submodule

git submodule init

git submodule update

#### update all module
git submodule update --init --recursive



#### Pull dan Update Submodule
git pull --recurse-submodules <br />
git submodule update --remote

## Micro Frontend - Angular


## App Frontend - Angular


## App Services - Laravel
git submodule add --branch main https://github.com/erp-next-step/auth-services.git code/laravel/services/auth <br />



## App - Laravel
git submodule add --branch main  https://github.com/ojie-dev/rondles-erp-migration.git code/laravel/app/migrations <br />

## Library
git submodule add --branch main  https://github.com/erp-next-step/erp-contracts.git code/php/erp-contracts <br />