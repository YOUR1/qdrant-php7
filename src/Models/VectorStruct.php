<?php
/**
 * @since     Mar 2023
 * @author    Haydar KULEKCI <haydarkulekci@gmail.com>
 */

namespace Qdrant\Models;

use Qdrant\Models\Traits\ProtectedPropertyAccessor;

class VectorStruct implements VectorStructInterface
{
    use ProtectedPropertyAccessor;

	protected array $vector;
	protected ?string $name = null;

    public function __construct(array $vector, ?string $name = null)
    {
		$this->vector = $vector;
		$this->name = $name;
    }

    public function isNamed(): bool
    {
        return $this->name !== null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function toSearchArray(string $name = null): array
    {
        if ($this->isNamed()) {
            return [
                'name' => $this->name,
                'vector' => $this->vector,
            ];
        }
        return $this->vector;
    }

    public function toArray(): array
    {
        if ($this->isNamed()) {
            return [
                $this->name => $this->vector
            ];
        }
        return $this->vector;
    }
}