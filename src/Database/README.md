## Usage

#### Instantiation

```php
use SmartValue\Database\QueryBuilder;

$queryBuilder = QueryBuilder::getInstance();
```

#### Query Types

Select

```php
$queryBuilder->select(['id', 'username', 'email'])
    ->from('users')
    ->where('id > 15')
    ->limit(5)
    ->orderBy('email')
    ->orderBy('username', 'ASC')
    ->run()
```

Delete

```php
$queryBuilder->delete()
    ->from('notifications')
    ->where('notificationType="old"')
    ->limit(20)
    ->getQuery()
```

Insert

```php
$queryBuilder->insert()
    ->into('users')
    ->columns(['username', 'password', 'email'])
    ->values(['alex', '123', 'alex@123.com'])
    ->values(['test', '123', 'test@123.com'])
    ->run()
```