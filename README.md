# Dribbble API PHP Wrapper
*by [Oscar Marcelo](http://oscarmarcelo.com)*

A PHP wrapper for the [Dribbble API v1](http://developer.dribbble.com/v1/).

## How to use
 1. An application is now required. [Register](https://dribbble.com/account/applications/new) a new one.
 2. There are two ways to use the API.
  - Using an OAuth authorization code, which gives full access to the API.
  - Using the Client Access Token, which gives a read-only access to the API.

 3. Paste the following code. Replace with you token, and include file path, if needed:
```php
require 'Dribbble-lite.php';
$token = 'YourTokenHere';
$dribbble = new Dribbble($token);
```
 4. Using the wrapper methods is easy as:
```php
$dribbble->get('user/shots', array('per_page' => 20));
``` 
 5. Good Work! :)

##Methods
Method | Description | API Documentation
-------|-------------|------------------
`get($endpoint, $params = array())` | The main GET method used by other methods | *none*
`user($user, $params = array())`|Gets information of a user|GET [/users/:user](http://developer.dribbble.com/v1/users/#get-a-single-user)
`current_user($params = array())`|Gets information of the authenticated user|GET [/user](http://developer.dribbble.com/v1/users/#get-the-authenticated-user)
`user_shots($user, $params = array())` | Gets shots of a user | GET [/users/:user/shots](http://developer.dribbble.com/v1/users/shots/)
`current_user_shots($params = array())` | Gets the shots of the authenticated user | GET [/user/shots](http://developer.dribbble.com/v1/users/shots/)

##Response
The wrapper return the responses as PHP objects.  
If any errors are encountered, then a `Exception` is thrown, which can be caught in a `try`/`catch` block.

##To do

 - Finish methods on Lite version
 - Do a full version (with authorization) of the wrapper