<?php

namespace App\Http\Controllers;
use App\Http\Requests\MagentoRequestBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use  JustBetter\MagentoClient\Client\Magento;
use JustBetter\MagentoClient\Query\SearchCriteria;
use Laravel\Ui\Presets\React;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected Magento $magento;
    protected $client;
    public function __construct()
    {
        $this->middleware('auth');
        $builder = new MagentoRequestBuilder();
        $this->magento = new Magento($builder);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    

    public function index()
    {
        return redirect('/products');
    }
}
