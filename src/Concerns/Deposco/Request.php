<?php

namespace FDC\Support\Deposco\Concerns;

use Illuminate\Support\Facades\Http;

class Request
{
	protected string $base;
	protected string $url;
	protected ?string $path = null;
	protected array $headers = [];
	protected array $parameters = [];
	protected ?string $key = null;

	public function __construct()
	{
		$this->base = config('deposco.baseUrl');
		$this->url = config('deposco.baseUrl');

		$this->headers = [
			'Authorization' => config('deposco.auth'),
			'Content-Type' => 'application/json',
			'Accept' => 'application/json'
		];

		$this->params(['pageNo' => '1', 'pageSize' => '2000']);
	}

	public function path(?string $path = null): Request
	{
		$this->path = $path;

		if (!is_null($this->path)) {
			$this->url = $this->base . "/" . $this->path;
		}

		return $this;
	}

	public function params(array $parameters = []): Request
	{
		$this->parameters = array_merge($this->parameters, $parameters);

		return $this;
	}

	public function key(string $key): Request
	{
		$this->key = $key;

		return $this;
	}

	public function get(?string $resultBaseKey = null)
	{
		return Http::withHeaders($this->headers)->get($this->url, $this->parameters)->json($resultBaseKey);
	}
}
