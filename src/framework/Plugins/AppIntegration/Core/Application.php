<?php namespace Framework\Plugins\AppIntegration\Core;

use Framework\Plugins\AppIntegration\Action\Action;

class Application extends Container {

    /**
     * The request class name.
     *
     * @var string
     */
    protected static $requestClass = 'Framework\Plugins\AppIntegration\Core\Request';

    /**
     * Build an Application instance.
     */
    public function __construct()
    {
        $this->registerBaseBindings($this->createNewRequest());
        $this->registerCoreIgniters();

        // Listen to front-end request.
        Action::listen('themosis_run', $this, 'run')->dispatch();
    }

    /**
     * Create a new Request instance.
     *
     * @return \Framework\Plugins\AppIntegration\Core\Request
     */
    protected function createNewRequest()
    {
        return forward_static_call(array(static::$requestClass, 'createFromGlobals'));
    }

    /**
     * Register base framework classes into the container.
     *
     * @param Request $request
     * @return void
     */
    protected function registerBaseBindings(Request $request)
    {
        $this->instance('request', $request);
        $this->instance('Framework\Plugins\AppIntegration\Core\Container', $this);
    }

    /**
     * Register all igniter services classes.
     *
     * @return void
     */
    protected function registerCoreIgniters()
    {
        $services = array(

            'asset'         => '\Framework\Plugins\AppIntegration\Asset\AssetIgniterService',
            'field'         => '\Framework\Plugins\AppIntegration\Field\FieldIgniterService',
            'form'          => '\Framework\Plugins\AppIntegration\Html\FormIgniterService',
            'html'          => '\Framework\Plugins\AppIntegration\Html\HtmlIgniterService',
            'metabox'       => '\Framework\Plugins\AppIntegration\Metabox\MetaboxIgniterService',
            'page'          => '\Framework\Plugins\AppIntegration\Page\PageIgniterService',
            'posttype'      => '\Framework\Plugins\AppIntegration\PostType\PostTypeIgniterService',
            'router'        => '\Framework\Plugins\AppIntegration\Route\RouteIgniterService',
            'sections'      => '\Framework\Plugins\AppIntegration\Page\Sections\SectionIgniterService',
            'taxonomy'      => '\Framework\Plugins\AppIntegration\Taxonomy\TaxonomyIgniterService',
            'user'          => '\Framework\Plugins\AppIntegration\User\UserIgniterService',
            'validation'    => '\Framework\Plugins\AppIntegration\Validation\ValidationIgniterService',
            'view'          => '\Framework\Plugins\AppIntegration\View\ViewIgniterService'

        );

        foreach($services as $key => $value){

            /**
             * Register the instance name.
             * The facade call the appropriate igniterService.
             */
            $this->igniters[$key] = $value;

        }
    }

    /**
     * Add the instance to the application.
     *
     * @param string $key The facade key.
     * @param callable $closure The function that call the needed instance.
     * @return void
     */
    public function bind($key, Callable $closure)
    {
        // Send the application instance to the closure.
        // Allows the container to call the dependencies.
        $this->instances[$key] = $closure($this);
    }

    /**
     * Run the front-end application and send the response.
     *
     * @return void
     */
    public function run()
    {
        $request = $this['request'];

        $response = with($this)->handle($request);

        $response->send();
    }

    /**
     * Handle the given request and get the response.
     *
     * @param \Framework\Plugins\AppIntegration\Core\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function handle(Request $request)
    {
        try{

            return $this->dispatch($request);

        } catch(\Exception $e){

            throw $e;

        }
    }

    /**
     * Handle the given request and get the response.
     *
     * @param  \Framework\Plugins\AppIntegration\Core\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dispatch(Request $request)
    {
        return $this['router']->dispatch($request);
    }

} 