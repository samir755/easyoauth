EasyOauth
============

for Symfony 5.* 

EasyOauth is a good starter pack for implement API with Oauth2 in your project.
EasyOauth manage life of token needed for your api. 

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

### Step 1: Define your http config in `config/packages/framework.yaml`

An example with a famous job api:

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

### Step 2: Configure your environment values (.env)

```php
###> EasyOauth/EasyOauth ###
CLIENT_ID=
CLIENT_SECRET=
CLIENT_URI=https://entreprise.pole-emploi.fr/connexion/oauth2/access_token?realm=%2Fpartenaire
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

Implement by dependency injection 

```php
    use EasyOauth\src\Provider\OauthProvider;
    
    //...
    
    //Generate Token 
    $this->oauthProvider->oauthConnect(true); //If scope is defined
    $token = $this->oauthProvider->getToken();

    //Start your call
```

Enjoy :)