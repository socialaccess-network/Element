<?php

namespace SANET;

use SANET\Element\ClassList;
use SANET\Element\Collection;

class Element {
	public ClassList $classList;
	public Collection $children;

	public function __construct(
		protected string $tag,
		protected array  $attributes = [],
		array|Collection $children = [],
	) {
		$this->classList = new ClassList();

		if (array_key_exists('class', $this->attributes)) {
			$this->classList->add(...explode(' ', $this->attributes['class']));
			unset($this->attributes['class']);
		}

		if (is_array($children))
			$this->children = new Collection($children);
		else
			$this->children = $children;
	}

	public function setAttribute(string $key, string $value): void {
		$this->attributes[$key] = $value;
	}

	public function getAttribute(string $key): string {
		return $this->attributes[$key];
	}

	public function removeAttribute(string $key): void {
		unset($this->attributes[$key]);
	}

	public function getChildren(): Collection {
		return $this->children;
	}

	public function toHTML(): string {
		$attributes = '';

		if ($this->classList->count()) {
			$attributes .= "class=\"$this->classList\"";
		}

		foreach ($this->attributes as $key => $value) {
			$attributes .= " $key=\"$value\"";
		}

		$children = $this->getChildren();
		return "<$this->tag $attributes>$children</$this->tag>";
	}

	public function __toString(): string {
		return $this->toHTML();
	}
}