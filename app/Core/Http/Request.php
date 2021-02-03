<?php

namespace App\Core\Http;

use App\Bags\FileBag;
use App\Bags\ParameterBag;
use App\Core\Container;
use App\Core\Includes\Session;
use App\Models\User;
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

    protected $files;

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
        $this->files = new FileBag($_FILES);
        $this->parameters = new ParameterBag(
            $_POST,
            $this->files->getFiles(),
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
     * @param string $name
     * @return mixed
     */
    public function only(string $name)
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

    /**
     * @param array $rules
     * @return mixed
     */
    public function validate(array $rules)
    {
        $data = $this->all();
        if (isset($this->user()->id)){
            $data = array_merge($this->all(), ['user_id' => $this->user()->id]);
        }

        $validator = new Validator($data);

        $validator->setRules($rules);

        $validator->setAliases([
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'title' => 'Title',
            'description' => 'Description',
            'gallery_id' => 'Gallery',
            'image.type' => 'Image type',
            'current_password' => 'Current password',
            'new_password' => 'New password',
            'new_password_again' => 'New password (retype)'
        ]);

        if (! $validator->validate()) {

            if ($user = $this->user()){
                $data = array_merge($validator->getErrors(), ['user' => $user], ['galleries' => $user->galleries()]);
            }

            View::render(ControllerMap::resolve(debug_backtrace()[1]['class']), $data);

            die();
        }

        return $this->all();
    }

    /**
     * @param $name
     * @param $value
     */
    public function setSession($name, $value)
    {
        Session::set($name, $value);
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function getSession($name)
    {
        return Session::get($name);
    }

    /**
     *
     */
    public function destroySession()
    {
        Session::destroy();
    }

    /**
     * @param string $path
     */
    public function redirect(string $path)
    {
        header('Location: /' . $path, true);
        exit;
    }

    /**
     * @return mixed
     */
    public function user()
    {
        if ( empty($user = User::find(Session::get('id')))){
            return false;
        }

        unset($user->password);
        return $user;
    }
}