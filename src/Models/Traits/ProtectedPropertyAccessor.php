<?php

namespace Qdrant\Models\Traits;

use InvalidArgumentException;
use ReflectionProperty;

/**
 * @see https://www.php.net/manual/en/function.str-starts-with
 */
if (!function_exists('str_starts_with')) {
	function str_starts_with(string $haystack, string $needle): bool
	{
		return strlen($needle) === 0 || strpos($haystack, $needle) === 0;
	}
}

/**
 * Trait ProtectedPropertyAccessor
 *
 * Allows access to protected properties through a magic getter method.
 */
trait ProtectedPropertyAccessor
{
    /**
     * Magic method to implement generic getter functionality for protected properties.
     *
     * @param string $method The name of the method being called.
     * @param array $arguments The arguments used to invoke the method.
     * @return mixed The value of the property.
     * @throws InvalidArgumentException if the property doesn't exist or is not protected.
     */
    public function __call(string $method, array $arguments)
    {
        $prefix = 'get';

        if (str_starts_with($method, $prefix)) {
            $property = lcfirst(substr($method, strlen($prefix)));

            if (property_exists($this, $property)) {
                $reflection = new ReflectionProperty($this, $property);
                if ($reflection->isProtected()) {
                    return $this->$property;
                } else {
                    throw new InvalidArgumentException("Access to property '$property' is not allowed");
                }
            }

            throw new InvalidArgumentException("Property '$property' does not exist");
        }
    }
}
