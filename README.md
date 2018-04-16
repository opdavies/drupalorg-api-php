# PHP library for the Drupal.org API

This library provides convenient wrapper functions for Drupal.org’s REST API. The API is [documented here][0].

[0]: https://www.drupal.org/api

## Examples

### Nodes

```php
$nids = [107871, 2945793, 1306976];
$query = new NodeQuery();
$query->setOptions(['query' => ['type' => Node::TYPE_MODULE, 'nid' => $nids]]);
$nodes = $query->execute()->getContents()->all();
```
### Users

```php
$uids = [1, 381388];
$query = new UserQuery();
$query->setOptions(['query' => ['uid' => $uids]]);
$users = $query->execute()->getContents()->all();
```
