<?php

namespace App\Core\Http;

use App\Bags\ParameterBag;
use App\Core\Container;
use App\Core\Validation\Validator;
use App\Core\View;
use App\Maps\ControllerMap;

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

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->parameters->getPostParameters();
    }

    public function validate(array $rules)
    {
        $validator = new Validator($this->all());

        $validator->setRules($rules);

        $validator->setAliases([
            'name' => 'Name'
        ]);

        if (! $validator->validate()) {
            View::render(
                ControllerMap::resolve(debug_backtrace()[1]['class']) . '.index',
                $validator->getErrors()
            );

            die();
        }

        return $this->all();
    }
}