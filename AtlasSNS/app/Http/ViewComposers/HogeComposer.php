<?php
namespace App\Http\ViewComposers;
     
use Illuminate\View\View;
 
class HogeComposer
{
    /**
    * @var String
    */
    protected $hoge;
     
    public function __construct()
    {
        $this->hoge = 'hogehoge';
    }
     
    /**
    * Bind data to the view.
    * @param View $view
    * @return void
    */
    public function compose(View $view)
    {
        $view->with('hoge', $this->hoge);
    }
}