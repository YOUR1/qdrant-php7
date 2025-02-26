<?php
/**
 * @since     Apr 2023
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Qdrant\Models\Filter\Condition;

use Qdrant\Domain\Assert;

class ValueCount extends AbstractCondition implements ConditionInterface
{
    protected const CONDITIONS = ['gt', 'gte', 'lt', 'lte'];

	protected array $valueCount;

    public function __construct(string $key, array $valueCount)
    {
        parent::__construct($key);
        Assert::keysExistsAtLeastOne(
            $valueCount,
            self::CONDITIONS,
            'ValueCount expects at least one of %s key'
        );
		$this->valueCount = $valueCount;
    }

    public function toArray(): array
    {
        return [
            'key' => $this->key,
            'values_count' => $this->valueCount
        ];
    }
}