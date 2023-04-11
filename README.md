# GDW RmProductsBySkuPath para Magento 2
Este módulo para magento 2 elimina productos con coincidencias en el SKU mediante consola.

## Compatibilidad
✓ Magento 2.3.x, ✓ Magento 2.4.x

![gdw_rmproductsbyskupath_01](https://gestiondigitalweb.com/github_assets/gdw_rmproductsbyskupath/gdw_rmproductsbyskupath_01.png)
![gdw_rmproductsbyskupath_02](https://gestiondigitalweb.com/github_assets/gdw_rmproductsbyskupath/gdw_rmproductsbyskupath_02.png)

###### Ejecuta los siguientes comandos en la ruta base de Magento.

### Instalación

```
composer require gdw/rmproductsbyskupath

php bin/magento module:enable GDW_RmProductsBySkuPath
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy
php bin/magento cache:flush
```

### Actualización

```
composer update gdw/rmproductsbyskupath

php bin/magento module:enable GDW_RmProductsBySkuPath
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy
php bin/magento cache:flush
```

### Eliminación

```
php bin/magento module:disbale GDW_RmProductsBySkuPath
composer remove gdw/disablewelcomeemail
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy
php bin/magento cache:flush
```

### Uso

```
php bin/magento gdw:rmproductsbysku --path=VALOR
Confirmar la cantidad de SKUs a eliminar.
Listo.
```

### Expresiones de Gratitud

* 📢 Comenta a otros sobre este proyecto.
* 👨🏽‍💻 Da las gracias públicamente.
* [🍺 Invítame una cerveza](https://www.paypal.me/gestiondigitalweb)


### Otros enlaces

* [ Sitio web](https://gdw.mx/?utm_source=github&utm_medium=gdw&utm_campaign=rmproductsbyskupath&utm_id=link)
* [Listado de Módulos](https://gdw.mx/modulos/)
* [Facebook](https://www.facebook.com/GestionDigitalWeb)
* [Youtube](https://www.youtube.com/c/Gestiondigitalweb)