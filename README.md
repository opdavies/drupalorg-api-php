# PHP library for the Drupal.org API

This library provides convenient wrapper functions for Drupal.org’s REST API. The API is [documented here][0].

[0]: https://www.drupal.org/api

## Examples

### Users

```
$uids = [1, 381388];
$query = new UserQuery;
$query->setOptions(['query' => ['uid' => $uids]]);
$users = $query->execute->getContents()->all();
```
