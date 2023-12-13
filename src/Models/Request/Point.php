<?php
/**
 * Point
 *
 * @since     Mar 2023
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Qdrant\Models\Request;

use Qdrant\Models\VectorStruct;
use Qdrant\Models\VectorStructInterface;

class Point implements RequestModel
{
    protected $vector;

	protected string $id;

	protected ?array $payload = null;

    public function __construct(string $id, $vector, ?array $payload = null)
    {
        if(is_array($vector)) {
            $vector = new VectorStruct($vector);
        }

        $this->vector = $vector;
		$this->id = $id;
		$this->payload = $payload;
    }

    public function toArray(): array
    {
        $data = [
            'id' => $this->id,
            'vector' => $this->vector->toArray(),
        ];

        if ($this->payload) {
            $data['payload'] = $this->payload;
        }

        return $data;
    }
}