<?php

namespace SANET\Element;

class ClassList {
	protected array $classes = [];

	public function __construct(
		string|array $classes = [],
	) {
		if (gettype($classes) === 'string') {
			$this->classes = explode(' ', $classes);
		} else {
			$this->classes = $classes;
		}
	}

	public function add(string|array $classes): static {
		if (gettype($classes) === 'string') {
			$classes = explode(' ', $classes);
		}

		foreach ($classes as $class) {
			if (!in_array($class, $this->classes)) {
				$this->classes[] = $class;
			}
		}

		return $this;
	}

	public function remove(string|array $classes): static {
		if (gettype($classes) === 'string') {
			$classes = explode(' ', $classes);
		}

		foreach ($classes as $class) {
			if (in_array($class, $this->classes)) {
				$this->classes = array_filter($this->classes, fn($c) => $c !== $class);
			}
		}

		return $this;
	}

	public function count() {
		return count($this->classes);
	}

	public function __toString(): string {
		return implode(' ', $this->classes);
	}
}