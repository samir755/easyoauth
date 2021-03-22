EasyOauth
============

EasyOauth is a good starter pack for implement API with Oauth2 in your project.
EasyOauth manage token needed for your api. 

*Build on Symfony 5* 

Installation
============

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Applications that use Symfony Flex
----------------------------------

Open a command console, enter your project directory and execute:

```console
$ composer require easyoauth
```

Applications that don't use Symfony Flex
----------------------------------------

### Step 1: Define your client in `config/packages/framework.yaml`

Here is an example for a famous French job api:

```yaml
    http_client:
        ...
        scoped_clients:
            oauth.client:
                scope: 'https://\entreprise\.pole-emploi.fr'
                headers:
                    Content-Type: application/x-www-form-urlencoded
                    Accept: application/json
```

### Step 2: Fill your environment values (.env)

```php
###> EasyOauth/EasyOauth ###
CLIENT_ID=
CLIENT_SECRET=
CLIENT_URI=      //Sample: https://entreprise.pole-emploi.fr/connexion/oauth2/access_token?realm=%2Fpartenaire
CLIENT_SCOPE=""
###< EasyOauth/EasyOauth ###
```

### Step 3: Update your database

```bash
Symfony console d:s:u --force
```

### Step 4: Register the bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```
EasyOauth\src\EasyOauthBundle::class => ['all' => true]
```

### Step 5: Connect to your API

Retreive **oauthConnect()** service with dependency injection into your controller 

```php
    use EasyOauth\src\Provider\OauthProvider;
    
    //...
    
    //Generate Token 
    $this->oauthProvider->oauthConnect(true); //If scope is defined
    $token = $this->oauthProvider->getToken();

    //Start your call
```

Enjoy :)
