## Porque? 
  Esse projeto foi baseado no sdk em php do mercadolivre que atualmente esá com erro, e pensando nisso
  reestruurei e melhorei o sdk php

## Como faço para instalá-lo?

       clone repositorio
       https://github.com/THAYLLER/sdk-mercadoLivre-PHP.git

## Como eu uso isso?

Para usar o sdk suba a pasta para o seu projeto, dentro da pasta sdk/config,  configure seus dados para que o sdk funcione,
após isso faça os includes correspondenes;

### Include
Include das libs

```php
require_once 'sdk/config/config.php';
require_once 'sdk/mercadoLivreActions.php';
require_once 'sdk/mercadoLivreAuth.php';
require_once 'sdk/mercadoLivreProducts.php';
```
Inicianndo o desenvolvimento!

### Criando instancia da classe principal

```php
$sdk = new mercadoLivreAuth();
```
