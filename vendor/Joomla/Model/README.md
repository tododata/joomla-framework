## The Model Package

### Interfaces

#### JModel

`JModel` is an interface that requires a class to be implemented with a
`getState` and a `setState` method.

### Classes

#### JModelBase

##### Construction

The contructor for `JModelBase` takes an optional `Registry` object that
defines the state of the model. If omitted, the contructor defers to the
protected `loadState` method. This method can be overriden in a derived
class and takes the place of the `populateState` method used in the legacy
model class.

##### Usage

The `JModelBase` class is abstract so cannot be used directly. All
requirements of the interface are already satisfied by the base class.

```php
/**
 * My custom model.
 *
 * @pacakge  Examples
 *
 * @since   12.1
 */
class MyModel extends JModelBase
{
	/**
	 * Get the time.
	 *
	 * @return  integer
	 *
	 * @since   12.1
	 */
	public function getTime()
	{
		return time();
	}
}
```

#### JModelDatabase

##### Construction

`JModelDatabase` is extended from `JModelBase` and the contructor takes an
optional `JDatabaseDriver` object and an optional `Registry` object (the
same one that `JModelBase` uses). If the database object is omitted, the
contructor defers to the protected `loadDb` method which loads the
database object from the platform factory.

##### Usage

The `JModelDatabase` class is abstract so cannot be used directly. It
forms a base for any model that needs to interact with a database.

```php
/**
 * My custom database model.
 *
 * @package  Examples
 *
 * @since   12.1
 */
class MyDatabaseModel extends JModelDatabase
{
	/**
	 * Get the content count.
	 *
	 * @return  integer
	 *
	 * @since   12.1
	 * @throws  RuntimeException on database error.
	 */
	public function getCount()
	{
		// Get the query builder from the internal database object.
		$q = $this->db->getQuery(true);

		// Prepare the query to count the number of content records.
		$q->select('COUNT(*)')->from($q->qn('#__content'));

		$this->db->setQuery($q);

		// Execute and return the result.
		return $this->db->loadResult();
	}
}

try
{
	$model = new MyDatabaseModel;
	$count = $model->getCount();
}
catch (RuntimeException $e)
{
	// Handle database error.
}
```
