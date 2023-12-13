<?php
/**
 * SearchParams
 *
 * @since     Mar 2023
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */
namespace Qdrant\Models\Request;

use Qdrant\Models\Filter\Filter;
use Qdrant\Models\Traits\ProtectedPropertyAccessor;
use Qdrant\Models\VectorStructInterface;

class SearchRequest
{
    use ProtectedPropertyAccessor;

	protected VectorStructInterface $vector;

    protected ?Filter $filter = null;

    protected array $params = [];

    protected ?int $limit = null;

    protected ?int $offset = null;

	/** @var bool|array|null */
    protected $withVector = null;

	/** @var bool|array|null */
    protected $withPayload = null;

    protected ?float $scoreThreshold = null;

    protected ?string $name = null;

    public function __construct(VectorStructInterface $vector)
    {
		$this->vector = $vector;
    }

	/**
	 * @return $this
	 */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

	/**
	 * @return $this
	 */
    public function setFilter(Filter $filter)
    {
        $this->filter = $filter;

        return $this;
    }

	/**
	 * @return $this
	 */
    public function setScoreThreshold(float $scoreThreshold)
    {
        $this->scoreThreshold = $scoreThreshold;

        return $this;
    }

	/**
	 * @return $this
	 */
    public function setParams(array $params)
    {
        $this->params = $params;

        return $this;
    }

	/**
	 * @return $this
	 */
    public function setLimit(int $limit)
    {
        $this->limit = $limit;

        return $this;
    }

	/**
	 * @return $this
	 */
    public function setOffset(int $offset)
    {
        $this->offset = $offset;

        return $this;
    }

	/**
	 * @return $this
	 */
    public function setWithPayload($withPayload)
    {
        $this->withPayload = $withPayload;

        return $this;
    }

	/**
	 * @return $this
	 */
    public function setWithVector($withVector)
    {
        $this->withVector = $withVector;

        return $this;
    }

	/**
	 * @return $this
	 */
    public function toArray()
    {
        $body = [
            'vector' => $this->vector->toSearchArray($this->name ?? $this->vector->getName()),
        ];

        if ($this->filter !== null && $this->filter->toArray()) {
            $body['filter'] = $this->filter->toArray();
        }
        if($this->scoreThreshold) {
            $body['score_threshold'] = $this->scoreThreshold;
        }
        if ($this->params) {
            $body['params'] = $this->params;
        }
        if ($this->limit) {
            $body['limit'] = $this->limit;
        }
        if ($this->offset) {
            $body['offset'] = $this->offset;
        }
        if ($this->withVector) {
            $body['with_vector'] = $this->withVector;
        }
        if ($this->withPayload) {
            $body['with_payload'] = $this->withPayload;
        }

        return $body;
    }

}