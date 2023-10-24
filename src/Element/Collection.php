<?php

namespace SANET\Element;

use SANET\Element;

class Collection {
	public array $children = [
		'default' => []
	];

	public function __construct(
		array $children = []
	) {
		foreach ($children as $index => $child) {
			if (gettype($index) === 'integer')
				$this->children['default'][] = $child;
			else {
				if (!isset($this->children[$index]))
					$this->children[$index] = [];
				$this->children[$index][] = $child;
			}
		}
	}

	public function add(string|Element|Collection $child) {
		$this->children['default'][] = $child;
	}

	public function set(int $index, string|Element|Collection $child) {
		$this->children['default'][$index] = $child;
	}

	public function get(int $index): string|Element|Collection|null {
		return $this->children['default'][$index];
	}

	public function slot(string $name): Collection {
		return new Collection($this->children[$name]);
	}

	public function count() {
		return count($this->children['default']);
	}

	public function __toString(): string {
		return implode('', $this->children['default']);
	}
}