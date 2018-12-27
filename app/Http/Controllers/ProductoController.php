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
			'store1'  => 'edit',
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
		$producto  = ProductoRepository::paginate();
		$categoria = CategoriaRepository::paginate();
		$links     = ProductoRepository::links();
		$atributos  = AtributoRepository::all();

		$stockName = array(
			array('nombre'=>Config::EN_STOCK_LABEL,'value'=>Config::EN_STOCK),
			array('nombre'=>Config::AGOTADO_LABEL,'value'=>Config::AGOTADO),
			array('nombre'=>Config::PRONTO_LABEL,'value'=>Config::PRONTO)
		);

		$productActive = "active";
		$categoryActive = "";

		$links = formatPagination($links);

		return View::make('productos.index',
			[
			'producto' => $producto,
			'links'=>$links,
			'categoria'=>$categoria,
			'stock' => $stockName,
			'atributos'=>$atributos,
            'productActive' => $productActive,
            'categoryActive' => $categoryActive
			]);
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

    protected function getInput()
    {
        return [
            'producto'     => Binput::get('nombreProducto'),
            'codigo'       => Binput::get('codigoProducto'),
            'descripcion'  => Binput::get('descripcionProducto'),
            'id_categoria' => Binput::get('selectCategorias'),
            'id_stock'     => Binput::get('stockValue'),
			'sku'          => Binput::get('sku'),
            'precio'       => Binput::get('precio'),
            'oferta'       => Binput::get('oferta'),
            'visibilidad'  => Binput::get('visibilidad')
        ];
    }

	/**
	 * Edit a new product.
	 */
	public function editProducto(Request $request) {

		$id                    = $request->input('id_producto');

		//Get Data
		$input['producto']     = $request->input('nombreProducto');
		$input['codigo']       = $request->input('codigoProducto');
		$input['descripcion']  = $request->input('descripcionProducto');
		$input['category_id']  = $request->input('selectCategorias');
		$input['id_stock']     = $request->input('stockValue_edit');
		$input['sku']          = $request->input('sku');
		$input['id_moneda']    = 1;
		$input['precio']       = $request->input('precio');
		$input['oferta']       = $request->input('oferta');
		$input['visibilidad']  = $request->input('visibilidad_edit');
		$vinculacionList       = $request->input('productoVinculadoEdit');

		//Multiple images
		if ($request->hasfile('filename')) {

			$images = $request->file('filename');

			foreach ($images as $key => $image) {
				if (!empty($image)) {
					$name = $image->getClientOriginalName();
					$image->move(public_path() . '/images/', $name);
					$data[] = $name;
				} else
					continue;
			}

			if (!empty($data)) {
				$input['filename'] = json_encode($data);
			}
		}

		//Main image
		if ($request->hasfile('filename_main')) {

			$images_main = $request->file('filename_main');

			$name_main = $images_main->getClientOriginalName();
			$images_main->move(public_path() . '/images/', $name_main);
			$data_main[] = $name_main;

			if (!empty($data_main)) {
				$input['filename_main'] = json_encode($data_main);
			}
		}

		if(!empty($vinculacionList)) {

			//Multiple vinculacion
			foreach($vinculacionList as $nkey=>$vinc) {
				$vincArr[]  = $vinc;
			}

			if (!empty($vincArr)) {
				$input['vinculacion'] = json_encode($vincArr);
			}
		}
		else {
			$vincArr = array();
			$input['vinculacion'] = json_encode($vincArr);
		}

		$id = $request->input('id_producto');

		$atributosList  = $request->input('atributoProductoVal');

		if(!empty($atributosList))
		{
			//Multiple attributes
			foreach($atributosList as $nkey=>$atrProdID) {

				$atrProd = AtributoProductoRepository::find($nkey);

				$inputAtr['valor'] = $atrProdID;

				$atrProd->update($inputAtr);
			}
		}

		$producto = ProductoRepository::find($id);

		$producto->update($input);

		return json_encode($producto);
	}

	/**
	 * Store a new product.
	 */
	public function storeProducto(Request $request) {

		//Get Data
		$input['producto']     = $request->input('nombreProducto');
		$input['codigo']       = $request->input('codigoProducto');
		$input['descripcion']  = $request->input('descripcionProducto');
		$input['category_id']  = $request->input('selectCategorias');
		$input['id_stock']     = $request->input('stockValue_add');
		$input['sku']          = $request->input('sku');
		$input['id_moneda']    = 1;
		$input['precio']       = $request->input('precio');
		$input['oferta']       = $request->input('oferta');
		$input['visibilidad']  = $request->input('visibilidad_add');
        $vinculacionList       = $request->input('productoVinculado');

        //Multiple images
		if ($request->hasfile('filename')) {

			$images = $request->file('filename');

			foreach ($images as $key => $image) {
				if (!empty($image)) {
					$name = $image->getClientOriginalName();
					$image->move(public_path() . '/images/', $name);
					$data[] = $name;
				} else
					continue;
			}

			if (!empty($data)) {
				$input['filename'] = json_encode($data);
			}
		}

		//Main image
		if ($request->hasfile('filename_main')) {

			$images_main = $request->file('filename_main');

			$name_main = $images_main->getClientOriginalName();
			$images_main->move(public_path() . '/images/', $name_main);
			$data_main[] = $name_main;

			if (!empty($data_main)) {
				$input['filename_main'] = json_encode($data_main);
			}
		}

		if(!empty($vinculacionList)) {

            //Multiple vinculacion
            foreach($vinculacionList as $nkey=>$vinc) {
                $vincArr[]  = $vinc;
            }

            if (!empty($vincArr)) {
                $input['vinculacion'] = json_encode($vincArr);
            }
        }


		$producto = ProductoRepository::create($input);

		$atributosList  = $request->input('atributoProductoVal');

		if(!empty($atributosList)) {

		    //Multiple attributes
            foreach($atributosList as $nkey=>$atr) {
                $inputAttr['attribute_id']  = $nkey;
                $inputAttr['valor'] = $atr;
                $inputAttr['product_id'] = $producto->id;

                AtributoProductoRepository::create($inputAttr);
            }
        }

		return json_encode($producto);
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
        $idAtributo = $request->input('id_atributo');

        foreach ($atributos as $key => $atr) {
            $arr['valor'] = $atr;
        }

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

        $arr['product_id'] = $producto->id;
        $arr['attribute_id'] = $idAtributo;

        AtributoProductoRepository::create($arr);

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
