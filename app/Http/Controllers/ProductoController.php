<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use GrahamCampbell\Binput\Facades\Binput;
use GrahamCampbell\BootstrapCMS\Facades\AtributoRepository;
use GrahamCampbell\BootstrapCMS\Facades\AtributoProductoRepository;
use GrahamCampbell\BootstrapCMS\Facades\ProductoRepository;
use GrahamCampbell\BootstrapCMS\Facades\CategoriaRepository;
use GrahamCampbell\BootstrapCMS\Models\Category;
use GrahamCampbell\BootstrapCMS\Models\Product;
use GrahamCampbell\Credentials\Facades\Credentials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use GrahamCampbell\BootstrapCMS\Http\Constants as Config;

class ProductoController extends AbstractController
{
	/**
	 * Create a new instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->setPermissions([
			'create'  => 'edit',
			'store'   => 'edit',
			'edit'    => 'edit',
			'update'  => 'edit',
			'destroy' => 'edit',
		]);

        $this->producto = Product::with('getCategoryById')->get();

		parent::__construct();
	}

	/**
	 * Display a listing of products.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		$producto = ProductoRepository::paginate();
        $links = ProductoRepository::links();

        return View::make('productos.index', ['producto' => $producto,'links'=>$links]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$categorias = CategoriaRepository::all();
		$atributos  = AtributoRepository::all();

		$stockName = array(
		    array('nombre'=>Config::EN_STOCK_LABEL,'value'=>Config::EN_STOCK),
            array('nombre'=>Config::AGOTADO_LABEL,'value'=>Config::AGOTADO),
            array('nombre'=>Config::PRONTO_LABEL,'value'=>Config::PRONTO)
        );

		return View::make('productos.create',[
		    'categorias' => $categorias,
            'stock' => $stockName,
            'atributos'=>$atributos
        ]);
	}

    /**
     * Get the user input.
     *
     * @return string[]
     */
    protected function getInput()
    {
        return [
            'producto'   => Binput::get('producto'),
            'codigo'     => Binput::get('codigo'),
            'descripcion'=> Binput::get('descripcion'),
            'id_categoria' => Binput::get('id_categoria'),
            'id_stock' => Binput::get('id_stock'),
            'precio' => Binput::get('precio'),
            'oferta' => Binput::get('oferta'),
            'filename' => ''
        ];
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function store(Request $request)
    {
        $input = array_merge(
            $this->getInput()
        );

        $val = ProductoRepository::validate($input, array_keys($input));

        if ($val->fails()) {
            return Redirect::route('producto.create')->withInput()->withErrors($val->errors());
        }

        $atributos = $request->input('valor');
		$id_atributos = $request->input('id_atributo');

        if ($request->hasfile('filename')) {
            $images = $request->file('filename');

            foreach ($images as $key => $image) {
                if (!empty($image)) {
                    $name = $image->getClientOriginalName();
                    $image->move(public_path() . '/images/', $name);
                    $data[] = $name;
                } else {
                    continue;
                }
            }
        }

        if (!empty($data)) {
            $input['filename'] = json_encode($data);
        }

        $producto = ProductoRepository::create($input);

		foreach ($atributos as $key => $atr) {
			$arr['attribute_id'] = $key;
			$arr['valor'] = $atr;
			$arr['product_id'] = $producto->id;
			AtributoProductoRepository::create($arr);
		}

        return Redirect::route('producto.show', ['producto' => $producto->id])
            ->with('success', trans('messages.producto.store_success'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
        $producto = ProductoRepository::paginate();
        $links = ProductoRepository::links();

        return View::make('productos.show', ['producto' => $producto,'links'=>$links]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $producto = ProductoRepository::find($id);
        $this->checkProduct($producto);

        $categoria = CategoriaRepository::all();

        $stockName = array(
            array('nombre'=>Config::EN_STOCK_LABEL,'value'=>Config::EN_STOCK),
            array('nombre'=>Config::AGOTADO_LABEL,'value'=>Config::AGOTADO),
            array('nombre'=>Config::PRONTO_LABEL,'value'=>Config::PRONTO)
        );

        return View::make('productos.edit', [
            'producto' => $producto,
            'categorias' => $categoria,
            'stock' => $stockName]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Request  $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
        $input = Binput::only(['producto',
                                'codigo',
                                'descripcion',
                                'id_categoria',
                                'id_stock',
                                'precio',
                                'oferta']);

        $val = ProductoRepository::validate($input, array_keys($input));
        if ($val->fails()) {
            return Redirect::route('producto.edit', ['producto' => $id])->withInput()->withErrors($val->errors());
        }

        $producto = ProductoRepository::find($id);
        $this->checkProduct($producto);

        $producto->update($input);

        return Redirect::route('producto.show', ['producto' => $producto->id])
            ->with('success', trans('messages.producto.update_success'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $producto = ProductoRepository::find($id);
        $this->checkProduct($producto);

        $producto->delete();

        return Redirect::route('producto.index')
            ->with('success', trans('messages.producto.delete_success'));
	}

    /**
     * Check the product model.
     *
     * @param mixed $product
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return void
     */
    protected function checkProduct($product)
    {
        if (!$product) {
            throw new NotFoundHttpException('Producto No Encontrado');
        }
    }
}
