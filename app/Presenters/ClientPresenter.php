<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 21/10/18
 * Time: 11:05 PM
 */

namespace GrahamCampbell\BootstrapCMS\Presenters;

use McCool\LaravelAutoPresenter\BasePresenter;

class ClientPresenter extends BasePresenter {

	use OwnerPresenterTrait, ContentPresenterTrait;
}