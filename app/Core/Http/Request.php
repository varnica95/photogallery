<?php

namespace App\Core\Http;

use App\Bags\ParameterBag;
use App\Core\Container;
use App\Core\Validation\Validator;

class Request
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @var array
     */
    protected $parameters = [];

    /**
     * Request constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->initialize();
    }

    /**
     *
     */
    protected function initialize()
    {
        $this->parameters = new ParameterBag(
            $_POST,
            $this->container->router->getParameters()
        );
    }

    /**
     * @return mixed
     */
    public function getRouteParameters()
    {
        return $this->parameters->getRouteParameters();
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        return $this->parameters->get($name);
    }

    public function all()
    {
        return $this->parameters->getPostParameters();
    }

    public function validate(array $rules)
    {
        $validator = new Validator([
            'name' => '',
            'email' => ''
        ]);

        $validator->setRules([
            //
        ]);

        $validator->validate();
    }
}