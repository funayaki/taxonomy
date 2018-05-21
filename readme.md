# Croogo/Taxonomy Plugin

This repository is a **read-only** split of the main Croogo code.

# Documentation

Please see the [documentation](http://docs.croogo.org/3.0)

## Usage

### Enable plugin

You need to enable the plugin your config/bootstrap.php file:

```
Plugin::load('Croogo/Taxonomy', ['bootstrap' => false, 'routes' => true, 'autoload' => true]);
```

### Running migrations

```
bin/cake migrations migrate --plugin Croogo/Taxonomy
```

### Inserting data (Optional)

```
bin/cake migrations seed --plugin Croogo/Taxonomy
```
